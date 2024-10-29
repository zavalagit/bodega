<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Cargo;

class CargoController extends Controller
{
	public function cargos(){
		$cargos = Cargo::orderBy('nombre','asc')->get();

		return view('cargo.cargos',[
			'cargos' => $cargos,
		]);
	}
	 
	public function cargo_formulario($id_cargo = 0){
		$cargo = "";
		if($id_cargo){
			$cargo = Cargo::find($id_cargo);
		}
		return view('cargo.cargo_formulario',
			[
				'cargo' => $cargo,
				'cargo_bandera' => $id_cargo,
			]	
		);
	}

	public function cargo_guardar(Request $request, $id_cargo = 0){
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

		if($id_cargo == 0)
			$cargo = new Cargo;
		else
			$cargo = Cargo::find((int)$id_cargo);

		$cargo->nombre = $request->nombre;
		$cargo->save();

		return response()->json([
         'satisfactorio' => true,
      ]);
	}
}
