<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolopcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rolopcion', function (Blueprint $table) {
            $table->bigIncrements('idRolOpcion')->comment('Id');
            $table->boolean('adicionarRolOpcion')->comment('Adicionar');
            $table->boolean('modificarRolOpcion')->comment('Modificar');
            $table->boolean('eliminarRolOpcion')->comment('Eliminar');
            $table->boolean('consultarRolOpcion')->comment('Consultar');
            $table->boolean('inactivarRolOpcion')->comment('Inactivar');
            $table->unsignedBigInteger('rol_id')->comment('Id rol');
            $table->foreign('rol_id')->references('idRol')->on('rol');
            $table->unsignedBigInteger('opcion_id')->comment('Id opcion');
            $table->foreign('opcion_id')->references('idOpcion')->on('opcion');
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
        Schema::dropIfExists('rolopcion');
    }
}
