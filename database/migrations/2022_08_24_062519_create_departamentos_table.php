<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentosTable extends Migration
{

    public function up()
    {
        Schema::create('departamento', function (Blueprint $table) {
            $table->bigIncrements('idDepartamento')->comment('Id');
            $table->unsignedBigInteger('pais_id')->comment('Id pais');
            $table->foreign('pais_id')->references('idPais')->on('pais');
            $table->string('codigoDepartamento');
            $table->string('nombreDepartamento');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departamento');
    }
}
