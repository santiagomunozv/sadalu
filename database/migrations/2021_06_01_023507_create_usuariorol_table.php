<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariorolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuariocompaniarol', function (Blueprint $table) {
            $table->bigIncrements('idUsuarioCompaniaRol')->comment('Id');
            $table->unsignedBigInteger('usuario_id')->comment('Id usuario');
            $table->foreign('usuario_id')->references('idUsuario')->on('usuario');
            $table->unsignedBigInteger('rol_id')->comment('Id rol');
            $table->foreign('rol_id')->references('idRol')->on('rol');
            $table->unsignedBigInteger('compania_id')->comment('Id compania');
            $table->foreign('compania_id')->references('idCompania')->on('compania');
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
        Schema::dropIfExists('usuariocompaniarol');
    }
}
