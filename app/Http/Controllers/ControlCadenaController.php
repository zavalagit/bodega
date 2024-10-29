<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Cadena;

class ControlCadenaController extends Controller
{
    public function validar_guardar(){
    	echo "hola";
    }

    public function cadenas_rechazadas(Request $request){
  		if($request->get('buscar') != "")
  			$cadenas = Cadena::buscar($request->get('buscar'))->get();
  		else{
        $cadenas = Cadena::join('users',function($join){
            $join->on('users.id','=','cadenas.user_id')
            ->where('users.fiscalia_id','=',Auth::user()->fiscalia_id)
            ->where('cadenas.estado','=','rechazada');
         })->get(['cadenas.*']);
      }  		

  		return view('bodega.rechazadas',[
  		'cadenas' => $cadenas
  		]);
    }

    public function cadenas_validadas(Request $request){
		if($request->get('buscar') != "")
			$cadenas = Cadena::buscar($request->get('buscar'))->get();
		else
			$cadenas = Cadena::where('estado', '=', 'validado')->get();

		return view('bodega.rechazadas',[
		'cadenas' => $cadenas
		]);
    }    

    public function cadenas_espera(Request $request){
		  if($request->has('buscar') != "")
			 $cadenas = Cadena::buscar($request->get('buscar'))->get();
		  else{
      $cadenas = Cadena::where('estado','espera')->where('fiscalia_id',Auth::user()->fiscalia_id)->get();
    }

		return view('bodega.espera',[
		'cadenas' => $cadenas
		]);
    }


   //  public function asignar_folio(Request $request){

   //  	$validator = Validator::make($request->all(), [
   //          'folio' => 'required|unique:cadenas,folio_bodega',
   //    ]);
   //    //Enviar error de validaciones
   //    if ($validator->fails()) {
   //       return response()->json([
   //          'satisfactorio' => false,
   //          'error' => $validator->errors()->all(),
   //       ]);
   //    }

   //    $cadena = Cadena::find($request->id_cadena);

   //    $cadena->folio_bodega = $request->folio;
   //    $cadena->estado = 'espera';
   //    $cadena->save();

   //    //Mandando mensaje satisfactorio
   //    return response()->json([
   //       'satisfactorio' => true,
   //       'id' => $cadena->id,
   //       'folio' => $request->folio
   //    ]);

   //  }
}
