<?php

namespace App\Http\Controllers\Peticiones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use PDF;
use Validator;
use App\Delegacion;
use App\Especialidad;
use App\Fiscalia;
use App\Petadscripcion;
use App\Petfiscalia;
use App\Peticion;
use App\Solicitud;
use App\Unidad;

class CoordinadorController extends Controller
{
    
    public function peticion_diaria(Request $request){
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
        return view('peticiones.coordinador.peticiones_diarias',[
            'fiscalias' => $fiscalias,
            'fecha' => $fecha,
            'peticiones' => $peticiones
        ]);
    }

    public function concentrado(Request $request){
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
        $fecha_hoy = date("Y-m-d");
        
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
       
        $es_mes = false;

        if( $request->filled('fecha_inicio') && $request->filled('fecha_fin') ){
            $primer_dia = mktime(0,0,0,date('m',strtotime($request->fecha_inicio)),1,date('Y',strtotime($request->fecha_inicio)));
            $primer_dia = date('Y-m-d',$primer_dia);
            $ultimo_dia = mktime(0,0,0,date('m',strtotime($request->fecha_inicio))+1,0,date('Y',strtotime($request->fecha_inicio)));
            $ultimo_dia = date('Y-m-d',$ultimo_dia);

            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;

            if( ( $request->fecha_inicio === $primer_dia ) && ( $request->fecha_fin === $ultimo_dia ) ){
                $fecha_encabezado = strtoupper(strftime('%B %Y',strtotime($primer_dia)));
                $es_mes = true;
            }
            else
                $fecha_encabezado = date('d-m-Y', strtotime($request->fecha_inicio)) . " / " . date('d-m-Y', strtotime($request->fecha_fin));
        }
        elseif( $request->filled('fecha_inicio') ){
            $fecha_encabezado = strtoupper(strftime('%A %d del %Y', strtotime($request->fecha_inicio)));
        }
        else{
            $mes = date('m');
            $ano = date('Y');
            $fecha_encabezado = strtoupper(strftime("%B %Y"));
            $fecha_inicio = date('Y-m-d',mktime(0,0,0,$mes,1,$ano));
            $fecha_fin =  date('Y-m-d',mktime(0,0,0,$mes+1,0,$ano));
            $es_mes = true;
        }

        
        $peticiones = Peticion::where(function($q) use($request,$fecha_inicio,$fecha_fin){
                                    if ($request->filled(['fecha_inicio','fecha_fin'])) 
                                        $q->whereBetween('fehca_peticion',[$fecha_inicio,$fecha_fin]);
                                    elseif($request->filled('fecha_inicio'))
                                        $q->where('fehca_peticion',$fecha_fin);
                                    else
                                        $q->whereBetween('fecha_peticion',[$fecha_inicio,$fecha_fin]);
                                })
                                ->get();

        $unidades = Unidad::where('coordinacion','si')->get();
        $fiscalias = Fiscalia::all();

        return view('peticiones.coordinador.concentrado',
            compact(
                'peticiones',
                'unidades',
                'fiscalias',
                'fecha_inicio',
                'fecha_fin'
            )
        );
    }
}
