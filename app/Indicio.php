<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicio extends Model
{
   protected $table = 'bodega.indicios';

   protected $fillable = [
      'identificador',
      'descripcion',
      'indicio_ubicacion_lugar',
      'recolectado_de',//Modificación Química
      'hora',
      'fecha',
      'recoleccion',
      'embalaje',
      'numero_indicios', //se registra en Entradas
      'condicion',
      'observacion',
      'estado',
      'resguardo',
      'cadena_id',      
      'baja_id',
      'list_destru'
   ];

   public function cadena(){
      return $this->belongsTo('App\Cadena');
   }

   public function prestamos(){
      return $this->belongsToMany('App\Prestamo')->withTimestamps();
   }

   public function ubicacion(){
      return $this->belongsTo('App\Ubicacion');
   }

   public function bajas(){
      return $this->belongsToMany('App\Baja')->withPivot('id','baja_descripcion','baja_cantidad_indicios','baja_tipo','baja_descripcion_antes');
   }

   public function depuraciones(){
      return $this->belongsToMany('App\Depuracion')->withPivot('id','depuracion_cantidad_indicios','listdepuracion_tipo')->withTimestamps();
   }

   public function arma(){
        return $this->hasOne('App\Arma');
   }

   public function indicio_region($region_id){
      return Indicio::whereHas('cadena',function($q) use($region_id){
         $q->where('fiscalia_id',$region_id);
      })->sum('indicio_cantidad_disponible');
   }
   
   public static function indicios_naturaleza($naturaleza_id){
      return Indicio::whereHas('cadena',function($q) use($naturaleza_id){
                        if($naturaleza_id > 0) $q->where('naturaleza_id',$naturaleza_id);
                        $q->where('estado','validada')
                        ->whereHas('entrada',function($a){
                           $a->whereIn('tipo',['indicio','evidencia']);
                        });
                     })
                     ->sum('indicio_cantidad_disponible');
   }
}
