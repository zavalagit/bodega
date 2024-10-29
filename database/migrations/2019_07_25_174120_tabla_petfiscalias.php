<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPetfiscalias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petfiscalias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');

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
        Schema::dropIfExists('petfiscalias;');
    }
}
