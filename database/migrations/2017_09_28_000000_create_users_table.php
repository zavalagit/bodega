<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('folio');
            $table->string('name');
            $table->string('password');
            $table->enum('tipo',['usuario','admin_peticiones','responsable_bodega','director_unidad','director_fiscalia','coordinador','fiscal','administrador']);

            
            //institucion
            $table->integer('institucion_id')->unsigned();
            $table->foreign('institucion_id')
                  ->references('id')->on('instituciones')
                  ->onDelete('cascade');      
            //fiscalia   
            $table->integer('fiscalia_id')->unsigned();
            $table->foreign('fiscalia_id')
                  ->references('id')->on('fiscalias')
                  ->onDelete('cascade');
            //unidad 
            $table->integer('unidad_id')->unsigned();
            $table->foreign('unidad_id')
                  ->references('id')->on('unidades')
                  ->onDelete('cascade');      
            //cargo
            $table->integer('cargo_id')->unsigned();
            $table->foreign('cargo_id')
                  ->references('id')->on('cargos')
                  ->onDelete('cascade');


            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
