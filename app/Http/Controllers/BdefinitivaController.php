<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Baja;
use App\Cadena;
use App\Cargo;
use App\Cedula;
use App\Delegacion;
use App\Indicio;
use App\Embalaje;
use App\Naturaleza;
use App\Prestamo;
use App\Unidad;

class BdefinitivaController extends Controller
{

   public function vista(){
      //$bajas = Baja::latest()->get();

       $bajas = Baja::with('cadena')->whereHas('cadena',function($q){
         $q->where('fiscalia_id',Auth::user()->fiscalia_id);
      })->latest()->get();

      return view('bodega.bajas.bajas',['bajas'=>$bajas]);
   }

   public function form($folio){
      $cadena = Cadena::where('folio_bodega',$folio)->get();

      return view('bodega.bdefinitiva-form',[
         'cadena' => $cadena[0]
      ]);
   }

   public function store(Request $request){
      $validator = Validator::make($request->all(),[
         'concepto' => 'required',
         'numindicios' => 'required',
         'hora' => 'required',
         'fecha' => 'required',
         'estado_cadena' => 'required',
         'recibe' => 'required'
      ]);

      if ($validator->fails()) {
         return response()->json([
            'satisfactorio' => false,
            'error' => $validator->errors()->all(),
         ]);
      }

      $baja = new Bdefinitiva;
      $baja->concepto = $request->concepto;
      $baja->numindicios = $request->numindicios;
      $baja->hora = $request->hora;
      $baja->fecha = $request->fecha;
      $baja->recibe = $request->recibe;
      $baja->estatus_cadena = $request->estado_cadena;
      if($request->has('observaciones'))
         $baja->observaciones = $request->observaciones;
      $baja->cedula_folio = $request->folio;
      $baja->save();

      $cedula = Cedula::find($request->folio);

      foreach ($cedula->indicios as $key => $indicio) {
            $indicio->estado = 'baja';
            $indicio->save();
      }

      return response()->json([
         'satisfactorio' => true,
      //   'idprestamo' => $idprestamo
      ]);

   }
}
