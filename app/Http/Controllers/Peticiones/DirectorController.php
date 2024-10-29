<?php

namespace App\Http\Controllers\Peticiones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use PDF;
use Validator;
use App\Delegacion;
use App\Especialidad;
use App\Necropsia;
use App\Unidad;
use App\Fiscalia;
use App\Petadscripcion;
use App\Petfiscalia;
use App\Peticion;
use App\Solicitud;

class DirectorController extends Controller
{
    /**__Ultimas 20 peticiones y busqueda de peticiones */

    public function peticion_buscar(Request $request, $lugar=null, $lugar_id=0){
        $mensaje = 'Realice una busqueda: Puede buscar por fecha, por un intervalo de fechas, por nuc, etc.';

        
            $peticiones = Peticion::where(function($q) use($request){
                                        #especialidad
                                        if( $request->especialidad != '0'){
                                            $q->whereHas('solicitud',function($a) use($request){
                                                $a->where('especialidad_id',$request->especialidad);
                                            });
                                        }
                                        #fecha, fecha_tipo
                                        if( $request->filled('fecha_inicio') ){
                                            if( $request->filled('fecha_fin') ){
                                                if($request->fecha_tipo != '0'){
                                                    $q->whereBetween($request->fecha_tipo,[$request->fecha_inicio, $request->fecha_fin]);
                                                }
                                                else{
                                                    $q->where(function($a) use($request){
                                                        $a->whereBetween('fecha_peticion',[$request->fecha_inicio,$request->fecha_fin])
                                                            ->orWhereBetween('fecha_elaboracion',[$request->fecha_inicio,$request->fecha_fin])
                                                            ->orWhereBetween('fecha_entrega',[$request->fecha_inicio,$request->fecha_fin]);
                                                    });
                                                }
                                            }
                                            else{
                                                if($request->fecha_tipo != '0'){
                                                    $q->where($request->fecha_tipo,$request->fecha_inicio);
                                                }
                                                else{
                                                    $q->where('fecha_peticion',$request->fecha_inicio)
                                                        ->orWhere('fecha_elaboracion',$request->fecha_inicio)
                                                        ->orWhere('fecha_entrega',$request->fecha_inicio);
                                                }
                                            }
                                        }
                                        #buscar_texto
                                        if( $request->filled('buscar_texto') ){
                                            $q->where(function($a) use($request){
                                                $a->where('nuc','like',"%{$request->buscar_texto}%")
                                                ->orWhere('oficio_numero','like',"%{$request->buscar_texto}%")
                                                ->orWhere('sp_solicita','like',"%{$request->buscar_texto}%")
                                                ->orWhere('sp_recibe','like',"%{$request->buscar_texto}%")
                                                ->orWhereHas('user',function($b) use($request){
                                                    $b->where('folio','like',"%{$request->buscar_texto}%")
                                                    ->orWhere('name','like',"%{$request->buscar_texto}%");
                                                });
                                            });
                                        }

                                    })
                                    ->get();
   
            
                  
        $fecha_tipo = $request->fecha_tipo;
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        $buscar_texto = $request->buscar_texto;

        $especialidades = Especialidad::where(function($q){
                                            if (Auth::user()->tipo == 'director_unidad') {
                                                $q->where('unidad_id',Auth::user()->unidad_id);
                                            }
                                        })
                                        ->get();

        return view('peticiones.peticion_buscar',
        compact(
            'peticiones',
            'especialidades',
            'fecha_tipo',
            'fecha_inicio',
            'fecha_fin',
            'buscar_texto',
            'mensaje'
            )
        );
    }



}
