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
        Schema::table('compania', function (Blueprint $table) {
            $table->unsignedBigInteger('tipoidentificacion_id')->nullable()->comment('Id tipo identificación');
            $table->foreign('tipoidentificacion_id')->references('idTipoIdentificacion')->on('tipo_identificacion');
            $table->integer("identificacionCompania")->comment("Identificación")->nullable();
            $table->integer("digitoVerificacionCompania")->comment("Dígito verificación")->nullable();
            $table->string("razonSocialCompania")->comment("Razón social")->nullable();
            $table->string("nombreComercialCompania")->comment("Nombre comercial")->nullable();
            $table->string("telefonoCompania")->comment("Teléfono")->nullable();
            $table->string("celularCompania")->comment("Celular")->nullable();
            $table->string("emailCompania")->comment("Email")->nullable();
            $table->unsignedBigInteger('ciudad_id')->nullable()->comment('Id ciudad');
            $table->foreign('ciudad_id')->references('idCiudad')->on('ciudad');
            $table->string("direccionCompania")->comment("Dirección")->nullable();
            $table->string("codigoPostalCompania")->comment("Código postal")->nullable();
            $table->string("paginaWebCompania")->comment("Código postal")->nullable();
            $table->string('logoCompania')->comment('Logo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compania', function (Blueprint $table) {
            $table->dropForeign('tipoidentificacion_id');
            $table->dropColumn('ciudad_id');

            $table->dropColumn('tipoidentificacion_id');
            $table->dropColumn('identificacionCompania');
            $table->dropColumn('digitoVerificacionCompania');
            $table->dropColumn('razonSocialCompania');
            $table->dropColumn('nombreComercialCompania');
            $table->dropColumn('telefonoCompania');
            $table->dropColumn('celularCompania');
            $table->dropColumn('emailCompania');
            $table->dropColumn('ciudad_id');
            $table->dropColumn('direccionCompania');
            $table->dropColumn('codigoPostalCompania');
            $table->dropColumn('paginaWebCompania');
            $table->dropColumn('logoCompania');
        });
    }
};
