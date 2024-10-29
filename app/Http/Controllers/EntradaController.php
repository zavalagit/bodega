<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;
use Validator;
use App\Cadena;
use App\Cargo;
use App\Delegacion;
use App\Entidad;
use App\Entrada;
use App\Fiscalia;
use App\Indicio;
use App\Naturaleza;
use App\Prestamo;
use App\Perito;
use App\Unidad;
use App\User;
use App\Exports\ExcelViewExport;
use Maatwebsite\Excel\Facades\Excel;


class EntradaController extends Controller
{
	public function cadena_a_validar(Request $request){
      set_time_limit(0);
      if ( $request->has('buscar_btn') && $request->filled('buscar_texto') ) {
         $cadenas = Cadena::/*where('fiscalia_id',Auth::user()->fiscalia_id)
                           ->*/where('estado','revision')
                           ->where(function($q) use($request){
                              $q->where('nuc','like',"%{$request->buscar_texto}%")
                              ->orWhereHas('user',function($a) use($request){
                                 $a->where('folio','like',"%{$request->buscar_texto}%")
                                 ->orWhere('name','like',"%{$request->buscar_texto}%");
                              })
                              ->orWhereHas('indicios',function($a) use($request){
                                 $a->where('descripcion','like',"%{$request->buscar_texto}%");
                              });
                           })
                           ->get();

         return view('bodega.cadenas',[
            'cadenas' => $cadenas,
            'buscar_texto' => $request->buscar_texto,
         ]);
      }

      return view('bodega.cadenas');
   }


    public function form_validar($idCadena){
      $cadena = Cadena::find($idCadena);

      $cargos = Cargo::all();
      $entidades = Entidad::all();
      $delegaciones = Delegacion::where('entidad_id',16)->orderBy('nombre','asc')->get();
      $naturalezas = Naturaleza::all();
      $unidades = Unidad::all();

      return view('bodega.alta',[
         'cadena' => $cadena,
         'entidades' => $entidades,
         'delegaciones' => $delegaciones,
         'naturalezas' => $naturalezas,
         'cargos' => $cargos
      ]);

   }


   public function save_alta(Request $request){
      setlocale(LC_TIME,"es_MX.UTF-8");
      date_default_timezone_set("America/Mexico_City");

      $mensajes = [
         'folio.required' => 'El campo "Folio" es requerido.',
         'folio.unique' => 'Ese número de Folio ya está asignado a otra Cadena.',
         'fecha.required' => 'El campo "fecha" es requerido.',
         'fecha.before_or_equal' => 'La "fecha" debe ser menor o igual a '.date('d-m-Y').'.',
         'hora.required' => 'El campo "hora" es requerido.',
         'hora.before_or_equal' => 'La "hora" debe ser menor o igual a '.date('H:i:s').' hrs.',
         'naturaleza.required' => 'El campo "naturaleza" es requerido.',
         'embalaje.required' => 'El campo "embalaje" es requerido.',
         'numero_indicios.*.required' => 'El cantidad de indicios/evidencias es requerida',
         'numero_indicios.*.min' => 'El cantidad de indicios/evidencias debe ser de al menos 1',
         'tipo.required' => 'El campo "tipo" es requerido.',
         'perito.required' => 'El Servidor Público que entrega es requerido.',
         'responsable_bodega.required' => 'El Responsable de Bodega que recibe es requerido.',
      ];
      
      $validator = Validator::make($request->all(),[
         'folio' => 'required|unique:sqlsrv.bodega.cadenas,folio_bodega',
         'delegacion' => 'required',
         'fecha' => 'required|date|before_or_equal:today',
         'hora' => 'required',
         'naturaleza' => 'required',
         'embalaje' => 'required',
         'numero_indicios.*' => 'required|numeric|min:1',
         'tipo' => 'required',
         'perito' => 'required',
         'responsable_bodega' => 'required',
      ],$mensajes);

      $validator->sometimes('hora',"before_or_equal:".date('H:i:s'),function($input){
         if($input->fecha == date('Y-m-d'))
            return true;
      });

      if ($validator->fails()) {
         return response()->json([
            'satisfactorio' => false,
            'error' => $validator->errors()->all(),
         ]);
      }



      
      $entrada = new Entrada;
//      $entrada->numindicios = $request->numindicios;
      $entrada->embalaje = $request->embalaje;
      $entrada->hora = $request->hora;
      $entrada->fecha = $request->fecha;     
      $entrada->tipo = $request->tipo;
      $entrada->naturaleza_id = $request->naturaleza;
      $entrada->delegacion_id = $request->delegacion;
      $entrada->perito_id = $request->perito; //Quien entrega(perito)
      $entrada->user_id = $request->responsable_bodega; //Quien recibe (responsable de bodega)
      $entrada->cadena_id = $request->id_cadena; //Quien recibe (responsable de bodega)
//      if($request->has('observacion'))
         $entrada->observacion = $request->observacion;
	 $entrada->tiene_oficio_fgr = $request->filled('tiene_oficio_fgr') ? 1 : 0;
	$entrada->tiene_oficio_sedena = $request->filled('tiene_oficio_sedena') ? 1 : 0;
      $entrada->save();

      //Asignando 'validado', en el campo 'estado' de la cadena
      $cadena = Cadena::find($request->id_cadena);
      $cadena->folio_bodega = $request->folio;
      $cadena->estado = 'validada';
      $cadena->editar = 'no';
      $cadena->fiscalia_id = Auth::user()->fiscalia_id;
	  $cadena->naturaleza_id = $request->naturaleza;
      $cadena->save();

      //Asignando numero de indicios a los Identificadores
      foreach ($cadena->indicios as $key => $indicio) {         
         $indicio->numero_indicios = $request->numero_indicios[$key];
		 $indicio->indicio_cantidad_disponible = $request->numero_indicios[$key];
         $indicio->save();         
      }


      return response()->json([
         'satisfactorio' => true,
         'folio' => $cadena->folio_bodega,
      ]);

   }//save_alta

   public function entradas(Request $request){
      set_time_limit(0);
      if ( $request->has('btn') && ( $request->filled('buscar_fecha_inicio') || $request->filled('buscar_texto') ) ) {
         //  dd('entassssaddasdasdasd');
         $cadenas = Cadena::where(function($q) use($request){
                              if ( $request->filled('buscar_naturaleza') && ($request->buscar_naturaleza > 0) ) {
                                 $q->whereHas('entrada',function($a) use($request){
                                    $a->where('naturaleza_id',$request->buscar_naturaleza);
                                 });
                              }
                              if ( $request->filled('buscar_fecha_inicio') ) {
                                 $q->whereHas('entrada',function($a) use($request){
                                    if($request->filled('buscar_fecha_fin'))
                                       $a->whereBetween('fecha',[$request->buscar_fecha_inicio,$request->buscar_fecha_fin]);
                                    else
                                       $a->where('fecha',$request->buscar_fecha_inicio);
                                 });
                              }
                              if ( $request->filled('buscar_texto') ) {
                                 $q->where(function($a) use($request){
                                    $a->where('folio_bodega','like',"%{$request->buscar_texto}%")
                                    ->orWhere('nuc','like',"%{$request->buscar_texto}%")
                                    ->orWhereHas('indicios',function($b) use($request){
                                       $b->where('descripcion','like',"%{$request->buscar_texto}%");
                                    });
                                 });
                              }
                           })
                           #Región
                           ->where(function($q) use($request){
                              if( $request->filled('buscar_region') ){
                                 $q->where('fiscalia_id',$request->buscar_region);
                              }
                              else{
                                 if(Auth::user()->tipo != 'administrador')
                                    $q->where('fiscalia_id',Auth::user()->fiscalia_id);
                              }
                           })
                           #validada cadena
                           ->where(function($q) use($request){
                              if( (Auth::user()->tipo == 'responsable_bodega') || ($request->filled('prestamo_multiple')) )
                                 $q->where('estado','validada');
                           })
                           ->with('entrada')
                           ->with('indicios')
                           ->get();
      }
      else{
         $cadenas = Cadena::where('estado','validada')
                           #Región
                           ->where(function($q) use($request){
                              if( $request->filled('buscar_region') ){
                                 $q->where('fiscalia_id',$request->buscar_region);
                              }
                              else{
                                 $q->where('fiscalia_id',Auth::user()->fiscalia_id);
                              }
                           })
                           ->latest('updated_at')->take(20)
                           ->with('entrada')
                           ->with('indicios')
                           ->get();    
      }
      
      if ($cadenas->count()) {
         $cadenas = $cadenas->sortByDesc('folio_bodega')->values();
      }

      if($request->filled('prestamo_multiple')){
         return view('prestamo.prestamo_multiple',compact('cadenas'));
      }
      else{
         // dd('entrasd');
         $naturalezas = Naturaleza::all();
         $regiones = Fiscalia::all();
         return view('bodega.entradas',[
            'cadenas' => $cadenas,
            'regiones' => $regiones,
            'naturalezas' => $naturalezas,
            'buscar_region' => $request->buscar_region,
            'buscar_naturaleza' => $request->buscar_naturaleza,
            'buscar_fecha_inicio' => $request->buscar_fecha_inicio,
            'buscar_fecha_fin' => $request->buscar_fecha_fin,
            'buscar_texto' => $request->buscar_texto,
         ]);
      }

   }


   public function autocompletar(Request $request){
      $usuarios = Perito::where('folio','like',"%{$request->buscar}%")->orWhere('nombre','like',"%{$request->buscar}%")->take(5)->get();

      return response()->json([
         'usuarios' => $usuarios,
      ]);
   }

   public function perito_entrega(Request $request){
      $perito = Perito::find($request->id);

        $cargo = $perito->cargo->nombre;
      $institucion = $perito->institucion->nombre;

      return response()->json([
            'perito' => $perito,
            'cargo'=>$cargo,
            'institucion' =>$institucion,
         ]);
   } 


   //---
   //REPORTE
   public function reporte(){
      $users = User::where('tipo','responsable_bodega')->orWhere('tipo','administrador')->where('fiscalia_id','4')->get();

      return view('bodega.reporte',['users'=>$users]);
    }

   public function generareporte(Request $request){
      
      
/*
      $entradas = Entrada::whereBetween('fecha', [$request->fecha1, $request->fecha2 ,
         'hora', $request->hora1, $hora1,
      'hora', $hora2, $request->$hora2 ]) ->get();
*/

      $dia1 = Entrada::where('fecha',$request->fecha1)
            ->whereBetween('hora', [$request->hora1,'23:59:59'])->get();

      $dia2 = Entrada::where('fecha', $request->fecha2)
            ->whereBetween('hora', ['00:00:00',$request->hora2])->get();

      $entradas = $dia1->concat($dia2);      

      return view('bodega.reporte-mostrar',['entradas' => $entradas]);
   }
     
   /*--Administracion entradas--*/
   public function administracion_entradas(){
      // if (condition) {
      //    # code...
      // }
   }


   public function entrada_acciones(Cadena $cadena){
      return view('entrada.entrada_acciones_modal',['cadena' => $cadena]);
   }

}
