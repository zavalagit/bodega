<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Embalaje extends Model
{
   protected $table = 'embalajes';

   protected $fillable = ['nombre'];

   public function cedulas(){
      return $this -> hasMany('App\Cedula');
   }


}
