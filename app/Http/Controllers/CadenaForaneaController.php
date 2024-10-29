<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Cadena;
use App\Cargo;
use App\Delegacion;
use App\Entidad;
use App\Entrada;
use App\Indicio;
use App\Embalaje;
use App\Naturaleza;
use App\Prestamo;
use App\Unidad;
use App\User;


class CadenaForaneaController extends Controller
{

    public function form(){
      $cargos = Cargo::all();
      $entidades = Entidad::all();
      $delegaciones = Delegacion::where('entidad_id',16)->orderBy('nombre','asc')->get();
      $naturalezas = Naturaleza::all();
      $unidades = Unidad::all();

      return view('bodega.cadena_foranea',[
         'entidades' => $entidades,
         'delegaciones' => $delegaciones,
         'naturalezas' => $naturalezas,
         'cargos' => $cargos,
         'unidades'=>$unidades,
      ]);
    }

    public function guardar(Request $request){
      setlocale(LC_TIME,"es_MX.UTF-8");
      date_default_timezone_set("America/Mexico_City");
			$mensajes = [
				'folio.required' => 'El campo "FOLIO" es requerido.',
				'folio.unique' => 'Este "FOLIO" ya está asignado a otra cadena',
				'nuc.required' => 'El campo "NUC" es requerido.',
        'unidad.required' => 'El campo "UNIDAD" es requerido.',
        'fecha.required' => 'El campo "fecha" es requerido.',
        'fecha.before_or_equal' => 'La "fecha" debe ser menor o igual a '.date('d-m-Y').'.',
				'hora.required' => 'El campo "hora" es requerido.',
        'hora.before_or_equal' => 'La "hora" debe ser menor o igual a '.date('H:i:s').' hrs.',
				'naturaleza.required' => 'El campo "NATURALEZA" es requerido.',
				'embalaje.required' => 'El campo "EMBALAJE" es requerido.',
				'identificador.*.required' => 'En apartado de " REGISTRO DE INDICIOS O EVIDENCIAS" el campo IDENTIFICADOR es requerido.',
				'descripción.*.required' => 'En apartado de " REGISTRO DE INDICIOS O EVIDENCIAS" el campo DESCRIPCIÓN es requerido.',
				'numero_indicios.*.required' => 'El cantidad de indicios/evidencias es requerida',
        'numero_indicios.*.min' => 'El cantidad de indicios/evidencias debe ser de al menos 1',
				'perito.required' => 'El Servidor Público que entrega es requerido.',
				'responsable_bodega.required' => 'El Responsable de Bodega que recibe es requerido.',
				'tipo.required' => 'El campo "TIPO" es requerido (Indicio o Evidencia).',
			];

    	$validator = Validator::make($request->all(), [
        'folio' => 'required|unique:sqlsrv.bodega.cadenas,folio_bodega',
        'nuc' => 'required',
        'unidad' => 'required',
				'fecha' => 'required|date|before_or_equal:today',
        'hora' => 'required',
  			'naturaleza' => 'required',
        'embalaje' => 'required',
				'identificador.*' => 'required',
				'descripcion.*' => 'required',
				'numero_indicios.*' => 'required|numeric|min:1',
				'perito' => 'required',
				'responsable_bodega' => 'required',
				'tipo' => 'required',
      ], $mensajes);
      #validacion para la hora
      $validator->sometimes('hora',"before_or_equal:".date('H:i:s'),function($input){
        if($input->fecha == date('Y-m-d'))
           return true;
      });
      if ($validator->fails()) {
         return response()->json([
            'satisfactorio' => false,
            'error' => $validator->errors()->all(),
         ]);
      }

      $user = User::find($request->responsable_bodega);

    	$cadena = new Cadena;
    	$cadena->folio_bodega = $request->folio;
    	$cadena->nuc = $request->nuc;
      $cadena->unidad_id = $request->unidad;
      $cadena->estado = 'validada';
      $cadena->editar = 'no';
      $cadena->fiscalia_id = $user->fiscalia_id;
	  $cadena->naturaleza_id = $request->naturaleza;
      //$cadena->observacion = $request->observacion;
    	$cadena->save();

    	//$id_cadena = $cadena->id;


    	$entrada = new Entrada;
    	$entrada->embalaje = $request->embalaje;
      $entrada->hora = $request->hora;
      $entrada->fecha = $request->fecha;
      $entrada->tipo = $request->tipo;
      $entrada->observacion = $request->observacion;
      $entrada->naturaleza_id = $request->naturaleza;
      $entrada->delegacion_id = $request->delegacion;
      $entrada->perito_id = $request->perito;
      $entrada->user_id = $request->responsable_bodega;
      $entrada->cadena_id = $cadena->id;
	  $entrada->tiene_oficio_fgr = $request->filled('tiene_oficio_fgr') ? 1 : 0;
	$entrada->tiene_oficio_sedena = $request->filled('tiene_oficio_sedena') ? 1 : 0;
    	$entrada->save();

    	for ($i=0; $i < count($request->identificador); $i++) {

         $indicio = new Indicio;
         $indicio->identificador = $request->identificador[$i];
         $indicio->descripcion = $request->descripcion[$i];
         $indicio->numero_indicios = $request->numero_indicios[$i];
		 $indicio->indicio_cantidad_disponible = $request->numero_indicios[$i];
         $indicio->cadena_id = $cadena->id;

         $indicio->save();
      }
	  
	  
				
	 

      //Mandando mensaje satisfactorio
      return response()->json([
         'satisfactorio' => true,
      ]);

    }
}
