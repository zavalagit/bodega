<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Especialidad;
use App\Solicitud;
use App\Necropsia;
use App\NecropsiaClasificacion;
use App\Unidad;

class ReturnViewController extends Controller
{
    #Especialidad
    public function get_especialidades_options(Request $request, Unidad $unidad){
        return view('especialidad.especialidad_form_select_options',[
            'especialidades' => in_array($unidad->id,[66,108]) ? Especialidad::all() : Especialidad::where('unidad_id',$unidad->id)->get(),
        ]);
    }
    #Solicitud
    public function get_solicitudes_options(Request $request, Especialidad $especialidad){
        return view('solicitud.solicitud_form_select_options',[
            'solicitudes' => Solicitud::where('especialidad_id',$especialidad->id)->get(),
        ]);
    }
    #Necropsia
    public function get_necropsias_options(Request $request, NecropsiaClasificacion $necropsia_clasificacion){
        return view('necropsia.necropsia_form_select_options',[
            'necropsias' => Necropsia::where('necropsia_clasificacion_id',$necropsia_clasificacion->id)->get(),
        ]);
    }
    #Unidad
    public function get_unidades_options(Request $request, Unidad $unidad){
        return view('unidad.unidad_form_select_options',[
            'unidades' => Unidad::find($unidad->id)->relacion_unidad()->get(),
        ]);
    }
}
