<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud;

class SolicitudController extends Controller
{
    public function get_solicitudes_form_select($especialidad = 0){
        $solicitudes = Solicitud::where('especialidad_id',$especialidad)->get();
        // return $solicitudes;
        return view('solicitud.solicitud_form_select_options',
            [
                'solicitudes' => $solicitudes
            ]
        );
    }
}
