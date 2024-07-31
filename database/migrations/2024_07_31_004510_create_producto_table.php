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
        Schema::create('producto', function (Blueprint $table) {
            $table->bigIncrements('idProducto')->comment('Id');
            $table->string('codigoProducto')->comment('Código');
            $table->string('nombreProducto')->comment('Nombre');
            $table->string('eanProducto')->comment('EAN');
            $table->string('imagenProducto')->comment('Imagen');
            $table->unsignedBigInteger('tipoproducto_id')->comment('Id tipo producto');
            $table->foreign('tipoproducto_id')->references('idTipoProducto')->on('tipo_producto');
            $table->unsignedBigInteger('marca_id')->comment('Id marca');
            $table->foreign('marca_id')->references('idMarca')->on('marca');
            $table->unsignedBigInteger('unidadmedida_id')->comment('Id unidad medida');
            $table->foreign('unidadmedida_id')->references('idUnidadMedida')->on('unidad_medida');
            $table->string('estadoProducto')->comment('Estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
};
