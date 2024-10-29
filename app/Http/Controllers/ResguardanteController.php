<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Cargo;
use App\Unidad;
use App\Perito;

class ResguardanteController extends Controller
{
   public function resguardantes(Request $request){
		if ($request->filled('buscar_resguardante')) {
			//dd($request->buscar_resguardante);
			$resguardantes = Perito::where('nombre','like',"%{$request->buscar_resguardante}%")
							->orWhere('folio','like',"%{$request->buscar_resguardante}%")
							->get();
							

			//dd($resguardantes);

			return view('administrador.resguardantes.resguardantes',[
				'resguardantes' => $resguardantes,
				'buscar_resguardante' => $request->buscar_resguardante,
			]);
		}

		return view('administrador.resguardantes.resguardantes');
	}

	public function resguardante_editar($id_resguardante){
		$resguardante = Perito::find($id_resguardante);
		$cargos = Cargo::all();
		$unidades = Unidad::all();
		// $fiscalias = Fiscalia::all();
		return view('administrador.resguardantes.resguardante_editar',[
			'resguardante' => $resguardante,
			'cargos' => $cargos,
			'unidades' => $unidades,
			// 'fiscalias' => $fiscalias,
		]);
	}

	public function resguardante_guardar(Request $request, $id_resguardante = 0){
		
		$validator = Validator::make($request->all(), [
			'folio' => 'required',
			'nombre' => 'required',
			'cargo' => 'required',
			// 'unidad' => 'required',
			// 'fiscalia' => 'required',
		]);


			//Enviar error de validaciones
			if ($validator->fails()) {
				return response()->json([
					'satisfactorio' => false,
					'error' => $validator->errors()->all(),
				]);
			}

		if($id_resguardante > 0){
			$resguardante = Perito::find($id_resguardante);
		}
		else{
			#crear nuevo resguardante
		}


		
		$resguardante->folio = $request->folio;
		$resguardante->nombre = $request->nombre;
		$resguardante->cargo_id = $request->cargo;
		//$resguardante->unidad_id = $request->unidad;
		//$resguardante->fiscalia_id = $request->fiscalia;
		$resguardante->save();

		return response()->json([
			'satisfactorio' => true,
		]);
	}
}
