<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Institucion;

class InstitucionController extends Controller
{
	public function instituciones(){
		$instituciones = Institucion::orderBy('nombre','asc')->get();

		return view('institucion.instituciones',[
			'instituciones' => $instituciones,
		]);
	}
	public function institucion_formulario($id_institucion = 0){
		$institucion = "";
		if($id_institucion){
			$institucion = Institucion::find($id_institucion);
		}
		return view('institucion.institucion_formulario',
			[
				'institucion' => $institucion,
				'institucion_bandera' => $id_institucion,
			]	
		);
	}
	public function institucion_guardar(Request $request, $id_institucion = 0){
		$mensajes = [
			'nombre.required' => 'El campo "Nombre" es requerido.',
		];
		$validator = Validator::make($request->all(), [
			'nombre' => 'required',
		 ], $mensajes);
		 #Envia error de validacion
		 if ($validator->fails()) {
			 return response()->json([
				 'satisfactorio' => false,
				 'error' => $validator->errors()->all(),
			 ]);
		 }

		if($id_institucion == 0)
			$institucion = new Institucion;
		else
			$institucion = Institucion::find((int)$id_institucion);

		$institucion->nombre = $request->nombre;
		$institucion->save();

		return response()->json([
         'satisfactorio' => true,
      ]);
	}
}
