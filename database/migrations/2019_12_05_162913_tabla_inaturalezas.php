<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaInaturalezas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inaturalezas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activo');
            $table->integer('prestamo');
            $table->integer('baja');

            $table->integer('naturaleza_id')->unsigned()->nullable();
            $table->foreign('naturaleza_id')
               ->references('id')->on('naturalezas')
               ->onDelete('cascade');

            $table->integer('fiscalia_id')->unsigned()->nullable();
            $table->foreign('fiscalia_id')
               ->references('id')->on('fiscalias')
               ->onDelete('cascade');

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
        Schema::dropIfExists('inaturalezas');
    }
}
