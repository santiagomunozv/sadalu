<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulo', function (Blueprint $table) {
            $table->bigIncrements('idModulo')->comment('Id');
            $table->string('nombreModulo')->comment('Nombre');
            $table->string('iconoModulo')->nullable()->comment('Icono');
            $table->unsignedBigInteger('paquete_id')->comment('Id paquete');
            $table->foreign('paquete_id')->references('idPaquete')->on('paquete');
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
        Schema::dropIfExists('modulo');
    }
}
