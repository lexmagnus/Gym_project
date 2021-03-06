<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('username')->unique();
            $table->boolean('isAdmin')->default(0);
            $table->boolean('isInst')->default(0);
            $table->string('email')->unique();
            $table->string('avatar')->default('default.jpg');
            $table->string('password');
            $table->string('verifyToken')->nullable();
            //colocado a 1 para podermos fazer teste sem ter que confirmar sempre o email...
            $table->boolean('status')->default(0);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
