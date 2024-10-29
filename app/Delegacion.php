<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delegacion extends Model
{
   protected $table = 'bodega.delegaciones';

   protected $fillable = ['nombre'];

   public function cadenas(){
      return $this -> hasMany('App\Cadena');
   }

   public function cedulas(){
      return $this -> hasMany('App\Cedula');
   }
}
