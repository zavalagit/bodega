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
      //activo
      else $indicio->estado = 'activo';

      $indicio->save();
   }
}