<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiniestroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siniestro', function (Blueprint $table) {
            $table->increments('id');
            $table->string('conductor');
            $table->string('terceroUno');
            $table->string('dominioUno');
            $table->string('conductorUno');
            $table->string('terceroDos');
            $table->string('dominioDos');
            $table->string('conductorDos');
            $table->date('fechaSiniestro');
            $table->date('fechaDenunciaInterna');
            $table->boolean('exposicionPolicial');
            $table->boolean('fotocopiaDni');
            $table->boolean('fotocopiaCV');
            $table->boolean('fotocopiaCC');
            $table->boolean('fotocopiaVTV');
            $table->boolean('otros');
            $table->date('fechaReclamoTercero');
            $table->boolean('exposicionPolicialTercero');
            $table->boolean('fotocopiaCVTercero');
            $table->boolean('fotocopiaCCTercero');
            $table->boolean('boletaCompra');
            $table->boolean('certificadoCobertura');
            $table->boolean('denunciaAdministrativa');
            $table->float('presupuesto');
            $table->float('presupuestoDos');
            $table->float('totalPresupuesto');
            $table->float('gastosMedicos');
            $table->boolean('informeMedico');
            $table->date('fechaEnvioDI');
            $table->date('fechaEnvioRT');
            $table->date('fechaDictamen');
            $table->string('dictamen');
            $table->float('ofrecimiento');
            $table->date('vencimientoReclamo');
            $table->integer('poliza_id')->unsigned();
            $table->foreign('poliza_id')->references('id')->on('poliza')->onDelete('cascade');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('cascade');
            $table->integer('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculo')->onDelete('cascade');
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
        Schema::dropIfExists('siniestro');
    }
}
