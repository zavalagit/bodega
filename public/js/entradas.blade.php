{{-- {{dd('vista')}} --}}
@extends('plantilla.template')

{{--item menu selected--}}
@section('nombre_pagina','vista-entradas')
    
@section('css')
   <link rel="stylesheet" href="{{asset('css/entrada/columna_fija.css')}}">
   <link rel="stylesheet" href="{{asset('css/modal/modal.css')}}">
   <link rel="stylesheet" href="{{asset('css/entrada/modal_acciones.css')}}">
   <link rel="stylesheet" href="{{asset('css/entrada/modal_observacion.css')}}">
   <link rel="stylesheet" href="{{asset('css/entrada/modal_inhabilitar_cadena.css')}}">
   <link rel="stylesheet" href="{{asset('css/colores.css')}}">
   <link rel="stylesheet" href="{{asset('css/tablas.css')}}">

   <style media="screen">
      *{ 
         box-sizing: border-box !important;
      }
      body{
         overflow-x: hidden;
      }
      .row{
         margin: 0 !important;
         padding: 0 !important;
      }
      #tabla-entradas{
         width: 5000px !important;
      }
   </style>
@endsection

@section('titulo')
   ENTRADAS
@endsection
@section('seccion', 'ENTRADAS')


@section('contenido')

<div class="row">
   <div class="col s12 m12 l12 right-align" {{--style="padding-right: 0px !important;"--}}>
      {{-- <button class="btn-guardar-ic" type="submit" name="btn" value="buscar"><i class="fas fa-search i-buscar"></i></button> --}}
      <a class="modal-trigger a-btn pulse z-depth-2" href="#modal-buscar">
         <i class="fas fa-search fa-lg"></i> {{--<span><b>Buscar...</b></span>--}} 
      </a>
   </div>
</div>

<!--div busqueda-->
   {{-- <div class="row">
         <form class="col s12" autocomplete="off">
            <div class="row">
               <!--Si administrador-->
               @if (Auth::user()->tipo == 'administrador')
                  <div class="input-field col s2">
                     <select name="buscar_region">
                        <option value="0" disabled selected>---</option>
                        @foreach ($regiones->sortBy('nombre')->values() as $i => $region)
                              <option value="{{$region->id}}" {{ ($region->id == $buscar_region) ? 'selected' : '' }}>{{$i+1}}. {{$region->nombre}}</option>
                        @endforeach
                     </select>
                     <label>REGIÓN</label>
                  </div>
               @endif
               <div class="input-field col s2">
                  <select name="buscar_naturaleza">
                     <option value="0">---</option>
                     @foreach ($naturalezas as $naturaleza)
                        @if ($buscar_naturaleza == $naturaleza->id)
                           <option value="{{$naturaleza->id}}" selected>{{$naturaleza->nombre}}</option>
                        @else
                           <option value="{{$naturaleza->id}}">{{$naturaleza->nombre}}</option>
                        @endif
                     @endforeach
                  </select>
                  <label>NATURALEZA</label>
               </div>
               <div class="input-field col s2">
                  @isset($buscar_fecha_inicio)
                     <input id="fecha-inicio" type="date" name="buscar_fecha_inicio" value="{{$buscar_fecha_inicio}}">
                  @endisset
                  @empty($buscar_fecha_inicio)
                     <input id="fecha-inicio" type="date" name="buscar_fecha_inicio">
                  @endempty
                  <label class="active" for="fecha-inicio">FECHA INICIO</label>
               </div>
               <div class="input-field col s2">
                  @isset($buscar_fecha_fin)
                     <input id="fecha-fin" type="date" name="buscar_fecha_fin" value="{{$buscar_fecha_fin}}">
                  @endisset
                  @empty($buscar_fecha_fin)
                     <input id="fecha-fin" type="date" name="buscar_fecha_fin">
                  @endempty
                  <label class="active" for="fecha-fin">FECHA FIN</label>
               </div>
               
               <div class="input-field col s4" id="input-buscar">
                  @isset($buscar_texto)
                     <input type="text" id="buscar-texto" name="buscar_texto" value="{{$buscar_texto}}">
                  @endisset
                  @empty($buscar_texto)
                     <input type="text" id="buscar-texto" placeholder="Buscar... Folio, N.U.C., descripción" name="buscar_texto">
                  @endempty
               </div>

               <div class="input-field col s2">
                  <button class="btn-guardar-ic" type="submit" name="btn" value="buscar"><i class="fas fa-search i-buscar"></i></button>
               </div>
               <div class="input-field col s2">
                  <button class="btn-guardar-ic" type="submit" formtarget="_blank" name="btn" value="otro"><i class="fas fa-arrow-alt-circle-up"></i></button>
               </div>

            </div>
         </form>
   </div> --}}
<!--div busqueda-->

<!--cantidad registros-->
   <div class="row"">
      <div class="col s12 m4 l2 offset-m8 offset-l10" style="padding-right: 0 !important;">
         <h6 style="padding: 5px 20px; background-color: #304049; color: #c09f77; font-weight:bold; border-radius: 15px 0 0 15px;">{{($cadenas->count() == 1) ? "{$cadenas->count()} REGISTRO" : "{$cadenas->count()} REGISTROS"}}</h6>
      </div>
   </div>
<!--cantidad registros-->

   <div class="contenedor-tabla">
      <table id="tabla-entradas" class="highlight">
         <thead>
            <tr>
               <th class="sticky-1 th-center">Nº</th>
               <th class="sticky-2 th-center">ACCIÓN</th>
               <th class="sticky-3">FOLIO</th>
               <th>ESTADO</th>
               <th>N.U.C.</th>
               @if (Auth::user()->tipo == 'administrador')
               <th>ID CADENA</th>
               <th>REGIÓN</th>
               <th>SISTEMA</th>
               <th>S. P. REALIZA</th>
               @endif
               <th>HORA</th>
               <th>FECHA</th>
               <th>NATURALEZA</th>
               <th>ENTREGA</th>
               <th>RECIBE</th>
			   @if (Auth::user()->tipo == 'administrador')
			   <th>ID_INDICIO</th>
			   @endif
               <th>IDENTIFICADOR</th>
               <th>DESCRIPCIÓN</th>
               <th>CANTIDAD I/E</th>
               <th>RESGUARDO</th>
            </tr>
         </thead>
         <tbody>
            @php $n = 1; @endphp
            @forelse ($cadenas as $key => $cadena)
               <!--contador-->
               <td rowspan="{{$cadena->indicios->count()}}" class="sticky-1 td-contador"><b>{{$n++}}</b></td>
               <!--acción-->
               <td rowspan="{{$cadena->indicios->count()}}" class="sticky-2 td-center">
                  <a href="" class="btn-acciones" data-cadena-folio="{{$cadena->folio_bodega}}" data-cadena-id="{{$cadena->id}}">
                     <i style="color: #152f4a;" class="fas fa-ellipsis-h fa-lg"></i>
                  </a>
               </td>
               <!--folio-->
               @isset($cadena->entrada)
                  <td rowspan="{{$cadena->indicios->count()}}" class="sticky-3"><b>{{$cadena->folio_bodega}}</b></td> 
               @endisset
               @empty($cadena->entrada)
                  <td rowspan="{{$cadena->indicios->count()}}" class="sticky-3"><b>---</b></td> 
               @endempty
               <!--estado-->
               <td rowspan="{{$cadena->indicios->count()}}" style="width: 150px; background-color:#394049;">
                  @php $estado = true; @endphp
                  <!--estados de la cadena-->
                  @if (Auth::user()->tipo == 'administrador')    
                     @if ($cadena->estado == 'revision')
                        @php $estado = false; @endphp
                        <i style="color: #fff;" class="fas fa-square cadena-estado-revision"></i> 
                     @elseif ($cadena->estado == 'espera')
                        @php $estado = false; @endphp
                        <i style="color: #ffff00;" class="fas fa-square cadena-estado-espera"></i> 
                     @elseif ($cadena->estado == 'rechazada')
                        @php $estado = false; @endphp
                        <i style="color: #dd2c00;" class="fas fa-square cadena-estado-rechazada"></i> 
                     @elseif ($cadena->estado == 'bloqueada')
                        @php $estado = false; @endphp
                        <i style="color: #000;" class="fas fa-square cadena-estado-bloqueada"></i> 
                     @endif
                  @endif
                  <!--estados de la entrada-->
                  @if ( ($cadena->editar == 'si') && ($cadena->estado == 'validada' ) )
                     @php $estado = false; @endphp
                     <a href="" class="btn-inhabilitar" data-cadena-folio="{{$cadena->folio_bodega}}" data-cadena-id="{{$cadena->id}}">
                        <i style="color: #ff9800;" class="fas fa-square cadena-estado-editar"></i>
                     </a>
                  @endif
                  @if ($cadena->bajas->count())
                     @php $estado = false; @endphp
                     <i style="color: red;" class="fas fa-square cadena-estado-baja"></i>
                  @endif
                  @if ($cadena->prestamos->count() && ($cadena->prestamos->last()->estado == 'activo'))
                     @php $estado = false; @endphp
                     <i style="color: #42a5f5;" class="fas fa-square cadena-estado-prestamo"></i>
                  @endif
                  @if ($estado)
                     <i style="color: #76ff03;" class="fas fa-square cadena-estado-activo"></i>
                  @endif
                  @isset($cadena->entrada)
                     @if($cadena->entrada->observacion != '')
                        <a href="" class="btn-observacion" data-cadena-folio="{{$cadena->folio_bodega}}" data-cadena-observacion="{{$cadena->entrada->observacion}}">
                           <i style="color: #b388ff;" class="fas fa-square cadena-estado-observacion"></i>
                        </a>
                     @endif
                  @endisset
               </td>
               <!--nuc-->
               <td rowspan="{{$cadena->indicios->count()}}" width="300px" style="background-color: #394049;color: #c6c6c6 !important;"><b>{{$cadena->nuc}}</b></td>
               <!--campos de admistrador-->
               @if (Auth::user()->tipo == 'administrador')
               <td rowspan="{{$cadena->indicios->count()}}" width="120px">{{$cadena->id}}</td>
               <td rowspan="{{$cadena->indicios->count()}}" width="150px">{{$cadena->fiscalia->nombre}}</td>
               <td rowspan="{{$cadena->indicios->count()}}" width="80px">{{ ( isset($cadena->user_id) ) ? 'Si' : 'No'}}</td>
               <td rowspan="{{$cadena->indicios->count()}}" width="400px">{{ ( isset($cadena->user_id) ) ? "{$cadena->user->name}" : '---'}}</td>
               @endif
               <!--datos entrada-->
               @isset($cadena->entrada)
                  <!--hora-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="120px">{{date('H:i:s',strtotime($cadena->entrada->hora))}}</td>
                  <!--fecha-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="120px">{{date('d-m-Y',strtotime($cadena->entrada->fecha))}}</td>
                  <!--naturaleza-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="200px">{{$cadena->entrada->naturaleza->nombre}}</td>
                  <!--perito entrega-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="400px">{{$cadena->entrada->perito->nombre}}</td>
                  <!--rb recibe-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="400px">{{$cadena->entrada->user->name}}</td>
               @endisset
               @empty($cadena->entrada)
                  <!--hora-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="120px">---</td>
                  <!--fecha-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="120px">---</td>
                  <!--naturaleza-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="200px">---</td>
                  <!--perito entrega-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="400px">---</td>
                  <!--rb recibe-->
                  <td rowspan="{{$cadena->indicios->count()}}" width="400px">---</td 
               @endempty
               <!--indicios-->   
               @foreach ($cadena->indicios as $indicio)
                     @if ($loop->iteration > 1)
                        <tr>    
                     @endif
						@if (Auth::user()->tipo == 'administrador')
						<td>{{$indicio->id}}</td>
						@endif
					 
                        @if ($indicio->estado === 'activo')
                           <td width="200px" style="border: 1px solid #c09f77; border-left: 1px solid #c09f77;">{{$indicio->identificador}}</td>
                           <td style="text-align:justify; border: 1px solid #c09f77;">{{$indicio->descripcion}}</td>
                        @elseif($indicio->estado === 'prestamo')
                           <td class="blue lighten-4" width="200px" style="border: 1px solid #c09f77; border-left: 1px solid #c09f77;">{{$indicio->identificador}}</td>
                           <td class="blue lighten-4" style="text-align:justify; border: 1px solid #c09f77;">{{$indicio->descripcion}}</td>
                        @elseif($indicio->estado === 'baja')
                           <td class="red lighten-4" width="200px" style="border: 1px solid #c09f77; border-left: 1px solid #c09f77;">{{$indicio->identificador}}</td>
                           <td class="red lighten-4" style="text-align:justify; border: 1px solid #c09f77;">{{$indicio->descripcion}}</td>
                        @endif

                        <td class="td-center" width="130px">{{$indicio->numero_indicios}}</td>

                        <td width="500px" style="padding-left: 5px !important;">
                           @isset($indicio->ubicacion_id)
                              {{$indicio->ubicacion->nombre}}
                           @endisset
                           @empty($indicio->ubicacion_id)
                              No hay ubicación
                           @endempty
                        </td>
                  </tr>
               @endforeach
            @empty
               <tr>
                  <td colspan="11">
                     <blockquote class="yellow lighten-2">No hay registros</blockquote>
                  </td>
               </tr> 
            @endforelse
         </tbody>
      </table>
   </div>

<!--Modal buscar-->
<div id="modal-buscar" class="modal modal-buscar">
   <div class="modal-cerrar right-align">
      <a href="#" class="btn-modal-cerrar"><i class="fas fa-window-close fa-lg" style="color:#d50000"></i></a>
   </div>
   <div class="row">
      <div id="modal-header" class="col s12 modal-buscar-header">
         <p class="header-titulo header-folio"><i class="fas fa-search fa-sm"></i> Buscar...</p>
         {{-- <p class="header-titulo">buscar</p> --}}
      </div>
   </div>
   <div id="modal-body" class="row modal-buscar-body"> 
      <div id="modal-contenido" class="row" style="padding:10px 0 !important;">
         <form class="col s12" autocomplete="off">
            <div class="row">
               <div class="input-field col s12" id="input-buscar">
                  @isset($buscar_texto)
                     <input type="text" id="buscar-texto" name="buscar_texto" value="{{$buscar_texto}}">
                  @endisset
                  @empty($buscar_texto)
                     <input type="text" id="buscar-texto" placeholder="Buscar... Folio, N.U.C., descripción" name="buscar_texto">
                  @endempty
               </div>
               <div class="input-field col s12">
                  @isset($buscar_fecha_inicio)
                     <input id="fecha-inicio" type="date" name="buscar_fecha_inicio" value="{{$buscar_fecha_inicio}}">
                  @endisset
                  @empty($buscar_fecha_inicio)
                     <input id="fecha-inicio" type="date" name="buscar_fecha_inicio">
                  @endempty
                  <label class="active" for="fecha-inicio">FECHA INICIO</label>
               </div>
               <div class="input-field col s12">
                  @isset($buscar_fecha_fin)
                     <input id="fecha-fin" type="date" name="buscar_fecha_fin" value="{{$buscar_fecha_fin}}">
                  @endisset
                  @empty($buscar_fecha_fin)
                     <input id="fecha-fin" type="date" name="buscar_fecha_fin">
                  @endempty
                  <label class="active" for="fecha-fin">FECHA FIN</label>
               </div>
               <div class="input-field col s12">
                  <select name="buscar_naturaleza">
                     <option value="0">---</option>
                     @foreach ($naturalezas as $naturaleza)
                        @if ($buscar_naturaleza == $naturaleza->id)
                           <option value="{{$naturaleza->id}}" selected>{{$naturaleza->nombre}}</option>
                        @else
                           <option value="{{$naturaleza->id}}">{{$naturaleza->nombre}}</option>
                        @endif
                     @endforeach
                  </select>
                  <label>NATURALEZA</label>
               </div>
               <!--Si administrador-->
               @if (Auth::user()->tipo == 'administrador')
                  <div class="input-field col s12">
                     <select name="buscar_region">
                        <option value="0" disabled selected>---</option>
                        @foreach ($regiones->sortBy('nombre')->values() as $i => $region)
                              <option value="{{$region->id}}" {{ ($region->id == $buscar_region) ? 'selected' : '' }}>{{$i+1}}. {{$region->nombre}}</option>
                        @endforeach
                     </select>
                     <label>REGIÓN</label>
                  </div>
               @endif
               <div class="col s12" style="margin-bottom: 20px;">
                  <input type="checkbox" class="filled-in" id="prestamo-multiple" name="prestamo_multiple" value="prestamo_multiple"/>
                  <label for="prestamo-multiple" style="color: #152f4a !important;">Prestamo multiple</label>
               </div>

               <div class="col s12">
                  <hr class="hr-main">
               </div>

               <div class="input-field col s12">
                  <button class="btn-guardar" id="btn-buscar" style="display: inline-block !important; width:100%;" type="submit" name="btn" value="buscar">Buscar</button>
               </div>
            </div>
         </form>
      </div>
   </div>
   <div id="modal-footer" class="modal-buscar-footer">
      {{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a> --}}
   </div>
</div>
<!--Modal acciones-->
<div id="modal-acciones" class="modal">
   <div class="modal-cerrar right-align">
      <a href="#" class="btn-modal-cerrar"><i class="fas fa-window-close fa-lg" style="color:#d50000"></i></a>
   </div>
   <div class="row">
      <div id="modal-header" class="col s12 modal-acciones-header">
         <p class="header-titulo header-folio"></p>
         <p class="header-titulo">Acciones</p>
      </div>
   </div>
   <div id="modal-body" class="row modal-acciones-body"> 
      {{-- <div style="width: 98%; padding-top: 10px; padding-bottom: 5px;" class="right-align">
         <i style="color: #394049;" class="fas fa-hammer fa-flip-horizontal fa-2x"></i>
      </div> --}}
      <div id="modal-contenido" class="row" style="padding:10px 0 !important;">

      </div>
   </div>
   <div id="modal-footer" class="modal-acciones-footer">
      {{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a> --}}
   </div>
</div>
<!--Modal inhabilitar-cadena-->
<div id="modal-inhabilitar" class="modal">
   <div class="modal-cerrar right-align">
      <a href="#" class="btn-modal-cerrar"><i class="fas fa-window-close fa-lg" style="color:#d50000"></i></a>
   </div>
   <div class="row">
      <div id="modal-header" class="col s12 modal-inhabilitar-header">
         <p class="header-titulo header-folio"></p>
         <p class="header-titulo">Inhabilitar cadena</p>
      </div>
   </div>
   <div id="modal-body" class="row modal-inhabilitar-body">
      <div style="width: 98%;" class="right-align">
         <i style="color: #394049;" class="fas fa-pen-square fa-2x"></i>
      </div>
      <div id="modal-contenido" class="row" style="margin-bottom:10px !important;">

      </div>
   </div>
   <div id="modal-footer" class="modal-inhabilitar-footer">
      {{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a> --}}
   </div>
</div>
<!--Modal observación-->
<div id="modal-observacion" class="modal">
   <div class="modal-cerrar right-align">
      <a href="#" class="btn-modal-cerrar"><i class="fas fa-window-close fa-lg" style="color:#d50000"></i></a>
   </div>
   <div class="row">
      <div id="modal-header" class="col s12 modal-observacion-header">
         <p class="header-titulo header-folio"></p>
         <p class="header-titulo">Observación - Nota</p>
      </div>
   </div>
   <div id="modal-body" class="row modal-observacion-body">
      <div style="width: 98%;" class="right-align">
         <i style="color: #394049;" class="fas fa-sticky-note fa-2x"></i>
      </div>
      <div id="modal-contenido">
         <!--observacion o nota-->
      </div>
   </div>
   <div id="modal-footer" class="modal-observacion-footer">
      {{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a> --}}
   </div>
</div>


@endsection

@section('js')
<script src="{{asset('js/busqueda.js')}}"></script>
<script src="{{asset('js/modal/modal.js')}}"></script>
<script src="{{asset('js/cadenas/cadena_accion.js')}}"></script>
<script src="{{asset('js/cadenas/cadena_estado.js')}}"></script>
<script src="{{asset('js/cadenas/cadena_inhabilitar.js')}}"></script>
<script src="{{asset('js/cadenas/cadena_reset.js')}}"></script>
<script src="{{asset('js/cadenas/cadena_observacion.js')}}"></script>
<script src="{{asset('js/prestamo/prestamo_multiple_blank.js')}}"></script>

   

   <script>
      var texto = $('#buscar-texto').val();
       if(texto != ''){
         console.log('entro:' + texto);
         $('td').mark(texto,{
         "separateWordSearch": false,
         });
      }
   </script>

@endsection
