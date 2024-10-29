<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petfiscalia extends Model
{
    protected $table = 'bodega.petfiscalias';

    protected $fillable = ['nombre','fiscalia_id'];

    public function fiscalia(){
        return $this->belongsTo('App\Fiscalia');
    }

    public function petadscripciones(){
        return $this->belongsToMany('App\Petadscripcion')->withTimestamps();
    }

    public function peticiones(){
        return $this->hasMany('App\Peticion');
    }
}
