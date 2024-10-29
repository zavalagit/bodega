<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
	protected $table = 'bodega.entradas';

	protected $fillable = [
		'embalaje',
		'hora',
		'fecha',
		'tipo',
		'observacion',
		'naturaleza_id',
		'delegacion_id',
		'perito_id',//Quien entrega (perito)
		'user_id',//Quien recibe (responsable de bodega)
		'cadena_id',//A que cadena pertenece 
	];


	public function cadena(){
		return $this->belongsTo('App\Cadena');
	}

	public function naturaleza(){
      return $this->belongsTo('App\Naturaleza');
   }

	public function perito(){
      return $this->belongsTo('App\Perito','perito_id');
   }

   public function user(){
      return $this->belongsTo('App\User');
   }

   public function scopeBuscar($query, $busqueda){
//      return $query->where('folio','like','%'.$busqueda.'%')
//                  ->orWhere('nuc','like','%'.$busqueda.'%');

//		return $query->join()
   }

}
