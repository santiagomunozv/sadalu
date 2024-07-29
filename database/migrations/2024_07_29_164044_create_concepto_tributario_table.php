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
        Schema::create('concepto_tributario', function (Blueprint $table) {
            $table->bigIncrements('idConceptoTributario')->comment('Id');
            $table->string('nombreConceptoTributario')->comment('Nombre');
            $table->string('grupoConceptoTributario')->comment('Grupo');
            $table->string('tipoConceptoTributario')->comment('Tipo');
            $table->string('operacionConceptoTributario')->comment('Operación');
            $table->string('operadorConceptoTributario')->comment('Operador');
            $table->decimal('baseConceptoTributario', 18, 2)->comment('Base');
            $table->decimal('tarifaConceptoTributario', 18, 2)->comment('Tarifa');
            $table->string('codigoDianConceptoTributario')->comment('Código Dian');
            $table->string('nombreDianConceptoTributario')->comment('Nombre Dian');
            $table->string('estadoConceptoTributario')->comment('Estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('concepto_tributario');
    }
};
