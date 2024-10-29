<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perito extends Model
{
    protected $table = 'bodega.peritos';

    protected $fillable = [
    	'nombre','folio','institucion_id','fiscalia_id','unidad_id','cargo_id','adscripcion_id'
	];


	public function institucion(){
	  return $this->belongsTo('App\Institucion');
	}	

	public function unidad(){
	  return $this->belongsTo('App\Unidad');
	}	

	public function cargo(){
	  return $this->belongsTo('App\Cargo');
	}

	public function adscripcion(){
		return $this->belongsTo('App\Adscripcion');
	}
}
