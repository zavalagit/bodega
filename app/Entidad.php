<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
   protected $table = 'bodega.entidades';

   protected $fillable = ['nombre'];


   public function delegaciones(){
      return $this -> hasMany('App\Delegacion');
   }

}
