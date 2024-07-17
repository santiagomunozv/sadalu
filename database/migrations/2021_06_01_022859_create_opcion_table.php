<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opcion', function (Blueprint $table) {
            $table->bigIncrements('idOpcion')->comment('Id');
            $table->string('nombreOpcion')->comment('Nombre');
            $table->string('rutaOpcion')->comment('Ruta');
            $table->string('iconoOpcion')->nullable()->comment('Icono');
            $table->unsignedBigInteger('modulo_id')->comment('Id modulo');
            $table->foreign('modulo_id')->references('idModulo')->on('modulo');
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
        Schema::dropIfExists('opcion');
    }
}
