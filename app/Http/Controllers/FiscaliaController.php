<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Fiscalia;


class FiscaliaController extends Controller
{
	public function fiscalias(){
		$fiscalias = Fiscalia::orderBy('nombre','asc')->get();

		return view('fiscalia.fiscalias',[
			'fiscalias' => $fiscalias,
	  ]);
	}

	public function fiscalia_formulario($id_fiscalia = 0){
		$fiscalia = "";
		if($id_fiscalia){
			$fiscalia = Fiscalia::find($id_fiscalia);
		}
		return view('fiscalia.fiscalia_formulario',
			[
				'fiscalia' => $fiscalia,
				'fiscalia_bandera' => $id_fiscalia,
			]	
		);
	}

	public function fiscalia_guardar(Request $request, $id_fiscalia = 0){
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

		if($id_fiscalia == 0)
			$fiscalia = new Fiscalia;
		else
			$fiscalia = Fiscalia::find((int)$id_fiscalia);

		$fiscalia->nombre = $request->nombre;
		$fiscalia->save();

		return response()->json([
         'satisfactorio' => true,
      ]);
	}

}
