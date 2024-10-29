<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Entrada;
use App\Delegacion;
use App\Categoria;
use App\Embalaje;
use App\Entidad;
use App\Fiscalia;
use App\Indicio;
use App\Unidad;
use App\Usuario;
use App\User;
use Validator;
use Auth;

class CadenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function cadena_form()
     {
        //$unidades = Unidad::all();
        return view('cadenas.registrar',[
           'unidades' => Unidad::where('unidad_estado','activo')->get(),
        ]);
     }

     public function editar_form($id){
        $cadena = Cadena::find($id);
        //$unidades = Unidad::all();
        return view('cadenas.editar', [
           'id' => $id,
           'cadena' => $cadena,
           'unidades' => Unidad::where('unidad_estado','activo')->get(),
        ]);
     }

     public function clonar_form($id){
       $cadena = Cadena::find($id);
       //$unidades = Unidad::all();
       return view('cadenas.clonar', [
          'id' => $id,
          'cadena' => $cadena,
          'unidades' => Unidad::where('unidad_estado','activo')->get(),
       ]);
     }

   public function fiscalia_cambiar($id){
      $cadena = Cadena::find($id);
      $fiscalias = Fiscalia::all();

      return view('administrador.cadenas.cadena_fiscalia_cambiar',
         [
            'cadena' => $cadena,
            'fiscalias' => $fiscalias,
         ]
      );
   }
   public function fiscalia_cambiar_guardar(Request $request){
      $cadena = Cadena::find($request->id_cadena);
      $cadena->fiscalia_id = $request->fiscalia;
      $cadena->save();

      //Mandando mensaje satisfactorio
      return response()->json([
         'satisfactorio' => true
      ]);
   }

     public function cadena_guardar(Request $request, $id_cadena = 0)
     {

       $mensajes = [
         'nuc.required' => 'El campo "NUC" es requerido.',
         'nuc.min' => 'El campo "NUC" debe contener al menos 13 caracteres.',
         'unidad.required' => 'El campo "UNIDAD" es requerido.',
         'intervencion_lugar.required' => 'El campo "LUGAR DE INTERVENCIÓN" es requerido.',
         'intervencion_hora.required' => 'El campo "HORA DE INTERVENCIÓN" es requerido.',
         'intervencion_fecha.required' => 'El campo "FECHA DE INTERVENCIÓN" es requerido.',
         'motivo.required' => 'El campo "MOTIVO DEL REGISTRO" es requerido.',
         'identificador.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "IDENTIFICADOR" es requerido.',
         'descripcion.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "DESCRIPCIÓN" es requerido.',
         'ubicacion.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "UBICACIÓN DEL LUGAR" es requerido.',
         'recoleccion_hora.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "HORA DE RECOLECCIÓN" es requerido.',
         'recoleccion_fecha.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "FECHA DE RECOLECCIÓN" es requerido.',
         'escrito.required' => 'Verifique el apartado "2. DOCUMENTACIÓN" el campo "ESCRITO" es requerido.',
         'fotografico.required' => 'Verifique el apartado "2. DOCUMENTACIÓN" el campo "FOTOGRÁFICO" es requerido.',
         'croquis.required' => 'Verifique el apartado "2. DOCUMENTACIÓN" el campo "CROQUIS" es requerido.',
         'otro.required' => 'Verifique el apartado "2. DOCUMENTACIÓN" el campo "OTRO" es requerido.',
         'etapa.*.required' => 'Verifique el apartado "5. SERVIDORES PÚBLICOS" el campo "ETAPA" es requerido.',
         'traslado.required' => 'Verifique el apartado "6. TRASLADO" el campo "VÍA" es requerido.',
         'trasladoCondiciones.required' => 'Verifique el apartado "6. TRASLADO" el campo "CONDICIONES DEL TRASLADO" es requerido.',
         'embalaje.required' => 'Verifique el apartado "ANEXO 4".',
       ];


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
                 //5. servidores publicos
                 'etapa.*' => 'required',
                 //6. Traslado
                 'traslado' => 'required',
                 'trasladoCondiciones' => 'required',
                 //Anexo 4
                 'embalaje' => 'required',
           ], $mensajes);
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
                 //5. servidores publicos
                 'etapa.*' => 'required',
                 //6. Traslado
                 'traslado' => 'required',
                 'trasladoCondiciones' => 'required',
                 //Anexo 4
                 'embalaje' => 'required',
           ], $mensajes);
        }


        //Enviar error de validaciones
        if ($validator->fails()) {
           return response()->json([
              'satisfactorio' => false,
              'error' => $validator->errors()->all(),
           ]);
        }

        //if(Auth::user()->unidad_id != 1 ){
           foreach ($request->identificador as $i => $id) {
             $hora_i = strtotime($request->intervencion_hora);
             $hora_r = strtotime($request->recoleccion_hora[$i]);
              if ($request->recoleccion_fecha[$i] == $request->intervencion_fecha) {
                 if($request->recoleccion_hora[$i] == $request->intervencion_hora ){
                    if($request->motivo != 'aportacion'){
                       return response()->json([
                          'satisfactorio' => false,
                          'error' => ["Verifique el apartado \"1. IDENTIDAD\", la hora de recolección en el identificador {$id} (La hora de recoleccón puede ser igual a la hora de intervención solo cuando el motivo del registro es una aportación)"],
                       ]);
                    }
                 }
                 elseif ($request->intervencion_hora > $request->recoleccion_hora[$i]) {
                    return response()->json([
                       'satisfactorio' => false,
                       'error' => ["Verifique el apartado \"1. IDENTIDAD\", la hora de recolección en el identificador {$id} (La hora de recoleción no puede ser menor o igual a la hora de intervención)"],
                    ]);
                 }
              }
              elseif ($request->recoleccion_fecha[$i] < $request->intervencion_fecha) {
                 return response()->json([
                          'satisfactorio' => false,
                          'error' => ["Verifica la fecha de recoleccion en el identificador {$id} (La fecha de recolección no puede ser menor a la fecha de intervención)"],
                       ]);
              }
           }
      //  }

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

        //Número de descripciones, para comparar con el número
        //de identificadores en recolección y embalaje
        $no_desc = count($request->descripcion);

        //3. Recoleccion
          if( !($request->has('manual')) && !($request->has('instrumental')) ){
            return response()->json([
              'satisfactorio' => false,
              'error' => ['Verifique los identificadores en el apartado "3. RECOLECCIÓN" (No hay identificadores asignados)'],
            ]);
          }
          elseif( $request->has('manual') && $request->has('instrumental') ){
            $no_id = count($request->manual)+count($request->instrumental);

            if ($no_id < $no_desc) {
              return response()->json([
                'satisfactorio' => false,
                'error' => ['Verifique los identificadores en el apartado "3. RECOLECCIÓN"'],
              ]);
            }
            elseif ($no_id > $no_desc) {
              return response()->json([
                'satisfactorio' => false,
                'error' => ['Verifique los identificadores en el apartado "3. RECOLECCIÓN"'],
              ]);
            }
            else{
                foreach ($request->manual as $m) {
                  foreach ($request->instrumental as $i) {
                    if($m == $i){
                      return response()->json([
                        'satisfactorio' => false,
                        'error' => ["Verifique los identificadores en el apartado \"3. RECOLECCIÓN\" (Identificador {$m} repetido)"],
                      ]);
                    }//if
                  }//foreach
                }//foreach
            }//else
          }//if $request->has('manual') && $request->has('instrumental')
          elseif ( $request->has('manual') && !($request->has('instrumental')) ) {
            if( count($request->manual) <  $no_desc ){
              return response()->json([
                'satisfactorio' => false,
                'error' => ['Verifique los identificadores en el apartado "3. RECOLECCIÓN" (Faltan identificadores por asignar)'],
              ]);
            }//if
          }//elseif
          elseif ( !($request->has('manual')) && $request->has('instrumental') ) {
            if( count($request->instrumental) <  $no_desc ){
              return response()->json([
                'satisfactorio' => false,
                'error' => ['Verifique los identificadores en el apartado "3. RECOLECCIÓN" (Faltan identificadores por asignar)'],
              ]);
            }//if
          }//elseif

        //4. EMPAQUE/EMBALAJE
          $bolsa=0;
          $caja=0;
          $recipiente=0;

          if( $request->has('bolsa') ) $bolsa = count($request->bolsa);
          if( $request->has('caja') ) $caja = count($request->caja);
          if( $request->has('recipiente') ) $recipiente = count($request->recipiente);

          $ids_total = $bolsa + $caja + $recipiente;

          //Si ids_total >=  1
          if ( $ids_total ) {
            //Si $bolsa y $caja son >= 1
            if( $bolsa && $caja && $recipiente){
              //1er foreach
              foreach ($request->bolsa as $b) {
                foreach ($request->caja as $c) {
                  if($b == $c){
                    return response()->json([
                      'satisfactorio' => false,
                      'error' => ["Verifique los identificadores en el apartado \"4. EMPAQUE\\EMBALAJE\" (Identificador {$b} repetido)"],
                    ]);
                  }//if($b == $c)
                }//foreach
              }//foreach

              //2do foreach
              foreach ($request->bolsa as $b) {
                foreach ($request->recipiente as $r) {
                  if($b == $r){
                    return response()->json([
                      'satisfactorio' => false,
                      'error' => ["Verifique los identificadores en el apartado \"4. EMPAQUE\\EMBALAJE\" (Identificador {$b} repetido)"],
                    ]);
                  }//if($b == $r)
                }//foreach
              }//foreach

              //3er foreach
              foreach ($request->caja as $c) {
                foreach ($request->recipiente as $r) {
                  if($c == $r){
                    return response()->json([
                      'satisfactorio' => false,
                      'error' => ["Verifique los identificadores en el apartado \"4. EMPAQUE\\EMBALAJE\" (Identificador {$c} repetido)"],
                    ]);
                  }//if($b == $r)
                }//foreach
              }//foreach

              if ( ($bolsa+$caja+$recipiente) < $no_desc ) {
                return response()->json([
                  'satisfactorio' => false,
                  'error' => ["Verifique los identificadores en el apartado \"4. EMPAQUE\\EMBALAJE\" (Faltan identificadores por asignar)"],
                ]);
              }//if( ($bolsa+$caja) < $no_desc )
            }//if($bolsa && $caja && $recipiente)

            //Si $bolsa y $caja son >= 1
            elseif( $bolsa && $caja ){
              foreach ($request->bolsa as $b) {
                foreach ($request->caja as $c) {
                  if($b == $c){
                    return response()->json([
                      'satisfactorio' => false,
                      'error' => ["Verifique los identificadores en el apartado \"4. EMPAQUE\\EMBALAJE\" (Identificador {$b} repetido)"],
                    ]);
                  }//if($b == $c)
                }//foreach
              }//foreach
              if ( ($bolsa+$caja) < $no_desc ) {
                return response()->json([
                  'satisfactorio' => false,
                  'error' => ["Verifique los identificadores en el apartado \"4. EMPAQUE\\EMBALAJE\" (Faltan identificadores por asignar)"],
                ]);
              }//if( ($bolsa+$caja) < $no_desc )
            }//if($bolsa && $caja)

            //Si $bolsa y recipiente son >= 1
            elseif( $bolsa && $recipiente ){
              foreach ($request->bolsa as $b) {
                foreach ($request->recipiente as $r) {
                  if($b == $r){
                    return response()->json([
                      'satisfactorio' => false,
                      'error' => ["Verifique los identificadores en el apartado \"4. EMPAQUE\\EMBALAJE\" (Identificador {$b} repetido)"],
                    ]);
                  }//if($b == $r)
                }//foreach
              }//foreach
              if ( ($bolsa+$recipiente) < $no_desc ) {
                return response()->json([
                  'satisfactorio' => false,
                  'error' => ["Verifique los identificadores en el apartado \"4. EMPAQUE\\EMBALAJE\" (Faltan identificadores por asignar)"],
                ]);
              }//if( ($bolsa+$recipiente) < $no_desc )
            }//elseif($bolsa && recipiente)

            //Si $caja y recipiente son >= 1
            elseif( $caja && $recipiente ){
              foreach ($request->caja as $c) {
                foreach ($request->recipiente as $r) {
                  if($c == $r){
                    return response()->json([
                      'satisfactorio' => false,
                      'error' => ["Verifique los identificadores en el apartado \"4. EMPAQUE\\EMBALAJE\" (Identificador {$c} repetido)"],
                    ]);
                  }//if($b == $r)
                }//foreach
              }//foreach
              if ( ($caja+$recipiente) < $no_desc ) {
                return response()->json([
                  'satisfactorio' => false,
                  'error' => ["Verifique los identificadores en el apartado \"4. EMPAQUE\\EMBALAJE\" (Faltan identificadores por asignar)"],
                ]);
              }//if( ($bolsa+$recipiente) < $no_desc )
            }//elseif($caja && recipiente)

            //Si $bolsa

            elseif( $bolsa && $bolsa < $no_desc ){
                return response()->json([
                  'satisfactorio' => false,
                  'error' => ["1Verifique los identificadores en el apartado \"4. EMPAQUE\\EMBALAJE\" (Faltan identificadores por asignar)"],
                ]);
            }//elseif(< $no_desc)

            //Si $caja
            elseif( $caja && $caja < $no_desc ){
                return response()->json([
                  'satisfactorio' => false,
                  'error' => ["Verifique los identificadores en el apartado \"4. EMPAQUE\\EMBALAJE\" (Faltan identificadores por asignar)"],
                ]);
            }//elseif($caja)

            //Si $recipiente
            elseif( $recipiente && $recipiente < $no_desc ){
                return response()->json([
                  'satisfactorio' => false,
                  'error' => ["Verifique los identificadores en el apartado \"4. EMPAQUE\\EMBALAJE\" (Faltan identificadores por asignar)"],
                ]);
            }//elseif($recipiente)

          }//if($ids_total)
          elseif ( !$ids_total ) {
            return response()->json([
              'satisfactorio' => false,
              'error' => ['Verifique los identificadores en el apartado "4. EMPAQUE/EMBALAJE" (No hay identificadores asignados)'],
            ]);
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

        if($id_cadena === 0){
           $cadena = new Cadena;
           $cadena->user_id = Auth::user()->id;
           $cadena->fiscalia_id = Auth::user()->fiscalia_id;
           $cadena->estado="revision";
        }
        else{
          $cadena = Cadena::find($id_cadena);
        }

    //CADENA(Abre)
        $cadena->nuc = $request->nuc;
        $cadena->folio = $request->folio;
        $cadena->intervencion_lugar = $request->intervencion_lugar;
        $cadena->intervencion_hora = $request->intervencion_hora;
        $cadena->intervencion_fecha = $request->intervencion_fecha;
        $cadena->motivo = $request->motivo;

        //2. Documentacion
        $cadena->escrito = $request->escrito;
        $cadena->fotografico = $request->fotografico;
        $cadena->croquis = $request->croquis;
        $cadena->otro = $request->otro;
        if ( $request->has('especifique') )
          $cadena->especifique = $request->especifique;

        //6. Traslado
        $cadena->traslado = $request->traslado;
        $cadena->trasladoCondiciones = $request->trasladoCondiciones;
        if ( $request->has('trasladoRecomendaciones') )
          $cadena->trasladoRecomendaciones = $request->trasladoRecomendaciones;

        $cadena->unidad_id = $request->unidad;
   

        //Anexo 4
        $cadena->embalaje = $request->embalaje;

	
        //Guardando  registro en BD
        $cadena->save();
    //CADENA(Cierre)

    //INDICIOS(Abre)
        if ($id_cadena === 0) {
          //Guardando indicios
          for ($i=0; $i < count($request->identificador); $i++) {

             $indicio = new Indicio;
             $indicio->identificador = $request->identificador[$i];
             $indicio->descripcion = $request->descripcion[$i];
             $indicio->indicio_ubicacion_lugar = $request->ubicacion[$i];
             $indicio->recolectado_de = $request->recolectado_de[$i];
             $indicio->hora = $request->recoleccion_hora[$i];
             $indicio->fecha = $request->recoleccion_fecha[$i];
             $indicio->condicion = $request->estado_indicio[$i];
             $indicio->observacion = $request->observacion[$i];
             $indicio->cadena_id = $cadena->id;


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
        }//if($id_cadena ==== 0)
        else {
          //EDITAR CADENA
          //Si la cantidad indicios es igual a los que habia
          if (count($cadena->indicios) == count($request->identificador)) {
             foreach ($cadena->indicios as $i => $indicio) {
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
          elseif(count($cadena->indicios) > count($request->identificador)) {


             foreach ($cadena->indicios as $i => $indicio) {
               if( ($i+1) > count($request->identificador) )
                  $indicio->delete();
              else{
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
              }
             }//foreach
          }//elseif(indicios menor a los que habia)
          else {
            //Indicios mayor a los que habia
            $bandera = 0;
            foreach ($cadena->indicios as $i => $indicio) {
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
              $bandera = $i;
            }//foreach
            for ($i=$bandera+1; $i < count($request->identificador); $i++) {
              $indicio = new Indicio;
              $indicio->identificador = $request->identificador[$i];
              $indicio->descripcion = $request->descripcion[$i];
              $indicio->indicio_ubicacion_lugar = $request->ubicacion[$i];
              $indicio->recolectado_de = $request->recolectado_de[$i];
              $indicio->hora = $request->recoleccion_hora[$i];
              $indicio->fecha = $request->recoleccion_fecha[$i];
              $indicio->condicion = $request->estado_indicio[$i];
              $indicio->observacion = $request->observacion[$i];
              $indicio->cadena_id = $cadena->id;


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
          }//else
        }//else(Cuando $id_cadena != 0)
    //INDICIOS(Cierre)

    //SERVIDORES PÚBLICOS(Abre)
        //Agregando Servidores Publicos a la tabla pivote
        if($id_cadena != 0)//Solo cuando es editar
          $cadena->users()->detach();//Borra los usuarios de la tabla cadena_user
        for ($i=0; $i < count($request->id_sp); $i++) {
           $cadena->users()->attach($request->id_sp[$i],['etapa'=>$request->etapa[$i]]);
        }
    //SERVIDORES PÚBLICOS(Cierre)


        //Mandando mensaje satisfactorio
        return response()->json([
           'satisfactorio' => true,
           'nuc' => $request->nuc,
           'tipo_usuario' => Auth::user()->tipo,
        ]);

  }//cadena_guardar

}
