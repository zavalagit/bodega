@extends('plantilla.template')

{{--item menu selected--}}
@section('nombre_pagina','vista-cadena-consultar')
@section('nombre_submenu','submenu-cadenas')

@section('titulo','CONSULTAR-CADENA')
@section('seccion', 'CONSULTA CADENA DE CUSTODIA')

@section('css')
   <link rel="stylesheet" href="{{asset('css/tablas.css')}}">
   <link rel="stylesheet" href="{{asset('css/btn.css')}}">
   <link rel="stylesheet" href="{{asset('css/modal/modal.css')}}">
   <link rel="stylesheet" href="{{asset('css/hr.css')}}">
   <style media="screen">
      
   </style>

   <link rel="stylesheet" href="{{asset('css/js_maker.css')}}">
@endsection

@section('contenido')

   <span id="span-csrf" data-csrf="{{csrf_token()}}"></span>

   <section>
      <div class="row">
         <form class="col s12">
            <div class="row">
               <div class=" col s10">
                  <input id="buscar-input" type="text" placeholder="N.U.C. - Descripción" name="buscar" value="{{app('request')->input('buscar')}}">
               </div>
               <div class="col s2">
                  <button class="btn-guardar-ic" type="submit" id="buscar-btn">
                     <i class="fas fa-search fa-lg i-buscar"></i>
                  </button>
               </div>
            </div>
         </form>
      </div>
   </section>


   <div class="row">
      <div class="col s12">
         <table class="highlight">
            <thead>
               <tr>
                  <th class="th-center">Nº</th>
                  <th>FOLIO BODEGA</th>
                  <th>N.U.C.</th>
                  <th>IDENTIFICADOR</th>
                  <th>DESCRIPCIÓN</th>
                  <th class="th-center">ANEXO 3</th>
                  <th class="th-center">ANEXO 4</th>
                  <th class="th-center">ETIQUETA</th>
                  <th class="th-center">CLONAR</th>
                  <th class="th-center">EDITAR</th>
                  <!--
                  <th>MAPA</th>
                  -->
               </tr>
            </thead>
            <tbody>
               @isset($cadenas)
                  @php $n=1; @endphp
                  @forelse ($cadenas as $cadena)
                     @php $filas=$cadena->indicios->count(); @endphp
                     <tr class="{{($cadena->estado == 'validada') ? 'green lighten-5' : ''}}">
                        <!--contador-->
                        <td rowspan="{{$filas}}" width="2%" class="td-contador"><b>{{$n++}}</b></td>
                        <!--folio-->
                        <td width="5%" rowspan="{{$filas}}">
                           @isset($cadena->folio_bodega)
                              <b>{{$cadena->folio_bodega}}<b>
                           @endisset
                           @empty($cadena->folio_bodega)
                              <b>- - -</b>
                           @endempty
                        </td>
                        <!--nuc-->
                        <td rowspan="{{$filas}}" width="8%">{{$cadena->nuc}}</td>
                        <!--indicios-->
                        @foreach ($cadena->indicios as $indicio)
                           @if ($loop->iteration > 1)
                              <tr class="{{($cadena->estado == 'validada') ? 'green lighten-5' : ''}}">    
                           @endif
                           <!--identificador-->
                           <td width="6%">{{$indicio->identificador}}</td>
                           <!--descripcion-->
                           <td>{{$indicio->descripcion}}</td>
                           
                           @if ($loop->first)
                              <!--anexo 3-->
                              <td rowspan="{{$filas}}" width="4%" class="td-center">
                                 <a href="" class="btn-anexo" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-3">
                                    <i class="fas fa-file-pdf fa-lg i-dorado"></i>
                                 </a>
                              </td>
                              <!--anexo 4-->
                              <td rowspan="{{$filas}}" width="4%" class="td-center">
                                 <a href="" class="btn-anexo" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-4">
                                    <i class="fas fa-file-pdf fa-lg i-dorado"></i>
                                 </a>
                              </td>
                              <!--etiqueta-->
                              <td rowspan="{{$filas}}" width="4%" class="td-center">
                                 <a href="" class="btn-etiqueta" data-cadena-id="{{$cadena->id}}">
                                    <i class="fas fa-file-pdf fa-lg i-dorado"></i>
                                 </a>
                              </td>
                              <!--clonar-->
                              <td rowspan="{{$filas}}" width="3%" class="td-center">
                                 <a href="/clonar-cadena/{{$cadena->id}}">
                                    <i class="fas fa-copy fa-lg i-dorado"></i>
                                 </a>
                              </td>
                              <!--editar-->
                              <td rowspan="{{$filas}}" width="3%" class="td-center">
                                 @if ($cadena->editar === 'no')
                                    <a href="" class="a-disabled"><i class="fa fa-lock fa-lg i-dorado"></i></a>
                                 @elseif($cadena->editar === 'si')
                                    <a href="/editar-cadena/{{$cadena->id}}"><i class="fas fa-pen-square fa-lg i-dorado"></i></a>
                                 @endif
                              </td>
                           @endif
                        @endforeach
                     </tr>
                  @empty
                     <tr>
                        <td colspan="9">
                           <blockquote class="yellow lighten-2">
                              No se encontraron coincidencias</b>
                           </blockquote>
                        </td>
                     </tr>
                  @endforelse 
               @endisset
               @empty($cadenas)
                  <tr>
                     <td colspan="9">
                        <blockquote class="yellow lighten-2">
                           Realice una busqueda
                        </blockquote>
                     </td>
                  </tr>
               @endempty
            </tbody>
         </table>
      </div>
   </div>


<!--modal anexos-->
@include('modal.modal_anexos')

<!--modal etiqueta-->
@include('modal.modal_etiqueta')

@endsection

@section('js')
   <script type="text/javascript">
      $('.li-registrar-cadena').removeClass('active');
      $('.li-consultar-cadena').addClass('active');
      $('.a-disabled').bind('click', false);
   </script>

   <script src="{{asset('js/modal/modal.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/cadenas/anexos_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/etiqueta_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/sesion_perito/buscar_maker.js')}}" ></script>

   @include('general.error_method_get')
@endsection
