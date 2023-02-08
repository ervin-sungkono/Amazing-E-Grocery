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
            $table->id('user_id');
            $table->unsignedBigInteger('role_id')->foreign()->references('role_id')->on('roles');
            $table->unsignedBigInteger('gender_id')->foreign()->references('gender_id')->on('genders');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('display_picture_link');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
