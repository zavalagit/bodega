<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Unidad;

class UnidadController extends Controller
{
	public function unidades(){
		$unidades = Unidad::orderBy('nombre','asc')->get();

		return view('administrador.unidades.unidades',[
			'unidades' => $unidades,
		]);
	}

	public function unidad_formulario($id_unidad = 0){
		$unidad = "";
		if($id_unidad){
			$unidad = Unidad::find($id_unidad);
		}
		return view('administrador.unidades.unidad_formulario',
			[
				'unidad' => $unidad,
				'unidad_bandera' => $id_unidad,
			]	
		);
	}

	public function unidad_guardar(Request $request, $id_unidad = 0){
		$mensajes = [
			'nombre.required' => 'El campo "Nombre" es requerido.',
			'coordinacion.required' => 'Hay que indicar si la nueva Unidad pertenece a la Coordinación de Servicios Periciales.',
			'peticion.required' => 'Hay que indicar si la Unidad va a figurar en las Peticiones.',
		];
		$validator = Validator::make($request->all(), [
			'nombre' => 'required',
			'coordinacion' => 'required',
			'peticion' => 'required',
		 ], $mensajes);
		 #Envia error de validacion
		 if ($validator->fails()) {
			 return response()->json([
				 'satisfactorio' => false,
				 'error' => $validator->errors()->all(),
			 ]);
		 }

		if($id_unidad == 0)
			$unidad = new Unidad;
		else
			$unidad = Unidad::find((int)$id_unidad);

		$unidad->nombre = $request->nombre;
		$unidad->coordinacion = $request->coordinacion;
		$unidad->peticion = $request->peticion;
		$unidad->save();

		return response()->json([
         'satisfactorio' => true,
      ]);
	}
}
