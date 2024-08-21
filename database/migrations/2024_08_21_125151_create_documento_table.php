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
        Schema::create('documento', function (Blueprint $table) {
            $table->bigIncrements('idDocumento')->comment('Id');
            $table->unsignedBigInteger('consecutivo_id')->comment('Id consecutivo');
            $table->foreign('consecutivo_id')->references('idConsecutivo')->on('consecutivo');
            $table->string('tipoDocumento')->comment('Tipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento');
    }
};
