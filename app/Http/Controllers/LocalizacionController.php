<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Naturaleza;
use App\Cadena;
use App\Indicio;

class LocalizacionController extends Controller
{
    public function asignar_localizacion(Request $request){
        $naturalezas = Naturaleza::all();
        
        // if( $request->filled('btn_buscar') ){ 
        //     // dd($request->all());
        //     #validacion
        //     $mensajes = [
        //         'buscar_folio.required_without' => 'Indique un "folio" o una "fechass".',
        //         'buscar_fecha_inicio.required_without' => 'Indique un "folio" o una "fecha".',
        //         'buscar_fecha_inicio.before_or_equal' => 'El campo "fecha inicio" no deber ser una fecha mayor a hoy.',
        //         'buscar_fecha_fin.after' => 'El campo "fecha fin" debe ser mayor al campo "fecha inicio".',
        //         'buscar_fecha_fin.before_or_equal' => 'El campo "fecha fin" no deber ser una fecha mayor a hoy.',
        //     ];
        //     $request->validate([
        //         'buscar_folio' => 'required_without:buscar_fecha_inicio',
        //         'buscar_fecha_inicio' => 'nullable|required_without:buscar_folio|date|before_or_equal:today',
        //         'buscar_fecha_fin' => 'nullable|date|after:buscar_fecha_inicio|before_or_equal:today',
        //     ],$mensajes);

        //     #busqueda
        //     //folio
        //     if( $request->filled('buscar_folio') ){
        //         $cadenas = Cadena::where('folio_bodega','like',"%{$request->buscar_folio}%")->where('fiscalia_id',Auth::user()->fiscalia_id)->get();
        //     }
        //     //fecha
        //     else if ($request->filled('buscar_fecha_inicio')) {
        //         $cadenas = Cadena::where('fiscalia_id',Auth::user()->fiscalia_id)
        //                         ->whereHas('entrada',function($q) use($request){
        //                             //con fecha_fin
        //                             if ($request->filled('buscar_fecha_fin')) {
        //                                 $q->whereBetween('fecha',[$request->buscar_fecha_inicio,$request->buscar_fecha_fin]);
        //                             }
        //                             //solo fecha_inicio
        //                             else{
        //                                 $q->where('fecha',$request->buscar_fecha_inicio);
        //                             }
        //                             //naturaleza
        //                             if($request->buscar_naturaleza){
        //                                 $q->where('naturaleza_id',$request->buscar_naturaleza);
        //                             }
        //                         })
        //                         ->orderBy('folio_bodega')
        //                         ->get();
        //     }
            
        //     $request->flash();
        //     return view('localizacion.ubicacion_consultar',[
        //         'cadenas' => $cadenas,
        //         'naturalezas' => $naturalezas
        //     ]);
        // }

        return view('localizacion.ubicacion_consultar',['naturalezas' => $naturalezas]);
    }
}
