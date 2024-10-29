<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
   protected $table = "bodega.lugares";

   protected $fillable = ['nombre'];

   public function indicios(){
      return $this->hasMany('App\Indicio');
   }
}
