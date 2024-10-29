<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaIndicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicios', function (Blueprint $table) {
            $table->increments('id');

            $table->string('identificador');
            $table->longText('descripcion');
            //Ubicación del indicio
            $table->longText('indicio_ubicacion_lugar')->nullable();
            $table->longText('recolectado_de')->nullable(); //Modificacion
            $table->time('hora')->nullable();
            $table->date('fecha')->nullable();
            //Recolección
            $table->enum('recoleccion',['manual','instrumental'])->default('manual');
            //Embalaje
            $table->enum('embalaje',['bolsa','caja','recipiente'])->default('bolsa');

            //numero de indicios
            $table->integer('numero_indicios')->nullable();
            
            //Etiqueta
            //Condición o estado del indicio al llegar a bodega
            $table->string('condicion')->nullable();
            $table->longText('observacion')->nullable();

            //Estado del indicio; 1:activo, 2:prestamo, 3:baja
            $table->enum('estado',['activo','prestamo','baja'])->default('activo');


            //Lugar de resguardo del indicio que no sea un lugar, charola o caja
            $table->longText('resguardo')->nullable();


            $table->integer('cadena_id')->unsigned()->nullable();
            $table->foreign('cadena_id')
               ->references('id')->on('cadenas');
            
            $table->integer('ubicacion_id')->unsigned()->nullable();
            $table->foreign('ubicacion_id')
               ->references('id')->on('ubicaciones');

            $table->integer('baja_id')->unsigned()->nullable();
            $table->foreign('baja_id')
               ->references('id')->on('bajas');

/*
            $table->string('cedula_folio')->nullable();
            $table->foreign('cedula_folio')
               ->references('folio')->on('cedulas');
*/
/*

            $table->integer('lugar_id')->unsigned()->nullable();
            $table->foreign('lugar_id')
               ->references('id')->on('lugares');
/*
            $table->integer('charola_id')->unsigned()->nullable();
            $table->foreign('charola_id')
               ->references('id')->on('charolas');

            $table->integer('caja_id')->unsigned()->nullable();
            $table->foreign('caja_id')
               ->references('id')->on('cajas');
*/
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
        Schema::dropIfExists('descripciones');
    }
}
