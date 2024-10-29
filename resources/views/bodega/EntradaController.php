<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use Validator;
use App\Cadena;
use App\Cargo;
use App\Delegacion;
use App\Entidad;
use App\Entrada;
use App\Fijacion;
use App\Fiscalia;
use App\Indicio;
use App\Naturaleza;
use App\Prestamo;
use App\Perito;
use App\Unidad;
use App\User;
use Config;

class EntradaController extends Controller
{

	protected function obtener_extencion($extensionTmp){
    $extensionTmp = explode('/',$extensionTmp);
    $extension = end($extensionTmp);
    return $extension;
  }

	public function cadena_a_validar(Request $request,$fis=""){

      if($fis != ""){
         $fiscalia = Fiscalia::where('nombre',$fis)->get();
         $fiscalia = $fiscalia[0];

      //   $fiscalia = (int)$id;
         $cadenas = Cadena::join('users',function($join) use ($fiscalia){
            $join->on('users.id','=','cadenas.user_id')
            ->where('users.fiscalia_id','=',$fiscalia->id)
            ->where('cadenas.estado','=','revision');
         })->get(['cadenas.*']);


         $fiscalia = Fiscalia::find($fiscalia);
         return view('bodega.cadenas_revisar',[
            'cadenas' => $cadenas,
            'fiscalia' => $fiscalia
         ]);
      }
      elseif($request->has('buscar') && ($request->buscar != NULL) ){
         $buscar = $request->buscar;
         $cadenas = Cadena::where( function($query) use ($buscar){
            $query->where('nuc','like',"%{$buscar}%")
                  ->orWhereHas('indicios',function($q) use ($buscar){
                    $q->where('descripcion','like',"%{$buscar}%");
                  })->orWhereHas('user',function($z) use ($buscar){
                     $z->where('name','like',"%{$buscar}%")->orWhere('folio','like',"%{$buscar}%");
                  });
               })->where('estado','revision')->where('fiscalia_id',Auth::user()->fiscalia_id)->orderBy('created_at','desc')->get();

         return view('bodega.cadenas_revisar',[
            'cadenas' => $cadenas,
            'buscar' => $request->buscar,
         ]);
      }
      else{
         $cadenas = Cadena::where('estado','revision')->where('fiscalia_id',Auth::user()->fiscalia_id)->orderBy('created_at','desc')->get();
      }



//      Config::set('fiscalia.nombre', $id);

      return view('bodega.cadenas_revisar',[
         'cadenas' => $cadenas
      ]);
   }


    public function form_validar($idCadena){
      $cadena = Cadena::find($idCadena);

      $cargos = Cargo::all();
      $entidades = Entidad::all();
      $delegaciones = Delegacion::where('entidad_id',16)->orderBy('nombre','asc')->get();
      $naturalezas = Naturaleza::all();
      $unidades = Unidad::all();

      return view('bodega.alta',[
         'idCadena' => $idCadena,
         'cadena' => $cadena,
         'entidades' => $entidades,
         'delegaciones' => $delegaciones,
         'naturalezas' => $naturalezas,
         'cargos' => $cargos
      ]);

   }


   public function save_alta(Request $request){


      $validator = Validator::make($request->all(),[
         'delegacion' => 'required',
         'hora' => 'required',
         'fecha' => 'required',
         'naturaleza' => 'required',
         'embalaje' => 'required',
         'numero_indicios.*' => 'required',
         'tipo' => 'required',
         'id_perito' => 'required',
				 'fotos.*' => 'mimes:jpg,jpeg,png',
      ]);

      if ($validator->fails()) {
         return response()->json([
            'satisfactorio' => false,
            'error' => $validator->errors()->all(),
         ]);
      }

      $entrada = new Entrada;
      $entrada->embalaje = $request->embalaje;
      $entrada->hora = $request->hora;
      $entrada->fecha = $request->fecha;
      $entrada->tipo = $request->tipo;
      $entrada->naturaleza_id = $request->naturaleza;
      $entrada->delegacion_id = $request->delegacion;
      $entrada->perito_id = $request->id_perito; //Quien entrega(perito)
      $entrada->user_id = Auth::id(); //Quien recibe (responsable de bodega)
      $entrada->cadena_id = $request->id_cadena; //Quien recibe (responsable de bodega)
      $entrada->observacion = $request->observacion;
      $entrada->save();

      //Asignando 'validado', en el campo 'estado' de la cadena
      $cadena = Cadena::find($request->id_cadena);
      $cadena->estado = 'validada';
      $cadena->save();

      //Asignando numero de indicios a los Identificadores
      foreach ($cadena->indicios as $key => $indicio) {
         $indicio->numero_indicios = $request->numero_indicios[$key];
         $indicio->save();
      }

			/*--FIJACIÓN--*/
      if ($request->has('fotos')) {
        $ruta = public_path('fijaciones');
        $contador = 1;
        foreach ($request->file('fotos')  as $key => $foto) {
          $fijacion_img = Image::make($foto);
          $extension = $this->obtener_extencion($fijacion_img->mime());
          $fijacion_img_nombre = "{$cadena->id}_{$contador}.{$extension}";
          $contador += 1;
          $fijacion_img->save("{$ruta}/{$fijacion_img_nombre}", 100);
          //agregar a la BDD
          $fijacion = new Fijacion;
          $fijacion->nombre = $fijacion_img_nombre;
          $fijacion->cadena_id = $cadena->id;
          $fijacion->save();
        }
      }

      return response()->json([
         'satisfactorio' => true,
         'folio' => $request->folio_bodega,
      ]);

   }//save_alta

   public function entradas(Request $request){
/*
      if( $request->has('buscar') && $request->has('filtro') && ($request->get('buscar') != '' ) ){

         $buscar = $request->buscar;

         switch ($request->get('filtro')) {
            case 1:
               $cadenas = Cadena::with('indicios')->whereHas('indicios',function($q) use($buscar){
                  $q->where('descripcion','like',"%{$buscar}%");
               })->get();
               $cadenas = $cadenas->sortBy('folio_bodega');
               break;
            case 2:
               $cadenas = Cadena::where('fiscalia_id',Auth::user()->fiscalia_id)->with('entrada')->whereHas('entrada',function($q) use ($buscar){
                  $q->whereDate('fecha',$buscar);
               })->get();
               $cadenas = $cadenas->sortBy('folio_bodega');
               break;
            case 3:
               $cadenas = Cadena::where('folio_bodega','like',"%{$buscar}%")->where('estado','validada')->where('fiscalia_id',Auth::user()->fiscalia_id)->get();
               break;
            case 4:
                $cadenas = collect();
               $entradas = Entrada::whereTime('hora',$buscar)->where('estado','validada')->get();
               foreach ($entradas as $key => $entrada) {
                  $cadenas->push($entrada->cadena);
               }
            case 5:
               $cadenas = Cadena::where('nuc','like',"%{$buscar}%")->where('fiscalia_id',Auth::user()->fiscalia_id)->where('estado','validada')->get();
               break;
            case 6:
               $cadenas = Cadena::where('fiscalia_id',Auth::user()->fiscalia_id)->with('entrada')->whereHas('entrada',function($q) use ($buscar){
                  $q->where('naturaleza_id',$buscar);
               })->get();
               $cadenas = $cadenas->sortBy('folio_bodega');
               break;
            default:
               echo "hola";
               break;
         }

      }
      else{

     $cadenas = Cadena::where('fiscalia_id',Auth::user()->fiscalia_id)->where('estado','validada')->latest()->take(1000)->get();
    	$cadenas = $cadenas->sortByDesc('folio_bodega')->take(70);


      }
*/
			$naturalezas = Naturaleza::all();

			//Naturaleza, Fecha, Texto
			if( ($request->buscar_naturaleza > 0) && ( $request->buscar_fecha != NULL) && ( $request->buscar_texto != NULL) ){
				$naturaleza = $request->buscar_naturaleza;
				$fecha = $request->buscar_fecha;
				$buscar = $request->buscar_texto;

				$cadenas = Cadena::where( function($query) use ($buscar){
					$query->where('folio_bodega','like',"%{$buscar}%")
								->orWhere('nuc','like',"%{$buscar}%")
								->orWhereHas('indicios',function($q) use ($buscar){
					        $q->where('descripcion','like',"%{$buscar}%");
								});
				})->whereHas('entrada',function($c) use ($naturaleza,$fecha){
					$c->where('naturaleza_id', $naturaleza)->where('fecha',$fecha);
				})->where('fiscalia_id',Auth::user()->fiscalia_id)->get();
			}
			//Naturaleza, Fecha
			elseif( ($request->buscar_naturaleza > 0) && ( $request->buscar_fecha != NULL) && ( $request->buscar_texto == NULL) ) {

				$naturaleza = $request->buscar_naturaleza;
				$fecha = $request->buscar_fecha;
				$cadenas = Cadena::whereHas('entrada', function($q) use ($naturaleza, $fecha){
					$q->where('naturaleza_id', $naturaleza)->where('fecha',$fecha);
				})->where('fiscalia_id',Auth::user()->fiscalia_id)->get();
			}
			//Naturaleza, Texto
			elseif ( ($request->buscar_naturaleza > 0) && ( $request->buscar_fecha == NULL) && ( $request->buscar_texto != NULL) ) {
				$naturaleza = $request->buscar_naturaleza;
				$buscar = $request->buscar_texto;

				$cadenas = Cadena::whereHas('indicios',function($q) use ($buscar){
						$q->where('descripcion','like',"%{$buscar}%");
				})->whereHas('entrada',function($c) use($naturaleza){
					$c->where('naturaleza_id',$naturaleza);
				} )->where('fiscalia_id',Auth::user()->fiscalia_id)->get();
			}
			//Fecha, Texto
			elseif ( ($request->buscar_naturaleza == 0) && ($request->buscar_fecha != NULL) && ($request->buscar_texto != NULL) ) {
				$fecha = $request->buscar_fecha;
				$buscar = $request->buscar_texto;

				$cadenas = Cadena::whereHas('indicios',function($q) use ($buscar){
						$q->where('descripcion','like',"%{$buscar}%");
				})->whereHas('entrada',function($c) use($fecha){
					$c->where('fecha',$fecha);
				} )->where('fiscalia_id',Auth::user()->fiscalia_id)->get();
			}
			//Fecha
			elseif ( ($request->buscar_naturaleza == 0) && ($request->buscar_fecha != NULL) && ( $request->buscar_texto == NULL)) {
				$fecha = $request->buscar_fecha;
				$cadenas = Cadena::whereHas('entrada',function($q) use($fecha){
					$q->where('fecha',$fecha);
				})->where('fiscalia_id',Auth::user()->fiscalia_id)->orderBy('folio_bodega','asc')->get();
			}
			//Texto
			elseif ( ($request->buscar_naturaleza == 0) && ($request->buscar_fecha == NULL) && ($request->buscar_texto != NULL) ) {
				$buscar = $request->buscar_texto;
				$cadenas = Cadena::where(function ($query) use ($buscar){
					$query->where('folio_bodega','like',"%{$buscar}%")->orWhere('nuc','like',"%{$buscar}%")->orWhereHas('indicios',function($q) use ($buscar){
		        $q->where('descripcion','like',"%{$buscar}%");
					});
				})->where('fiscalia_id',Auth::user()->fiscalia_id)->orderBy('folio_bodega','asc')->get();
			}
			//Ninguna Busqueda
			else {
				$cadenas = Cadena::where('fiscalia_id',Auth::user()->fiscalia_id)->where('estado','validada')->latest()->take(1000)->get();
				$cadenas = $cadenas->sortByDesc('folio_bodega')->take(70);
			}

			if($request->has('buscar_naturaleza')){
				return view('bodega.cadenas_entradas',[
					'cadenas' => $cadenas,
					'naturalezas' => $naturalezas,
					'buscar_naturaleza' => $request->buscar_naturaleza,
					'fecha' => $request->buscar_fecha,
					'texto' => $request->buscar_texto,
				]);
			}else{
				return view('bodega.cadenas_entradas',[
					'cadenas' => $cadenas,
					'naturalezas' => $naturalezas,
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

//dd($request->all());

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



}
