<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baja extends Model
{
    protected $table = 'bodega.bajas';

    protected $fillable = [
    	'concepto',
    	'hora',
      'fecha',
    	'numero_indicios',
    	'quien_recibe',
    	'observaciones',
    	'estado_cadena',//Se va o se queda la cadena ['x','o']
      'tipo',//baja parcial o definitiva
      'user_id',//User que entrega (Responsable de Bodega)
    	'perito_id',//User que recibe (Perito)
      'identificacion',
      'embalaje',
      'cadena_id',
    ];

   
   public function indicios(){
      return $this->belongsToMany('App\Indicio','baja_indicio','baja_id','indicio_id')
                  ->withPivot('id','baja_descripcion','baja_cantidad_indicios','baja_tipo','baja_descripcion_antes')
                  ->withTimestamps();
   }

  public function cadena(){
    return  $this->belongsTo('App\Cadena');
  }

  public function user(){
    return $this->belongsTo('App\User');
  }

  public function perito(){
    return $this->belongsTo('App\Perito');
  }  

	public function institucion(){
		return $this->belongsTo('App\Institucion');
	}

  public function fotos(){
	  return $this->morphMany('App\Foto','fotografia');
	}

}
