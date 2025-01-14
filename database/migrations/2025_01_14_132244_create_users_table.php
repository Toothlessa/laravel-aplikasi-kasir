<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("username", 100)->nullable(false)->unique("username_users_unique");
            $table->string("email", 100)->nullable(false)->unique("email_users_unique");
            $table->string("password", 100)->nullable(false);
            $table->string("token", 100)->nullable()->unique("token_users_unique");
            $table->string("refresh_token", 100)->nullable()->unique("refresh_token_users_unique");
            $table->integer("expiresIn")->nullable();
            $table->integer("created_by")->nullable();
            $table->integer("updated_by")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
