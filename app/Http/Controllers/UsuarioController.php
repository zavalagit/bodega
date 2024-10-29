<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Cadena;
use App\User;
use App\Cargo;
use App\Unidad;
use App\Fiscalia;


class UsuarioController extends Controller
{
   public function usuarios(Request $request){
    	
		//$usuarios = User::all();

		if ($request->filled('buscar_usuario')) {
			$usuarios = User::where('name','like',"%{$request->buscar_usuario}%")
							->orWhere('folio','like',"%{$request->buscar_usuario}%")
							->get();
							
			return view('administrador.usuarios',[
				'usuarios' => $usuarios,
				'buscar_usuario' => $request->buscar_usuario,
			]);
		}

		return view('administrador.usuarios');
	}
	
	public function usuario_editar($id_user){
		$user = User::find($id_user);
		$cargos = Cargo::all();
		$unidades = Unidad::where('unidad_estado','activo')->get();
		$fiscalias = Fiscalia::all();
		return view('administrador.usuarios.usuario_editar',[
			'user' => $user,
			'cargos' => $cargos,
			'unidades' => $unidades,
			'fiscalias' => $fiscalias,
		]);
	}

	public function usuario_editar_guardar(Request $request){

		$validator = Validator::make($request->all(), [
			'folio' => 'required',
			'name' => 'required',
			'cargo' => 'required',
			'unidad' => 'required',
			'fiscalia' => 'required',
		]);


			//Enviar error de validaciones
			if ($validator->fails()) {
				return response()->json([
					'satisfactorio' => false,
					'error' => $validator->errors()->all(),
				]);
			}
		$user = User::find($request->id_user);
		$user->folio = $request->folio;
		$user->name = $request->name;
		$user->cargo_id = $request->cargo;
		$user->unidad_id = $request->unidad;
		$user->fiscalia_id = $request->fiscalia;
		$user->save();

		return response()->json([
			'satisfactorio' => true,
		]);

	}



	public function usuario_password_reset(Request $request){

		// dd('holasdasdasd');
    	
		$usuarios = User::all();

		if ($request->filled('buscar_usuario')) {
			$usuarios = User::where('name','like',"%{$request->buscar_usuario}%")
							->orWhere('folio','like',"%{$request->buscar_usuario}%")
							->get();
							
			return view('administrador.usuarios.resetusuarios',[
				'usuarios' => $usuarios,
				'buscar_usuario' => $request->buscar_usuario,
			]);
		}

		return view('administrador.resetusuarios');
	}

	public function reset_usuario_form($id_user){
		$user = User::find($id_user);
		$cargos = Cargo::all();
		$unidades = Unidad::all();
		$fiscalias = Fiscalia::all();
		return view('administrador.usuarios.usuario_password_reset',[
			'user' => $user,
			'cargos' => $cargos,
			'unidades' => $unidades,
			'fiscalias' => $fiscalias,
		]);
	}

	public function guardar_password(Request $request){
		$validator = Validator::make($request->all(), [
			'password' => 'required|string|min:6|confirmed',
		]);


			//Enviar error de validaciones
			if ($validator->fails()) {
				return response()->json([
					'satisfactorio' => false,
					'error' => $validator->errors()->all(),
				]);
			}
		$user = User::find($request->id_user);
		$user->password = bcrypt($request->password);
		$user->save();

		return response()->json([
			'satisfactorio' => true,
		]);

	}

}
