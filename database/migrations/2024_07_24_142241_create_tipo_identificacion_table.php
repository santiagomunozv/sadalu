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
        Schema::create('tipo_identificacion', function (Blueprint $table) {
            $table->bigIncrements('idTipoIdentificacion')->comment('Id');
            $table->string('codigoDianTipoIdentificacion')->comment('Código Dian');
            $table->string('nombreTipoIdentificacion')->comment('Nombre');
            $table->string('estadoTipoIdentificacion')->comment('Estado');
            $table->boolean('requiereDigitoVerificationTipoIdentificacion')->comment('Requiere digito verificación');
            $table->boolean('requiereRazonSocialTipoIdentificacion')->comment('Requiere razón social');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_identificacion');
    }
};
