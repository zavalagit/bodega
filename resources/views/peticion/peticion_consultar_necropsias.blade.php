@extends('template.template')

{{--item menu selected--}}
{{-- ,'vista-peticion-consultar') --}}


{{-- @section('seccion', 'CONSULTA DE PETICIONES') --}}
@section('title','Consultar Peticiones')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<link rel="stylesheet" href="{{asset('/css/materialize/chips.css')}}">
<link rel="stylesheet" href="{{asset('/css/nav/sidenav_buscador.css')}}">
<link rel="stylesheet" href="{{asset('/css/btn.css')}}">
<link rel="stylesheet" href="{{asset('/css/table.css')}}">
<link rel="stylesheet" href="{{asset('/css/tablas/tabla_modal.css')}}">
<link rel="stylesheet" href="{{asset('/css/buscador/buscador_parametros_busqueda.css')}}">
<link rel="stylesheet" href="{{asset('/css/jconfirm/jconfirm_theme.css')}}">
   <style media="screen">
      


   .modal{
      width: 60% !important;
      max-height: 100% !important;
      margin-top: 0 !important;
      padding-top: 0 !important
   }
   .span-estado:hover{

   }

   .ocultar{
        display: none;
    }
   

   </style>
@endsection
@section('header')
   <div class="col s2 l1 offset-l11 offset-ls10 center-align" style="padding-top: 3px;">
      <a href="#" class="btn-sidenav-buscador-open pulse"><i class="fas fa-search" style="color: #fff;"></i></a>
   </div>
@endsection
@section('main')

   {{-- <span id="span-csrf" data-csrf="{{csrf_token()}}"></span> --}}

   <section>      
      <div class="row">
         <!--parametros de busqueda-->
         @include('peticion.peticion_consultar_necropsias_parametros_busqueda')
         <div class="col s12">
            <hr class="hr-2">
         </div>
      </div>
   </section>

   {{-- <div class="row">
      <div class="col s12">
         <p style="text-align: justify;">
            <i style="color:#152f4a;" class="fas fa-square"></i> <span style="color:#c09f77;"><b>Fecha de registro en Sistema</b></span>. Es la fecha en la que se notifica a su Director o Coordinador que ha recibido una nueva Petición. Es la fecha en que su Director o Coordinador reporta que usted recibió una nueva Petición. <br>
            <i style="color:#152f4a;" class="fas fa-square"></i> <span style="color:#c09f77;"><b>Fecha en que se reportó cómo atendida en Sistema</b></span>. Es la fecha en la que se notifica a su Director o Coordinador que ha atendido una Petición, por lo cual usted emite un nuevo Documento. Es la fecha en que su Director o Coordinador reporta que usted emitió un nuevo Documento.
         </p>

      </div>
   </div> --}}


    <div class="row">
        <div class="col s12">
            <table class="tabla highlight bordered">
               <thead>
                  <tr>
                     <th width="2%" class="td-center">No.</th>                     
                     <th width="7%">N.U.C.</th>                     
                     <th width="7%" class="th-center">ACCIONES</th>
                     <th width="12%">FECHA DE REGISTRO EN SISTEMA</th>
                     <th width="12%">FECHA EN QUE SE REPORTÓ CÓMO ATENDIDA EN SISTEMA</th>
                     <th width="12%">FECHA A LA QUE PERTENECE LA NECROPSIA</th>                     
                     <th width="15%">USUARIO</th>                     
                     <th width="12%">NECROPSIA CAUSA</th>
                     <th width="8%">NECROPSIA CLASIFICACIÓN</th>
                     <th>SOLICITUD</th>                     
                  </tr>
               </thead>
               <tbody>
                  @isset($necros)
                     @forelse ($necros->sortBy('fecha_necropsia')->values() as $i => $peticion)
                        <tr>
                           <!--index-->
                           <td class="td-index">{{$i+1}}</td>
                           <!--nuc-->
                           <td class="td-top">{{$peticion->nuc}}</td>
                           <!--Estado-->
                           {{-- <td style="background-color: #152f4a; color: #c09f77 !important;">
                              @if ($peticion->estado == 'pendiente')
                                 <i style="color: orange;" class="fas fa-square"></i> <b> PENDIENTE </b>
                              @elseif($peticion->estado == 'atendida')
                                 <i style="color: yellowgreen;" class="fas fa-square"></i> <b> ATENDIDA </b>
                              @elseif($peticion->estado == 'entregada')   
                                 <i style="color: green;" class="fas fa-square"></i> <b> ENTREGADA </b>
                              @endif
                           </td> --}}
                           <!--acciones-->                           
                           <td style="background-color: #152f4a; color: #c09f77 !important;">                              
                              @if (Auth::user()->tipo == 'administrador_peticiones')
                                 <!--etapa-->
                                 @if ( $peticion->estado != 'entregada' )
                                    <a class="etapa" href="{{route('peticion_form',['formAccion' => 'continuar','peticion' => $peticion])}}" style="color: tomato;">
                                       <i class="fas fa-paper-plane"></i> <small><strong>({{$peticion->estado == 'pendiente' ? 'Atender' : 'Entregar'}})</strong></small>
                                    </a> <hr> 
                                 @endif
                              @endif
                                 <!--ver-->
                                 <a href="" style="color: #c09f77;" class="peticion-info" data-peticion-id={{$peticion->id}}>
                                    <i style="color: #c09f77;" class="fas fa-eye i-btn"></i> <small><strong>(Ver)</strong></small>
                                 </a> <hr>
                              
                              @if ( in_array(Auth::user()->tipo,['administrador_peticiones','usuario']) )
                                 <!--editar-->
                                 <a href="{{route('peticion_form',['formAccion' => 'editar', 'peticion' => $peticion])}}" style="color: #c09f77;">
                                    <i class="fas fa-pen-square"></i> <small><strong>(Editar)</strong></small>
                                 </a> <hr>
                                 <!--clonar-->
                                 <a href="{{route('peticion_form',['formAccion' => 'clonar', 'peticion' => $peticion])}}" style="color: #c09f77;">
                                    <i class="fas fa-copy"></i> <small><strong>(Clonar)</strong></small>
                                 </a> <hr>
                                 <!--eliminar-->
                                 <a href="{{route('peticion_eliminar',['peticion'=>$peticion])}}" style="color: #c09f77;"
                                    class="
                                       registro-eliminar
                                       {{date('Y-m-d',strtotime($peticion->created_at) ) != date('Y-m-d') ? 'ocultar' : '' }}
                                    "
                                 >
                                    <i class="fas fa-trash"></i> <small><strong>(Eliminar)</strong></small>
                                 </a> <hr class="{{date('Y-m-d',strtotime($peticion->created_at) ) != date('Y-m-d') ? 'ocultar' : '' }}">
                              @endif
                           </td>                                                                                         
                           <!--Fecha de registro en sistema-->
                           <td class="td-top td-destacar">{{date( 'H:i:s ~ d-m-Y',strtotime($peticion->created_at) )}}</td>
                           <!--Fecha en que se reportó cómo atendidad en sistema-->
                           <td class="td-top td-destacar">{{ ($peticion->fecha_sistema) ? date( 'd-m-Y',strtotime($peticion->fecha_sistema) ) : '---'}}</td>
                           <!--Fecha a la que pertenece la necro-->
                           <td class="td-top td-destacar">{{ ($peticion->fecha_necropsia) ? date( 'd-m-Y',strtotime($peticion->fecha_necropsia) ) : '---'}}</td>
                           <!--usuario-->                           
                           <td class="td-top">{{$peticion->user->name ?? '---'}}</td>                                                   
                           <!--necropsia_causa-->
                           <td class="td-top">{{$peticion->necropsia->nombre ?? '---'}}</td>
                           <!--necropsia_clasificacion-->
                           <td class="td-top">{{$peticion->necropsia->necropsia_clasificacion->nombre ?? '---'}}</td>
                           <!--Solicitud-->
                           <td class="td-top">{{$peticion->solicitud->nombre ?? '---'}}</td>
                        </tr>
                     @empty
                        <tr>
                           <td class="td-aviso" colspan="11">- NO HAY COINCIDENCIAS</td>
                        </tr>
                     @endforelse
                  @endisset
                  @empty($necros)
                      <tr>
                         <td class="td-aviso" colspan="11">- REALICE UNA BUSQUEDA</td>
                      </tr>
                  @endempty            
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

@include('peticion.peticion_consultar_necropsias_buscador')

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
{{-- <script src="{{asset('/js/peticiones/peticion_accion.js')}}"></script> --}}
<script src="{{asset('/js/general/sidenav_buscador.js')}}"></script>
<script src="{{asset('/js/modelo/get_modelo.js')}}"></script>
<script src="{{asset('/js/peticion/peticion_informacion.js')}}"></script>
<script src="{{asset('/js/peticiones/peticion_eliminar.js')}}"></script>
<script src="{{asset('/js/especialidad/especialidad_solicitudes.js')}}"></script>

<script src="{{asset('/js/general/registro_eliminar.js')}}"></script>


<script src="{{asset('/js/peticion/peticion_buscador.js')}}"></script>
@endsection
