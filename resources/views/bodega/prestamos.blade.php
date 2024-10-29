@extends('bodega.plantilla')


@section('titulo','Prestamos')
@section('nombre_pagina','vista-prestamos')
@section('css')
<link rel="stylesheet" href="{{asset('css/modal/modal.css')}}">
<link rel="stylesheet" href="{{asset('css/prestamo/prestamos_columna_fija.css')}}">
<link rel="stylesheet" href="{{asset('css/colores.css')}}">
<link rel="stylesheet" href="{{asset('css/tablas.css')}}">

   <style media="screen">
   
   table{
       width: 3000px !important;
   }
   .tabla{
      margin: 0 !important;
      padding: 0 !important;
   }
   td{
      vertical-align: top !important;
   }
   .center{
      text-align: center;
   }


   .i-editar{
      color: #394049;
   }
   .i-editar:hover{
      color: #c09f77;
   }

   .i-pdf-prestamo{
      color: #394049;
   }
   .i-pdf-prestamo:hover{
      color: red;
   }
   .i-prestamo-reingreso{
      color: #394049;
   }
   .i-prestamo-reingreso:hover{
      color: #c09f77;
   }

   </style>
@endsection



@section('seccion', 'PRESTAMOS')

@section('contenido')

{{-- {{dd($request->all())}} --}}


<!--div busqueda-->
{{-- <div class="row">
   <form class="col s12" autocomplete="off">
      <div class="row">
         <div class="col s2">
            @isset($buscar_prestamo_estado)
               <p>
                  <b>Estado Prestamo:</b>
               </p>
               <p>
                  @if ($buscar_prestamo_estado === 'todo')
                     <input name="buscar_prestamo_estado" type="radio" id="todo" checked value="todo" />
                  @else
                     <input name="buscar_prestamo_estado" type="radio" id="todo" value="todo" />
                  @endif
                  <label for="todo">Todo</label>
               </p>
               <p>
                  @if ($buscar_prestamo_estado === 'activo')
                     <input name="buscar_prestamo_estado" type="radio" id="activo" checked value="activo" />
                  @else
                     <input name="buscar_prestamo_estado" type="radio" id="activo" value="activo" />
                  @endif
                  <label for="activo">Activo</label>
               </p>
               <p>
                  @if ($buscar_prestamo_estado === 'concluso')
                     <input name="buscar_prestamo_estado" type="radio" id="concluso" checked value="concluso" />
                  @else
                     <input name="buscar_prestamo_estado" type="radio" id="concluso" value="concluso" />
                  @endif
                  <label for="concluso">Concluso</label>
               </p>
            @endisset
            @empty($buscar_prestamo_estado)
               <p>
                  <b>Estado Prestamo:</b>
               </p>
               <p>
                  <input name="buscar_prestamo_estado" type="radio" id="todo" value="todo" />
                  <label for="todo">Todo</label>
               </p>
               <p>
                  <input name="buscar_prestamo_estado" type="radio" id="activo" checked value="activo" />
                  <label for="activo">Activo</label>
               </p>
               <p>
                  <input name="buscar_prestamo_estado" type="radio" id="concluso" value="concluso" />
                  <label for="concluso">Concluso</label>
               </p>
            @endempty
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
               <input type="text" id="buscar-texto" placeholder="Buscar... Folio, N.U.C., Resguardante" name="buscar_texto">
            @endempty
         </div>
         <div class="input-field col s12">
            <input type="hidden" id="perito-hidden" name="id_perito">
            <input type="text" class="autocomplete" id="autocomplete-resguardante" data-tabla="peritos" data-input-hidden="perito-hidden">
            <label for="autocomplete-resguardante">Resguardante</label>
         </div>
         <div class="col s12" style="margin-bottom: 20px;">
            <input type="checkbox" class="filled-in" id="reingreso-multiple" name="reingreso_multiple" value="reingreso_multiple"/>
            <label for="reingreso-multiple" style="color: #152f4a !important;">Reingreso multiple</label>
         </div>
         <div class="input-field col s2">
            <button class="btn-guardar-ic" type="submit" name="buscar_btn" value="buscar"><i class="fas fa-search fa-lg i-buscar"></i></button>
         </div>

      </div>
   </form>
</div> --}}


<div class="row">
   <div class="col s12 m12 l12 right-align" {{--style="padding-right: 0px !important;"--}}>
      {{-- <button class="btn-guardar-ic" type="submit" name="btn" value="buscar"><i class="fas fa-search i-buscar"></i></button> --}}
      <a class="modal-trigger a-btn pulse z-depth-2" href="#modal-buscar">
         <i class="fas fa-search fa-lg"></i> {{--<span><b>Buscar...</b></span>--}} 
      </a>
   </div>
</div>

      <div class="contenedor-tabla">
         <table class="highlight bordered" id="tabla-prestamos">
            <thead>
               <tr>
                  <th class="sticky-1 th-center">Nº</th>
                  <th class="sticky-2">FOLIO</th>
                  <th class="sticky-3">N.U.C.</th>
                  <th>ESTADO</th>
                  <th>REINGRESO</th>
                  <th>EDITAR</th>
                  <th>PDF</th>
                  <th>NO. INDICIOS</th>
                  <th>HORA SALIDA</th>
                  <th>FECHA SALIDA</th>
                  <th>AUTORIZA</th>
                  <th>RESGUARDANTE</th>
				  <th>RESGUARDANTE-UNIDAD</th>
                  <th>RB ENTREGA</th>
                  <th>DESCRIPCIÓN</th>
               </tr>
            </thead>
            <tbody>
               @isset ($prestamos)
                  @forelse ($prestamos->values() as $key => $prestamo)
                     <tr>
                        <!--numero consecutivo-->
                        <td class="sticky-1 td-contador">{{$key+1}}</td>
                        <!--FOLIO-->
                        <td class="sticky-2">
                           <b>{{$prestamo->cadena->folio_bodega}}</b>
                        </td>
                        <!--NUC-->
                        <td class="sticky-3"><b>{{$prestamo->cadena->nuc}}</b></td>
                        <!--estado-->
                        <td style="width: 5%">
                           <b>{{strtoupper($prestamo->estado)}}</b>
                        </td>
                        <!--REINGRESO-->
                        <td>
                           @if ($prestamo->estado == 'activo')
                              <a href="/bodega/prestamo-form/reingresar/{{$prestamo->cadena_id}}/{{$prestamo->id}}" target="_blank">
                                 <i class="fas fa-arrow-alt-circle-right fa-lg i-prestamo-reingreso"></i>
                              </a>
                           @elseif($prestamo->estado == 'concluso')
                              <i class="fas fa-ban fa-lg"></i>
                           @endif
                        </td>
                        <!--EDITAR-->
                        <td style="width: 3%">
                           <a href="/bodega/prestamo-form/editar/{{$prestamo->cadena_id}}/{{$prestamo->id}}" target="_blank">
                              <i class="fas fa-pen-square fa-lg i-editar"></i>
                           </a>
                        </td>
                        <!--PDF-->
                        <td style="width: 3%">
                           <a href="/bodega/prestamo-pdf/{{$prestamo->id}}" target="_blank">
                              <i class="fas fa-file-pdf fa-lg i-pdf-prestamo"></i>
                           </a>
                        </td>
                        <!--NO. INDICIOS-->
                        <td style="width: 5%">{{$prestamo->prestamo_numindicios}}</td>
                        <!--HORA SALIDA-->
                        <td style="width: 5%">{{date('H:i:s',strtotime($prestamo->prestamo_hora))}}</td>
                        <!--FECHA SALIDA-->
                        <td style="width: 5%">{{date('d-m-Y',strtotime($prestamo->prestamo_fecha))}}</td>
                        <!--AUTORIZA-->
                        <td>{{$prestamo->prestamo_ordena}}</td>
                        <!--RESGUARDANTE-->
                        <td>{{$prestamo->perito1->nombre}}</td>
						<!--RESGUARDANTE-->
                        <td>{{$prestamo->perito1->unidad->nombre}}</td>
                        <!--RB ENTREGA-->
                        <td>{{$prestamo->user1->name}}</td>
                        <!--DESCRIPCIÓN INDICIOS-->
                        <td style="width: 35%">
                           @foreach ($prestamo->indicios as $key => $indicio)
                              <b>{{$indicio->identificador}}:</b>{{$indicio->descripcion}}<br>
                           @endforeach
                        </td>
                     </tr>
                  @empty
                     <tr>
                        <td colspan="15">
                           <blockquote class="yellow lighten-2"><b>No hay resultados</i></b></blockquote>
                        </td>
                     </tr>
                  @endforelse
               @endisset
               @empty($prestamos)
                  <tr>
                     <td colspan="15">
                        <blockquote class="yellow lighten-2"><b>Realice una busqueda <i class="fas fa-search"></i></b></blockquote>
                     </td>
                  </tr>
               @endempty
   
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
               <!--prestamo estado-->
               <div class="col s12">
                  <p><b>Estado Prestamo:</b></p>
               </div>
               <div class="col s4">
                  <input type="radio" name="buscar_prestamo_estado" id="todo" checked value="todo"/>
                  <label for="todo">Todo</label>
               </div>
               <div class="col s4">
                  <input type="radio" name="buscar_prestamo_estado" id="activo" {{(old('buscar_prestamo_estado') == 'activo') ? 'checked' : ''}} value="activo" />
                  <label for="activo">Activo</label>
               </div>
               <div class="col s4" style="margin-bottom: 20px;">
                  <input type="radio" name="buscar_prestamo_estado" id="concluso" {{(old('buscar_prestamo_estado') == 'concluso') ? 'checked' : ''}} value="concluso" />
                  <label for="concluso">Concluso</label>
               </div>
               <!--región-->
               @if (Auth::user()->tipo == 'administrador')
                  <div class="input-field col s12">
                     <select name="buscar_region">
                        <option value="0" disabled selected>---</option>
                        @foreach ($regiones->sortBy('nombre')->values() as $i => $region)
                              <option value="{{$region->id}}" {{ ( $region->id == old('buscar_region') ) ? 'selected' : '' }}>{{$i+1}}. {{$region->nombre}}</option>
                        @endforeach
                     </select>
                     <label>REGIÓN</label>
                  </div>
               @endif
               <!--prestamo fecha_inicio-->
               <div class="input-field col s12">
                  <input id="fecha-inicio" type="date" name="buscar_fecha_inicio" value="{{old('buscar_fecha_inicio')}}">
                  <label class="active" for="fecha-inicio">FECHA INICIO</label>
               </div>
               <!--prestamo fecha_fin-->
               <div class="input-field col s12">
                  <input id="fecha-fin" type="date" name="buscar_fecha_fin" value="{{old('buscar_fecha_fin')}}">
                  <label class="active" for="fecha-fin">FECHA FIN</label>
               </div>
               <!--prestamo texto_buscar-->
               <div class="input-field col s12" id="input-buscar">
                  <input type="text" id="buscar-texto" placeholder="Folio, N.U.C." name="buscar_texto" value="{{old('buscar_texto')}}">
               </div>
               <div class="input-field col s12">
                  <input type="hidden" id="perito-hidden" name="resguardante" value="{{old('resguardante')}}">
                  <input type="text" class="autocomplete" id="autocomplete-resguardante" data-tabla="peritos" data-input-hidden="perito-hidden" name="resguardante_autocomplete" value="{{old('resguardante_autocomplete')}}">
                  <label for="autocomplete-resguardante">Resguardante</label>
               </div>
               <!--reingreso multiple-->
               <div class="col s12">
                  <input type="checkbox" class="filled-in" id="reingreso-multiple" name="reingreso_multiple" value="reingreso_multiple"/>
                  <label for="reingreso-multiple" style="color: #152f4a !important;">Reingreso multiple</label>
               </div>
               <!--hr-->
               <div class="col s12">
                  <hr class="hr-main">
               </div>
               <!--btn busca-->
               <div class="input-field col s12">
                  <button type="submit" class="btn-guardar" id="btn-buscar" style="display: inline-block !important; width:100%;" name="btn_buscar" value="buscar">buscar</button>
               </div>
            </div>
         </form>
      </div>
   </div>
   <div id="modal-footer" class="modal-buscar-footer">
      {{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a> --}}
   </div>
</div>
@endsection

@section('js')
   <script src="{{asset('js/modal/modal.js')}}"></script>
   <script src="{{asset('js/modelo/get_modelo.js')}}"></script>
<script>
   var texto = $('#buscar-texto').val();
    if(texto != ''){
      console.log('entro:' + texto);
      $('td').mark(texto,{
      "separateWordSearch": false,
      });
   }

   $('#reingreso-multiple').click(function(){
         if ( $(this).prop('checked') ){
            $('#btn-buscar').attr('formtarget','_blank');
         }
         else{
            $('#btn-buscar').removeAttr('formtarget');
         }
      });
</script>
@endsection
