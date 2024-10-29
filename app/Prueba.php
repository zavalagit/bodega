<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    protected $table = 'bodega.pruebas';

    protected $fillable = ['nombre,'];

    public function colectivo(){
        $this->belongsToMany('App\Colectivo')->withPivot('id','colectivo_id','prueba_otro','prueba_cim','cantidad_estudios')->withTimestamps();
    }
}
