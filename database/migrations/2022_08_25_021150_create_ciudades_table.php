<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCiudadesTable extends Migration
{

    public function up()
    {
        Schema::create('ciudad', function (Blueprint $table) {
            $table->bigIncrements('idCiudad')->comment('Id');
            $table->unsignedBigInteger('departamento_id')->comment('Id departamento');
            $table->foreign('departamento_id')->references('idDepartamento')->on('departamento');
            $table->string('codigoCiudad');
            $table->string('nombreCiudad');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ciudades');
    }
}
