<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaListdepuraciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodega.listdepuraciones', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->date('fecha');
            $table->time('hora');
            $table->integer('depuracion_numindicios');
            $table->longText('observaciones')->nullable();

            //Llave foranea de solicitudes depuracion
            $table->bigInteger('soldepuracion')->unsigned();
            $table->foreign('soldepuracion')->references('id')->on('bodega.sol_depuraciones');

            //llave foranea de la cadena
            $table->bigInteger('cadena_id')->unsigned();
            $table->foreign('cadena_id')->references('id')->on('bodega.cadenas');

            //Llave foranea del usuario responsable del registro
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('bodega.users');


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
        Schema::dropIfExists('bodega.listdepuraciones');
    }
}
