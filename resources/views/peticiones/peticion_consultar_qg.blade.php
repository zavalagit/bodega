@extends('cadenas.plantilla_peticiones')

@section('seccion', 'CONSULTA DE SOLICITUDES')
@section('titulo','CONSULTAR-CADENA')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
   <style media="screen">
      .fa-search{
         color: #4db6ac;
      }

      .fa-file-pdf-o{
         color: #b71c1c;
      }


     .div-buscador{
      margin: 0 !important;
      padding: 0 !important;
     }
     .fa-file-pdf{
       color: red;
     }
     .fa-copy{
       color: #607d8b;
     }
     .fa-file-pdf:hover,.fa-copy:hover,.fa-pen:hover{
       font-size: 117%;
     }



     #td-nuc, #th-nuc{
        text-align: left;
     }


   table {
      width: 120% !important;
      overflow-x: scroll;
      overflow-y: hidden;
   }

   a.etapa{
      color:#c09f77;
      text-decoration: underline;
   }
   a.etapa:hover{
      color:#394049;
   }

   .fas{
      color:#394049;
   }
   .fas:hover{
      color:#c09f77;
   }

   .fa-times:hover{
      color:red;
   }

   button.btn.btn-default:hover{
   background-color: #152f4a !important;
   color: #c09f77 !important;
   }
   button.btn.btn-default{
      margin-right: 15px !important;
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
              <button class="btn waves-effect waves-light" type="submit" name="buscar_btn" value="buscar">Buscar</button>
            </div>
         </div>
      </form>
    </section>

    <div class="row">
        <div class="col s12">
            <table class="highlight bordered centered">
               <thead>
                  <tr>
                     <th>No.</th>
                     <th>FOLIO INTERNO</th>
                     <th style="text-align:left;">N.U.C.</th>
                     <th>CONTENIDO</th>
                     <!--
                     <th style="text-align:left;">ETAPA</th>
                     <th>EDITAR</th>
                     <th>CLONAR</th>
                     <th>ELIMINAR</th>
                     <th>FECHA PETICIÓN</th>
                     <th style="text-align:left;">M. P. SOLICITA</th>
                     <th>FECHA ELABORACIÓN</th>
                     <th>DOCUMENTO EMITIDO</th>
                     <th>ESPECIALIDAD</th>
                     <th style="text-align:left;">SOLICITUD</th>
                     <th>FECHA DE ENTREGA</th>
                     <th style="text-align:left;">M. P. RECIBE</th>
                     <th style="text-align:left;">FISCALÍA</th>
                     <th style="text-align:left;">ADSCRIPCIÓN</th>
                     -->
                  </tr>
               </thead>
               <tbody>
                  @php
                      $no_consecutivo = 1;
                  @endphp
                  @foreach ($peticiones as $key => $peticion)
                     <tr>
                        <td style="width:3%;">{{$no_consecutivo++}}</td>
                        <td style="text-align:left;">{{$key}}</td>
                        <td>{{$peticion->keys()->first()}}</td>
                        <td>
                           <table>
                              <thead>
                                 <tr>
                                    @if (Auth::user()->tipo === 'admin_peticiones')
                                    <th>Perito</th>
                                    @endif
                                    <th>Especialidad</th>
                                    <th>Solicitud</th>
                                    <th>Fecha peticion</th>
                                    <th>Fecha recepción</th>
                                    <th>Fecha elaboración</th>
                                    <th>Fecha entrega</th>
                                    <th>Etapa</th>
                                    <th>Editar</th>
                                    <th>Clonar</th>
                                    <th>Eliminar</th>
                                 </tr>
                              </thead>
                              @foreach ($peticion->first() as $s)
                                 <tr>
                                    @if (Auth::user()->tipo === 'admin_peticiones')
                                    <td>{{$s->user->name}}</td>
                                    @endif
                                    @isset($s->solicitud_id)
                                    <td>{{$s->solicitud->especialidad->nombre}} </td>
                                    <td>{{$s->solicitud->nombre}}</td>
                                    @endisset
                                    @empty($s->solicitud_id)
                                    <td>---</td>
                                    <td>---</td>
                                    @endempty
                                    <td>{{$s->fecha_peticion}}</td>
                                    <td>{{$s->fecha_recepcion}}</td>
                                    <td style="width:6%;">
                                       @isset($s->fecha_elaboracion)
                                          {{date('d-m-Y',strtotime($s->fecha_elaboracion))}} 
                                       @endisset
                                       @empty($s->fecha_elaboracion)
                                           ---
                                       @endempty
                                    </td>
                                    <td style="width:6%;">
                                       @isset($s->fecha_entrega)
                                          {{date('d-m-Y',strtotime($s->fecha_entrega))}} 
                                       @endisset
                                       @empty($s->fecha_entrega)
                                           ---
                                       @endempty
                                    </td>
                                    <td style="text-align:left;width:5%;">
                                       @if ($s->estado === 'pendiente')
                                          <a class="etapa" href="/peticion-registrar/continuar/{{$s->id}}">
                                             AGREGAR DATOS DE ELABORACIÓN
                                          </a>
                                       @elseif($s->estado === 'atendida')
                                          <a class="etapa" href="/peticion-registrar/continuar/{{$s->id}}">
                                             AGREGAR DATOS DE ENTRGA
                                          </a>
                                       @elseif($s->estado === 'entregada')
                                          <b>CONCLUSO</b>
                                       @endif
                                    </td>
                                    <td style="width:3%;">
                                       <a href="/peticion-editar/{{$s->id}}">
                                          <i class="fas fa-pen"></i>
                                       </a>
                                    </td>
                                    <td style="width:4%;">
                                       <a href="/peticion-registrar/clonar/{{$s->id}}">
                                          <i class="fas fa-clone"></i>
                                       </a>
                                    </td>
                                    <td style="width:4%;">
                                       <a class="peticion-eliminar" data-id="{{$s->id}}" href="">
                                          <i class="fas fa-times"></i>
                                       </a>
                                    </td>
                                 </tr>
                              @endforeach
                           </table>
                        </td>

                        {{--
                        <td style="text-align:left;width:5%;">
                           @if ($peticion->estado === 'pendiente')
                              <a class="etapa" href="/peticion-registrar/continuar/{{$peticion->id}}">
                                 AGREGAR DATOS DE ELABORACIÓN
                              </a>
                           @elseif($peticion->estado === 'atendida')
                              <a class="etapa" href="/peticion-registrar/continuar/{{$peticion->id}}">
                                 AGREGAR DATOS DE ENTRGA
                              </a>
                           @elseif($peticion->estado === 'entregada')
                              <b>CONCLUSO</b>
                           @endif
                        </td>
                        <td style="width:3%;">
                           <a href="/peticion-editar/{{$peticion->id}}">
                              <i class="fas fa-pen"></i>
                           </a>
                        </td>
                        <td style="width:4%;">
                           <a href="/peticion-registrar/clonar/{{$peticion->id}}">
                              <i class="fas fa-clone"></i>
                           </a>
                        </td>
                        <td style="width:4%;">
                           <a class="peticion-eliminar" data-id="{{$peticion->id}}" href="">
                              <i class="fas fa-times"></i>
                           </a>
                        </td>
                        
                        <td style="width:6%;">{{date('d-m-Y',strtotime($peticion->fecha_peticion))}}</td>
                        <td style="width:8%;">{{$peticion->oficio_numero}}</td>
                        <td style="text-align:left;width:10%;">{{$peticion->sp_solicita}}</td>
                        <!--2da etapa-->
                        <td style="width:6%;">
                           @isset($peticion->fecha_elaboracion)
                              {{date('d-m-Y',strtotime($peticion->fecha_elaboracion))}} 
                           @endisset
                           @empty($peticion->fecha_elaboracion)
                               ---
                           @endempty
                        </td>
                        <td style="width:8%;">
                           @isset($peticion->documento_emitido)
                              {{strtoupper($peticion->documento_emitido)}} 
                           @endisset
                           @empty($peticion->documento_emitido)
                               ---
                           @endempty
                        </td>
                        <td style="width:8%;">
                           @isset($peticion->solicitud_id)
                              {{$peticion->solicitud->especialidad->nombre}} 
                           @endisset
                           @empty($peticion->solicitud_id)
                               ---
                           @endempty
                        </td>
                        <td style="text-align:left;width:10%;">
                           @isset($peticion->solicitud_id)
                              {{$peticion->solicitud->nombre}} 
                           @endisset
                           @empty($peticion->solicitud_id)
                               ---
                           @endempty
                        </td>
                        <!--3ra etapa-->
                        <td style="width:6%;">
                           @isset($peticion->fecha_entrega)
                              {{date('d-m-Y',strtotime($peticion->fecha_entrega))}} 
                           @endisset
                           @empty($peticion->fecha_entrega)
                               ---
                           @endempty
                        </td>
                        <td  style="text-align:left;width:10%;">
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
                        </td>
                        --}}
                     </tr>
                  @endforeach
                 
               </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
   <script src="{{asset('/js/peticiones/peticion_eliminar.js')}}"></script>
@endsection
