<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaNecropsias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('necropsias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->enum('necropsia_tipo',['hecho_transito','dolosa','suicidio','patologia_otra']);
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
        Schema::dropIfExists('necropsias');
    }
}
