@php
   $plantilla = "";
   if(Auth::user()->tipo === 'coordinador')
      $plantilla = 'plantillas.peticiones.plantilla_coordinador';
   elseif(Auth::user()->tipo === 'director_unidad')
      $plantilla = 'plantillas.plantilla_director';
   elseif(Auth::user()->tipo === 'director_fiscalia')
      $plantilla = 'plantillas.plantilla_director';
   elseif(Auth::user()->tipo === 'usuario')
      $plantilla = 'plantilla.template';
@endphp
@extends($plantilla)

@if (Auth::user()->tipo === 'usuario')
    {{--item menu selected--}}
   @section('nombre_pagina','vista-peticion-dia')
   @section('nombre_submenu','submenu-peticiones')
@endif

@section('seccion', " REPORTE DE PETICIONES")
@section('titulo','CONSULTAR-PETICIONES')

@section('css')

    <link rel="stylesheet" href="{{asset('css/botones/btn_icon.css')}}">
    <link rel="stylesheet" href="{{asset('css/tablas.css')}}">
    <link rel="stylesheet" href="{{asset('/css/btn.css')}}">
    <link rel="stylesheet" href="{{asset('/css/tablas/tabla_modal.css')}}">
   <style media="screen">
      body{
         zoom: 72% !important;
      }



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

     table {
      /*width: 220% !important;*/
      overflow-x: scroll;
      overflow-y: hidden;
   }

   .td-total{
      font-weight: bold;
      background-color:#c09f77;
      color:#394049;
      width: 20%;
   }

   .td-total-rezago{
      font-weight: bold;
      background-color:#c09f77;
      color:#394049;
      width: 45%;
   }
   .td-total-cantidad{
      background-color: #394049;
      color: #fff !important;
   }
   .fecha-encabezado{
        margin: 0 !important;
    }
    .fecha-encabezado h5{
        text-align: center;
        background-color: #152f4a;
        color: #c09f77;
        padding-top: 6px;
        padding-bottom: 6px;
    }

   

   </style>
@endsection

@section('contenido')

   <span id="span-csrf" data-csrf="{{csrf_token()}}"></span>

    <!--buscar-->
    <section>
      <form class="col s12">
         <div class="row">

            @if (Auth::user()->tipo === 'coordinador')
               <div id="div-fiscalias" class="input-field col s2">
                  <select id="fiscalia-select" name="buscar_fiscalia">
                  @foreach ($fiscalias->sortBy('nombre') as $f)
                        <option value="{{$f->id}}" {{ ($f->id === $fiscalia->id) ? 'selected' : '' }}>{{$f->nombre}}</option>
                  @endforeach
                  </select>
                  <label>Seleccione Fiscalía</label>
               </div>
               
               @if ($lugar === 'unidad')
                  <div id="div-unidades" class="input-field col s2">
                        <select id="unidad-select" name="buscar_unidad">
                        @foreach ($unidades->sortBy('nombre') as $u)
                           <option value="{{$u->id}}" {{ ($u->id === $unidad->id) ? 'selected' : '' }}>{{$u->nombre}}</option>
                        @endforeach
                        </select>
                        <label>Seleccione Unidad</label>
                  </div>
               @endif
            @endif
			
			@if ( $lugar == 'unidad' && $lugar_id == 2 )
               <div class="col s1">
                  <input type="checkbox" id="violencia-familiar" class="filled-in" {{old('violencia_familiar') ? 'checked' : ''}} name="violencia_familiar"/>
                  <label for="violencia-familiar">F. Violencia familiar</label>
               </div>
            @endif

            <div class="input-field col s2">
               <select name="especialidad_buscar" id="especialidad-select">
                  <option value="0" selected>Todo</option>

                  @if(Auth::user()->tipo === 'usuario')
                     @foreach ($especialidades->where('unidad_id',Auth::user()->unidad_id)->sortBy('nombre') as $especialidad)                     
                        <option value="{{$especialidad->id}}" {{ ($especialidad->id == $request->especialidad_buscar) ? "selected" : "" }}>{{$especialidad->nombre}}</option>
                     @endforeach
                  @else
                     @foreach ($especialidades->sortBy('nombre') as $especialidad)                     
                        <option value="{{$especialidad->id}}" {{ ($especialidad->id == $request->especialidad_buscar) ? "selected" : "" }}>{{$especialidad->nombre}}</option>
                     @endforeach
                  @endif

                  
               </select>
               <label>Especialidad</label>
            </div>
            
            
            <div class="input-field col s2">
               <select name="solicitud_buscar" id="solicitud-select">
                  @if ( $request->especialidad_buscar > 0 )
                     <option value="" selected>Selecciona una solicitud</option>
                     @foreach ($solicitudes->sortBy('nombre') as $solicitud)                     
                        <option value="{{$solicitud->id}}" {{ ($solicitud->id == $request->solicitud_buscar) ? "selected" : "" }}>{{$solicitud->nombre}}</option>
                     @endforeach
                  @endif   
               </select>
               <label>Solicitud</label>
            </div>

            <div class="input-field col s3">
               <input type="text" id="buscar-texto" placeholder="N.U.C., Perito , Número oficio" name="texto_buscar" value="{{$request->texto_buscar}}">
               {{-- <label for="buscar-texto">First Name</label> --}}
            </div>

            <div class="input-field col s2">
                  @isset($fecha_inicio)
                     <input type="date" name="fecha_inicio" value="{{$fecha_inicio}}">
                  @endisset
                  @empty($fecha_inicio)
                     <input type="date" name="fecha_inicio" >
                  @endempty
            </div>
            
            <div class="input-field col s1">
                  <button class="btn waves-effect waves-light" type="submit" name="btn_buscar" value="buscar">
                     <i style="color:#394049;" class="fas fa-search"></i>
                  </button>
            </div>
           
         </div>
      </form>
   </section>

   <!--encabezado-->
   <section>
      <div class="row">
          <div class="fecha-encabezado col s12" style="margin-bottom:0 !important;">
              <h5 style="margin-bottom:0 !important;"> <b>PETICIONES {{$fecha_encabezado}}</b> </h5>
          </div>

          <div class="fecha-encabezado col s12" style="margin-top:0 !important;">
              @if ($lugar === 'unidad')
                  <h5 style="margin-top:0 !important;"> <b>{{$unidad->nombre}}</b> </h5>
              @elseif($lugar === 'fiscalia')
                  <h5 style="margin-top:0 !important;"> <b>{{$fiscalia->nombre}}</b> </h5>
              @elseif( Auth::user()->tipo === 'usuario')
                  <h5 style="margin-top:0 !important;"><b>{{Auth::user()->nombre}}</b></h5>
              @endif
          </div>
      </div>
  </section>

  <section>
      <div class="row">
         <div class="col s12">
            <ul class="collapsible popout margen-ul">
               <li class="margen-li">
                  <div class="collapsible-header">
                     <table>
                        <thead>
                           <tr>
                              <th>Tipo peticiones</th>
                              <th>Registradas</th>
                              <th>Atendidas</th>
                              <th>Pendientes</th>
                              <th>Dictamenes</th>
                              <th>Informes</th>
                              <th>Certificados</th>
                              <th>Salida Juzgado</th>
                              <th>Archivo</th>
                              @unless ( (Auth::user()->tipo === 'director_unidad') && (Auth::user()->unidad_id != 2) )
                                 <th>Necropsias</th> 
                              @endunless
                              <th>Estudios</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td class="td-total">TOTAL</td>
                              <td class="td-total-cantidad">{{$peticiones->count()}}</td>
                              <td class="td-total-cantidad">{{$peticiones->where('fecha_sistema',$fecha_inicio)->whereIn('estado',['atendida','entregada'])->count() + $rezagos->count()}}</td>
                              {{--<td class="td-total-cantidad">{{$peticiones->whereIn('estado',['atendida','entregada'])->count()}}</td>--}}
                              <td class="td-total-cantidad">{{$peticiones->where('fecha_sistema','!=',$fecha_inicio)->count()}}</td> {{-- total pendientes --}}
                              <td class="td-total-cantidad">{{$peticiones->where('fecha_sistema',$fecha_inicio)->where('documento_emitido','dictamen')->count() + $rezagos->where('documento_emitido','dictamen')->count()}}</td> {{-- total dictamen --}}
                              <td class="td-total-cantidad">{{$peticiones->where('fecha_sistema',$fecha_inicio)->where('documento_emitido','informe')->count()  + $rezagos->where('documento_emitido','informe')->count()}}</td>  {{-- total informe --}}
                              <td class="td-total-cantidad">{{$peticiones->where('fecha_sistema',$fecha_inicio)->where('documento_emitido','certificado')->count() + $rezagos->where('documento_emitido','certificado')->count()}}</td> {{-- certificado --}}
                              <td class="td-total-cantidad">{{$peticiones->where('fecha_sistema',$fecha_inicio)->where('documento_emitido','salida_juzgado')->count() + $rezagos->where('documento_emitido','salida_juzgado')->count()}}</td> {{-- salida_juzgado --}}
                              <td class="td-total-cantidad">{{$peticiones->where('fecha_sistema',$fecha_inicio)->where('documento_emitido','archivo')->count() + $rezagos->where('documento_emitido','archivo')->count()}}</td> {{-- archivo --}}
                              @unless ( (Auth::user()->tipo === 'director_unidad') && (Auth::user()->unidad_id != 2) )
                                 <td class="td-total-cantidad">{{$peticiones->where('necropsia_id','!=',NULL)->count() + $rezagos->where('necropsia_id','!=',NULL)->count()}}</td>
                              @endunless
                              <td class="td-total-cantidad">{{$peticiones->where('fecha_sistema',$fecha_inicio)->sum('cantidad_estudios') + $rezagos->sum('cantidad_estudios')}}</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="collapsible-body">
                     {{--peticione de fecha de hoy--}}
                     <table>
                        <thead>
                           <tr>
                              <th>Tipo peticiones</th>
                              <th>Cantidad</th>
                              <th>Atendidas</th>
                              <th>Pendientes</th>
                              <th>Dictamenes</th>
                              <th>Informes</th>
                              <th>Certificados</th>
                              <th>Salida Juzgado</th>
                              <th>Archivo</th>
                              @unless ( (Auth::user()->tipo === 'director_unidad') && (Auth::user()->unidad_id != 2) )
                                 <th>Necropsias</th> 
                              @endunless
                              <th>Estudios</th>
                           </tr>
                        </thead>
                        <tbody>
                        
                           <tr>
                           
                              <td class="td-total">Peticiones {{$fecha_inicio}}</td>
                              <td class="">{{$peticiones->count()}}</td>
                              <td class="">{{$peticiones->where('fecha_sistema',$fecha_inicio)->whereIn('estado',['atendida','entregada'])->count()}}</td>
                           
                              <td class="">{{$peticiones->where('fecha_sistema','!=',$fecha_inicio)->count()}}</td> 
                              <td class="">{{$peticiones->where('fecha_sistema',$fecha_inicio)->where('documento_emitido','dictamen')->count() }}</td>
                              <td class="">{{$peticiones->where('fecha_sistema',$fecha_inicio)->where('documento_emitido','informe')->count() }}</td> 
                              <td class="">{{$peticiones->where('fecha_sistema',$fecha_inicio)->where('documento_emitido','certificado')->count()}}</td>
                              <td class="">{{$peticiones->where('fecha_sistema',$fecha_inicio)->where('documento_emitido','salida_juzgado')->count() }}</td>
                              <td class="">{{$peticiones->where('fecha_sistema',$fecha_inicio)->where('documento_emitido','archivo')->count() }}</td>
                              @unless ( (Auth::user()->tipo === 'director_unidad') && (Auth::user()->unidad_id != 2) )
                                 <td class="">{{$peticiones->where('necropsia_id','!=',NULL)->count()}}</td>
                              @endunless
                              <td class="">{{$peticiones->where('fecha_sistema',$fecha_inicio)->sum('cantidad_estudios')}}</td>
                           </tr>
                        </tbody>
                     </table>
                     {{--peticione trabajadas de fechas anteriores--}}
                     <table>
                        <thead>
                           <tr>
                              <th>Tipo peticiones</th>
                              <th>Cantidad</th>
                              <th>Atendidas</th>
                              <th>Pendientes</th>
                              <th>Dictamenes</th>
                              <th>Informes</th>
                              <th>Certificados</th>
                              <th>Salida Juzgado</th>
                              <th>Archivo</th>
                              @unless ( (Auth::user()->tipo === 'director_unidad') && (Auth::user()->unidad_id != 2) )
                                 <th>Necropsias</th> 
                              @endunless
                              <th>Estudios</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td class="td-total">Peticion atendidas de (Rezago) TOTAL</td>
                              <td class="">0</td>
                              <td class="">{{$rezagos->count()}}</td>
                              <td class="">0</td>
                              <td class="">{{$rezagos->where('documento_emitido','dictamen')->count()}}</td>
                              <td class="">{{$rezagos->where('documento_emitido','informe')->count()}}</td>
                              <td class="">{{$rezagos->where('documento_emitido','certificado')->count()}}</td>
                              <td class="">{{$rezagos->where('documento_emitido','salida_juzgado')->count()}}</td>
                              <td class="">{{$rezagos->where('documento_emitido','archivo')->count()}}</td>
                              @unless ( (Auth::user()->tipo === 'director_unidad') && (Auth::user()->unidad_id != 2) )
                                 <td class="">{{$rezagos->where('necropsia_id','!=',NULL)->count()}}</td>
                              @endunless
                              <td class="">{{$rezagos->sum('cantidad_estudios')}}</td>
                           </tr>
                        </tbody>
                     </table>
                     <!--colectivos-->
                     {{-- <table>
                        <thead>
                           <tr>
                              <th>Tipo peticiones</th>
                              <th>Cantidad</th>
                              <th>Tarjetiva informtiva</th>
                              <th>Estudios</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td class="td-total">Colectivos</td>
                              <td class="">{{$colectivos->count()}}</td>
                              <td>{{$colectivos->where('documento_emitido','tarjeta_informativa')->count()}}</td>
                              <td class=""> {{ $colectivos->sum(function ($colectivo) { return $colectivo->pruebas->sum('pivot.cantidad_estudios'); }) }} </td>
                           </tr>
                        </tbody>
                     </table> --}}
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </section>

   <div class="row">
      <div class="col s12">
         <table id="tabla-peticion-dia" class="highlight bordered">
            <thead>
               <tr>
               <th class="th-center">No.</th>
               <th>REGISTRADO A LAS</th>
               <th>N.U.C.</th>
               <th class="th-center">VER REGISTRO</th>
               <th>PERITO</th>
               <th>ESPECIALIDAD</th>
               <th>SOLICITUD</th>
               {{-- <th>FECHA PETICIÓN</th> --}}
               <th>FECHA RECEPCIÓN</th>
               <th>FECHA ELABORACIÓN</th>
               <th>DOCUMENTO EMITIDO</th>
               <th>ESTUDIOS</th>
               
               {{-- <th style="text-align:left;">NÚMERO OFICIO</th> --}}
               @if (Auth::user()->tipo === 'director_fiscalia')
                  <th>UNIDAD</th>  
               @endif
                  <th>ESTADO</th>
               </tr>
            </thead>
            <tbody>
               @php
               $no_consecutivo = 1;
               @endphp
               @forelse ($peticiones as $peticion)
                  <tr>
                     <!--Contador-->
                     <td style="width:3%; padding-left:0 !important;" class="td-contador">{{$no_consecutivo++}}</td>
                     <!--fecha de regitro en sistema-->
                     <td style="width:7%;">{{date('H:i:s d-m-Y',strtotime($peticion->created_at))}}</td>
                     <!--nuc-->
                     <td style="width:10%;">{{$peticion->nuc}}</td>
                     <!--informacion peticion-->
                     <td class="td-center" style="width:5%;">
                        <a href="" class="peticion-info" data-peticion-id={{$peticion->id}}>
                           <i class="fas fa-eye i-btn"></i>
                        </a>
                     </td>
                     <!--perito-->
                     <td style="width:13%;">{{$peticion->user->name}}</td>
                     <!--especialidad-->
                     <td style="width:10%;">{{$peticion->solicitud->especialidad->nombre}}</td>
                     <!--solicitud-->
                     <td style="width:20%;">{{$peticion->solicitud->nombre}}</td>
                     <!--fecha_recepcion-->
                     <td>{{date('d-m-Y',strtotime($peticion->fecha_recepcion))}}</td>
                     <!--Determinando si esta atendida o entregada en el día en que se registro la peticion-->
                     @if ($peticion->fecha_sistema == date('Y-m-d', strtotime($peticion->created_at)))
                        <td>{{date('d-m-Y',strtotime($peticion->fecha_elaboracion))}}</td>
                        <td>{{strtoupper($peticion->documento_emitido)}}</td>
                        <td>{{$peticion->cantidad_estudios}}</td>
                     @else
                        <td>------</td>
                        <td>------</td>
                        <td>------</td>
                     @endif
                     <!--unidad-->
                     @if (Auth::user()->tipo === 'director_fiscalia')
                        <td>{{$peticion->unidad->nombre}}</td>  
                     @endif
                     <!--estado-->
                     @if ($peticion->fecha_sistema == date('Y-m-d', strtotime($peticion->created_at)))            
                        <td>{{ strtoupper($peticion->estado) }}</td>
                     @else
                        <td>PENDIENTE</td>
                     @endif
                  </tr>
               @empty
                  <tr>
                     <td colspan="13">NO HAY COINCIDENCIAS</td>
                  </tr>   
               @endforelse
            </tbody>
         </table>
      </div>
   </div>

 {{-- rezago atendido --}}
   <div class="row">
      <div class="col s12">
         <table class="highlight bordered">
            <caption><b>PETICIONES ATENDIDAS DE (REZAGO)</b></caption>
            <thead>
               <tr>
                  <th class="th-center">No.</th>
                  <th>REGISTRADO A LAS</th>
                  <th>N.U.C.</th>
                  <th class="th-center">VER REGISTRO</th>
                  <th>PERITO</th>
                  <th>ESPECIALIDAD</th>
                  <th>SOLICITUD</th>
                  {{-- <th>FECHA PETICIÓN</th> --}}
                  <th>FECHA RECEPCIÓN</th>
                  <th>FECHA ELABORACIÓN</th>
                  <th>DOCUMENTO EMITIDO</th>
                  <th>ESTUDIOS</th>
                  
                  {{-- <th style="text-align:left;">NÚMERO OFICIO</th> --}}
                  @if (Auth::user()->tipo === 'director_fiscalia')
                     <th>UNIDAD</th>  
                  @endif
                     <th>ESTADO</th>
               </tr>
            </thead>
            <tbody>
               @php
               $no_consecutivo = 1;
               @endphp
               @forelse ($rezagos as $rezago)
                  <tr data-id="{{$rezago->id}}">
                     <!--Contador-->
                     <td style="width:3%; padding-left:0 !important;" class="td-contador">{{$no_consecutivo++}}</td>
                     <!--fecha de regitro en sistema-->
                     <td style="width:7%;">{{date('H:i:s d-m-Y',strtotime($rezago->created_at))}}</td>
                     <!--nuc-->
                     <td style="width:10%;">{{$rezago->nuc}}</td>
                     <!--informacion peticion-->
                     <td style="width:5%; text-align:center; padding-left:0 !important;">
                        <a href="" class="peticion-info" data-peticion-id={{$rezago->id}}>
                           <i class="fas fa-eye i-btn"></i>
                        </a>
                     </td>
                     <!--perito-->
                     <td style="width: 13%;">{{$rezago->user->name}}</td>
                     <!--especialidad-->
                     <td style="width:10%;">{{$rezago->solicitud->especialidad->nombre}}</td>
                     <!--solicitud-->
                     <td style="width:20%;">{{$rezago->solicitud->nombre}}</td>
                     {{--fecha_recepcion--}}
                     <td>{{date('d-m-Y',strtotime($rezago->fecha_recepcion))}}</td>


                     <td>{{date('d-m-Y',strtotime($rezago->fecha_elaboracion))}}</td>
                     <td>{{$rezago->documento_emitido}}</td>
                     <td>{{$rezago->cantidad_estudios}}</td>
            
                     @if (Auth::user()->tipo === 'director_fiscalia')
                        <td style="text-align:left;">{{$rezago->unidad->nombre}}</td>  
                     @endif
                     <td style="text-align:left;">{{ strtoupper($rezago->estado) }}</td>
                  </tr>
               @empty
                  <tr>
                     <td colspan="13">NO HAY COINCIDENCIAS</td>
                  </tr>
               @endforelse
            </tbody>
         </table>
      </div>
   </div>

   {{-- @if (AutH::user()->unidad_id == 1)
      <!--colectivos-->
      <div class="row">
         <div class="col s12">
            <table class="highlight bordered">
               <caption><b>COLECTIVOS</b></caption>
               <thead>
                  <tr>
                     <th class="th-center">No.</th>
                     <th>REGISTRADO A LAS</th>
                     <th>FOLIO</th>
                     <th>NOMBRE CIUDADANO</th>
                     <th>FECHA DE TOMA DE MUESTRA</th>
                     <th>TIPO DE MUESTRA</th>
                     <th>CANTIDAD DE ESTUDIOS</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($colectivos->sortBy('created_at')->values() as $i => $colectivo)
                  @php $filas = $colectivo->pruebas->count(); @endphp
                  <tr>
                     <td rowspan="{{$filas}}" width="2%" class="td-contador">{{$i+1}}</td>
                     <td rowspan="{{$filas}}" width="10%">{{date('H:i:s ~ d-m-Y',strtotime($colectivo->created_at))}}</td>
                     <td rowspan="{{$filas}}" width="6%">{{$colectivo->colectivo_folio}}</td>
                     
                     <td rowspan="{{$filas}}" width="20%">{{$colectivo->colectivo_persona}}</td>
                     <td rowspan="{{$filas}}" width="10%">{{($colectivo->colectivo_fecha)}}</td>
                     @foreach ($colectivo->pruebas->sortBy('nombre') as $prueba)
                        @if ($loop->iteration > 1)
                           <tr>
                        @endif
                        <td width="20%">{{$prueba->nombre}}</td>
                        <td width="8%">{{$prueba->pivot->cantidad_estudios}}</td>
                        
                     </tr>
                     @endforeach
               @empty
                  <tr><td colspan="9">No hay nada :(</td></tr>
               @endforelse
               </tbody>
            </table>
         </div>
      </div>
   @endif --}}


   <!-- Modal Structure -->
  <div id="modal-registro" class="modal bottom-sheet">
      <div class="modal-content">
        <h4>Modal Header</h4>
        <p>A bunch of text</p>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"><i style="color:red;" class="fas fa-times"></i></a>
      </div>
    </div>

<!-- Modal Info -->
<div id="modal-peticion-informacion" class="modal">
   <div class="modal-content">
   </div>
</div>


@endsection

@section('js')
   <script type="text/javascript">
      $('.li-registrar-cadena').removeClass('active');
      $('.li-consultar-cadena').addClass('active');
      $('.a-disabled').bind('click', false);
   </script>  
   <script type="text/javascript" src="{{asset('js/peticiones/peticion_diaria.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/peticiones/solicitudes.js')}}" ></script>
   <script src="{{asset('js/get_tablas/get_unidades.js')}}"></script>
   <script src="{{asset('/js/peticiones/peticion_informacion.js')}}"></script>


@endsection
