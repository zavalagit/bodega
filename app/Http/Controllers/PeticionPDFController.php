<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;
use App\Especialidad;
use App\Fiscalia;
use App\Necropsia;
use App\Peticion;

class PeticionPDFController extends Controller
{
	public function __construct()
    {
		set_time_limit(0);
		ini_set('memory_limit', '-1');
        setlocale(LC_TIME, "spanish");
        date_default_timezone_set('America/Mexico_City');
    }
	
    public function peticion_solicitud_vista(Request $request){


        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');

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
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = "";
        }
        else{
            $mes = date('m');
            $ano = date('Y');
            $fecha_encabezado = strtoupper(strftime("%B %Y"));
            $fecha_inicio = date('Y-m-d',mktime(0,0,0,$mes,1,$ano));
            $fecha_fin =  date('Y-m-d',mktime(0,0,0,$mes+1,0,$ano));
            $es_mes = true;
        }


        //dd([$fecha_inicio, $fecha_fin]);


        if( $request->filled('fecha_inicio') ){

            $peticiones = Peticion::where(function($q) use($request){
                if( $request->filled('fecha_fin') ){
                    $q->whereBetween('fecha_sistema',[$request->fecha_inicio,$request->fecha_fin]);
                }
                else{
                    $q->where('fecha_sistema',$request->fecha_inicio);
                }
            })
            //->where('fiscalia2_id',Auth::user()->fiscalia_id)
            ->where('unidad_id',Auth::user()->unidad_id)
            ->whereIn('estado',['atendida','entregada'])
            ->get();



            //dd($peticiones->where('solicitud_id',61)->where('fiscalia2_id',4)->where('documento_emitido','informe')->count());


$dia_siguiente = date("Y-m-d", strtotime("{$request->fecha_fin} +1 day"));
            $necropsias = Peticion::whereIn('solicitud_id',[61,62])
                            /*->where('unidad_id',2)*/
                            ->whereBetween('fecha_necropsia',[$request->fecha_inicio,$request->fecha_fin])
                            ->get();


            //dd($necropsias->where('unidad_id',2)->where('fiscalia2_id',4)->count());

            //dd($necropsias);
            
            $fiscalias = Fiscalia::all();
            $especialidades = Especialidad::where('unidad_id',Auth::user()->unidad_id)->get();
            $necros = Necropsia::all();


            $array_necropsia_tipo = ['apoyo_uspec','apoyo_uecs','dolosa','hecho_transito','patologia_otra','suicidio'];


            if(Auth::user()->unidad_id == 3){
                $vista = "peticiones.pdf.uic_{$request->reporte_tipo}";
            }
            else if(Auth::user()->unidad_id == 1){
                $vista = "peticiones.pdf.ugf_{$request->reporte_tipo}";
            }
            else if(Auth::user()->unidad_id == 2){
                $vista = "peticiones.pdf.uf_{$request->reporte_tipo}";
            }

/*
            $vista = 'peticiones.pdf.';
            switch ($request->reporte_tipo) {
                case 'reporte_general':
                    $vista = "{$vista}reporte_general";
                    break;
                case 'reporte_solicitud':
                    $vista = "{$vista}reporte_solicitud";
                    break;
                case 'reporte_necropsias_general':
                    $vista = "{$vista}reporte_necropsias_general";
                    break;
                case 'reporte_necropsias_mecanica':
                    $vista = "{$vista}reporte_necropsias_mecanica";
                    break;
                default:
                    # code...
                    break;
            }
*/


            // dd($necropsias);

            $pdf = PDF::loadView($vista,
                    compact(
                        'peticiones',
                        'necropsias',
                        'fiscalias',
                        'especialidades',
                        'necros',
                        'array_necropsia_tipo',
                        'fecha_encabezado'
                    )
            );
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download('Busqueda.pdf');
        }



        
        return view('peticiones.reportes.peticion_solicitud_vista',
            compact(
                'fecha_inicio',
                'fecha_fin'
            )
        );
    }
}
