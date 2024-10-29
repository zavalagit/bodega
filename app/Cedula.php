<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cedula extends Model
{
   protected $table = "cedulas";

   protected $primaryKey = 'folio';
   public $incrementing = false;
   protected $keyType = 'string';

   protected $fillable = [
      'folio',
      'nuc',
      'numindicios',
      'embalaje',
      'hora',
      'fecha',
      'cadena_quien_entrega',//quien entrega
      'cadena_cargo_quien_entrega',
      'tipo',
      'estado',
      'observacion',
      'unidad_id',
      'naturaleza_id',
      'delegacion_id',
      'user_id',//Quien recibe (responsable de bodega)
   ];

   public function usuario(){
      return $this->belongsTo('App\Usuario');
   }

   public function delegacion(){
      return $this->belongsTo('App\Delegacion');
   }

   public function categoria(){
      return $this->belongsTo('App\Categoria');
   }

   public function embalaje(){
      return $this->belongsTo('App\Embalaje');
   }

   public function entidad(){
      return $this->belongsTo('App\Entidad');
   }

   public function fiscalia(){
      return $this->belongsTo('App\Fiscalia');
   }

   public function unidad(){
      return $this->belongsTo('App\Unidad');
   }

   public function naturaleza(){
      return $this->belongsTo('App\Naturaleza');
   }

   public function cargo(){
      return $this->belongsTo('App\Cargo');
   }

   public function indicios(){
      return $this->hasMany('App\Indicio');
   }

   public function prestamos(){
      return $this->hasMany('App\Prestamo');
   }

   //Quien recibe
   //Un cedula es recibida por un usuario responsable de bodega
   public function user(){
      return $this->belongsTo('App\User');
   }


   public function bdefinitiva(){
      return $this->hasOne('App\Bdefinitiva');
   }

   //SCOPES

   public function scopeBuscar($query, $busqueda){
      return $query->where('folio','like','%'.$busqueda.'%')
                  ->orWhere('nuc','like','%'.$busqueda.'%');
   }



}
