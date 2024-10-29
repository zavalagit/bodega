<?php
namespace App\Traits;
use Auth;
use App\Peticion;
use App\Especialidad;
use App\Fiscalia;
use App\Unidad;
use App\User;

trait TraitPeticiones{

   protected $modelo,$modelo_id;

   public function set_modelo($request){
      if($request->filled('b_unidad') && ($request->b_unidad != 0)){
         $this->modelo = 'unidad';
         $this->modelo_id = $request->b_unidad;
      }else if($request->filled('b_region') && ($request->b_region != 0)){
         $this->modelo = 'region';
         $this->modelo_id = $request->b_region;
      }else{
         if(Auth::user()->tipo == 'usuario'){
            $this->modelo = 'user';
            $this->modelo_id =  Auth::id();
         }
         else if(Auth::user()->tipo == 'coordinador_peticiones_unidad'){
            $this->modelo = 'unidad';
            $this->modelo_id =  Auth::user()->unidad_id;
         }
         else if(Auth::user()->tipo == 'coordinador_peticiones_region'){
            $this->modelo = 'region';
            $this->modelo_id =  Auth::user()->fiscalia_id;
         }
      }
   }
   
   #peticiones_dia
   public function get_peticiones_dia($request, $peticion_tipo){
      return
      Peticion::where(function($q) use($request,$peticion_tipo){
         #peticion_tipo
         switch ($peticion_tipo) {
            // Peticiones que fueron registradas en el día
            case 'recibidas': $q->recibidas($request->b_fecha_inicio ?? date('Y-m-d')); break;
            // Peticiones que se registraron en el día y fueron atendidas en el día
            case 'atendidas': $q->recibidas($request->b_fecha_inicio ?? date('Y-m-d'))->atendidas($request->b_fecha_inicio ?? date('Y-m-d')); break;
            // Peticiones que se registraron en el día, pero <strong>no</strong> fueron atendidas en el día. Pude que ya hayan sido atendidas en fecha posterior
            case 'rezago':    $q->rezago($request->b_fecha_inicio ?? date('Y-m-d'))->atendidas($request->b_fecha_inicio ?? date('Y-m-d')); break;
            // Peticiones que se registraron en el día y aún <strong>no</strong> han sido atendidas
            case 'necros':    $q->necros($request->b_fecha_inicio ?? date('Y-m-d')); break;
         }
         #especialidad
         if ( $request->filled('b_especialidad') && ($request->b_especialidad != 0) ) {
            $q->especialidad($request->b_especialidad);
         }
         #solicitud
         if ( $request->filled('b_solicitud') && ($request->b_solicitud != 0) ) {
            $q->solicitud($request->b_solicitud);
         }
         if ( $request->has('violencia_familiar') ) {
            $q->where('unidad1_id',60);
         }
      })
      ->modelo($this->modelo,$this->modelo_id)
      ->get();
   }
   
   #peticion_estadistica
   public function get_peticiones_estadistica($request, $peticion_tipo){
      return
      Peticion::where(function($q) use($request,$peticion_tipo){
         #peticion_tipo
         switch ($peticion_tipo) {
            case 'recibidas':    $q->recibidas($request->b_fecha_inicio ?? date('Y-m-d'),$request->b_fecha_fin); break;
            case 'atendidas':    $q->atendidas($request->b_fecha_inicio ?? date('Y-m-d'),$request->b_fecha_fin); break;
            case 'pendientes':   $q->pendientes($request->b_fecha_inicio ?? date('Y-m-d'),$request->b_fecha_fin); break;
            case 'necros':       $q->necros($request->b_fecha_inicio ?? date('Y-m-d'),$request->b_fecha_fin); break;
         }
      })
      ->modelo($this->modelo,$this->modelo_id)
      ->get();
   }

   #peticiones_consultar
   public function peticiones_consultar($request){
      return
      Peticion::where(function($q) use($request){
		 #id
         if( $request->b_peticion_id ){
            $q->where('id',$request->b_peticion_id);
         }
         #fecha
         if ( $request->filled('b_fecha_inicio') ){
            $q->recibidas($request->b_fecha_inicio,$request->b_fecha_fin);
         }
         #especialidad
         if ( $request->filled('b_especialidad') && ($request->b_especialidad != 0) ) {
            $q->especialidad($request->b_especialidad);
         }
         #solicitud
         if ( $request->filled('b_solicitud') && ($request->b_solicitud != 0) ) {
            $q->solicitud($request->b_solicitud);
         }else{
			 $q->where('solicitud_id','<>',258);
		 }
         #nuc
         if ( $request->filled('b_nuc') != 0 ) {
            $q->nuc($request->b_nuc);
         }
         #estado
         if ( $request->filled('b_estado') && ($request->b_estado != '0') ) {
            $q->estado($request->b_estado);
         }
         #user
         if ( $request->filled('b_user') ) {
            $q->user($request->b_user);
         }
         if ( $request->filled('b_region') && ($request->b_region != 0) ) {
            $q->modelo($this->modelo,$this->modelo_id);
         }
      })
      ->modelo($this->modelo,$this->modelo_id)
      ->get();
   }
   
   public function peticiones_consultar_default(){
      if( Auth::user()->tipo == 'usuario' ){
         return
         Peticion::modelo($this->modelo,$this->modelo_id)
            ->latest()
            ->take(5)
            ->get();
      }else{
         return null;
      }
   }

   public function get_especialidades(){
      if ( $this->modelo == 'unidad' && in_array($this->modelo_id,[66,108]) ) {
         return Especialidad::where('id','<>',26)->get();
      }else{
         switch ($this->modelo) {
            case 'user': return Especialidad::where('unidad_id',Auth::user()->unidad_id)->get();
            case 'unidad': return Especialidad::where('unidad_id',$this->modelo_id)->get();
            case 'region': return Especialidad::where('id','<>',26)->get();
            default: return Especialidad::where('id','<>',26)->get();
         }         
      }
   }
}