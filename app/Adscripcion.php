<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adscripcion extends Model
{
	protected $table = 'bodega.adscripciones';

	protected $fillable = ['nombre'];


	public function peticiones(){
		return $this->hasMany('App\Peticion');
	}
	
}
