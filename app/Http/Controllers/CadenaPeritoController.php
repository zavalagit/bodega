<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Cadena;
use App\Unidad;
use App\Indicio;

class CadenaPeritoController extends Controller
{
   public function consultar(Request $request){

      if( $request->filled('buscar') ){
         $cadenas = Cadena::buscar($request->buscar)->get();
         return view('cadenas.consultar',[
            'cadenas' => $cadenas,
            'buscar' => $request->buscar,
         ]);
      }
      else {
         $cadenas = Cadena::where('user_id',Auth::user()->id)->orderBy('id','desc')->latest()->take(20)->get();
         return view('cadenas.consultar',[
            'cadenas'=>$cadenas,
         ]);
      }
   }

   public function formEditar($id){
      $cadena = Cadena::find($id);
      $unidades = Unidad::all();

      return view('cadenas.editar', [
         'id' => $id,
         'cadena' => $cadena,
         'unidades' => $unidades,
      ]);
   }

   public function actualizar(Request $request, $id_cadena){

      if(Auth::user()->unidad_id == 1 ){
         $validator = Validator::make($request->all(), [
               'nuc' => 'required|min:13',
               'unidad' => 'required',
            //   'folio' => 'required',
//               'intervencion_lugar' => 'required',
//               'intervencion_hora' => 'required',
               'intervencion_fecha' => 'required',
               'motivo' => 'required',
               //1. Identidad
               'identificador.*' => 'required',
               'descripcion.*' => 'required',
//               'ubicacion.*' => 'required',
//               'recolectado_de.*' => 'required',
//               'recoleccion_hora.*' => 'required',
               'recoleccion_fecha.*' => 'required',
           //    'estado_indicio.*' => 'required',
               //2. Documentación
               'escrito' => 'required',
               'fotografico' => 'required',
               'croquis' => 'required',
               'otro' => 'required',
               //3. Recoleccion
               //4. Empaque/embalaje
               'embalaje' => 'required',
               //5. servidores publicos
               'etapa.*' => 'required',
               //6. Traslado
               'traslado' => 'required',
               'trasladoCondiciones' => 'required',
         ]);
      }
      else{
         $validator = Validator::make($request->all(), [
               'nuc' => 'required|min:13',
               'unidad' => 'required',
            //   'folio' => 'required',
               'intervencion_lugar' => 'required',
               'intervencion_hora' => 'required',
               'intervencion_fecha' => 'required',
               'motivo' => 'required',
               //1. Identidad
               'identificador.*' => 'required',
               'descripcion.*' => 'required',
               'ubicacion.*' => 'required',
               'recoleccion_hora.*' => 'required',
               'recoleccion_fecha.*' => 'required',
           //    'estado_indicio.*' => 'required',
               //2. Documentación
               'escrito' => 'required',
               'fotografico' => 'required',
               'croquis' => 'required',
               'otro' => 'required',
               //3. Recoleccion
               //4. Empaque/embalaje
               'embalaje' => 'required',
               //5. servidores publicos
               'etapa.*' => 'required',
               //6. Traslado
               'traslado' => 'required',
               'trasladoCondiciones' => 'required',
         ]);
      }


      //Enviar error de validaciones
      if ($validator->fails()) {
         return response()->json([
            'satisfactorio' => false,
            'error' => $validator->errors()->all(),
         ]);
      }

/*
      //Comparacion de hora de intervencion con hora de recoleccion
      foreach ($request->recoleccion_hora as $horar) {
         if( !($horar >= $request->intervencion_hora && $request->motivo == 'aportacion') ){
            if($horar <=  $request->intervencion_hora)
            return response()->json([
               'satisfactorio' => false,
               'error' => ['Verifica la hora de recoleccion.'],
            ]);
         }
      }
      //Comparacion de fecha de intervencion con fecha de recoleccion
      foreach ($request->recoleccion_fecha as $fecha) {
         if($fecha < $request->intervencion_fecha)
            return response()->json([
               'satisfactorio' => false,
               'error' => ['Verifica la fecha de recoleccion.'],
            ]);
      }
*/

      if(Auth::user()->unidad_id != 1 ){
         foreach ($request->identificador as $i => $id) {
            if ($request->recoleccion_fecha[$i] == $request->intervencion_fecha) {
               if($request->recoleccion_hora[$i] == $request->intervencion_hora ){
                  if($request->motivo != 'aportacion'){
                     return response()->json([
                        'satisfactorio' => false,
                        'error' => ["Verifica la hora de recoleccion en el identificador {$id}"],
                     ]);
                  }
                  elseif ($request->recoleccion_hora[$i] < $request->intervencion_hora) {
                     return response()->json([
                        'satisfactorio' => false,
                        'error' => ["Verifica la hora de recoleccion en el identificador {$id}"],
                     ]);
                  }
               }
            }
            elseif ($request->recoleccion_fecha[$i] < $request->intervencion_fecha) {
               return response()->json([
                        'satisfactorio' => false,
                        'error' => ["Verifica la fecha de recoleccion en el identificador {$id}"],
                     ]);
            }
         }
      }




      //2.Documentacion
         //Revisa el campo "especifique" en Documentacion
         if($request->otro == 'si'){
            if ( !($request->has('especifique')) ){
               return response()->json([
                  'satisfactorio' => false,
                  'error' => ['Especifique el "otro" tipo de documento.'],
               ]);
            }
         }



      //3. Recoleccion
         if ((count($request->manual)+count($request->instrumental)) < count($request->descripcion)) {
            return response()->json([
               'satisfactorio' => false,
               'error' => ['Verifique los identificadores en Recolección.'],
            ]);
         }
         elseif ((count($request->manual)+count($request->instrumental)) > count($request->descripcion)) {
            return response()->json([
               'satisfactorio' => false,
               'error' => ['Verifique los identificadores en Recolección.'],
            ]);
         }
         elseif ((count($request->manual)+count($request->instrumental)) == count($request->descripcion)) {
            if( !( ( count($request->manual) == count($request->descripcion) ) || ( count($request->instrumental) == count($request->descripcion) ) ) ){
               foreach ($request->manual as $m) {
                  foreach ($request->instrumental as $i) {
                     if($m == $i){
                        return response()->json([
                           'satisfactorio' => false,
                           'error' => ['Hay identificadores repetidos en Recolección.'],
                        ]);
                     }//if
                  }//foreach
               }//foreach
            }//if
         }

      //4. Empaque/embalaje
         if( ((count($request->bolsa)+count($request->caja)+count($request->recipiente)) != count($request->descripcion)) ){
            return response()->json([
               'satisfactorio' => false,
               'error' => ['Verifique los identificadores en Empaque/embalaje'],
            ]);
         }
         if($request->has('bolsa') && $request->has('caja')){
            foreach ($request->bolsa as $key => $ib) {
               foreach ($request->caja as $key => $ic) {
                  if($ib == $ic){
                     return response()->json([
                        'satisfactorio' => false,
                        'error' => ['No puede estar un identificador en más de un tipo de Empaque/embalaje '],
                     ]);
                  }
               }
            }
         }
         if($request->has('bolsa') && $request->has('recipiente')){
            foreach ($request->bolsa as $key => $ib) {
               foreach ($request->recipiente as $key => $ir) {
                  if($ib == $ir){
                     return response()->json([
                        'satisfactorio' => false,
                        'error' => ['No puede estar un identificador en más de un tipo de Empaque/embalaje '],
                     ]);
                  }
               }
            }
         }
         if($request->has('caja') && $request->has('recipiente')){
            foreach ($request->caja as $key => $ic) {
               foreach ($request->recipiente as $key => $ir) {
                  if($ic == $ir){
                     return response()->json([
                        'satisfactorio' => false,
                        'error' => ['No puede estar un identificador en más de un tipo de Empaque/embalaje '],
                     ]);
                  }
               }
            }
         }


      //6. Traslado
         //Revisa el campo "recomendaciones" en Traslado
         if($request->condiciones == 'si'){
            if ( !($request->has('recomendaciones')) ){
               return response()->json([
                  'satisfactorio' => false,
                  'error' => 'Escriba las recomendaciones de traslado.',
               ]);
            }
         }




      $cadtemp = Cadena::find($id_cadena);
//      $cadtemp->bodega = $folio;
      $cadtemp->nuc = $request->nuc;
      $cadtemp->folio = $request->folio;
      $cadtemp->intervencion_lugar = $request->intervencion_lugar;
      $cadtemp->intervencion_hora = $request->intervencion_hora;
      $cadtemp->intervencion_fecha = $request->intervencion_fecha;
      $cadtemp->motivo = $request->motivo;



      //2. Documentacion
         $cadtemp->escrito = $request->escrito;
         $cadtemp->fotografico = $request->fotografico;
         $cadtemp->croquis = $request->croquis;
         $cadtemp->otro = $request->otro;
         if ( $request->has('especifique') )
            $cadtemp->especifique = $request->especifique;


      $cadtemp->embalaje = $request->embalaje;

      //6. Traslado
         $cadtemp->traslado = $request->traslado;
         $cadtemp->trasladoCondiciones = $request->trasladoCondiciones;
         if ( $request->has('trasladoRecomendaciones') )
            $cadtemp->trasladoRecomendaciones = $request->trasladoRecomendaciones;


      $cadtemp->unidad_id = $request->unidad;


      //Estado de la cadena
      $cadtemp->estado="revision";

      //Guardando  registro en BD
      $cadtemp->save();



      //Guardando indicios

      $cadtemp = Cadena::find($id_cadena);

      //Si la cantidad indicios anteriormente guardados son iguales a los indicios que se van ahora a guardar
      if (count($cadtemp->indicios) == count($request->identificador)) {
         foreach ($cadtemp->indicios as $i => $indicio) {
            $indicio->identificador = $request->identificador[$i];
            $indicio->descripcion = $request->descripcion[$i];
            $indicio->indicio_ubicacion_lugar = $request->ubicacion[$i];
            $indicio->recolectado_de = $request->recolectado_de[$i];
            $indicio->hora = $request->recoleccion_hora[$i];
            $indicio->fecha = $request->recoleccion_fecha[$i];
            $indicio->condicion = $request->estado_indicio[$i];
            $indicio->observacion = $request->observacion[$i];

            if($request->has('manual')){
               foreach ($request->manual as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->recoleccion = 'manual';
                  }
               }
            }
            if($request->has('instrumental')){
               foreach ($request->instrumental as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->recoleccion = 'instrumental';
                  }
               }
            }
            if($request->has('bolsa')){
               foreach ($request->bolsa as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->embalaje = 'bolsa';
                  }
               }
            }
            if($request->has('caja')){
               foreach ($request->caja as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->embalaje = 'caja';
                  }
               }
            }
            if($request->has('recipiente')){
               foreach ($request->recipiente as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->embalaje = 'recipiente';
                  }
               }
            }

            $indicio->save();
         }//foreach
      }//fin if

      //Si la cantidad de idicios es menor a la que se habian guardado
      if (count($cadtemp->indicios) > count($request->identificador)) {

         $cadtemp->indicios[1]->delete();

         $ciclo = count($cadtemp->indicios) - count($request->identificador);
         $num_indicios = count($cadtemp->indicios);

         for ($i=0; $i < $ciclo; $i++) {
            $cadtemp->indicios[$num_indicios - $i]->delete();
         }

         foreach ($cadtemp->indicios as $i => $indicio) {
            $indicio->identificador = $request->identificador[$i];
            $indicio->descripcion = $request->descripcion[$i];
            $indicio->indicio_ubicacion_lugar = $request->ubicacion[$i];
            $indicio->hora = $request->recoleccion_hora[$i];
            $indicio->fecha = $request->recoleccion_fecha[$i];
            $indicio->condicion = $request->estado_indicio[$i];
            $indicio->observacion = $request->observacion[$i];

            if($request->has('manual')){
               foreach ($request->manual as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->recoleccion = 'manual';
                  }
               }
            }
            if($request->has('instrumental')){
               foreach ($request->instrumental as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->recoleccion = 'instrumental';
                  }
               }
            }
            if($request->has('bolsa')){
               foreach ($request->bolsa as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->embalaje = 'bolsa';
                  }
               }
            }
            if($request->has('caja')){
               foreach ($request->caja as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->embalaje = 'caja';
                  }
               }
            }
            if($request->has('recipiente')){
               foreach ($request->recipiente as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->embalaje = 'recipiente';
                  }
               }
            }

            $indicio->save();
         }//foreach
      }

/*
      //Si la cantidad de indicios es menor a los que se van a guardar
      if (count($cadtemp->indicios) < count($request->identificador)) {


         foreach ($cadtemp->indicios as $key => $indicio) {
            $indicio->delete();
         }


         for ($i=0; $i < count($request->identificador); $i++) {

            $indicio = new Indicio;
            $indicio->identificador = $request->identificador[$i];
            $indicio->descripcion = $request->descripcion[$i];
            $indicio->indicio_ubicacion_lugar = $request->ubicacion[$i];
            $indicio->hora = $request->recoleccion_hora[$i];
            $indicio->fecha = $request->recoleccion_fecha[$i];
            $indicio->condicion = $request->estado_indicio[$i];
            $indicio->observacion = $request->observacion[$i];
            $indicio->cadena_id = $id_cadena;


            if($request->has('manual')){
               foreach ($request->manual as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->recoleccion = 'manual';
                  }
               }
            }
            if($request->has('instrumental')){
               foreach ($request->instrumental as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->recoleccion = 'instrumental';
                  }
               }
            }
            if($request->has('bolsa')){
               foreach ($request->bolsa as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->embalaje = 'bolsa';
                  }
               }
            }
            if($request->has('caja')){
               foreach ($request->caja as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->embalaje = 'caja';
                  }
               }
            }
            if($request->has('recipiente')){
               foreach ($request->recipiente as $key => $id) {
                  if($id === $request->identificador[$i]){
                     $indicio->embalaje = 'recipiente';
                  }
               }
            }

            $indicio->save();
         }
      }

*/
      //EDITANDO SERVIDORES PUBLICOS


//      if(count($cadtemp->users) == count($request->id_sp)){

 //     }


      //Agregando Servidores Publicos a la tabla pivote
      $cadtemp->users()->detach();
      for ($i=0; $i < count($request->id_sp); $i++) {

         $cadtemp->users()->attach($request->id_sp[$i],['etapa'=>$request->etapa[$i]]);

      }


      //Mandando mensaje satisfactorio
      return response()->json([
         'satisfactorio' => true,
//         'id' => $id,
         'nuc' => $request->nuc
      ]);

   }///editar
}
