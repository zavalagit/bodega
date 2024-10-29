<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaBajas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bajas', function (Blueprint $table) {
            $table->increments('id');

            $table->longText('concepto');
            $table->time('hora');
            $table->date('fecha');
            $table->integer('numero_indicios');
            $table->string('quien_recibe')->nullable();
            //IFE, INE, ETC
            $table->string('identificacion')->nullable();
            $table->longText('observaciones')->nullable();
            //Embalaje
            $table->longText('embalaje')->nullable();
            $table->enum('estado_cadena',['o','x']);
            $table->enum('tipo',['parcial','definitiva','pertenencia']);

            //User que entrega(Responsable de Bodega)
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
               ->references('id')->on('users');

            //quien recibe baja
            $table->integer('perito_id')->unsigned()->nullable();
            $table->foreign('perito_id')
               ->references('id')->on('peritos');

            //id de la cadena
            $table->integer('cadena_id')->unsigned();
            $table->foreign('cadena_id')
               ->references('id')->on('cadenas');

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
        Schema::dropIfExists('bajas');
    }
}
