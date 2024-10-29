<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;


class Cadena extends Model
{
   protected $table = 'bodega.cadenas';

   protected $fillable = [
      'bodega',
      'nuc',
      'folio',
      'intervencion_lugar',
      'intervencion_hora',
      'intervencion_fecha',
      'motivo',
      'escrito',
      'fotografico',
      'croquis',
      'otro',
      'especifique',
      'embalaje',
      'traslado',
      'trasladoCondiciones',
      'trasladoRecomendaciones',
      'estado',
      'nota',
      'observacion',
      'unidad_id',
      'user_id',
   ];

   public function indicios(){
      return $this->hasMany('App\Indicio');
   }

   public function unidad(){
      return $this->belongsTo('App\Unidad');
   }
   
   public function fiscalia(){
      return $this->belongsTo('App\Fiscalia');
   }

   //Perito que hace la cadena
   public function user(){
      return $this->belongsTo('App\User','user_id');
   }

   //Peritos o Servidores Publicos que intervienen en cadena
   public function users(){
      return $this->belongsToMany('App\User')->withPivot('etapa')->withTimestamps();
   }

   public function entrada(){
      return $this->hasOne('App\Entrada');
   }

   public function prestamos(){
      return $this->hasMany('App\Prestamo');
   }

   public function bajas(){
      return $this->hasMany('App\Baja');
   }


   public function scopeBuscar($query, $busqueda){
      return $query->where('user_id',Auth::user()->id)
                  ->where(function($q) use($busqueda){
                     $q->where('folio_bodega','like','%'.$busqueda.'%')
                        ->orWhere('nuc','like','%'.$busqueda.'%')
                        /*
                        ->orWhere('nuc_ci','like','%'.$busqueda.'%')
                        ->orWhere('nuc_otro','like','%'.$busqueda.'%')
                        */
                        ->orWhereHas('indicios',function($q) use ($busqueda){
                           $q->where('descripcion','like',"%{$busqueda}%");
                        });
                  });
                  
                  
   }

   public function scopePerito($query,$perito){
      return $query->where('user_id',$perito);
   }
}
