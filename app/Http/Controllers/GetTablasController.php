<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Especialidad;
use App\Unidad;

class GetTablasController extends Controller
{
    public function get_especialidades(Request $request){

        if( ($request->unidad_id == 6) || ($request->unidad_id == 7) )
            $especialidades = Especialidad::where('id','<>',26)->get();
        else
            $especialidades = Especialidad::where('unidad_id',$request->unidad_id)->orderBy('nombre', 'asc')->get();
        
            return response()->json(
            [
                'especialidades' => $especialidades,
            ]
        );
    }

    public function get_unidades(Request $request){
        $unidades = Unidad::where('coordinacion','si')->orderBy('nombre', 'asc')->get();

        return response()->json(
            [
                'unidades' => $unidades,
            ]
        );
    }
}
