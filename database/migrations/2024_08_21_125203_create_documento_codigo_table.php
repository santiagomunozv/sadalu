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
        Schema::create('documento_codigo', function (Blueprint $table) {
            $table->bigIncrements('idDocumentoCodigo')->comment('Id');
            $table->unsignedBigInteger('documento_id')->comment('Id documento');
            $table->foreign('documento_id')->references('idDocumento')->on('documento');
            $table->string('codigoDocumentoCodigo')->comment('Código');
            $table->string('etiquetaDocumentoCodigo')->comment('Etiqueta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_codigo');
    }
};
