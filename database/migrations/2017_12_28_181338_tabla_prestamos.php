<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPrestamos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->increments('id');

            //Campos prestamo
            $table->string('prestamo_ordena');
            $table->time('prestamo_hora');
            $table->date('prestamo_fecha');
            $table->integer('prestamo_numindicios');
            //Campos reingreso
            $table->time('reingreso_hora')->nullable();
            $table->date('reingreso_fecha')->nullable();
            $table->integer('reingreso_numindicios')->nullable();
            //estado del pretsamo
            $table->enum('estado',['activo','concluso'])->default('activo');
            //Responsable de bodega que entrega
            $table->integer('user1_id')->unsigned();//prestamo_entrega
            $table->foreign('user1_id')
               ->references('id')->on('users');
            //Resguardante se lleva indicios
            $table->integer('perito1_id')->unsigned();//prestamo_recibe
            $table->foreign('perito1_id')
               ->references('id')->on('peritos');
            //Resguardante entrega indicios
            $table->integer('perito2_id')->unsigned()->nullable();//reingreso_entrega
            $table->foreign('perito2_id')
               ->references('id')->on('peritos');
            ////Responsable de bodega que recibe
            $table->integer('user2_id')->unsigned()->nullable();//reingreso_recibe
            $table->foreign('user2_id')
               ->references('id')->on('users');
            //id de la cadena
            $table->integer('cadena_id')->unsigned()->nullable();//reingreso_recibe
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
        Schema::dropIfExists('prestamos');
    }
}
