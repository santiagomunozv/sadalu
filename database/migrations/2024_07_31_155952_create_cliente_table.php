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
        Schema::create('cliente', function (Blueprint $table) {
            $table->bigIncrements('idCliente')->comment('Id');
            $table->unsignedBigInteger('tipoidentificacion_id')->comment('Id tipo identificación');
            $table->foreign('tipoidentificacion_id')->references('idTipoIdentificacion')->on('tipo_identificacion');
            $table->integer("identificacionCliente")->comment("Identificación");
            $table->integer("digitoVerificacionCliente")->comment("Dígito verificación");
            $table->string("razonSocialCliente")->comment("Razón social");
            $table->string("nombreComercialCliente")->comment("Nombre comercial");
            $table->string("primerNombreCliente")->comment("Primer nombre");
            $table->string("segundoNombreCliente")->comment("Segundo nombre");
            $table->string("primerApellidoCliente")->comment("Primer apellido");
            $table->string("segundoApellidoCliente")->comment("Segundo apellido");
            $table->string("telefonoCliente")->comment("Teléfono");
            $table->string("celularCliente")->comment("Celular");
            $table->string("emailCliente")->comment("Email");
            $table->unsignedBigInteger('ciudad_id')->comment('Id ciudad');
            $table->foreign('ciudad_id')->references('idCiudad')->on('ciudad');
            $table->string("direccionCliente")->comment("Dirección");
            $table->string("codigoPostalCliente")->comment("Código postal");
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
        Schema::dropIfExists('cliente');
    }
};
