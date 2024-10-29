<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
   protected $table = 'bodega.unidades';

   protected $fillable = ['nombre'];


   public function users(){
      return $this->hasMany('App\User');
   }

   public function cadenas(){
      return $this->hasMany('App\Cadena');
   }

   public function prestamos(){
      return $this->hasMany('App\Prestamo');
   }

   public function relacion_unidad(){
      return $this->belongsToMany('App\Unidad','relacion_unidad','unidad1_id','unidad2_id');
   }

}
