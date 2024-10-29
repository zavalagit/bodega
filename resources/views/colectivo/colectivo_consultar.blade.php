@extends('plantilla.template')

{{--item menu selected--}}
@if (Auth::user()->tipo == 'usuario')
   @section('nombre_pagina','vista-colectivo-consultar')
   @section('nombre_submenu','submenu-colectivos')
@else
   @section('nombre_pagina','vista-colectivo-consultar')
@endif

@section('seccion')
   Colectivos ({{ ($colectivo_estado == 'usuario') ? 'consultar' : $colectivo_estado }}) 
@endsection

@section('titulo','CONSULTAR-CADENA')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<link rel="stylesheet" href="{{asset('/css/btn.css')}}">
<link rel="stylesheet" href="{{asset('/css/tablas.css')}}">
<link rel="stylesheet" href="{{asset('css/modal/modal.css')}}">
<link rel="stylesheet" href="{{asset('/css/tablas/tabla_modal.css')}}">
<link rel="stylesheet" href="{{asset('/css/nav/sidenav_buscador.css')}}">
<link rel="stylesheet" href="{{asset('/css/hr.css')}}">
<link rel="stylesheet" href="{{asset('/css/materialize/tooltip.css')}}">
   <style media="screen">
      


   /* .modal{
      width: 60% !important;
      max-height: 100% !important;
      margin-top: 0 !important;
      padding-top: 0 !important
   } */
   .span-estado:hover{

   }

   .row-color{
      background-color: rgba(57,64,73,0.2);
   }

   table{
         /* width: 3200px !important; */
         /* width: 1680px !important; */
         width: 100% !important;
      }


      .chip{
         background-color: rgba(192, 159, 119, 0.4);
         color: #152f4a;
      }

      .background-color-muestreo{
         background-color: rgba(21, 47, 74, 0.2);
      }
      .background-color-validacion{
         background-color: rgba(192, 159, 119, 0.3);
      }
      .background-color-emision{
         background-color: rgba(57, 64, 73, 0.3);
      }
      .colectivo-accion-true,
      .colectivo-accion-true i{
         color: green;
         
      }
      .colectivo-accion-true:hover,
      .colectivo-accion-true i:hover{
         color: green;
      }
      .colectivo-accion-false,
      .colectivo-accion-false i{
         color: red;
         
      }
      .colectivo-accion-false:hover,
      .colectivo-accion-false i:hover{
         color: red !important;
         cursor: default;
      }
      /* .colectivo-accion-icon-false{
         color: red;
      } */
      .color-check{
         color: green;
      }

      .enlace-no-activo{
         pointer-events: none;
         cursor: default;
         color: red;
      }
      .enlace-activo{
         color: green;
      }

      .jconfirm.jconfirm-my-theme .jconfirm-bg{
         /* background-color: rgba(192, 159, 119, 0.5); */
         /* background-color: rgba(57, 64, 73, 0.8); */
         background-color: rgba(21, 41, 74, 0.8);
      }
      .jconfirm.jconfirm-my-theme .jconfirm-box{
         /* background-color: rgba(21, 41, 74, 0.8); */
         background-color: rgba(192, 159, 119, 0);
      }
      .jconfirm.jconfirm-my-theme .jconfirm-box .jconfirm-closeIcon{
         background-color: tomato;
      }
      .jconfirm.jconfirm-my-theme .jconfirm-box .jconfirm-title-c{
         text-align: center;
         margin-bottom: 10px;
      }
      .jconfirm.jconfirm-my-theme .jconfirm-box .jconfirm-content{
         /* color: #152f4a; */
         color: #c09f77;
         font-size: 18px;
      }
      .jconfirm.jconfirm-my-theme .jconfirm-box .jconfirm-buttons{
         /* border-style: none; */
         /* align-items: center; */
         text-align: right;
      }
      .jconfirm.jconfirm-my-theme .jconfirm-box .jconfirm-buttons button{
         /* background-color: rgba(255, 255, 255, 0); */
         background-color: tomato;
         /* color: #c09f77; */
         font-weight: bold;
         border-style: none !important;
      }
      .fa-exclamation-triangle{
         color: tomato;
      }
   </style>
@endsection

@section('contenido')

   <span id="span-csrf" data-csrf="{{csrf_token()}}"></span>

   <section>
      @include('colectivo.colectivo_consultar_buscador')
      <div class="row">
         <div class="col s1 l1 offset-s11 offset-l11 right-align">
            <a href="#" data-activates="sidenav-buscador" class="b-side-nav btn-sidenav-desplegar"><i class="fas fa-search fa-lg"></i></a>
         </div>
      </div>
   </section>

   <section>
      @include('colectivo.colectivo_consultar_parametros_busqueda')
      <div class="row">
         <div class="col s12">
            <hr class="hr-3">
         </div>
      </div>
   </section>

   <section>
      <div class="row">
         <div class="col s12">
            @component('componentes.componente_nota')
               <strong><em>Editar</em></strong> en una <strong>fecha posterior</strong> a la <strong>fecha de registro</strong>, solo podrá modificar aulgunos campos.
            @endcomponent
            @component('componentes.componente_nota')
               Si el regsitro ya fue <strong><em>Validado</em></strong>, ya no podrá modificar ningun campo.
            @endcomponent
            @component('componentes.componente_nota')
               El orden de los registros es de acuerdo a la <strong><em>fecha de registro</em></strong> más <strong>reciente</strong>.
            @endcomponent
         </div>
      </div>
      {{-- <div class="row">
         <div class="col s12">
            <hr class="hr-3">
         </div>
      </div> --}}
   </section>

   @isset($request)
      <div class="row">
         <div class="col s12">
            <p style="text-align: justify;">
               {{-- <i style="color:#152f4a;" class="fas fa-square"></i> <span style="color:#c09f77;"><b>Fecha de registro en Sistema</b></span>. Es la fecha en la que se notifica a su Director o Coordinador que ha recibido una nueva Petición. Es la fecha en que su Director o Coordinador reporta que usted recibió una nueva Petición. <br>
               <i style="color:#152f4a;" class="fas fa-square"></i> <span style="color:#c09f77;"><b>Fecha en que se reportó cómo atendida en Sistema</b></span>. Es la fecha en la que se notifica a su Director o Coordinador que ha atendido una Petición, por lo cual usted emite un nuevo Documento. Es la fecha en que su Director o Coordinador reporta que usted emitió un nuevo Documento. --}}
               <i style="color:#152f4a;" class="fas fa-square"></i> <b>Se muestran los últimos 20 registros realizados, siendo el primero el último que realizó.</b>
            </p>
         </div>
      </div>   
   @endisset


    <div class="row">
        <div class="col s12 contenedor-tabla">
            <table class="bordered">
               <thead>
                  <!--tr-1-->
                  <tr>
                     <!--contador-->
                     <th rowspan="2" width="2%" class="th-center">Nº</th>
                     {{-- @if (Auth::user()->tipo == 'coordinador_colectivos') --}}
                        <!--etapa-->
                        <th rowspan="2" width="5%" class="th-center">ETAPA</th>
                        <!--grupo familiar-->
                        {{-- <th>GRUPO FAMILIAR</th> --}}
                        <!--coincidencia - match-->
                        {{-- <th>COINCIDENCIA</th> --}}
                     {{-- @endif --}}
                     
                     <!--acciones-->
                     <th rowspan="2" width="2%">ACCIONES <i class="fas fa-mouse-pointer"></i></th>                     
                     <!--fecha de registro en sistema-->
                     <th rowspan="{{Auth::user()->tipo == 'usuario' ? 2 : 1}}" width="4%">FECHA DE REGISTRO EN SISTEMA</th>
                     <!--región-->
                     <th width="6%">REGIÓN</th>
                     <!--donante nombre-->
                     <th width="10%">NOMBRE DEL DONANTE</th>
                     <!--pruebas-->
                     <th colspan="2" width="15%">PRUEBAS</th>
                     @if (Auth::user()->tipo == 'coordinador_colectivos')
                        <!--cim-->
                        <th width="12%">CIM</th>
                        <!--cantidad de estudios-->
                        <th width="10%">CANTIDAD DE ESTUDIOS</th>
                        <!--quien recibe-->               
                        <th width="8%">QUIÉN RECIBE</th>
                     @endif
                  </tr>
                  <!--tr-2-->
                  <tr>
                     @if (Auth::user()->tipo == 'coordinador_colectivos')
                        <!--perito que muestrea-->
                        <th>PERITO MUESTREA</th>
                     @endif
                     <!--fecha de toma de muestra-->
                     <th>FECHA DE TOMA DE MUESTRA</th>
                     <th>PARENTESCO DEL DONADOR CON RESPECTO A LA PERSONA DESAPARECIDA</th>
                     <th width="9%">NOMBRE DE LA PERSONA DESAPARECIDA</th>
                     <th widt="">OBJETO APORTADO</th>
                     @if (Auth::user()->tipo == 'coordinador_colectivos')
                        <!--perito analiza-->
                        <th>PERITO ANALIZA</th>
                        <!--fecha de validación-->
                        <th>FECHA DE VALIDACIÓN</th>
                        <!--fecha de emisión-->
                        <th>FECHA DE EMISIÓN</th>
                     @endif
                  </tr>
               </thead>
               <tbody>
                  @forelse ($colectivos->sortByDesc('created_at')->values() as $key => $colectivo)
                     <!--numero de filas-->
                     @php  $filas_pruebas = $pruebas->count();
                           $filas_objetos = count( explode('~', $colectivo->parentescos->pluck('pivot.ausente_objeto_aportado')->implode('~') ) ) ;
                           /*$editar = ( date('Y-m-d') == date('Y-m-d', strtotime($colectivo->created_at)) ) ? ($colectivo->colectivo_estado == 'validada' ? false : true) : false; */ @endphp
 
 {{-- {{ dd($colectivo->parentescos)}}  --}}
{{-- @if (!$loop->first)
{{ dd( count(explode('~', $colectivo->parentescos->pluck('pivot.ausente_objeto_aportado')->implode('~') ) ))}} 
@endif --}}
 {{-- @php
     $a1 = implode('~', $colectivo->parentescos->pluck('pivot.ausente_objeto_aportado')->toArray() );
     dd( count( explode('~',$a1) ) );
   //   dd($a1);
 @endphp --}}

                     <tr class="{{ ( ($key+1)%2 ) ? '' : 'row-color' }}">
                        <!--nº-->
                        <td rowspan="{{$filas_pruebas + $filas_objetos}}" width="45px" class="td-contador" style="border-color: #c09f77;">{{$key+1}}</td>
                        <!--etapa-->
                        {{-- @if (Auth::user()->tipo == 'coordinador_colectivos') --}}
                           <td rowspan="{{$filas_pruebas + $filas_objetos}}" style="background-color: rgba(57,64,73,0.8); border-color: #c09f77;">
                              <i class="fas fa-square"
                                 style="color: {{$colectivo->colectivo_estado == 'revision' ? '#ffea00;' : ''}}
                                    {{$colectivo->colectivo_estado == 'validada' ? 'orange;' : ''}}
                                    {{$colectivo->colectivo_estado == 'entregada' ? '#76ff03;' : ''}}
                                 "
                              ></i> <strong style="color: #c6c6c6;">{{ucfirst($colectivo->colectivo_estado)}}</strong>
                           </td>
                        {{-- @endif --}}
                        <!--grupo familiar-->
                        {{-- @if (Auth::user()->tipo != 'usuario')
                        <td rowspan="{{$filas_pruebas + $filas_objetos}}" width="170px" style="color: red !important;">
                           <b>{{$colectivo->colectivo_grupo_familiar ?? '---'}}<b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <a href="" class="btn-grupo-familiar" data-colectivo-id="{{$colectivo->id}}"><i class="fas fa-pen-square fa-lg"></i></a>
                        </td>
                        @endif --}}
                        <!--coincidencia-->
                        {{-- @if (Auth::user()->tipo != 'usuario')
                        <td rowspan="{{$filas_pruebas + $filas_objetos}}" width="100px">
                           @php
                              $match = 
                              #colectivo_donante vs colectivo_donante
                              App\Colectivo::where('colectivo_donante','like',"%{$colectivo->colectivo_donante}%")
                                 ->where('id','<>',$colectivo->id)->get()->count() + 
                              #colectivo_donante vs ausente_nombre
                              App\Colectivo::whereHas('parentescos', function($q) use($colectivo){
                                    $q->where('ausente_nombre','like',"%{$colectivo->colectivo_donante}%");
                                 })->where('id','<>',$colectivo->id)->get()->count() +
                              #ausente_nombre vs ausente_nombre
                              App\Colectivo::whereHas('parentescos',function($q) use($colectivo){
                                    foreach ($colectivo->parentescos as $i => $parentesco) {
                                       $q->where('ausente_nombre','like',"%{$parentesco->pivot->ausente_nombre}%");
                                    }
                                 })->where('id','<>',$colectivo->id)->get()->unique('id')->count()
                           @endphp
                           
                           <a href="{{ ($match) ? route('colectivo_match',['colectivo' => $colectivo->id]) : '' }}"> <i class="fas {{ ($match) ? 'fa-eye' : 'fa-lock' }}"></i> </a>
                        </td>
                        @endif --}}
                        <!--acciones-->                        
                        <td rowspan="{{$filas_pruebas + $filas_objetos}}">
                           <!--etapa-->
                           @if (Auth::user()->tipo == 'coordinador_colectivos' && $colectivo->colectivo_estado != 'entregada')                  
                              @php $colectivo_etapa = app\Http\Controllers\ColectivoController::colectivo_etapa($colectivo) @endphp
                              <a href="{{$colectivo_etapa->url}}" style="color: tomato;">
                                 <i class="fas fa-paper-plane"></i> <small><strong>({{$colectivo_etapa->mensaje}})</strong></small>
                              </a> <hr>
                           @endif
                           <!--editar-->
                           <a href="{{ route('colectivo_form',['accion'=>'editar','colectivo'=>$colectivo->id]) }}"
                              class="{{ ( (Auth::user()->tipo == 'usuario' && $colectivo->colectivo_estado == 'revision') || (Auth::user()->tipo == 'coordinador_colectivos') ) ? 'enlace-activo' : 'enlace-no-activo' }}"
                           >
                              <i class="fas fa-pen-square"></i> <small><strong>(Editar)</strong></small>
                           </a> <hr>
                           <!--acciones solo para usuario-->
                           @if (Auth::user()->tipo != 'coordinador_colectivos')
                              <!--clonar-->
                              <a href="{{route('colectivo_form',['accion'=>'clonar','colectivo_id'=>$colectivo->id])}}"
                                 class="enlace-activo"
                              >
                                 <i class="fas fa-copy"></i> <small><strong>(Clonar)</strong></small>
                              </a> <hr>
                              <!--eliminar-->
                              <a href="{{route('colectivo_eliminar',['colectivo'=>$colectivo->id])}}"
                                 class="colectivo-eliminar
                                    {{ ( $colectivo->colectivo_estado == 'revision' && date('Y-m-d',strtotime($colectivo->created_at) ) == date('Y-m-d') ) ? 'enlace-activo' : 'enlace-no-activo' }}
                                 "
                              >
                                 <i class="fas fa-trash"></i> <small><strong>(Eliminar)</strong></small>
                              </a> <hr>
                           @endif
                        </td>                           
                        
                        <!--fecha de registro en sistema-->
                        <td rowspan="{{$filas_pruebas + ( Auth::user()->tipo == 'usuario' ? $filas_objetos : 0 )}}">{{date('H:i:s ~ d-m-Y',strtotime($colectivo->created_at))}}</td>                        
                        <!--región-->
                        <td rowspan="{{$filas_pruebas}}">{{$colectivo->fiscalia->nombre}}</td>                        
                        <!--donante nombre-->
                        <td rowspan="{{$filas_pruebas}}" class="background-color-muestreo">
                           <a class="tooltipped" data-position="right" data-delay="50"
                              data-tooltip="
                                 <strong>· Lugar de procedencia <small>(Entidad Federativa)</small></strong>: {{$colectivo->entidad->nombre}} <br>
                                 <strong>· Lugar de procedencia <small>(Municipio)</small></strong>: {{$colectivo->delegacion->nombre ?? '---'}}
                              ">
                              <i style="color: tomato;" class="fas fa-eye"></i>
                           </a> - 
                           <span><b>{{$colectivo->colectivo_donante}}</b></span>
                        </td>                              
                        <!--pruebas-->
                        @foreach ($pruebas as $prueba)
                           @if (!$loop->first)
                              <tr class="{{ ( ($key+1)%2 ) ? '' : 'row-color' }}">
                           @endif
                                 <td colspan="2" class="background-color-muestreo">
                                    <i class="fas {{$colectivo->pruebas->contains('id',$prueba->id) ? 'fa-check-square color-check' : 'fa-square'}}"></i> 
                                    {{$prueba->nombre}}{{( ($prueba->id == 5) && ($colectivo->pruebas->contains('id',$prueba->id)) ) ? ': '.$colectivo->pruebas->where('pivot.prueba_id',5)->first()->pivot->prueba_otro   : '' }}
                                 </td>
                                 @if (Auth::user()->tipo == 'coordinador_colectivos')
                                    <!--prueb_cim-->
                                    <td class="background-color-validacion"> {{ ( $colectivo->pruebas->contains('id',$prueba->id) && (in_array($colectivo->colectivo_estado,['validada','entregada'])) ) ? $colectivo->pruebas->where('pivot.prueba_id',$prueba->id)->first()->pivot->prueba_cim : '---'}}</td>                                    
                                    <!--prueba_estudios-->
                                    <td class="background-color-validacion"> {{ ( $colectivo->pruebas->contains('id',$prueba->id) && (in_array($colectivo->colectivo_estado,['validada','entregada'])) ) ? $colectivo->pruebas->where('pivot.prueba_id',$prueba->id)->first()->pivot->prueba_estudios : '---'}}</td>
                                    @if ($loop->first)
                                       <!--perosna recibe-->
                                       <td rowspan="{{$filas_pruebas}}" class="background-color-emision"> {{ $colectivo->colectivo_emision_persona ?? '---' }}</td>         
                                    @endif
                                 @endif
                              </tr>
                        @endforeach
                                 
                        <!--pruebas-->
                        {{-- @foreach ($colectivo->pruebas->sortBy('nombre') as $prueba)
                           @if (!$loop->first)
                           <tr class="{{ ( ($key+1)%2 ) ? '' : 'row-color' }}">
                           @endif
                           <td width="200px" class="{{ ($loop->first) ? '' : 'td-no-border-left' }}">{{$prueba->nombre}}</td>
                           @if (Auth::user()->tipo != 'usuario')
                           <td width="180px">{{ $prueba->pivot->prueba_cim ?? '---'}}</td>
                           <td width="150px">{{ $prueba->pivot->prueba_estudios ?: '---' }}</td>
                           @endif
                           @if ($loop->first)
                              @if (Auth::user()->tipo != 'usuario')
                              <!--validacion-->
                              <td rowspan="{{$filas}}" width="200px">{{$colectivo->colectivo_validacion_fecha ?? '---'}}</td>
                              <td rowspan="{{$filas}}" width="380px">{{$colectivo->user2->name ?? '---'}}</td>
                              <!--entrega-->
                              <td rowspan="{{$filas}}" width="200px">{{$colectivo->colectivo_emision_fecha ?? '---'}}</td>   
                              <td rowspan="{{$filas}}" width="400px">{{$colectivo->colectivo_emision_persona ?? '---'}}</td>  
                              @endif
                           @endif
                           </tr>
                        @endforeach --}}

                        @foreach ($colectivo->parentescos as $parentesco)
                           <tr class="{{ ( ($key+1)%2 ) ? '' : 'row-color' }}">
                              @php $filas_objetos_por_parentesco = count( explode('~',$parentesco->pivot->ausente_objeto_aportado) ); @endphp

                              @if ( $loop->first)
                                 <!--user1 - perito_muestrea-->
                                 @if (Auth::user()->tipo == 'coordinador_colectivos')
                                    <td rowspan="{{$filas_objetos}}">{{$colectivo->user1->name}}</td>
                                 @endif 
                                 <!--fecha de muestreo-->
                                 <td rowspan="{{$filas_objetos}}">{{date('d-m-Y',strtotime($colectivo->colectivo_fecha))}}</td>                                                         
                              @endif

                              <td rowspan="{{$filas_objetos_por_parentesco}}" class="background-color-muestreo">{{$parentesco->nombre}} {{($parentesco->id == 10 ? ': '.$parentesco->pivot->parentesco_otro : '')}}</td>
                              <!--ausente_nombre-->
                              <td rowspan="{{$filas_objetos_por_parentesco}}" class="background-color-muestreo">
                                 <a class="tooltipped" data-position="right" data-delay="50"
                                    data-tooltip="
                                       <strong>· Nombre</strong>: {{$parentesco->pivot->ausente_nombre}} <br>
                                       <strong>· Sexo</strong>: {{$parentesco->pivot->ausente_sexo}} <br>
                                       <strong>· Fecha nacimiento</strong>: {{$parentesco->pivot->ausente_fecha_nacimiento ?? '---'}} <br>
                                       <strong>· Edad</strong>: {{$parentesco->pivot->ausente_edad ?? '---'}} <br>
                                       <strong>· Lugar de desaparición</strong>: {{$parentesco->pivot->ausente_lugar_desaparicion ?? '---'}} <br>
                                       <strong>· Fecha de desaparición</strong>: {{$parentesco->pivot->ausente_fecha_desaparicion ?? '---'}}
                                    ">
                                    <i style="color: tomato;" class="fas fa-eye"></i>
                                 </a> - 
                                 <span><b>{{$parentesco->pivot->ausente_nombre}}</b></span> 
                              </td>
                              @if ($filas_objetos_por_parentesco > 1)
                                 @foreach (explode('~',$parentesco->pivot->ausente_objeto_aportado) as $objeto)
                                    @if (!$loop->first)
                                       <tr class="{{ ( ($key+1)%2 ) ? '' : 'row-color' }}">
                                    @endif
                                       <!--objeto-->
                                       <td class="background-color-muestreo">{{$objeto}}</td>
                                       @if (Auth::user()->tipo == 'coordinador_colectivos' && $loop->first)
                                          <!--user2 - perito_analiza-->
                                          <td rowspan="{{$filas_objetos}}" class="background-color-validacion">{{$colectivo->user2->name ?? '---'}}</td>
                                          <!--fecha_vilidacion-->
                                          <td rowspan="{{$filas_objetos}}" class="background-color-validacion">{{$colectivo->colectivo_validacion_fecha ?? '---'}}</td>
                                          <!--fecha_entrega-->
                                          <td rowspan="{{$filas_objetos}}" class="background-color-emision">{{$colectivo->colectivo_emision_fecha ?? '---'}}</td>
                                       @endif

                                    </tr>
                                 @endforeach
                              @else
                                    <!--objeto-->
                                    <td class="background-color-muestreo">{{ ($parentesco->pivot->ausente_objeto_aportado == '') ? '---' : $parentesco->pivot->ausente_objeto_aportado }}</td>
                                    @if (Auth::user()->tipo == 'coordinador_colectivos' && $loop->first)
                                       <!--user2 - perito_analiza-->
                                       <td rowspan="{{$filas_objetos}}" class="background-color-validacion">{{$colectivo->user2->name ?? '---'}}</td>
                                       <!--fecha_vilidacion-->
                                       <td rowspan="{{$filas_objetos}}" class="background-color-validacion">{{$colectivo->colectivo_validacion_fecha ?? '---'}}</td>
                                       <!--fecha_entrega-->
                                       <td rowspan="{{$filas_objetos}}" class="background-color-emision">{{$colectivo->colectivo_emision_fecha ?? '---'}}</td>
                                    @endif
                                 </tr>
                              @endif
                        @endforeach
                  @empty
                     <tr><td colspan="13">No hay nada :(</td></tr>
                  @endforelse
                 
               </tbody>
            </table>
        </div>
    </div>

<section id="modal-asd">
   
</section>

<div id="modal-parentesco" class="modal">
   <div class="modal-content">
      
   </div>
</div>
@endsection

@section('js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="{{asset('js/colectivo/colectivo_consultar.js')}}"></script>
    <script src="{{asset('js/colectivo/colectivo_parentesco.js')}}"></script>
    <script src="{{asset('js/colectivo/colectivo_eliminar.js')}}"></script>
    <script src="{{asset('js/colectivo/colectivo_grupo_familiar_modal.js')}}"></script>
    <script src="{{asset('js/modal/modal.js')}}"></script>
    <script src="{{asset('js/colectivo/colectivo_form_grupo_familiar.js')}}"></script>
    <script src="{{asset('/js/general/sidenav_buscador.js')}}"></script>

  <script>
      $(document).ready(function(){
		  $('.tooltipped').tooltip({
			  delay: 50,
			  html: true,
		});
      });
   </script>

   @if ($errors->any())
      <script type="text/javascript">
         const error = @json($errors->first());
         alertify.error(error);
      </script>
   @endif
@endsection
