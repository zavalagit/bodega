<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPetadscripcionPetfiscalia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petadscripcion_petfiscalia', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('petfiscalia_id')->unsigned();
            $table->foreign('petfiscalia_id')->references('id')->on('petfiscalias');
            
            $table->integer('petadscripcion_id')->unsigned();
            $table->foreign('petadscripcion_id')->references('id')->on('petadscripciones');

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
        Schema::dropIfExists('petfiscalia_petadscripcion');
    }
}
