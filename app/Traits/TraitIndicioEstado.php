<?php
namespace App\Traits;
use App\Indicio;

trait TraitIndicioEstado{
   public function set_indicio_estado(Indicio $indicio){
      //baja
      if( $indicio->bajas->count() ){
         if( $indicio->numero_indicios - $indicio->bajas()->wherePivot('indicio_id',$indicio->id)->sum('baja_cantidad_indicios')  == 0 ) $indicio->estado = 'baja';
         else{
            if( $indicio->prestamos->contains('estado','activo') ) $indicio->estado = 'prestamo_baja';
            else $indicio->estado = 'activo_baja';
         }
      }
      //prestamo
      elseif ( $indicio->prestamos->count() ) {
         if ( $indicio->prestamos->contains('estado','activo') ) $indicio->estado = 'prestamo';
         else $indicio->estado = 'activo';
      }
      //depuraciones
      elseif( $indicio->depuraciones->count() ){
         if( $indicio->numero_indicios - $indicio->depuraciones()->wherePivot('indicio_id',$indicio->id)->sum('depuracion_cantidad_indicios')  == 0 ) $indicio->estado = 'depuracion';
         else{
            $indicio->estado = 'activo_depuracion';
         }
      }
      //activo
      else $indicio->estado = 'activo';

      $indicio->save();
   }
}