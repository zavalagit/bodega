{{-- {{dd('vista')}} --}}
@extends('plantilla.template')

{{--item menu selected  ayuda a atener selecionado y extendido --}}
,'vista-arma-consultar')
@section('nombre_submenu','submenu-armas')

    
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
   VISTA ARMAS
@endsection
@section('seccion', 'LISTADO ARMAS')


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
   <div class="row">
      <div class="col s12 m4 l2 offset-m8 offset-l10" style="padding-right: 0 !important;">
         <h6 style="padding: 5px 20px; background-color: #304049; color: #c09f77; font-weight:bold; border-radius: 15px 0 0 15px;">{{($armas->count() == 1) ? "{$armas->count()} REGISTRO" : "{$armas->count()} REGISTROS"}}</h6>
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
               <th>N.U.C.</th>
               <th>ESTADO</th>
               
               <th>DESCRIPCIÓN</th>
               <th>CLASIFICACION</th>
               <th>TIPO</th>               
               <th>FABRICANTE (MARCA)</th>
               <th>MODELO</th>
               <th>SERIE</th>
               
               {{-- <th class="th-center">INDICIO RELACIONADO</th> --}}
               
               <th>CALIBRE</th>
               <th>PAIS</th>
               <th>IMPORTADOR</th>
               
            
               
              
               <th>DOMICILIO</th>
               <th>OBSERVACION</th>

               
            </tr>
         </thead>
         <tbody>
            @php $n = 1; @endphp
      @forelse ($armas as $key => $arma)
            <tr>
         <!--contador-->
               <td class="sticky-1 td-contador"><b>{{$n++}}</b></td>
         <!--acción-->
               <td class="sticky-2 td-center">
                  <a href="" class="btn-acciones" data-arma-id="{{$arma->id}}">
                     <i style="color: #152f4a;" class="fas fa-ellipsis-h fa-lg"></i>
                  </a>
               </td>
         <!--folio-->
               <td class="sticky-3"><b>{{$arma->indicio->cadena->folio_bodega}}</b></td>
         <!--nuc-->
               <td class="sticky-3"><b>{{$arma->indicio->cadena->nuc}}</b></td>
         <!--estado-->
               <td style="width: 100px; background-color:#394049;">
                  @php $estado = true; @endphp
         <!--estados del arma referente al indicio-->
                    
                     @if ($arma->indicio->estado == 'activo')
                        @php $estado = false; @endphp
                        <i style="color: #76ff03;" class="fas fa-square indicio-activo"></i> 
                     @elseif ($arma->indicio->estado == 'prestamo')
                        @php $estado = false; @endphp
                        <i style="color: #c09f77;" class="fas fa-square indicio-prestamo"></i> 
                     @elseif ($arma->indicio->estado == 'baja')
                        @php $estado = false; @endphp
                        <i style="color: #dd2c00;" class="fas fa-square indicio-baja"></i> 
                     @elseif ($arma->indicio->estado == 'bloqueado')
                        @php $estado = false; @endphp
                        <i style="color: #000;" class="fas fa-square indicio-bloqueada"></i> 
                     @endif
                  
         
               </td>
         <!--descripcion-->
         <td>{{$arma->indicio->identificador}}: {{$arma->indicio->descripcion}}</td>
         <!--clasificacion-->
         <td style="width: 150px;" ><b>{{  $arma->clasificacion }}</b></td>
         <!--arma_tipo-->
         <td style="width: 150px;" ><b>{{  $arma->tipo }}</b></td>
         <!--fabricante-->      
         <td style="width: 150px;" >{{ $arma->fabricante }}</td>          
         <!--modelo-->
         <td style="width: 100px;" >{{ $arma->modelo }}</td>
         <!--serie-->
         <td style="width: 150px;">{{ $arma->serie }}</td>
        
           
         <!--indicio aqui podras ver la inforacion del indicio-->      
                     {{-- <td class="td-center" style="width: 100px; background-color:#152f4a;">
                        <a class="a-btn btn-relacion-indicio" href="" data-relacion-arma-id="{{$arma->indicio_id}}" data-indicio-estado="{{$arma->indicio->estado}}">
                           <i style="color: #eff1f3;" class="fas fa-biohazard fa-lg"></i>
                        </a>
                     </td> --}}
                
         <!--calibre-->      
                     <td style="width: 150px;">{{ $arma->calibre }}</td>
       
         <!--pais-->      
                     <td style="width: 150px;">{{ $arma->pais->nombre }}</td>
         
         <!--importador-->      
                     <td  style="width: 150px;">{{ $arma->importador }}</td>
         
         <!--domicilio-->                   
                     <td>{{ $arma->domicilio }}</td>
         
         <!--observacion-->                   
                     <td>{{ $arma->created_at }}</td>
         </tr>   
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
                     <input type="text" id="buscar-texto" placeholder="Buscar... Serie,  Calibre,   Fabricante" name="buscar_texto">
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
                  <select name="buscar_pais">
                     <option value="0">---</option>
                     @foreach ($paises as $pais)
                        @if ($buscar_pais == $pais->id)
                           <option value="{{$pais->id}}" selected>{{$pais->nombre}}</option>
                        @else
                           <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                        @endif
                     @endforeach
                  </select>
                  <label>PAIS</label>
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
               {{--  <div class="col s12" style="margin-bottom: 20px;">
                  <input type="checkbox" class="filled-in" id="prestamo-multiple" name="prestamo_multiple" value="prestamo_multiple"/>
                  <label for="prestamo-multiple" style="color: #152f4a !important;">Prestamo multiple</label>
               </div>  --}}

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
<!--Modal indicio-->
         <div id="modal-indicio" class="modal">
            <div class="modal-cerrar right-align">
               <a href="#" class="btn-modal-cerrar"><i class="fas fa-window-close fa-lg" style="color:#d50000"></i></a>
            </div>
            <div class="row">
               <div id="modal-header" class="col s12 modal-indicio-header">
                  <p class="header-subtitulo header-folio"></p>
                  <p class="header-titulo">Estado del Indicio</p>
               </div>
            </div>
            <div id="modal-body" class="row modal-indicio-body"> 
               <div id="modal-contenido" class="row" style="padding:20px 0 !important;">
                 
               </div>
            </div>
            <div id="modal-footer" class="modal-indicio-footer">
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
<script src="{{asset('js/arma/arma_accion.js')}}"></script>
<script src="{{asset('js/arma/arma_estado.js')}}"></script>
<script src="{{asset('js/arma/arma_relacion_indicio.js')}}"></script>
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