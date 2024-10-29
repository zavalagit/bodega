<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;
use App\Cadena;
use App\Fiscalia;
use App\Naturaleza;
use App\Unidad;
use App\User;

class AdministrarCadenaController extends Controller
{
    public function editar_cadena($id){
      $cadena = Cadena::find($id);
      $unidades = Unidad::all();

      return view('administrador.cadenas.cadena_editar_form', [
         'id' => $id,
         'cadena' => $cadena,
         'unidades' => $unidades,
      ]);
   }

   public function cadena_editar_habilitar(Cadena $cadena){
      if($cadena->editar == 'si')
         $cadena->editar = 'no';
      else
         $cadena->editar = 'si';

      $cadena->save();
      
      return response()->json([
         'satisfactorio' => true,
         'cadena_editar' => $cadena->editar
      ]);      
   }

   public function cadenas_usuario($id_usuario){
      $cadenas =  Cadena::where('usuario_id',$id_usuario);
   }



}
