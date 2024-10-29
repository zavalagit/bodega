<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Naturaleza extends Model
{
   protected $table = 'bodega.naturalezas';

   protected $fillable = ['id','nombre'];

   //Relaciones
   public function cadenas(){
      return $this -> hasMany('App\Cadena');
   }
   public function indicios(){
      return $this->hasManyThrough('App\Indicio', 'App\Cadena');
   }
   public function indicios_region($region_id){
      return $this->hasManyThrough('App\Indicio', 'App\Cadena')->whereHas('cadena',function($q) use($region_id){
			$q->where('fiscalia_id',$region_id)->where('estado','validada')->whereHas('entrada',function($a){
            $a->whereIn('tipo',['indicio','evidencia']);
         });
		})->sum('indicio_cantidad_disponible');
   }
}
