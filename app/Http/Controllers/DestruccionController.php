<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Depuracion;
use App\Cadena;
use App\Indicio;
use App\Soltdepuracion;
use App\Institucion;
use App\Fiscalia;

class DestruccionController extends Controller
{
   public $cadena;
   public $depuracion;
   public $formAccion;

   public function __construct(){
      setlocale(LC_TIME,"es_MX.UTF-8");
      date_default_timezone_set('America/Mexico_City');
   }


    public function indicio_destruccion(Request $request){
        // echo "hola destruccion";
        set_time_limit(0);
      if ( $request->has('buscar_btn') && $request->filled('buscar_texto') ) {
         $cadenas = Cadena::where('estado','validada')
                           ->where(function($q) use($request){
                                $q->where('nuc','like',"%{$request->buscar_texto}%")
                                    ->WhereHas('indicios',function($a){
                                       $a->whereIN('estado',['activo','prestamo']);
                                
                                    });
                          })->take(70)
                          ->get();                  
         //dd($cadenas);
         return view('destruccion.destruccion',[
            'cadenas' => $cadenas,
            'buscar_texto' => $request->buscar_texto,
         ]);
      }
        return view('destruccion.destruccion');
    }

    public function destruccion_form($formAccion,Cadena $cadena, Depuracion $depuracion){
      //dd($formAccion);
      $instituciones = Institucion::all();
	   $regiones = Fiscalia::all();
      $solicitud_depuraciones = Soltdepuracion::all();
         return view('destruccion.destruccion_form',compact('formAccion', 'cadena', 'depuracion', 'solicitud_depuraciones','instituciones','regiones'));
      
   }
}
