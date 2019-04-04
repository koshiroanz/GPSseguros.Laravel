<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenSiniestroClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagen_siniestro_cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->integer('asegurado');
            $table->integer('siniestro_id')->unsigned();
            $table->foreign('siniestro_id')->references('id')->on('siniestro')->onDelete('cascade');
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
        Schema::dropIfExists('imagen_siniestro_cliente');
    }
}
