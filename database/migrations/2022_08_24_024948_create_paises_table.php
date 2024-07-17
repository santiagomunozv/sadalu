<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaisesTable extends Migration
{
    public function up()
    {
        Schema::create('pais', function (Blueprint $table) {
            $table->bigIncrements('idPais')->comment('Id');
            $table->string('codigoPais');
            $table->string('nombrePais');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pais');
    }
}
