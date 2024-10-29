<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Adscripcion;
use App\Cargo;
use App\Fiscalia;
use App\Institucion;
use App\Perito;
use App\Unidad;
use App\User;

class PeritoController extends Controller
{
	public function get_perito(Request $request){
		$peritos = Perito::where('folio','like',"%{$request->buscar}%")
								->orWhere('nombre','like',"%{$request->buscar}%")->take(5)->get();

		return response()->json([
			'registros' => $peritos,
		]);
	}

	public function perito_registrar(){
		
		$adscripciones = Adscripcion::all();
		$cargos = Cargo::all();
		$fiscalias = Fiscalia::all();
		$instituciones = Institucion::all();
		$unidades = Unidad::all();

		return view('bodega.perito_capturar',[
			'adscripciones' => $adscripciones,
			'cargos' => $cargos,
			'fiscalias' => $fiscalias,
			'instituciones' => $instituciones,
			'unidades' => $unidades,
		]);

	}

	public function perito_guardar(Request $request){

		$validator = Validator::make($request->all(),[
            'folio' => 'required|unique:sqlsrv.bodega.peritos,folio',
            'nombre' => 'required',
      	]);

      	//Enviar error de validaciones
		if ($validator->fails()) {
			return response()->json([
        		'satisfactorio' => false,
            	'error' => $validator->errors()->all(),
     		]);
      	}

      $perito = new Perito;
      $perito->nombre = $request->nombre;
      $perito->folio = $request->folio;
      $perito->institucion_id = $request->institucion;
      $perito->fiscalia_id = $request->fiscalia;
      $perito->unidad_id = $request->unidad;
      $perito->cargo_id = $request->cargo;
      $perito->adscripcion_id = $request->adscripcion;
      $perito->save();


      return response()->json([
         'satisfactorio' => true,
      ]);
	
	}



    public function mis_datos(){
    	return view('cadenas.datos');
    }

    public function cambiar_password(Request $request){

    	$usuario = User::find($request->id);

    	$usuario->password = bcrypt($request->pass);

    	$usuario->save();

    	return view('cadenas.datos');
    }
}

