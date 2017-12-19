<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_client', function (Blueprint $table) {
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('pessoa_id')
                  ->on('clientes')->onDelete('cascade');
      
            $table->integer('service_id')->unsigned()->nullable();
            $table->foreign('service_id')->references('id')
                  ->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_client');
    }
}
