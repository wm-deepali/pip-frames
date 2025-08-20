<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 191)->unique();           // Username
            $table->string('name', 191);                          // Full name
            $table->string('email', 191)->unique();               // Email
            $table->string('phone', 15)->nullable();              // Phone number
            $table->enum('role', ['admin', 'user'])->nullable();      // User role
            $table->string('company')->nullable();           // Company name
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable(); // Gender
            $table->date('birth_date')->nullable();          // Birth date

            $table->timestamp('email_verified_at')->nullable(); // Email verification
            $table->string('password');                         // Hashed password

            $table->string('profile_img')->nullable();       // Profile image
            $table->string('logo_img')->nullable();          // Logo image

            $table->rememberToken();                         // Remember me token
            $table->timestamps();                            // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
