<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BajaFormRequest;
use App\Traits\TraitIndicioEstado;
use Auth;
use Validator;
use App\Baja;
use App\Cadena;
use App\Indicio;
use App\Institucion;
use App\Fiscalia;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BajaController extends Controller
{
   use TraitIndicioEstado;

   public $cadena;
   public $baja;
   public $formAccion;

   public function __construct(){
      setlocale(LC_TIME,"es_MX.UTF-8");
      date_default_timezone_set('America/Mexico_City');
   }
   public function baja_form($formAccion, Cadena $cadena, Baja $baja){
	  $instituciones = Institucion::all();
	  $regiones = Fiscalia::all();
      return view('baja.baja_form',compact('formAccion','cadena','baja','instituciones','regiones'));
	}
   public function set_baja_atributos(Request $request){
	   $this->baja->motivo = $request->motivo;
	   $this->baja->institucion_id = $request->institucion_id;
	   if($request->filled('fiscalia_id')) $this->baja->fiscalia_id = $request->fiscalia_id;
      $this->baja->concepto = strtoupper($request->baja_concepto);
      $this->baja->hora = $request->baja_hora;
      $this->baja->fecha = $request->baja_fecha;
      // $this->baja->tipo = $request->baja_tipo;
      $this->baja->estado_cadena = $request->baja_cadena_estado;
      $this->baja->embalaje = $request->baja_embalaje;
      $this->baja->observaciones = $request->baja_observaciones;
      $this->baja->user_id = $request->baja_entrega;//baja entrega (Responsable de bodega)
      if($request->input_radio_baja_recibe == 'servidor_publico'){
         $this->baja->perito_id = $request->baja_recibe;//baja recive (servidor publico)
         $this->baja->identificacion = null;//Identificación IFE, INE, ect. (Ciudadano)
         $this->baja->quien_recibe = null;//baja recibe (Ciudadano)
      }
      else if($request->input_radio_baja_recibe == 'civil'){
         $this->baja->perito_id = null;//baja recive (servidor publico)
         $this->baja->identificacion = $request->baja_recibe_civil_identificacion;//Identificación IFE, INE, ect. (Ciudadano)
         $this->baja->quien_recibe = $request->baja_recibe_civil_nombre;//baja recibe (Ciudadano)
      }
      $this->baja->cadena_id = $this->cadena->id;
      $this->baja->save();
   }
   public function set_baja_indicios(Request $request){
      $indicios = Indicio::find($request->indicios);
      foreach ($indicios as $key => $indicio) {
         $tipo_baja = $request->indicios_baja_tipo[$indicio->id];
         $this->baja->indicios()->attach($indicio->id,[
            'baja_descripcion' => ($tipo_baja == 'parcial') ? $request->baja_parcial_descripcion[$indicio->id] : null,
            'baja_cantidad_indicios' => ($tipo_baja == 'parcial') ? $request->baja_parcial_cantidad_indicios[$indicio->id] : $indicio->numero_indicios,
            'baja_tipo' => $tipo_baja,
            'baja_descripcion_antes' => isset($indicio->indicio_descripcion_disponible) ? $indicio->indicio_descripcion_disponible : null,
         ]);

         $this->set_indicio_estado($indicio); //indicio_estado
         $indicio->indicio_cantidad_disponible -= ($tipo_baja == 'parcial') ? $request->baja_parcial_cantidad_indicios[$indicio->id] : $indicio->numero_indicios;
         $indicio->indicio_descripcion_disponible =  $request->filled('baja_descripcion_disponible') ? $request->baja_descripcion_disponible[$indicio->id] : null;
         $indicio->save();
      }
      $this->baja->numero_indicios = $this->baja->indicios->sum('pivot.baja_cantidad_indicios');
      $this->baja->save();
   }
   public function baja_save(BajaFormRequest $request, $formAccion, Cadena $cadena, Baja $baja){
      // return response()->json([
      //    'satisfactorio' => false,
      //    'request' => $request->all(),
      // ]);

      $this->formAccion = $formAccion;
      $this->cadena = $cadena;
      $this->baja = isset($baja->id) ? $baja : new Baja;

      $this->set_baja_atributos($request);
      if($formAccion == 'registrar') $this->set_baja_indicios($request);

      return response()->json([
         'respuesta' => true,
         'baja_id' => $this->baja->id,
         'accion' => $formAccion,
      ]);
   }
   public function baja_eliminar(Baja $baja){
      foreach ($baja->indicios as $i => $indicio) {
         $indicio->indicio_descripcion_disponible = isset($indicio->pivot->baja_descripcion_antes) ? $indicio->pivot->baja_descripcion_antes : null;
         $indicio->indicio_cantidad_disponible += $indicio->pivot->baja_cantidad_indicios;
         $indicio->save();
      }
      $indicios = $baja->indicios;
      $baja->indicios()->detach(); //eliminar indicios de la baja
      $baja->delete(); //eliminar baja
      foreach ($indicios as $i => $indicio) {
         $this->set_indicio_estado($indicio); //indicio_estado
      }
      return response()->json([
         'status' => true,      
      ]);
   }
}
