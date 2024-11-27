<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;

class DestruccionController extends Controller
{
    public function indicio_destruccion(Request $request){
        // echo "hola destruccion";
        set_time_limit(0);
      if ( $request->has('buscar_btn') && $request->filled('buscar_texto') ) {
         $cadenas = Cadena::/*where('fiscalia_id',Auth::user()->fiscalia_id)
                           ->*/where('estado','validada')
                           ->where(function($q) use($request){
                              $q->where('nuc','like',"%{$request->buscar_texto}%")
                              ->orWhereHas('indicios',function($a) use($request){
                                 $a->where('descripcion','like',"%{$request->buscar_texto}%");
                              });
                           })->take(50)
                           ->get();

         return view('destruccion.destruccion',[
            'cadenas' => $cadenas,
            'buscar_texto' => $request->buscar_texto,
         ]);
      }
        return view('destruccion.destruccion');
    }

    public function destruccion_form($formAccion,Cadena $cadena){
      //dd($formAccion);
      if ($formAccion == 'registrar' ) {

         return view('destruccion.destruccion_form',compact('formAccion','cadena'));
      }
      
   }
}
