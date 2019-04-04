<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoCuotaPolizaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_cuota_poliza', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('numCuota');
            $table->integer('pago_id')->unsigned();
            $table->foreign('pago_id')->references('id')->on('pago')->onDelete('cascade');
            $table->integer('poliza_id')->unsigned();
            $table->foreign('poliza_id')->references('id')->on('poliza')->onDelete('cascade');
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
        Schema::dropIfExists('pago_cuota_poliza');
    }
}
