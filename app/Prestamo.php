<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
   protected $table = 'bodega.prestamos';

   protected $fillable = [
      'prestamo_ordena',
      'prestamo_hora',
      'prestamo_fecha',
      'prestamo_numindicios',
      'reingreso_hora',
      'reingreso_fecha',
      'reingreso_numindicios',
      'estado',
      'user1_id',//prestamo entrega (Responsable de bodega)
      'perito1_id',//prestamo recibe (Resguardante)
      'perito2_id',//Reingreso entrega (Resguardante)
      'user2_id',//reingreso recibe (Responsable de Bodega)
      'cadena_id',
   ];

   public function unidad(){
      return $this->belongsTo('App\Unidad');
   }

   public function user1(){
      return $this->belongsTo('App\User','user1_id');
   }

   public function user2(){
      return $this->belongsTo('App\User','user2_id');
   }  

   public function perito1(){
      return $this->belongsTo('App\Perito','perito1_id');
   }

   public function perito2(){
      return $this->belongsTo('App\Perito','perito2_id');
   }

   public function indicios(){
      return $this->belongsToMany('App\Indicio')
                  ->withPivot('id','indicio_id','prestamo_id','prestamo_cantidad_indicios','prestamo_descripcion','reingreso_cantidad_indicios','reingreso_descripcion')   
                  ->withTimestamps();
   }

   public function cadena(){
      return $this->belongsTo('App\Cadena');
   }

   public function fotos(){
		return $this->morphMany('App\Foto','fotografia');
	}


   //SCOPES
   public function scopeBuscaprestamo($query,$folio){
//      return $query->where('cedula_folio',$folio)
//                  ->orWhere('nuc')
   }
}
