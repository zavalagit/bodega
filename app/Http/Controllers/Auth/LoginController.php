<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\Auth\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

   protected $redirectTo = '/bodega/cadenas';


   protected function redirectTo(){
      $tipo = Auth::user()->tipo;
      if(($tipo == 'usuario') && (Auth::user()->unidad->peticion == 'si'))
         return '/elegir';
      elseif($tipo == 'usuario')
         return '/registrar-cadena';
      elseif($tipo == 'responsable_bodega')
         return '/bodega/revisar';
      elseif($tipo == 'director_fiscalia')
         return '/peticion-dia/fiscalia/'.Auth::user()->fiscalia_id;
      elseif($tipo == 'director_unidad')
         return '/peticion-dia/unidad/'.Auth::user()->unidad_id;
      elseif($tipo == 'coordinador')
         return '/peticion-estadistica-elegir';
      elseif($tipo == 'fiscal')
         return 'fiscal-vista';
      elseif($tipo == 'administrador')
         return '/administrador/inicio';
      elseif($tipo == 'admin_peticiones')
         return '/peticion-registrar';
	   elseif($tipo == 'coordinador_colectivos')
         return '/colectivo-consultar';
	   elseif($tipo == 'administrador_peticiones')
         return '/peticion2-dia';
	   elseif($tipo == 'coordinador_peticiones_region')
         return '/peticion2-dia';
	   elseif($tipo == 'coordinador_peticiones_unidad')
         return '/peticion2-dia';
   }

   public function username(){
      return 'folio';
   }

/*
   public function login(){

   }
*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
