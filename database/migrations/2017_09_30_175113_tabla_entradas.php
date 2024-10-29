<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaEntradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->increments('id');

        //    $table->integer('numindicios')->nullable();
            $table->string('embalaje')->nullable();
           $table->time('hora')->nullable();
           $table->date('fecha')->nullable();
//           $table->string('cadena_quien_entrega');
//           $table->string('cadena_cargo_quien_entrega');
           $table->enum('tipo',['indicio','evidencia'])->nullable();
           //1:activo; 2:prestamo; 3:prestamo-parcial; 4:baja-parcial, 5:baja-definitiva 6:prestamo-parcial con baja-parcial
//           $table->enum('estado',['1','2','3','4','5','6'])->default('1');
           $table->string('observacion')->nullable();

/*
           $table->string('perito_entrega_nombre')->nullable();
           $table->string('perito_entrega_cargo')->nullable();
*/
           //key foranea naturalezas
           $table->integer('naturaleza_id')->unsigned()->nullable();
           $table->foreign('naturaleza_id')
           ->references('id')->on('naturalezas')
           ->onDelete('cascade');
            //key foranea delegaciones
            $table->integer('delegacion_id')->unsigned()->nullable();
            $table->foreign('delegacion_id')
            ->references('id')->on('delegaciones')
            ->onDelete('cascade');

            //persona que entraga cadena e indicios
            $table->integer('perito_id')->unsigned()->nullable();
            $table->foreign('perito_id')
               ->references('id')->on('peritos');

            ////Responsable de bodega que recibe
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
               ->references('id')->on('users');

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
        Schema::dropIfExists('entradas');
    }
}
