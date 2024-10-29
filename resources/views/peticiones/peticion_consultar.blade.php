@extends('plantilla.template')

{{--item menu selected--}}
@section('nombre_pagina','vista-peticion-consultar')
@section('nombre_submenu','submenu-peticiones')

@section('seccion', 'CONSULTA DE SOLICITUDES')
@section('titulo','CONSULTAR-CADENA')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<link rel="stylesheet" href="{{asset('/css/btn.css')}}">
<link rel="stylesheet" href="{{asset('/css/tablas.css')}}">
<link rel="stylesheet" href="{{asset('/css/tablas/tabla_modal.css')}}">
   <style media="screen">
      


   .modal{
      width: 60% !important;
      max-height: 100% !important;
      margin-top: 0 !important;
      padding-top: 0 !important
   }
   .span-estado:hover{

   }

   </style>
@endsection

@section('contenido')

   <span id="span-csrf" data-csrf="{{csrf_token()}}"></span>

   <section>
      <form class="col s12">
         <div class="row">
            <div class="input-field col s2">
               <select name="peticion_estado">
                  @isset($peticion_estado)
                     @if ($peticion_estado === 'pendiente')
                        <option value="0">TODO</option>
                        <option value="pendiente" selected>PENDIENTES DE ATENDER</option>
                        <option value="atendida">PENDIENTES DE ENTREGAR</option>
                        <option value="entregada">CONCLUSA</option>
                     @elseif($peticion_estado === 'atendida')
                        <option value="0">TODO</option>
                        <option value="pendiente">PENDIENTES DE ATENDER</option>
                        <option value="atendida" selected>PENDIENTES DE ENTREGAR</option>
                        <option value="entregada">CONCLUSA</option>
                     @elseif($peticion_estado === 'entregada'){
                        <option value="0">TODO</option>
                        <option value="pendiente">PENDIENTES DE ATENDER</option>
                        <option value="atendida">PENDIENTES DE ENTREGAR</option>
                        <option value="entregada" selected>CONCLUSA</option>
                     }
                     @endif
                  @endisset
                  @empty($peticion_estado)
                     <option value="0">TODO</option>
                     <option value="pendiente">PENDIENTES DE ATENDER</option>
                     <option value="atendida">PENDIENTES DE ENTREGAR</option>
                     <option value="entregada">CONCLUSA</option>
                  @endempty
               </select>
               <label>TIPO DE PETICIONES</label>
            </div>
            <div class="input-field col s2">
               @isset($fecha_inicio)
                  <input id="fecha-inicio" type="date" name="fecha_inicio" value="{{$fecha_inicio}}">
               @endisset
               @empty($fecha_inicio)
                  <input id="fecha-inicio" type="date" name="fecha_inicio">
               @endempty
               <label class="active" for="fecha-inicio">FECHA INICIO</label>
            </div>
            <div class="input-field col s2">
               @isset($fecha_fin)
                  <input id="fecha-fin" type="date" name="fecha_fin" value="{{$fecha_fin}}">
               @endisset
               @empty($fecha_fin)
                  <input id="fecha-fin" type="date" name="fecha_fin">
               @endempty
               <label class="active" for="fecha-fin">FECHA FIN</label>
            </div>
            <div class="input-field col s5">
               @isset($buscar_texto)
                  <input id="buscar-input" type="text" name="buscar_texto" value="{{$buscar_texto}}">
               @endisset
               @empty($buscar_texto)
                  <input id="buscar-input" type="text" placeholder="BUSCAR... (NUC, NÚMERO OFICIO, M. P. SOLICITA O RECIBE)" name="buscar_texto">
               @endempty
            </div>
            <div class="input-field col s1">
              <button class="btn-guardar" type="submit" name="buscar_btn" value="buscar">Buscar</button>
            </div>
         </div>
      </form>
    </section>

   <div class="row">
      <div class="col s12">
         <p style="text-align: justify;">
            <i style="color:#152f4a;" class="fas fa-square"></i> <span style="color:#c09f77;"><b>Fecha de registro en Sistema</b></span>. Es la fecha en la que se notifica a su Director o Coordinador que ha recibido una nueva Petición. Es la fecha en que su Director o Coordinador reporta que usted recibió una nueva Petición. <br>
            <i style="color:#152f4a;" class="fas fa-square"></i> <span style="color:#c09f77;"><b>Fecha en que se reportó cómo atendida en Sistema</b></span>. Es la fecha en la que se notifica a su Director o Coordinador que ha atendido una Petición, por lo cual usted emite un nuevo Documento. Es la fecha en que su Director o Coordinador reporta que usted emitió un nuevo Documento.
         </p>

      </div>
   </div>


    <div class="row">
        <div class="col s12">
            <table class="tabla highlight bordered">
               <thead>
                  <tr>
                     <th>No.</th>
                     {{-- <td>ACCIÓN</td> --}}
                     {{-- <th style="text-align:left;">ESTADO</th> --}}
                     <th style="text-align:center;">ETAPA</th>
                      <th style="text-align:center;">EDITAR</th>
                      <th style="text-align:center;">CLONAR</th>
                     {{-- <th>EDITAR</th>
                     <th>ELIMINAR</th> --}}
                     <th style="text-align:center;">VER REGISTRO</th>
                     <th style="text-align:left;">N.U.C.</th>
                     <th>FECHA DE REGISTRO EN SISTEMA</th>
                     <th>FECHA EN QUE SE REPORTÓ CÓMO ATENDIDA EN SISTEMA</th>
                     <th>FECHA DE RECEPCIÓN</th>
                     {{-- <th>NÚMERO OFICIO</th>
                     <th style="text-align:left;">M. P. SOLICITA</th> --}}
                     <th>FECHA DE ELABORACIÓN</th>
                     <th>FECHA DE ENTREGA</th>
                     {{-- <th>ESPECIALIDAD</th> --}}
                     <th style="text-align:left;">SOLICITUD</th>
                     <th>DOCUMENTO EMITIDO</th>
                     {{-- <th style="text-align:left;">M. P. RECIBE</th>
                     <th style="text-align:left;">FISCALÍA</th>
                     <th style="text-align:left;">ADSCRIPCIÓN</th> --}}
                  </tr>
               </thead>
               <tbody>
                  @php
                      $n = 1;
                  @endphp
                  @foreach ($peticiones as $peticion)
                     <tr>
                        <!--Contador-->
                        <td class="td-contador" style="width:2%;">{{$n++}}</td>
                        <!--Estado-->
                        {{-- <td style="text-align:left;width:5%;"><b>{{strtoupper($peticion->estado)}}</b></td> --}}
                        <!--Etapa-->
                        <td style="text-align:center; width:5%; padding-left:3px !important;">
                           @if ($peticion->estado === 'pendiente')
                              <a class="etapa" href="/peticion-registrar/continuar/{{$peticion->id}}">
                                 <span class="span-estado" style="color: #152f4a; text-decoration: underline #152f4a;"><b>AGREGAR DATOS DE ELABORACIÓN</b></span>
                              </a>
                           @elseif($peticion->estado === 'atendida')
                              <a class="etapa" href="/peticion-registrar/continuar/{{$peticion->id}}">
                                 <span class="span-estado" style="color: #152f4a; text-decoration: underline #152f4a;"><b>AGREGAR DATOS DE ENTRGA</b></span>
                              </a>
                           @elseif($peticion->estado === 'entregada')
                              <b>CONCLUSO</b>
                           @endif
                        </td>
                        <!--Editar-->
                        <td style="width:3%; text-align:center;">
                           @if ( date('Y-m-d', strtotime($peticion->created_at) ) == $fecha_hoy )
                              <a href="/peticion-editar/{{$peticion->id}}">
                                 <i class="fas fa-pen i-btn"></i>
                              </a>
                           @else
                              <i class="fas fa-lock i-btn"></i>
                           @endif
                        </td>
                        <!--Clonar-->
                        <td style="width:4%; text-align:center;">
                           <a href="/peticion-registrar/clonar/{{$peticion->id}}">
                              <i class="fas fa-clone i-btn"></i>
                           </a>
                        </td>
                        <!--ver registro-->
                        <td style="width:4%; text-align:center;">
                           <a href="" class="peticion-info" data-peticion-id={{$peticion->id}}>
                              <i class="fas fa-eye i-btn"></i>
                           </a>
                        </td>
                        <!--nuc-->
                        <td style="width:6%;">{{$peticion->nuc}}</td>
                        <!--Fecha de registro en sistema-->
                        <td style="width:8%;">{{$peticion->created_at}}</td>
                        <!--Fecha en que se reportó cómo atendidad en sistema-->
                        <td style="width:10%;">{{$peticion->fecha_sistema}}</td>
                        <!--Fecha de recepción-->
                        <td style="width:6%;">{{date('d-m-Y',strtotime($peticion->fecha_recepcion))}}</td>
                        <!--Fecha de elaboración-->
                        <td style="width:6%;">
                           @isset($peticion->fecha_elaboracion)
                              {{date('d-m-Y',strtotime($peticion->fecha_elaboracion))}} 
                           @endisset
                           @empty($peticion->fecha_elaboracion)
                               ---
                           @endempty
                        </td>
                        <!--Fecha de entrega-->
                        <td style="width:5%;">
                           @isset($peticion->fecha_entrega)
                              {{date('d-m-Y',strtotime($peticion->fecha_entrega))}} 
                           @endisset
                           @empty($peticion->fecha_entrega)
                               ---
                           @endempty
                        </td>
                        <!--Solicitud-->
                        <td style="text-align:left;width:15%;">{{$peticion->solicitud->nombre}}</td>
                        <!--Documento emitido-->
                        <td style="width:7%;">{{strtoupper($peticion->documento_emitido)}}</td>
                        
                        
                        {{--
                        <td style="width:4%;">
                           @if ( date('Y-m-d', strtotime($peticion->created_at) ) == $fecha_hoy )
                              <a class="peticion-eliminar" data-id="{{$peticion->id}}" href="">
                                 <i class="fas fa-times"></i>
                              </a>
                           @else
                              <i class="fas fa-lock"></i>
                           @endif
                        </td> --}}
                        
                        
                        
                        
                        
                        
                        
                        {{-- <td style="width:8%;">{{$peticion->oficio_numero}}</td> --}}
                        {{-- <td style="text-align:left;width:10%;">{{$peticion->sp_solicita}}</td> --}}
                        <!--2da etapa-->
                       
                        <!--3ra etapa-->
                        
                        
                        {{-- <td style="width:8%;">
                           @isset($peticion->solicitud_id)
                              {{$peticion->solicitud->especialidad->nombre}} 
                           @endisset
                           @empty($peticion->solicitud_id)
                               ---
                           @endempty
                        </td> --}}

                        
                        
                        {{-- <td  style="text-align:left;width:10%;">
                           @isset($peticion->sp_recibe)
                              {{$peticion->sp_recibe}} 
                           @endisset
                           @empty($peticion->sp_recibe)
                               ---
                           @endempty
                        </td>
                        <td style="text-align:left;width:10%;">{{$peticion->petfiscalia->nombre}}</td>
                        <td style="text-align:left;width:10%;">
                           @isset($peticion->petadscripcion_id)
                              {{$peticion->petadscripcion->nombre}} 
                           @endisset
                           @empty($peticion->petadscripcion_id)
                              ---
                           @endempty
                        </td> --}}

                       
                     </tr>
                  @endforeach
                 
               </tbody>
            </table>
        </div>
    </div>

   <!-- Modal Structure -->
  <div id="modal1" class="modal">
   <div class="modal-content" style="padding:5px; padding-bottom:15px;">
     <div class="modal-cerrar right-align right-align">
       <a href="#" class="btn-modal-cerrar"><i class="fas fa-times" style="color:#d50000"></i></a>
     </div>
     <h5 class="modal-folio center-align"></h5>
     <section class="modal-seccion-enlaces">
         <!--Esperando datos de cadenas_accion.js [$('.btn-modal').click]-->
     </section>
   </div>
   <!--
   <div class="modal-footer">
     <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
   </div>
 -->
 </div>


 <!-- Modal Info -->
 <div id="modal-peticion-informacion" class="modal">
   <div class="modal-content">
   </div>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
{{-- <script src="{{asset('/js/peticiones/peticion_accion.js')}}"></script> --}}
<script src="{{asset('/js/peticiones/peticion_informacion.js')}}"></script>
<script src="{{asset('/js/peticiones/peticion_eliminar.js')}}"></script>
@endsection
