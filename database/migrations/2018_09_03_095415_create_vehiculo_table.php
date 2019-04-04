<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dominio');
            $table->string('anio');
            $table->string('chasis');
            $table->string('motor');
            $table->string('color');
            $table->float('valor');
            $table->string('combustible');
            $table->integer('marca_id')->unsigned();
            $table->foreign('marca_id')->references('id')->on('marca');
            $table->integer('modelo_id')->unsigned();
            $table->foreign('modelo_id')->references('id')->on('modelo');
            $table->integer('carroceria_id')->unsigned();
            $table->foreign('carroceria_id')->references('id')->on('carroceria');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('cascade');
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
        Schema::dropIfExists('vehiculo');
    }
}
