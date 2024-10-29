<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
   protected $table = 'categorias';

   protected $fillable = ['nombre'];


   public function cadenas(){
      return $this -> hasMany('App\Cadena');
   }
   
}
