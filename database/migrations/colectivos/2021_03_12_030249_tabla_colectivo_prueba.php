<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaColectivoPrueba extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colectivo_prueba', function (Blueprint $table) {
            $table->increments('id');
            #colectivo_id
            $table->integer('colectivo_id')->unsigned();
            $table->foreign('colectivo_id')->references('id')->on('colectivos');
            #prueba_id
            $table->integer('prueba_id')->unsigned();
            $table->foreign('prueba_id')->references('id')->on('pruebas');
            #columnas pivote
            $table->integer('cantidad_estudios');
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
        Schema::dropIfExists('colectivo_prueba');
    }
}
