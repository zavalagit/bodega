<?php
namespace App\Traits;

trait TraitFechaFormato{

    public function get_fecha_formato($fecha_inicio, $fecha_fin = null){
        if ($fecha_fin != null) {
            if ( ( date('Y-m-01', strtotime($fecha_fin)) == $fecha_fin ) && ( date('Y-m-t', strtotime($fecha_inicio)) == $fecha_fin ) ){ //compando que las dos fechas sean el primer y ultmo día del mes
                return strftime('%B del %Y',strtotime($fecha_inicio));
            }
            else{
                return date('d-m-Y',strtotime($fecha_inicio)).' al '. date('d-m-Y',strtotime($fecha_fin));
            }
        }
        else return strftime('%d de %B del %Y',strtotime($fecha_inicio));
    }
}