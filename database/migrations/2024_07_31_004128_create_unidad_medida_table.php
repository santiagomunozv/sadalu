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
        Schema::create('unidad_medida', function (Blueprint $table) {
            $table->bigIncrements('idUnidadMedida')->comment('Id');
            $table->string('codigoDianUnidadMedida')->comment('Codigo Dian');
            $table->string('simboloUnidadMedida')->comment('Símbolo');
            $table->string('nombreUnidadMedida')->comment('Nombre');
            $table->string('estadoUnidadMedida')->comment('Estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidad_medida');
    }
};
