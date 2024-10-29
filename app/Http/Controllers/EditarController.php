<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Entrada;
use App\Cargo;
use App\Entidad;
use App\Delegacion;
use App\Naturaleza;
use App\Unidad;


class EditarController extends Controller
{
    public function editar_vista($id){
      $cadena = Cadena::find($id);
      $entrada = Entrada::where('cadena_id',$cadena->id)->get();
      $cargos = Cargo::all();
      $entidades = Entidad::all();
      $delegaciones = Delegacion::where('entidad_id',16)->orderBy('nombre','asc')->get();
      $naturalezas = Naturaleza::all();
      $unidades = Unidad::all();

//      dd($cadena->id);
//      dd($entrada[0]->naturaleza_id);
      return view('bodega.editar',[
         'entrada' => $entrada[0],
         'entidades' => $entidades,
         'delegaciones' => $delegaciones,
         'naturalezas' => $naturalezas,
         'cargos' => $cargos,
         'unidades'=>$unidades,
         'cadena'=>$cadena,
      ]);
    
    }


    public function editar_guardar(Request $request){
    	$cadena = Cadena::find($request->id_cadena);
      $cadena->folio_bodega = $request->folio;
      $cadena->nuc = $request->nuc;
      $cadena->unidad_id = $request->unidad;
      $cadena->save();

      $entrada = Entrada::find($request->id_entrada);
      $entrada->hora = $request->hora;
      $entrada->fecha = $request->fecha;
      $entrada->delegacion_id = $request->delegacion;
      $entrada->embalaje = $request->embalaje;
      $entrada->naturaleza_id = $request->naturaleza;
      $entrada->perito_id = $request->perito;
      $entrada->observacion = $request->observacion;
      $entrada->user_id = $request->responsable_bodega;
	  $entrada->tiene_oficio_fgr = $request->filled('tiene_oficio_fgr') ? 1 : 0;
	$entrada->tiene_oficio_sedena = $request->filled('tiene_oficio_sedena') ? 1 : 0;
      $entrada->save();

      
      foreach ($cadena->indicios as $key => $indicio) {
        $indicio->identificador = $request->identificador[$key];
        $indicio->descripcion = $request->descripcion[$key];
        $indicio->numero_indicios = $request->numero_indicios[$key];
		$indicio->indicio_cantidad_disponible = $request->numero_indicios[$key];
        $indicio->save();  
      }


      $link = "http://201.116.252.147:8000/bodega/entradas?filtro=3&buscar={$cadena->folio_bodega}";
      return redirect($link);
    }
}
