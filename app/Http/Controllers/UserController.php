<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;

class UserController extends Controller
{
	public function get_user(Request $request){
		/*
			--El request debe tener:
				*folio o name (requerido)
				*tipo de user (opcional)
		*/
		$users = User::where(function($q) use($request){
								$q->where('folio','like',"%{$request->buscar}%")
									->orWhere('name','like',"%{$request->buscar}%");
								//user_tipo
								if ( $request->filled('user_tipo') ) {
									$q->where('tipo',$request->user_tipo);
								}
								//user_fiscalia
								if ( $request->filled('user_fiscalia') ) {
									$q->where('fiscalia_id',$request->user_fiscalia);
								}
								if ( $request->filled('user_unidad') ) {
									$q->where('unidad_id',$request->user_unidad);
								}
							})
							->take(5)
							->with('institucion')
							->with('cargo')
							->get();

		return response()->json([
			'registros' => $users,
		]);
	}
	
	public function get_users(Request $request){
		/*
			--El request debe tener:
				*folio o name (requerido)
				*tipo de user (opcional)
		*/
		$users = User::where(function($q) use($request){
								$q->where('folio','like',"%{$request->buscar}%")
									->orWhere('name','like',"%{$request->buscar}%");
								//user_tipo
								if ( $request->filled('user_tipo') ) {
									$q->where('tipo',$request->user_tipo);
								}
								//user_fiscalia
								if ( $request->filled('user_fiscalia') ) {
									$q->where('fiscalia_id',$request->user_fiscalia);
								}
								if ( $request->filled('user_unidad') ) {
									$q->where('unidad_id',$request->user_unidad);
								}
							})
							->take(5)
							->with('institucion')
							->with('cargo')
							->get();

		return response()->json([
			'registros' => $users,
		]);
	}

   public function user_password($id_user = 0){
      if ($id_user) {
         $user = User::find($id_user);
         return view('user.user_password_formulario',['user'=>$user]);
      }
   }
   public function user_password_guardar(Request $request, $id_user = 0){
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
		$user = User::find($id_user);
		$user->password = bcrypt($request->password);
		$user->save();

		return response()->json([
			'satisfactorio' => true,
		]);
   }
}
