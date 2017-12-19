<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('contacto')->nullable();
            $table->string('nascimento')->nullable();
            $table->integer('nif')->nullable();
            $table->enum('sexo', array('Feminino', 'Masculino'))->nullable();
            $table->float('peso')->nullable();
            $table->float('altura')->nullable();
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('morada_id')->unsigned()->index()->nullable();
            $table->foreign('morada_id')->references('id')->on('moradas');
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
        Schema::dropIfExists('pessoas');
    }
}
