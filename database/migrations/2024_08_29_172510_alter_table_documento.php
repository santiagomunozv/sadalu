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
        Schema::table('documento', function (Blueprint $table) {
            $table->string('estadoDocumento')->comment('Estado');
        });

        Schema::table('caja', function (Blueprint $table) {
            $table->string('estadoCaja')->comment('Estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documento', function (Blueprint $table) {
            $table->dropColumn('estadoDocumento');
        });

        Schema::table('caja', function (Blueprint $table) {
            $table->dropColumn('estadoCaja');
        });
    }
};
