<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caja_medio_pago', function (Blueprint $table) {
            $table->bigIncrements('idCajaMedioPago')->comment('Id');
            $table->unsignedBigInteger('caja_id')->comment('Id caja');
            $table->foreign('caja_id')->references('idCaja')->on('caja');
            $table->unsignedBigInteger('mediopago_id')->comment('Id medio pago');
            $table->foreign('mediopago_id')->references('idMedioPago')->on('medio_pago');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caja_medio_pago');
    }
};
