<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPeticiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peticiones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nuc');
            $table->string('oficio_numero');
            $table->string('folio_interno')->nullable();
            $table->date('fecha_peticion');
            $table->date('fecha_recepcion');
            $table->date('fecha_elaboracion')->nullable();
            $table->date('fecha_necropsia')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->string('sp_solicita');
            $table->string('sp_recibe')->nullable();
            $table->enum('documento_emitido',['dictamen','informe','certificado','salida_juzgado'])->nullable();
            $table->enum('estado',['pendiente','atendida','entregada']);
            $table->integer('cantidad_estudios')->nullable();
            $table->date('fecha_sistema')->nullable();

            //Llave foranea de de la fiscalia del mp o servidor
            $table->integer('petfiscalia_id')->unsigned()->nullable();
            $table->foreign('petfiscalia_id')
            ->references('id')->on('petfiscalias')
            ->onDelete('cascade');
            //Llave foranea de la adscripción del mp o servidor
            $table->integer('petadscripcion_id')->unsigned()->nullable();
            $table->foreign('petadscripcion_id')
            ->references('id')->on('petadscripciones')
            ->onDelete('cascade');
            //Llave foranea de solicitud
            $table->integer('solicitud_id')->unsigned()->nullable();
            $table->foreign('solicitud_id')
            ->references('id')->on('solicitudes')
            ->onDelete('cascade');
            //Llave foranea de necropsia
            $table->integer('necropsia_id')->unsigned()->nullable();
            $table->foreign('necropsia_id')
            ->references('id')->on('necropsias')
            ->onDelete('cascade');


            //Unidad a la que pertenece la peticion
            $table->integer('unidad_id')->unsigned()->nullable();
            $table->foreign('unidad_id')
            ->references('id')->on('unidades');
            // ->onDelete('cascade');
            /*
            //Adscripcion a la que pertenece la peticion
            $table->integer('unidad2_id')->unsigned()->nullable();
            $table->foreign('unidad2_id')
            ->references('id')->on('unidades')
            ->onDelete('cascade');
            */
            //Fiscalia a la cual pertenece la petecion
            $table->integer('fiscalia1_id')->unsigned()->nullable();
            $table->foreign('fiscalia1_id')
            ->references('id')->on('fiscalias');
            // ->onDelete('cascade');
            //Fiscalia en donde se elaboro la peticion
            $table->integer('fiscalia2_id')->unsigned()->nullable();
            $table->foreign('fiscalia2_id')
            ->references('id')->on('fiscalias');
            // ->onDelete('cascade');
            //Llave foranea de user (perito que realiza la petición)
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
            ->references('id')->on('users');
            // ->onDelete('cascade');


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
        Schema::dropIfExists('peticiones');
    }
}
