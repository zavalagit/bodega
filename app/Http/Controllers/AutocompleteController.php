<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Perito;
use App\Cargo;
use App\User;

class AutocompleteController extends Controller
{
    public function autocompletar(Request $request){


      $usuarios = User::where('folio','like',"%{$request->buscar}%")->where('tipo','usuario')->orWhere('name','like',"%{$request->buscar}%")->where('tipo','usuario')->take(5)->get();

//        $usuarios = User::take(5)->get();


    	return response()->json([
         'usuarios' => $usuarios,

      	]);
    }

    public function perito(Request $request){
    	$perito = User::find($request->id);

      $cargo = $perito->cargo->nombre;
    	$institucion = $perito->institucion->nombre;

    	return response()->json([
         	'perito' => $perito,
         	'cargo'=>$cargo,
          'institucion' =>$institucion,
      ]);


    }
    
    public function users_lista(Request $request){
      $usuarios = User::where('folio','like',"%{$request->buscar}%")->orWhere('name','like',"%{$request->buscar}%")->take(5)->get();

    	return response()->json([
         'usuarios' => $usuarios,

      ]);
    }

    public function peritos_lista(Request $request){
      $peritos = Perito::where('folio','like',"%{$request->buscar}%")->orWhere('nombre','like',"%{$request->buscar}%")->take(5)->get();

    	return response()->json([
         'registros' => $peritos,

      ]);
    }

}
