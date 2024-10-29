<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fiscalia extends Model
{
   protected $table = 'bodega.fiscalias';

   protected $fillable = ['nombre'];

   public function cadenas(){
		return $this->hasMany('App\Cadena');
   }
   
   public function entradas(){
		return $this -> hasMany('App\Entrada');
   }

	public function users(){
		return $this -> hasMany('App\User');
	}
   
   public function petfiscalias(){
		return $this -> hasMany('App\Petfiscalia');
	}
   
   public function colectivos(){
		return $this->hasMany('App\Colectivo');
	}

	public function indicios(){
      return $this->hasManyThrough('App\Indicio', 'App\Cadena');
   }
	// public function indicios_tipo($region_id,$tipo){
   //    return $this->hasManyThrough('App\Indicio', 'App\Cadena')->whereHas('cadena',function($q) use($region_id,$tipo){
	// 		if ($region_id > 0) $q->where('fiscalia_id',$region_id);
	// 		$q->where('estado','validada')->whereHas('entrada',function($a) use($tipo){
	// 			$a->where('tipo',$tipo);
	// 		});
	// 	})->sum('indicio_cantidad_disponible');
   // }

	public function indicios_tipo(array $tipo){
      return $this->hasManyThrough('App\Indicio', 'App\Cadena')->whereHas('cadena',function($q) use($tipo){
			// if ($region_id > 0) $q->where('fiscalia_id',$region_id);
			$q->where('estado','validada')->whereHas('entrada',function($a) use($tipo){
				$a->whereIn('tipo',$tipo);
			});
		})->sum('indicio_cantidad_disponible');
   }

	public static function indicios_total(int $region_id, array $tipo){
		return Indicio::whereHas('cadena',function($q) use($region_id,$tipo){
			if ($region_id > 0) $q->where('fiscalia_id',$region_id);
			$q->where('estado','validada')->whereHas('entrada',function($a) use($tipo){
				$a->whereIn('tipo',$tipo);
			});
		})->sum('indicio_cantidad_disponible');
	}
  
}
