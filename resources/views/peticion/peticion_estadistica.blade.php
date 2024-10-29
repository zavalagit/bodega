@extends('template.template')

@section('css')
<link rel="stylesheet" href="{{asset('/css/materialize/chips.css')}}">
<link rel="stylesheet" href="{{asset('/css/nav/sidenav_buscador.css')}}">
<link rel="stylesheet" href="{{asset('/css/btn.css')}}">
<link rel="stylesheet" href="{{asset('/css/tablas.css')}}">
<link rel="stylesheet" href="{{asset('/css/tablas/tabla_modal.css')}}">
<link rel="stylesheet" href="{{asset('/css/buscador/buscador_parametros_busqueda.css')}}">
<style>
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

@section('title','Petición Estadistica')

@section('header')   
<div class="col s2 l1 offset-l11 offset-s10 center-align" style="padding-top: 3px;">
   <a href="#" class="btn-sidenav-buscador-open"><i class="fas fa-search" style="color: #fff;"></i></a>
</div>
@endsection

@section('main')
   <!--parametros_busqueda-->
   <section>
      <div class="row">
         @include('peticion.peticion_estadistica_parametros_busqueda')
         <div class="col s12">
            <hr class="hr-2">
         </div>
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
            @component('componentes.componente_nota_2')
               @slot('icono')
                  <i style="color: tomato" class="fas fa-comment-alt"></i>
               @endslot
               @slot('mensaje')
                  <span><strong><em>Recibidas</em>.</strong></span> Peticiones que fueron registradas en el intervalo de fecha consultado.
               @endslot
            @endcomponent
         </div>
         <div class="col s12">
            @component('componentes.componente_nota_2')
               @slot('icono')
                  <i style="color: tomato" class="fas fa-comment-alt"></i>
               @endslot
               @slot('mensaje')
                  <span><strong><em>Atendidas</em>.</strong></span> Peticiones que se reportaron como atendida en el intervalo de fecha consultado.
               @endslot
            @endcomponent
         </div>
         <div class="col s12">
            @component('componentes.componente_nota_2')
               @slot('icono')
                  <i style="color: tomato" class="fas fa-comment-alt"></i>
               @endslot
               @slot('mensaje')
                  <span><strong><em>Pendientes</em>.</strong></span> Peticiones que se registraron en el intervalo de fecha consultado, pero <strong>no</strong> fueron atendidas en dicho intervalo. Pude que ya hayan sido atendidas en fecha posterior.
               @endslot
            @endcomponent
         </div>
         <div class="col s12">
            @component('componentes.componente_nota_2')
               @slot('icono')
                  <i style="color: tomato" class="fas fa-comment-alt"></i>
               @endslot
               @slot('mensaje')
                  <span><strong><em>Rezago</em>.</strong></span> Peticiones que se registraron en el intervalo de fecha consultado y aún <strong>no</strong> han sido atendidas.
               @endslot
            @endcomponent
         </div>
         <div class="col s12 l5">
            @include('peticion.peticion_estadistica_general')
         </div>
         <div class="col s12 l7">
            @include('peticion.peticion_estadistica_documento_emitido')
         </div>
      </div>
   </section>
   <!--3. section ~ necros-->
   @if ( in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_region']) || ( in_array(Auth::user()->unidad_id,[2,66,108]) ) )
      <section>
         @include('peticion.peticion_estadistica.peticion_estadistica_3_necropsias')
      </section>       
   @endif
   <!--4. section ~ peticiones por especialidad-->
   <section>
      <div class="row">
         <div class="col s12" style="overflow-x:auto;">
            @include('peticion.peticion_estadistica_especialidad')
         </div>
      </div>
   </section>
   <!--5. section ~ peticion por solicitud-->
   <section>
      <div class="row">
         <div class="col s12">
            @include('peticion.peticion_estadistica_solicitud')
         </div>
      </div>
   </section>
   <!--6.- section - colectivos-->
   <section>
      <div class="row">
         <div class="col s12">

         </div>
      </div>
   </section>


   <!--buscador-->
   @include('peticion.peticion_estadistica_buscador')

@endsection

@section('js')
{{-- <script src="{{asset('/js/peticiones/peticion_accion.js')}}"></script> --}}
<script src="{{asset('/js/general/sidenav_buscador.js')}}"></script>
<script src="{{asset('/js/modelo/get_modelo.js')}}"></script>
<script src="{{asset('/js/peticiones/peticion_informacion.js')}}"></script>
<script src="{{asset('/js/peticiones/peticion_eliminar.js')}}"></script>
<script src="{{asset('/js/especialidad/especialidad_solicitudes.js')}}"></script>
<script src="{{asset('/js/peticion/peticion_buscador.js')}}"></script>

{{-- <script>   
   $(function(){
      $('#b-sidenav').sidenav({
         // menuWidth: 600, // Default is 300
         edge: 'right',
         draggable: true,
      });
      $('.btn-sidenav-buscar-open').click(function(e){
         e.preventDefault();
         $('#b-sidenav').sidenav('open');
      });
   });
</script> --}}
@endsection
