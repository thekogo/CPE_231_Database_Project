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
            $table->string('firstName');
            $table->string('lastName');
            $table->string('nickName');
            $table->date('birthday');
            $table->text('address');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('phoneNumber');
            $table->string('email')->unique();
            $table->string('facebook')->nullable();
            $table->rememberToken();
            $table->text('profileImgUrl')->nullable();
            $table->string('role')->default('student');
            $table->timestamps();
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
