@extends('template.template')

@section('css')
<link rel="stylesheet" href="{{asset('/plugins/jQuery_confirm/css/jquery-confirm.css')}}">
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

@section('title','Consultar Peticiones')

@section('header')
<div class="col s2 l1 offset-l11 offset-s10 center-align" style="padding-top: 3px;">
   <a href="#" class="btn-sidenav-buscador-open"><i class="fas fa-search" style="color: #fff;"></i></a>
</div>
@endsection

@section('main')
<section>
   <div class="row">
      @include('peticion.peticion_consultar_parametros_busqueda')
      <div class="col s12">
         <hr class="hr-2">
      </div>
   </div>
</section>

   <div class="row">
      <div class="col s12">
         <p style="text-align: justify;">
            <i style="color:#152f4a;" class="fas fa-square"></i> <span style="color:#c09f77;"><b>Fecha de registro en Sistema</b></span>. Es la fecha en la que se notifica a su Director o Coordinador que ha recibido una nueva Petición. Es la fecha en que su Director o Coordinador reporta que usted recibió una nueva Petición. <br>
            <i style="color:#152f4a;" class="fas fa-square"></i> <span style="color:#c09f77;"><b>Fecha en que se reportó cómo atendida en Sistema</b></span>. Es la fecha en la que se notifica a su Director o Coordinador que ha atendido una Petición, por lo cual usted emite un nuevo Documento. Es la fecha en que su Director o Coordinador reporta que usted emitió un nuevo Documento.
         </p>
      </div>
	  
	  @empty(old('btn_buscar'))
         @if (Auth::user()->tipo == 'usuario')
            <div class="col s12">
               @component('componentes.componente_nota_2')
                  @slot('icono')
                     <i style="color: tomato" class="fas fa-comment-alt"></i>
                  @endslot
                  @slot('mensaje')
                     Por delfault se enlistan los <strong>últimos 5 registos</strong> que ha realizado.
                  @endslot
               @endcomponent
            </div>                       
         @endif
      @endempty
   </div>

   <div class="row">
      <div class="col s12" style="overflow-x: auto">
         <table class="tabla highlight bordered">
            <thead>
               <tr>
                  <th width="2%" class="th-center">Nº</th>
                  <th width="3%" class="th-center">ESTADO</th>
                  <th width="4%" class="th-center">ACCIONES</th>
                  <th width="6%">N.U.C.</th>
                  <th width="7%">FECHA DE REGISTRO EN SISTEMA</th>
				  <th width="4%">FECHA DE RECEPCIÓN</th>
                  <th width="8%">FECHA EN QUE SE REPORTÓ CÓMO ATENDIDA EN SISTEMA</th>
                  @if (Auth::user()->tipo != 'usuario')
                     <th width="12%">USUARIO</th>
                  @endif                  
                  <th width="15%">SOLICITUD</th>
                  <th width="7%">DOCUMENTO EMITIDO</th>
               </tr>
            </thead>
            <tbody>
               @isset($peticiones)
                  @forelse ($peticiones->values() as $i => $peticion)
                     <tr>
                        <!--index-->
                        <td class="td-index">{{$i+1}}</td>
                        <!--Estado-->
                        <td style="background-color: #152f4a; color: #c09f77 !important;" class="td-top">
                           @if ($peticion->estado == 'pendiente')
                              <i style="color: orange;" class="fas fa-square"></i> <b> PENDIENTE </b>
                           @elseif($peticion->estado == 'atendida')
                              <i style="color: yellowgreen;" class="fas fa-square"></i> <b> ATENDIDA </b>
                           @elseif($peticion->estado == 'entregada')   
                              <i style="color: green;" class="fas fa-square"></i> <b> ENTREGADA </b>
                           @endif
                        </td>
                        <!--acciones-->                        
                        <td style="background-color: #152f4a; color: #c09f77 !important;">
                           @if ( in_array(Auth::user()->tipo,['administrador_peticiones','usuario']) )                              
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
                       
                        <!--nuc-->
                        <td class="td-nuc td-top">{{$peticion->nuc}}</td>                         
                        <!--Fecha de registro en sistema-->
                        <td class="td-destacar td-top">{{date( 'H:i:s ~ d-m-Y',strtotime($peticion->created_at) )}}</td>
						<!--Fecha de recepción-->
                        <td class="td-destacar td-top">{{date( 'd-m-Y',strtotime($peticion->fecha_recepcion) )}}</td>
                        <!--Fecha en que se reportó cómo atendidad en sistema-->
                        <td class="td-destacar td-top">{{ ($peticion->fecha_sistema) ? date( 'd-m-Y',strtotime($peticion->fecha_sistema) ) : '---'}}</td>
                        <!--usuario-->
                        @if (Auth::user()->tipo != 'usuario')
                        <td class="td-top">{{$peticion->user->name}}</td>
                        @endif                        
                        <!--Solicitud-->
                        <td class="td-top">
                           {{$peticion->solicitud->nombre}} <br>
                           {{in_array($peticion->solicitud_id,[61,62])
								? (isset($peticion->necropsia_id) ? "{$peticion->necropsia->necropsia_clasificacion->nombre}: {$peticion->necropsia->nombre}" : '???') 
								: ''
							}} <br>
                           {{isset($perticion->necropsia_apoyo) ? strtoupper($peticion->necropsia_apoyo) : ''}}
                        </td>
                        <!--Documento emitido-->
                        <td class="td-top">{{strtoupper($peticion->documento_emitido) ?? '---'}}</td>
                     </tr>
                  @empty
                     <tr>
                        <td class="td-aviso" colspan="11">- NO HAY COINCIDENCIAS</td>
                     </tr>
                  @endforelse
               @endisset
               @empty($peticiones)
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

<!--buscador-->
@include('peticion.peticion_consultar_buscador')

<!-- Modal Info -->
<div id="modal-peticion-informacion" class="modal">
   <div class="modal-content">
   </div>
</div>
@endsection

@section('js')
<script src="{{asset('/plugins/jQuery_confirm/js/jquery-confirm.js')}}"></script>
{{-- <script src="{{asset('/js/peticiones/peticion_accion.js')}}"></script> --}}
<script src="{{asset('/js/general/sidenav_buscador.js')}}"></script>
<script src="{{asset('/js/autocomplete/autocomplete.js')}}"></script>
<script src="{{asset('/js/peticion/peticion_informacion.js')}}"></script>
<script src="{{asset('/js/peticiones/peticion_eliminar.js')}}"></script>
<script src="{{asset('/js/peticion/peticion_buscador_especialidad_solicitudes.js')}}"></script>

<script src="{{asset('/js/general/registro_eliminar.js')}}"></script>
@endsection
