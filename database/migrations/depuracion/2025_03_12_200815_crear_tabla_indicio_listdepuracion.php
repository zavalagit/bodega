<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaIndicioListdepuracion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depuracion_indicio', function (Blueprint $table) {
            $table->bigIncrements('id');

            //llave foranea del del indicio
            $table->bigInteger('indicio_id')->unsigned();
            $table->foreign('indicio_id')->references('id')->on('bodega.indicios');

            //llave foranea del del indicio
            $table->bigInteger('depuracion_id')->unsigned();
            $table->foreign('listdepuracion_id')->references('id')->on('bodega.listdepuraciones');

            $table->Integer('depuracion_cantidad_indicios');
            $table->string('listdepuracion_tipo');

            $table->timestamps();

            $table->longText('depuracion_descripcion')->nullable();
            $table->longText('depuracion_descripcion_antes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depuracion_indicio');
    }
}
