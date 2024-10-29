<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Cadena;
use App\Caja;
use App\Charola;
use App\Lugar;
use App\Indicio;

class ResguardoController extends Controller
{
   public function vista($id_cadena){
      $cadena = Cadena::find($id_cadena);

//      $lugares = Lugar::all();
//      $charolas = Charola::all();
//      $cajas = Caja::all();

      return view('resguardo.vista',[
         'cadena'=>$cadena,
         
      ]);
   }

   public function form_bodega(){
      $lugares = Lugar::all();
      return view('resguardo.vista-administrar',[
         'lugares'=>$lugares,
      ]);
   }

   public function store_lugar(Request $request){
      $validator = Validator::make($request->all(),[
         'lugar' => 'required|unique:lugares,nombre',
      ]);

      if ($validator->fails()) {
         return response()->json([
            'satisfactorio' => false,
            'error' => $validator->errors()->all(),
         ]);
      }

      $lugar = new Lugar;
      $lugar->nombre = $request->lugar;
      $lugar->save();

      return response()->json([
         'satisfactorio' => true
      ]);

   }

   public function store_charola(Request $request){
      $validator = Validator::make($request->all(),[
         'charola' => 'required|unique:charolas,nombre',
         'lugar_charola' => 'required'
      ]);

      if ($validator->fails()) {
         return response()->json([
            'satisfactorio' => false,
            'error' => $validator->errors()->all(),
         ]);
      }

      $charola = new Charola;
      $charola->nombre = $request->charola;
      $charola->lugar_id = $request->lugar_charola;
      $charola->save();

      return response()->json([
         'satisfactorio' => true
      ]);
   }

   public function store_caja(Request $request){
      $validator = Validator::make($request->all(),[
         'caja' => 'required|unique:cajas,nombre',
         'lugar_caja' => 'required'
      ]);

      if ($validator->fails()) {
         return response()->json([
            'satisfactorio' => false,
            'error' => $validator->errors()->all(),
         ]);
      }

      $caja = new Caja;
      $caja->nombre = $request->caja;
      $caja->lugar_id = $request->lugar_caja;
      $caja->save();

      return response()->json([
         'satisfactorio' => true
      ]);

   }

   public function ubicacion(Request $request){
      $validator = Validator::make($request->all(),[
         'lugar' => 'required',
      ]);

      if ($validator->fails()) {
         return response()->json([
            'satisfactorio' => false,
            'error' => $validator->errors()->all(),
         ]);
      }

      $indicio = Indicio::find($request->id_indicio);

      $indicio->resguardo = $request->lugar;
      $indicio->save();

      return response()->json([
         'satisfactorio' => true
      ]);

   }

   public function resguardar_todo(Request $request){
      $validator = Validator::make($request->all(),[
         'lugar' => 'required',
      ]);

      if ($validator->fails()) {
         return response()->json([
            'satisfactorio' => false,
            'error' => $validator->errors()->all(),
         ]);
      }

      $cadena = Cadena::find($request->id_cadena);

      foreach ($cadena->indicios as $key => $indicio) {
         $indicio->resguardo = $request->lugar;
         $indicio->save();
      }


      return response()->json([
         'satisfactorio' => true
      ]);

   }

}
