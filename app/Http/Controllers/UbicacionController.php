<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Cadena;
use App\Indicio;
use App\Naturaleza;
use App\Ubicacion;

class UbicacionController extends Controller
{   
    public function ubicacion_consultar(Request $request){
        $naturalezas = Naturaleza::all();
        
        if( $request->filled('btn_buscar') ){ 
            // dd($request->all());
            #validacion
            $mensajes = [
                'buscar_folio.required_without' => 'Indique un "folio" o una "fechass".',
                'buscar_fecha_inicio.required_without' => 'Indique un "folio" o una "fecha".',
                'buscar_fecha_inicio.before_or_equal' => 'El campo "fecha inicio" no deber ser una fecha mayor a hoy.',
                'buscar_fecha_fin.after' => 'El campo "fecha fin" debe ser mayor al campo "fecha inicio".',
                'buscar_fecha_fin.before_or_equal' => 'El campo "fecha fin" no deber ser una fecha mayor a hoy.',
            ];
            $request->validate([
                'buscar_folio' => 'required_without:buscar_fecha_inicio',
                'buscar_fecha_inicio' => 'nullable|required_without:buscar_folio|date|before_or_equal:today',
                'buscar_fecha_fin' => 'nullable|date|after:buscar_fecha_inicio|before_or_equal:today',
            ],$mensajes);

            #busqueda
            //folio
            if( $request->filled('buscar_folio') ){
                $cadenas = Cadena::where('folio_bodega','like',"%{$request->buscar_folio}%")->where('fiscalia_id',Auth::user()->fiscalia_id)->get();
            }
            //fecha
            else if ($request->filled('buscar_fecha_inicio')) {
                $cadenas = Cadena::where('fiscalia_id',Auth::user()->fiscalia_id)
                                ->whereHas('entrada',function($q) use($request){
                                    //con fecha_fin
                                    if ($request->filled('buscar_fecha_fin')) {
                                        $q->whereBetween('fecha',[$request->buscar_fecha_inicio,$request->buscar_fecha_fin]);
                                    }
                                    //solo fecha_inicio
                                    else{
                                        $q->where('fecha',$request->buscar_fecha_inicio);
                                    }
                                    //naturaleza
                                    if($request->buscar_naturaleza){
                                        $q->where('naturaleza_id',$request->buscar_naturaleza);
                                    }
                                })
                                ->orderBy('folio_bodega')
                                ->get();
            }
            
            $request->flash();
            return view('ubicacion.ubicacion_consultar',[
                'cadenas' => $cadenas,
                'naturalezas' => $naturalezas
            ]);
        }

        return view('ubicacion.ubicacion_consultar',['naturalezas' => $naturalezas]);
    }

    public function ubicacion(Request $request){
        $ubicaciones= Ubicacion::all();
        $cadenas= Cadena::where('folio_bodega','like',"%{$request->buscar}%")->where('estado','validada')->take(20)->get();
        return view('ubicacion.ubicacion',['cadenas'=>$cadenas,]);
    }
    public function ubicacion_administrar(Request $request){
        $naturalezas= Naturaleza::all();
        if($request->filled("buscar")){
            $ubicaciones = Ubicacion::where('nombre','like',"%{$request->buscar}%")->orWhere('anio','like',"%{$request->buscar}%")->get();
        }
        else {
            $ubicaciones = Ubicacion::where('anio','like',"%{$request->buscar}%")->take(20)->get();
        }
        //dd('hoasdl');
        if ($request->btn === 'ubicacion') {
            $ubicacion = new Ubicacion;
            $ubicacion->nombre = $request->input('nombre');
            $ubicacion->anio = $request->input('anio');
            $ubicacion->naturaleza_id = $request->input('naturaleza_id');
            $ubicacion->save();
        }
        return view('ubicacion.ubicacion_administrar',['ubicaciones'=>$ubicaciones,'naturalezas'=>$naturalezas]);
    }
    public function ubicacion_agregar(Request $request, $id_ubicacion=0){
        $validator = Validator::make($request->all(),[
            'nombre' => 'required',
            'anio' => 'required',
            'naturaleza' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
            'satisfactorio' => false,
            'error' => $validator->errors()->all(),
            ]);
        }

        if($id_ubicacion > 0)//Editar
            $ubicacion = Ubicacion::find($id_ubicacion);
        else//Nva. ubicación
            $ubicacion = new Ubicacion;

        $ubicacion->nombre = $request->nombre;
        $ubicacion->anio = $request->anio;
        $ubicacion->naturaleza_id = $request->naturaleza;
        $ubicacion->fiscalia_id = Auth::user()->fiscalia->id;
        $ubicacion->save();

        return response()->json([
            'satisfactorio' => true,
        ]);
    }
    public function ubicacion_editar($id_ubicacion){
        $ubicacion = Ubicacion::find($id_ubicacion);
        $naturalezas = Naturaleza::all();

        return view('ubicacion.ubicacion_editar',
            [
                'ubicacion' => $ubicacion,
                'naturalezas' => $naturalezas,
            ]
        );
    }
    public function ubicacion_asignar($id_cadena){
        $cadena = Cadena::find($id_cadena);
        $naturalezas = Naturaleza::all();
        $ubicaciones = Ubicacion::all();
        return view('ubicacion.ubicacion_asignar', [
           'cadena' => $cadena,
           'naturalezas' => $naturalezas,
           'ubicaciones'  => $ubicaciones,
        ]);
    }
    public function ubicacion_get(Request $request){
        $ubicaciones = Ubicacion::where('nombre','like',"%{$request->buscar}%")
                                ->where('fiscalia_id',Auth::user()->fiscalia_id)
                                ->take(5)
                                ->get();

        return response()->json([
            'ubicaciones' => $ubicaciones,
        ]);
        
    }
    public function ubicacion_general_guardar(Request $request){
        $cadena = Cadena::find($request->id_cadena);
        foreach ($cadena->indicios as $key => $indicio) {
            $indicio->ubicacion_id = $request->id_ubicacion;
            $indicio->save();
        }
        return response()->json([
            'satisfactorio' => True,
        ]);
    }
    public function ubicacion_indicio_guardar(Request $request){
        $indicio = Indicio::find($request->id_indicio);
        $indicio->ubicacion_id = $request->id_ubicacion;
        $indicio->save();
        return response()->json([
            'satisfactorio' => True,
        ]);
    }
    
}
