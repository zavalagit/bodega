<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaIfiscalias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ifiscalias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('indicio_activo');
            $table->integer('indicio_prestamo');
            $table->integer('indicio_baja');
            $table->integer('evidencia_activo');
            $table->integer('evidencia_prestamo');
            $table->integer('evidencia_baja');

            $table->integer('fiscalia_id')->unsigned()->nullable();
            $table->foreign('fiscalia_id')
               ->references('id')->on('fiscalias')
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
        Schema::dropIfExists('ifiscalias');
    }
}
