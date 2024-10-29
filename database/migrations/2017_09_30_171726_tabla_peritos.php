<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPeritos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peritos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('folio');
            $table->string('nombre');

            //institucion
            $table->integer('institucion_id')->unsigned()->nullable();
            $table->foreign('institucion_id')
                  ->references('id')->on('instituciones')
                  ->onDelete('cascade');      
            //fiscalia   
            $table->integer('fiscalia_id')->unsigned()->nullable();
            $table->foreign('fiscalia_id')
                  ->references('id')->on('fiscalias')
                  ->onDelete('cascade');
            //unidad 
            $table->integer('unidad_id')->unsigned()->nullable();
            $table->foreign('unidad_id')
                  ->references('id')->on('unidades')
                  ->onDelete('cascade');      
            //cargo
            $table->integer('cargo_id')->unsigned()->nullable();
            $table->foreign('cargo_id')
                  ->references('id')->on('cargos')
                  ->onDelete('cascade');                  

            //adscripción
            $table->integer('adscripcion_id')->unsigned()->nullable();
            $table->foreign('adscripcion_id')
                  ->references('id')->on('adscripciones')
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
        Schema::dropIfExists('resguardantes');
    }
}
