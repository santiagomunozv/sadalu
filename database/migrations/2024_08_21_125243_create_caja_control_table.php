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
        Schema::create('caja_control', function (Blueprint $table) {
            $table->bigIncrements('idCajaControl')->comment('Id');
            $table->unsignedBigInteger('caja_id')->comment('Id caja');
            $table->foreign('caja_id')->references('idCaja')->on('caja');
            $table->dateTime('fechaAperturaCajaControl')->comment('Fecha apertura');
            $table->dateTime('fechaCierreCajaControl')->comment('Fecha cierre');
            $table->decimal('baseCajaControl', 18, 2)->comment('Base');
            $table->decimal('entregadoCajaControl', 18, 2)->comment('Entregado');
            $table->unsignedBigInteger('usuario_id')->comment('Id usuario');
            $table->foreign('usuario_id')->references('idUsuario')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caja_control');
    }
};
