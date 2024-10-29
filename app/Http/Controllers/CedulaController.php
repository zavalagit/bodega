<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Cadena;
use App\Cargo;
use App\Cedula;
use App\Delegacion;
use App\Indicio;
use App\Embalaje;
use App\Naturaleza;
use App\Prestamo;
use App\Unidad;

class CedulaController extends Controller
{
   public function cadenas(Request $request){

      if($request->get('buscar') != "")
         $cedulas = Cadena::buscar($request->get('buscar'))->get();
      else
         $cedulas = Cadena::where('estado', '=', 'validado');

      return view('bodega.cadenas',[
         'cadenas' => $cedulas
      ]);


/*
      $cadenas = Cadena::all()->where('visto', '=', false);

      return view('bodega.cadenas',[
         'cadenas' => $cadenas,
      ]);
*/
   }

   public function form_validar($idCadena){
      $cadena = Cadena::find($idCadena);

      $cargos = Cargo::all();
      $delegaciones = Delegacion::all();
      $embalajes = Embalaje::all();
      $naturalezas = Naturaleza::all();
      $unidades = Unidad::all();

      return view('bodega.alta',[
         'idCadena' => $idCadena,
         'cadena' => $cadena,
         'delegaciones' => $delegaciones,
         'embalajes' => $embalajes,
         'naturalezas' => $naturalezas,
         'cargos' => $cargos
      ]);

   }

   public function save_alta(Request $request){

      $validator = Validator::make($request->all(),[
         'folio' => 'required',
         'delegacion' => 'required',
         'numindicios' => 'required',
         'hora' => 'required',
         'fecha' => 'required',
         'naturaleza' => 'required',
         'embalaje' => 'required',
         'tipo' => 'required',
         'quien_entrega' => 'required',
         'cargo_quien_entrega' => 'required'
      ]);

      if ($validator->fails()) {
         return response()->json([
            'satisfactorio' => false,
            'error' => $validator->errors()->all(),
         ]);
      }
/*
      //calculado folio(primary key) para la cadena a guardar en bodega
      $folio;
      $ufolio = Cedula::all()->last();
      if($ufolio == NULL){
         $ano = date('y');
         $num = '00001';
         $folio = "{$ano}-{$num}";
      }else{
         $ufolio = $ufolio->folio;
         $ano = substr($ufolio,0,2);
         $num = substr($ufolio,3);

         if($ano == date('y')){
            $num = $num + 1;
            $num = str_pad($num,5,'0',STR_PAD_LEFT);
            $folio = "{$ano}-{$num}";
         }else{
            $ano = date('y');
            $num = '00001';
            $folio = "{$ano}-{$num}";
         }
      }

*/
      $cedula = new Cedula;
      $cedula->folio = $request->folio;
      $cedula->nuc = $request->nuc;
      $cedula->numindicios = $request->numindicios;
      $cedula->embalaje = $request->embalaje;
      $cedula->hora = $request->hora;
      $cedula->fecha = $request->fecha;
      $cedula->cadena_quien_entrega = $request->quien_entrega; //Quien entrga
      $cedula->cadena_cargo_quien_entrega = $request->cargo_quien_entrega; //Quien entrga cargo
      $cedula->tipo = $request->tipo;
      $cedula->unidad_id = $request->unidad;
      $cedula->user_id = $request->responsablebodega; //Quien recibe
      if($request->has('observacion'))
         $cedula->observacion = $request->observacion;
      $cedula->save();

      //Datos de la cadena a dar de alta
      $cadena = Cadena::find($request->idcadena);
      $cadena->visto = true;
      $cadena->save();

      //Agregando id cedula a los indicios
      Indicio::where('cadena_id',$request->idcadena)->update(['cedula_folio'=>$request->folio]);


      return response()->json([
         'satisfactorio' => true,
         'folio' => $request->folio,
      ]);

   }//save_alta

   public function entradas(Request $request){
      if($request->get('buscar') != "")
         $cedulas = Cedula::buscar($request->get('buscar'))->get();
      else
         $cedulas = Cedula::latest()->take(10)->get();

      return view('bodega.entradas',[
         'cedulas' => $cedulas
      ]);
   }



   public function pruebas(Request $request){
      $indicios = Cedula::find($request->folio)->indicios;

      $bandera = 0;
      foreach ($indicios as $key => $indicio) {
         if( $request->has($indicio->identificador) ){
            $bandera = 1;
         }
      }
      if(!$bandera){
         return response()->json([
            'satisfactorio' => false,
            'error' => ['Elige al menos un indicio para prestamo'],
         ]);
      }
      //Agregando indicio como prestado
      foreach ($indicios as $key => $indicio) {
         if( $request->has($indicio->identificador) ){
            echo "{$indicio->prestado} \n";
            $indicio->prestado = 1;
            $indicio->save();
         }
      }

   }

   public function prestamos(){
      $prestamos = Prestamo::all();

      return view('bodega.prestamos', [
         'prestamos' => $prestamos
      ]);
   }

   public function reingresos($idprestamo){
      $prestamo = Prestamo::find($idprestamo);
      $cargos = Cargo::all();

      return view('bodega.reingreso',[
         'prestamo' => $prestamo,
         'cargos' => $cargos
      ]);
   }


   public function bajas_definitivas(){
      return view('bodega.bajas');
   }


   public function realizar_baja($folio){
      $cedula = Cedula::find($folio);
      $cargos = Cargo::all();
      return view('bodega.realizarPrestamo',[
         'cedula' => $cedula,
         'cargos' => $cargos
      ]);
   }

}
