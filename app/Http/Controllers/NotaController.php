<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Cadena;

class NotaController extends Controller
{
    public function nota_guardar(Request $request){
    	$validator = Validator::make($request->all(), [
            'nota' => 'required',
      ]);
      //Enviar error de validaciones
      if ($validator->fails()) {
         return response()->json([
            'satisfactorio' => false,
            'error' => $validator->errors()->all(),
         ]);
      }

      $cadena = Cadena::find($request->id_cadena);
      $cadena->nota = $request->nota;
      $cadena->estado = 'rechazada';
      $cadena->save();

      //Mandando mensaje satisfactorio
      return response()->json([
         'satisfactorio' => true,
      ]);

    }


    public function nota_obtener(Request $request){

    	$cadena = Cadena::find($request->id);

    	return response()->json([
         'cadena' => $cadena,
      ]);
      
    }
}
