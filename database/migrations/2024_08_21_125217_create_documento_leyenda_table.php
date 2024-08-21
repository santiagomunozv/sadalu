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
        Schema::create('documento_leyenda', function (Blueprint $table) {
            $table->bigIncrements('idDocumentoLeyenda')->comment('Id');
            $table->unsignedBigInteger('documento_id')->comment('Id documento');
            $table->foreign('documento_id')->references('idDocumento')->on('documento');
            $table->integer('posicionDocumentoLeyenda')->comment('Posición');
            $table->string('mensajeDocumentoLeyenda')->comment('Mensaje');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_leyenda');
    }
};
