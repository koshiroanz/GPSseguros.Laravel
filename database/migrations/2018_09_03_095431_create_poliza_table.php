<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolizaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliza', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numPoliza');
            $table->date('vigenciaPedida');
            $table->date('vigenciaPedidaHasta');
            $table->date('vigenciaPoliza');
            $table->date('vigenciaPolizaHasta');
            $table->float('costoPoliza');
            $table->string('endoso');
            $table->string('estado');
            $table->float('sumaAsegurada');
            $table->string('numPolizaVida');
            $table->float('costoPolizaVida');
            $table->string('destino');
            $table->string('observacion');
            $table->integer('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculo')->onDelete('cascade');
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categoria');
            $table->integer('compSeguro_id')->unsigned();
            $table->foreign('compSeguro_id')->references('id')->on('companiaseguro')->onDelete('cascade');
            $table->integer('cobertura_id')->unsigned();
            $table->foreign('cobertura_id')->references('id')->on('cobertura');
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
        Schema::dropIfExists('poliza');
    }
}
