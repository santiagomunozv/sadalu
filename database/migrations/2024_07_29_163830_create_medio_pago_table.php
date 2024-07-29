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
        Schema::create('medio_pago', function (Blueprint $table) {
            $table->bigIncrements('idMedioPago')->comment('Id');
            $table->string('codigoDianMedioPago')->comment('Código Dian');
            $table->string('nombreMedioPago')->comment('Nombre');
            $table->string('estadoMedioPago')->comment('Estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medio_pago');
    }
};
