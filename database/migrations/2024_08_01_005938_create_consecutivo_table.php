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
        Schema::create('consecutivo', function (Blueprint $table) {
            $table->bigIncrements('idConsecutivo')->comment('Id');
            $table->integer('numeroConsecutivo')->comment('Consecutivo');
            $table->string('nombreConsecutivo')->comment('Nombre');
            $table->string('tipoConsecutivo')->comment('Tipo');
            $table->string('estadoConsecutivo')->comment('Estado');
            $table->string('resolucionConsecutivo')->comment('Resolución');
            $table->string('prefijoConsecutivo')->comment('Prefijo');
            $table->date('fechaInicioConsecutivo')->comment('Fecha inicio');
            $table->date('fechaFinConsecutivo')->comment('Fecha fin');
            $table->integer('numeroInicioConsecutivo')->comment('Número inicial');
            $table->integer('numeroFinConsecutivo')->comment('Número final');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consecutivo');
    }
};
