<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DepuracionFormRequest;
use App\Traits\TraitIndicioEstado;
use Auth;
use App\Depuracion;
use App\Cadena;
use App\Indicio;
use App\Soltdepuracion;
use App\Institucion;
use App\Fiscalia;

class DestruccionController extends Controller
{
   use TraitIndicioEstado;
   public $cadena;
   public $depuracion;
   public $formAccion;
   public $solicitud;

   public function __construct(){
      setlocale(LC_TIME,"es_MX.UTF-8");
      // no tiene zona horario de verano
      date_default_timezone_set('America/Regina');
   }

   public function listado_destruccion(){
      // aqui se va a mostrar el listado seleccionando indicios y agregando la solicitud depuracion
      // prueba de la columna folio_interno
      // $numero = 22;
      // $numeroConCeros = str_pad($numero, 5, "0", STR_PAD_LEFT);

      // echo $numeroConCeros;
      // dd(date($numeroConCeros));
      return view('destruccion.destruccion_listado');
   }

   public function listado_soldepuracion(){
      $solicitud_depuraciones = Soltdepuracion::all();
      return view('destruccion.solicitud_depuracion_listado', compact('solicitud_depuraciones'));
   }

   public function soldepuracion_form($formAccion, Soltdepuracion $solicitud){
      // dd([$formAccion, $solicitud]);
      return view('destruccion.solicitud_depuracion_form',compact('formAccion','solicitud'));
   }

   public function soldepuracion_save(Request $request){
      //dd($request->all());
      return response()->json([
         'satisfactorio' => false,
         'request' => $request->all(),
      ]);

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
      //dd(date('H:i'));
      $instituciones = Institucion::all();
	   $regiones = Fiscalia::all();
      $solicitud_depuraciones = Soltdepuracion::all();
         return view('destruccion.destruccion_form',compact('formAccion', 'cadena', 'depuracion', 'solicitud_depuraciones','instituciones','regiones'));
      
   }

   public function set_depuracion_atributos(Request $request){
	   $this->depuracion->soldepuracion = $request->solicitud_id;
      $this->depuracion->cadena_id = $this->cadena->id;
      $this->depuracion->user_id = $request->user_id;//quien realizo el registro (Responsable de bodega)
      $this->depuracion->hora = $request->registro_hora;
      $this->depuracion->fecha = $request->registro_fecha;
      $this->depuracion->observaciones = strtolower($request->registro_observaciones);

      $this->depuracion->save();
   }

   public function set_depuracion_indicios(Request $request){
      $indicios = Indicio::find($request->indicios);
      foreach ($indicios as $key => $indicio) {
         $tipo_depuracion = $request->indicios_baja_tipo[$indicio->id];
         $this->depuracion->indicios()->attach($indicio->id,[
            'depuracion_descripcion' => ($tipo_depuracion == 'parcial') ? $request->baja_parcial_descripcion[$indicio->id] : null,
            'depuracion_cantidad_indicios' => ($tipo_depuracion == 'parcial') ? $request->baja_parcial_cantidad_indicios[$indicio->id] : $indicio->numero_indicios,
            'listdepuracion_tipo' => $tipo_depuracion,
            'depuracion_descripcion_antes' => isset($indicio->indicio_descripcion_disponible) ? $indicio->indicio_descripcion_disponible : null,
         ]);

         $this->set_indicio_estado($indicio); //indicio_estado
         $indicio->indicio_cantidad_disponible -= ($tipo_depuracion == 'parcial') ? $request->baja_parcial_cantidad_indicios[$indicio->id] : $indicio->numero_indicios;
         $indicio->indicio_descripcion_disponible =  $request->filled('baja_descripcion_disponible') ? $request->baja_descripcion_disponible[$indicio->id] : null;
         $indicio->save();
      }
      $this->depuracion->depuracion_numindicios = $this->depuracion->indicios->sum('pivot.depuracion_cantidad_indicios');
      $this->depuracion->save();
   }

   public function depuracion_save(DepuracionFormRequest $request, $formAccion, Cadena $cadena, Depuracion $depuracion){
      //dd([$formAccion, $cadena, $depuracion->id]);
      //dd($request->all());
      // return response()->json([
      //    'satisfactorio' => false,
      //    'request' => $request->all(),
      // ]);

      $this->formAccion = $formAccion;
      $this->cadena = $cadena;
      $this->depuracion = isset($depuracion->id) ? $depuracion : new Depuracion;

      $this->set_depuracion_atributos($request);
      if($formAccion == 'registrar') $this->set_depuracion_indicios($request);

      return response()->json([
         'respuesta' => true,
         'accion' => $formAccion,
      ]);
   }
}
