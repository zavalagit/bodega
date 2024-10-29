@extends('plantilla.template')

{{--item menu selected--}}
@section('nombre_pagina','vista-peticion-consultar')
@section('nombre_submenu','submenu-peticiones')

@section('seccion', 'CONSULTA DE PETICIONES')
@section('titulo','CONSULTAR-CADENA')

@section('css')
<link rel="stylesheet" href="{{asset('/css/materialize/chips.css')}}">
<link rel="stylesheet" href="{{asset('/css/nav/sidenav_buscador.css')}}">
<link rel="stylesheet" href="{{asset('/css/btn.css')}}">
<link rel="stylesheet" href="{{asset('/css/tablas.css')}}">
<link rel="stylesheet" href="{{asset('/css/tablas/tabla_modal.css')}}">
<link rel="stylesheet" href="{{asset('/css/buscador/buscador_parametros_busqueda.css')}}">
<style>
   .collapsible-header{
      /* background-color: tomato; */
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
   <!--section ~ Buscador-->
   <section>
      @include('peticion.peticion_buscador')
      <div class="row">
         <div class="col s1 l1 offset-s11 offset-l11 right-align">
            <a href="#" class="btn-sidenav-buscador-open"><i class="fas fa-search fa-lg"></i></a>
         </div>
         <!--parametros de busqueda-->
         {{-- @include('peticiones.peticion_consultar_parametros_busqueda')
         <div class="col s12">
            <hr class="hr-2">
         </div> --}}
      </div>
   </section>
   <!--section ~ encabezado-->
   <section>
      <div class="row">
         <div class="fecha-encabezado col s12" style="margin-bottom:0 !important;">
             <h5 style="margin-bottom:0 !important;"> <b>PETICIONES {{strtoupper($fecha_formato)}}</b> </h5>
         </div>
      </div>
   </section>
   <!--1 y 2. section ~ peticiones_entradas_atendidas - peticion_documento_emitido-->
   <section>
      <div class="row">
         <div class="col s12">
            @include('colectivo.colectivo_estadistica.01_tabla_general')
         </div>
         {{-- <div class="col s7">
            @include('colectivo.colectivo_estadistica.02_tabla_documento_emitido')
         </div> --}}
      </div>
   </section>
   <!--3. section ~ necros-->
   {{-- <section>
      <div class="row">
         <div class="col s12">
            <table>
               <thead>
                   <tr>
                       <th>Nº</th>
                       <th>Tipo de muestra</th>
                       <th>Recolectadas</th>
                       <th>Reolectadas y analizadas dentro del rango de fecha indicado</th>
                       <th>Analizadas (Registro con fecha anterior al indicado, pero analizada dentro del rango de fecha indicado)</th>
                       <th>Cantidad de estudios</th>
                   </tr>
               </thead>
               <tbody>
                   @forelse ($pruebas->sortBy('nombre')->values() as $i => $prueba)
                       <tr>
                           <td>{{$i+1}}</td>
                           <td>{{$prueba->nombre}}</td>
                           @if ( old('b_fecha_fin') )
                              <td>
                                 {{
                                    $colectivos->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('colectivo_validacion_fecha','<=',old('b_fecha_fin').' 23:59:59')
                                    ->sum(function ($colectivo) use($prueba){ if( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ) return 1; })
                                 }} /
                                 {{
                                    $colectivos->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('colectivo_validacion_fecha','<=',old('b_fecha_fin').' 23:59:59')->count()
                                 }} ~ 
                                 {{
                                    round( (float)( ( $colectivos->sum(function ($colectivo) use($prueba){ if( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ) return 1; }) ) / $colectivos->count() ) * 100 )
                                 }}%
                              </td>
                              <td>
                                 {{
                                    $colectivos->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('colectivo_validacion_fecha','<=',old('b_fecha_fin').' 23:59:59')
                                    ->where('colectivo_validacion_fecha','>=',old('b_fecha_inicio'))->where('colectivo_validacion_fecha','<=',old('b_fecha_fin'))
                                    ->sum(function ($colectivo) use($prueba){ if( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ) return 1; })
                                 }} / 
                                 {{
                                    $colectivos->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('colectivo_validacion_fecha','<=',old('b_fecha_fin').' 23:59:59')->count()
                                 }} ~ 
                                 {{
                                    round( (float)( 
                                                      ( 
                                                         $colectivos->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('colectivo_validacion_fecha','<=',old('b_fecha_fin').' 23:59:59')
                                                         ->where('colectivo_validacion_fecha','>=',old('b_fecha_inicio'))->where('colectivo_validacion_fecha','<=',old('b_fecha_fin'))
                                                         ->sum(function ($colectivo) use($prueba){ if( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ) return 1; }) 
                                                      ) / $colectivos->count() 
                                                   ) * 100 )
                                 }}%
                              </td>
                              <td>
                                 {{
                                    $colectivos->where('created_at','<',old('b_fecha_inicio').' 00:00:00')
                                    ->where('colectivo_validacion_fecha','>=',old('b_fecha_inicio'))->where('colectivo_validacion_fecha','<=',old('b_fecha_fin'))
                                    ->sum(function ($colectivo) use($prueba){ if( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ) return 1; })
                                 }}
                              </td>
                              <td>
                                 {{
                                    $colectivos->where('colectivo_validacion_fecha','>=',old('b_fecha_inicio'))->where('colectivo_validacion_fecha','<=',old('b_fecha_fin'))
                                    ->sum(function ($colectivo) use($prueba){ return $colectivo->pruebas->where('pivot.prueba_id',$prueba->id)->sum('pivot.prueba_estudios'); })
                                 }}
                              </td>
                           @elseif( old('b_fecha_inicio') )
                              <td>
                                 {{
                                    $colectivos->where('colectivo_validacion_fecha',old('b_fecha_inicio'))
                                    ->sum(function ($colectivo) use($prueba){ if( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ) return 1; })}}/{{$colectivos->count()}} ~ {{round( (float)( ( $colectivos->sum(function ($colectivo) use($prueba){ if( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ) return 1; }) ) / $colectivos->count() ) * 100 )
                                 }} %
                              </td>
                              <td>
                                 {{
                                    $colectivos->where('colectivo_validacion_fecha',old('b_fecha_inicio'))
                                    ->sum(function ($colectivo) use($prueba){ return $colectivo->pruebas->where('pivot.prueba_id',$prueba->id)->sum('pivot.prueba_estudios'); })
                                 }}
                              </td>
                           @else
                              <td>
                                 {{
                                    $colectivos->where('colectivo_validacion_fecha',$fecha_hoy)
                                    ->sum(function ($colectivo) use($prueba){ if( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ) return 1; })}}/{{$colectivos->count()}} ~ {{round( (float)( ( $colectivos->sum(function ($colectivo) use($prueba){ if( $colectivo->pruebas->contains('pivot.prueba_id',$prueba->id) ) return 1; }) ) / $colectivos->count() ) * 100 )
                                 }} %
                              </td>
                              <td>
                                 {{
                                    $colectivos->where('colectivo_validacion_fecha',$fecha_hoy)
                                    ->sum(function ($colectivo) use($prueba){ return $colectivo->pruebas->where('pivot.prueba_id',$prueba->id)->sum('pivot.prueba_estudios'); })
                                 }}
                              </td>
                           @endif
                       </tr>
                   @empty
                       <tr><td colspan="4">no hay registros</td></tr>    
                   @endforelse
               </tbody>
           </table>
         </div>
      </div>
   </section> --}}
@endsection

@section('js')
<script src="{{asset('/js/general/sidenav_buscador.js')}}"></script>
<script src="{{asset('/js/modelo/get_modelo.js')}}"></script>
<script src="{{asset('/js/peticiones/peticion_informacion.js')}}"></script>
<script src="{{asset('/js/peticiones/peticion_eliminar.js')}}"></script>
<script src="{{asset('/js/especialidad/especialidad_solicitudes.js')}}"></script>
@endsection
