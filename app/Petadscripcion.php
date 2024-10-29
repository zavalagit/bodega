<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petadscripcion extends Model
{
    protected $table = 'bodega.petadscripciones';

   protected $fillable = ['nombre'];

    public function petfiscalias(){
        return $this->belongsToMany('App\Petfiscalia')->withTimestamps();
    }

    public function peticiones(){
        return $this->hasMany('App\Peticion');
    }
}
