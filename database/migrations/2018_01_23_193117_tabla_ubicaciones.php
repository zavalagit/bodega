<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaUbicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->year('anio')->nullable();

            $table->integer('naturaleza_id')->unsigned()->nullable();
            $table->foreign('naturaleza_id')
               ->references('id')->on('naturalezas');
            
            $table->integer('fiscalia_id')->unsigned();
            $table->foreign('fiscalia_id')
               ->references('id')->on('fiscalias');
            
            

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
        Schema::dropIfExists('ubicaciones');
    }
}
