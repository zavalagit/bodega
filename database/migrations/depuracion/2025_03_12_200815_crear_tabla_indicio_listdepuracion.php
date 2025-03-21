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
        Schema::create('indicio_listdepuracion', function (Blueprint $table) {
            $table->bigIncrements('id');

            //llave foranea del del indicio
            $table->bigInteger('indicio_id')->unsigned();
            $table->foreign('indicio_id')->references('id')->on('bodega.indicios');

            //llave foranea del del indicio
            $table->bigInteger('listdepuracion_id')->unsigned();
            $table->foreign('listdepuracion_id')->references('id')->on('bodega.listdepuraciones');

            $table->Integer('depuracion_cantidad_indicios');
            $table->string('listdepuracion_tipo');

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
        Schema::dropIfExists('indicio_listdepuracion');
    }
}
