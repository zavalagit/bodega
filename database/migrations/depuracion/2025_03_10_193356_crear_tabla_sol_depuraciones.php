<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSolDepuraciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodega.sol_depuraciones', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nuc');
            $table->string('folio_interno');
            $table->date('fecha_solicitud');
            $table->string('M_P_solicitud')->nullable();
            $table->string('unidad_solicitud')->nullable();

            $table->date('fecha_recepcion_solicitud');
            $table->longText('observaciones')->nullable();

            //Llave foranea de que perito hizo el registro
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
        Schema::dropIfExists('bodega.sol_depuraciones');
    }
}
