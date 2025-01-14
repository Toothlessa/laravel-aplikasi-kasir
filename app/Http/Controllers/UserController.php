<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        /* check if Username exists */
        if(User::where("username", $data["username"])->count()==1){
            throw new HttpResponseException(response([
                "errors"=> [
                    "USERNAME_EXISTS"
                ]
            ], 400));
        }

        /* check if email exist */
        if(User::where("email", $data["email"])->count()==1){
            throw new HttpResponseException(response([
                "errors"=> [
                    "USERNAME_EXISTS"
                ]
            ], 400));
        }

        $user = new User($data);
        $user->password = Hash::make($data['password']);
        $user->token = Str::uuid()->toString();
        $user->expiresIn = 10000;
        $user->save();

        return (new UserResource($user))->response()->setStatusCode(201);
        
    }
}
