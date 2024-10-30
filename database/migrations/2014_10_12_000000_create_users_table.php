<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->string('username')->unique()->nullable();
            $table->string('phone')->unique();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->boolean('status')->default(true);
            $table->date('birthdate')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade'); // The user following
            $table->foreignId('following_id')->constrained('users')->onDelete('cascade'); // The user being followed
            $table->timestamps();

            $table->unique(['follower_id', 'following_id']); // Prevent duplicate entries
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
};
