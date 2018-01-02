<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstrutorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrutors', function (Blueprint $table) {
            $table->integer('salario')->nullable();
            $table->enum('categoria', array('Personal Training Yoga', 'Personal Training Pilates', 'Personal Training'))->nullable();
            $table->integer('pessoa_id')->unsigned()->unique();
            $table->primary('pessoa_id');
            $table->foreign('pessoa_id')->references('id')->on('pessoas')->onDelete('cascade');
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
        Schema::dropIfExists('instrutors');
    }
}
