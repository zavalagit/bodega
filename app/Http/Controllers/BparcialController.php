<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Cadena;
use App\Cargo;
use App\Cedula;
use App\Bparcial;
use App\Delegacion;
use App\Indicio;
use App\Embalaje;
use App\Naturaleza;
use App\Prestamo;
use App\Unidad;

class BparcialController extends Controller
{

   public function vista(){
      $bparciales = Bparcial::latest()->take(10)->get();

      return view('bodega.vista-bparciales',['bparciales'=>$bparciales]);
   }

   public function form($folio){
      $cedula = Cedula::find($folio);

      return view('bodega.bparcial-form',[
         'cedula' => $cedula
      ]);
   }

   public function store(Request $request){
      $validator = Validator::make($request->all(),[
         'concepto' => 'required',
         'numindicios' => 'required',
         'hora' => 'required',
         'fecha' => 'required',
         'recibe' => 'required'
      ]);

      if ($validator->fails()) {
         return response()->json([
            'satisfactorio' => false,
            'error' => $validator->errors()->all(),
         ]);
      }

      //revisando que al menos se elija un indicio para prestamo
      $indicios = Cedula::find($request->folio)->indicios;
      $bandera = 0;
      foreach ($indicios as $key => $indicio) {
         if( $request->has($indicio->id) ){
            $bandera = 1;
         }
      }
      if(!$bandera){
         return response()->json([
            'satisfactorio' => false,
            'error' => ['Elige al menos un indicio para prestamo'],
         ]);
      }

      $baja = new Bparcial;
      $baja->concepto = $request->concepto;
      $baja->numindicios = $request->numindicios;
      $baja->hora = $request->hora;
      $baja->fecha = $request->fecha;
      $baja->recibe = $request->recibe;
      if($request->has('observaciones'))
         $baja->observaciones = $request->observaciones;
      $baja->indicio_id = $indicio->id;
      $baja->save();

      //ultimo id de baja
      $idbaja = Bparcial::all()->last()->id;
      foreach ($indicios as $key => $indicio) {
         if( $request->has($indicio->id) ){
            $indicio->bparcial_id = $idbaja;
            $indicio->estado = 'baja';
            $indicio->save();
         }   
      }


      return response()->json([
         'satisfactorio' => true,
      //   'idprestamo' => $idprestamo
      ]);


   }

}
