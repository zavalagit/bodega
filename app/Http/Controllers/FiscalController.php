<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Fiscalia;
use App\Peticion;

class FiscalController extends Controller
{
    public function fiscal_inicio(Request $request){
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set("America/Mexico_City");

        if($request->filled('fecha_peticiones')){
            $peticiones_del_dia = $request->fecha_peticiones;
        }
        else{
            $peticiones_del_dia = date('Y-m-d');
        }

        if($request->buscar_fiscalia != 0){
            $peticiones_recibidas = Peticion::where('fecha_peticion',$peticiones_del_dia)
                                            ->where(function($q) use($request){
                                                $id_fiscalia = intval($request->buscar_fiscalia);
                                                $q->where('fiscalia2_id',$id_fiscalia);
                                            })
                                            ->get();
            $peticiones_rezago = Peticion::where('estado','pendiente')
                                        ->where(function($q) use($request){
                                            $id_fiscalia = intval($request->buscar_fiscalia);
                                            $q->where('fiscalia2_id',$id_fiscalia);
                                        })
                                        ->get();
            $peticiones_rezago_atendido = Peticion::whereIn('estado',['atendida','entregada'])
                                                    ->where('fecha_peticion','<',$peticiones_del_dia)
                                                    ->where('fecha_elaboracion',$peticiones_del_dia)
                                                    ->where('fiscalia2_id',$request->buscar_fiscalia)
                                                    ->get();
        
            $fiscalias = Fiscalia::all();
            //$peticiones_fiscalia = Fiscalia::find($reques->buscar);
            return view('fiscal.fiscal_inicio',[
                'fiscalias' => $fiscalias,
                'buscar_fiscalia' => $request->buscar_fiscalia,
                'fecha_peticiones' => $peticiones_del_dia,
                'peticiones_recibidas' => $peticiones_recibidas,
                'peticiones_rezago' => $peticiones_rezago,
                'peticiones_rezago_atendido' => $peticiones_rezago_atendido,
            ]);
        }


        $fiscalias = Fiscalia::all();
        return view('fiscal.fiscal_inicio',[
            'fiscalias' => $fiscalias,
            'buscar_fiscalia' => $request->buscar_fiscalia,
        ]);
    }

    public function reporte_solicitudes($id_fiscalia,$fecha){
        $id_fiscalia = intval($id_fiscalia);
        $fiscalia = Fiscalia::find($id_fiscalia);

        $peticiones_recibidas = Peticion::where('fecha_peticion',$fecha)                                               
                                        ->where('fiscalia2_id',$id_fiscalia)    
                                        ->get();
        $peticiones_rezago = Peticion::where('estado','pendiente')
                                        ->where('fiscalia2_id',$id_fiscalia)
                                        ->get();
        $peticiones_rezago_atendido = Peticion::whereIn('estado',['atendida','entregada'])
                                                    ->where('fecha_peticion','<',$fecha)
                                                    ->where('fecha_elaboracion',$fecha)
                                                    ->where('fiscalia2_id',$id_fiscalia)
                                                    ->get();

      
        $pdf = PDF::loadView('pdf.reporte_fiscal', compact(
            'fecha',
            'fiscalia',
            'peticiones_recibidas',
            'peticiones_rezago',
            'peticiones_rezago_atendido'
        ));
        return $pdf->stream();
        
    }


    public function fiscal_vista(Request $request){
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set("America/Mexico_City");
        
        $fiscalias = Fiscalia::all();
        
        if($request->filled('fecha')){
            $fecha = $request->fecha;
        }
        else{
            $fecha = date('Y-m-d');
        }

        $peticiones = Peticion::where('fecha_peticion',$fecha)->get();
        return view('fiscal.fiscal_vista',[
            'fiscalias' => $fiscalias,
            'fecha' => $fecha,
            'peticiones' => $peticiones
        ]);
    }
}
