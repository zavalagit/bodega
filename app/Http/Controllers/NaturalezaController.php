<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Naturaleza;


class NaturalezaController extends Controller
{

	public function naturalezas(){
		$naturalezas = Naturaleza::orderBy('nombre','asc')->get();
		return view('naturaleza.naturalezas',[
			'naturalezas' => $naturalezas,
		]);
	}
	public function naturaleza_formulario($id_naturaleza = 0){
		$naturaleza = "";
		if($id_naturaleza){
			$naturaleza = Naturaleza::find($id_naturaleza);
		}
		return view('naturaleza.naturaleza_formulario',
			[
				'naturaleza' => $naturaleza,
				'naturaleza_bandera' => $id_naturaleza,
			]	
		);
	}
	public function naturaleza_guardar(Request $request, $id_naturaleza = 0){
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

		if($id_naturaleza == 0)
			$naturaleza = new Naturaleza;
		else
			$naturaleza = Naturaleza::find((int)$id_naturaleza);

		$naturaleza->nombre = $request->nombre;
		$naturaleza->save();

		return response()->json([
         'satisfactorio' => true,
      ]);
	}
}
