<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testRegisterSuccess()
    {
        $this->post('api/users',
        [
            "username" => "test",
            "email" => "email@tes.com",
            "password" => "rahasia",
        ])->assertStatus(201)
        ->assertJson(
            [
                "data" => [
                    "username" => "test",
                    "email" => "email@tes.com",
                ]
                ]);
    }
}
