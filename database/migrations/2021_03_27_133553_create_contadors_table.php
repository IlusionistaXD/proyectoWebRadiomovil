<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contadors', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->integer('movil');
            $table->integer('parada');
            $table->integer('promocion');
            $table->integer('permiso');
            $table->integer('tarifa');
            $table->integer('servicio');
            $table->integer('viaje');
            $table->integer('reporte');
            $table->integer('estadistica');
            $table->string('fecha');
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
        Schema::dropIfExists('contadors');
    }
}
