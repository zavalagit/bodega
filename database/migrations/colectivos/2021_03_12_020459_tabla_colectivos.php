<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaColectivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::disableForeignKeyConstraints();
        Schema::create('colectivos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('colectivo_folio')->nullable();
            $table->string('colectivo_persona')->nullable();
            $table->date('colectivo_fecha')->nullable();
            $table->enum('documento_emitido',['tarjeta_informativa'])->default('tarjeta_informativa');
            #llave fonaria users
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('utpyme.users');
            #llave fonaria region
            $table->bigInteger('fiscalia_id')->unsigned();
            $table->foreign('fiscalia_id')->references('id')->on('utpyme.fiscalias');
            
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
        Schema::dropIfExists('colectivos');
    }
}
