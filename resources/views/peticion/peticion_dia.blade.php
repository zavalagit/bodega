@extends('template.template')

@section('css')
<link rel="stylesheet" href="{{asset('/css/materialize/chips.css')}}">
<link rel="stylesheet" href="{{asset('/css/nav/sidenav_buscador.css')}}">
<link rel="stylesheet" href="{{asset('/css/btn.css')}}">
<link rel="stylesheet" href="{{asset('/css/table.css')}}">
<link rel="stylesheet" href="{{asset('/css/tablas/tabla_modal.css')}}">
<link rel="stylesheet" href="{{asset('/css/buscador/buscador_parametros_busqueda.css')}}">
<link rel="stylesheet" href="{{asset('css/materialize/carousel_panel.css')}}">
<style>
   body{
         /* background-color:rgba(21, 47, 74, 0.5); */
         /* background-color:rgba(57, 64, 73, 0.9); */
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
        /* border-radius: 15px; */
    }
   body{ background-color: rgba(57, 64, 73, 0.2); }
   .carousel{
      width: 98.5% !important;
      height:70vh !important;
      /* margin: auto; */
      /* background-color: tomato; */
      background-color: rgba(57, 64, 73, 0);
   }

   @media screen and (max-width: 600px){
      /* Force table to not be like tables anymore */
      table, caption, thead, tbody, th, td, tr { 
         display: block; 
      }
	
      /* Hide table headers (but not display: none;, for accessibility) */
      thead tr { 
         position: absolute;
         top: -9999px;
         left: -9999px;
      }
	
	   /* tr { border: 1px solid #ccc; } */
	
	   td { 
         /* Behave  like a "row" */
         border: none;
         border-bottom: 1px solid #eee; 
         position: relative;
         padding-left: 50% !important; 
         /* text-align: left !important; */
         /* padding-right: 50px !important; */
	   }
	
      td:before { 
         /* Now like a table header */
         position: absolute;
         /* Top/left values mimic padding */
         top: 6px;
         left: 6px;
         width: 45%; 
         padding-right: 10px; 
         white-space: nowrap;
         text-align: left;
         padding-left: 5px !important;
      }
      tr td:first-child {
           background: #f0f0f0;
           font-weight:bold;
           font-size:1.3em;
           text-align: center !important;
           padding-left: 0% !important; 
      }
	
      /*
      Label the data
      */
      #tabla-panel-uno td:nth-of-type(2):before { content: "Recibidas"; }
      #tabla-panel-uno td:nth-of-type(3):before { content: "Atendidas"; }
      #tabla-panel-uno td:nth-of-type(4):before { content: "Pendientes"; }
      #tabla-panel-uno td:nth-of-type(5):before { content: "Rezago"; }
      #tabla-panel-uno td:nth-of-type(6):before { content: "Dictamen"; }
      #tabla-panel-uno td:nth-of-type(7):before { content: "Certificado"; }
      #tabla-panel-uno td:nth-of-type(8):before { content: "Informe"; }
      #tabla-panel-uno td:nth-of-type(9):before { content: "Salida Juzgado"; }
      #tabla-panel-uno td:nth-of-type(10):before { content: "Archivo"; }
	  #tabla-panel-uno td:nth-of-type(11):before { content: "Colaboraciones"; }
      #tabla-panel-uno td:nth-of-type(12):before { content: "Estudios"; }
      #tabla-panel-uno td:nth-of-type(13):before { content: "Necros registradas en el día"; }
      #tabla-panel-uno td:nth-of-type(14):before { content: "Necros pertenecientes al día"; }
      
      #tabla-panel-dos td:nth-of-type(2):before { content: "Registrado a las"; }
      #tabla-panel-dos td:nth-of-type(3):before { content: "N.U.C."; }
      #tabla-panel-dos td:nth-of-type(4):before { content: "Ver"; }
      #tabla-panel-dos td:nth-of-type(5):before { content: "Región"; }
      #tabla-panel-dos td:nth-of-type(6):before { content: "Unidad"; }
      #tabla-panel-dos td:nth-of-type(7):before { content: "Perito"; }
      #tabla-panel-dos td:nth-of-type(8):before { content: "Especialidad"; }
      #tabla-panel-dos td:nth-of-type(9):before { content: "Solicitud"; }
      #tabla-panel-dos td:nth-of-type(10):before { content: "Fecha con atendidad en sistema"; }
      #tabla-panel-dos td:nth-of-type(11):before { content: "Documento emitido"; }
      #tabla-panel-dos td:nth-of-type(12):before { content: "Estudios"; }
      #tabla-panel-dos td:nth-of-type(13):before { content: "Estado"; }
   }
</style>
@endsection

@section('title','Petición Día')

@section('header')
<div class="col s2 l1 offset-l11 offset-s10 center-align" style="padding-top: 3px;">
   <a href="#" class="btn-sidenav-buscador-open"><i class="fas fa-search" style="color: #fff;"></i></a>
</div>
@endsection

@section('main')
   <!--section ~ Buscador-->
   <section>
      <div class="row" style="margin-bottom: 0;">
         <!--parametros de busqueda-->
         @include('peticion.peticion_dia_parametros_busqueda')
         <div class="col s12">
            <hr class="hr-4">
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

   <section>
      <div class="row">
         <div class="col s12">
            @component('componentes.componente_nota_2')
               @slot('icono')
                  <i style="color: tomato" class="fas fa-comment-alt"></i>
               @endslot
               @slot('mensaje')
                  <span><strong><em>Recibidas</em>.</strong></span> Peticiones que fueron registradas en el día.
               @endslot
            @endcomponent
            @component('componentes.componente_nota_2')
               @slot('icono')
                  <i style="color: tomato" class="fas fa-comment-alt"></i>
               @endslot
               @slot('mensaje')
                  <span><strong><em>Atendidas</em>.</strong></span> Peticiones que se registraron en el día y fueron atendidas en el día.
               @endslot
            @endcomponent
            @component('componentes.componente_nota_2')
               @slot('icono')
                  <i style="color: tomato" class="fas fa-comment-alt"></i>
               @endslot
               @slot('mensaje')
                  <span><strong><em>Pendientes</em>.</strong></span> Peticiones que se registraron en el día, pero <strong>no</strong> fueron atendidas en el día. Pude que ya hayan sido atendidas en fecha posterior.
               @endslot
            @endcomponent
            @component('componentes.componente_nota_2')
               @slot('icono')
                  <i style="color: tomato" class="fas fa-comment-alt"></i>
               @endslot
               @slot('mensaje')
                  <span><strong><em>Rezago</em>.</strong></span> Peticiones que se registraron en el día y aún <strong>no</strong> han sido atendidas.
               @endslot
            @endcomponent
      </div>
   </section>

   <!--1 y 2. section ~ peticiones_entradas_atendidas - peticion_documento_emitido-->
   <section>
      
      @component('componentes.componente_carousel')
         @component('componentes.componente_carousel_panel',['previo' => false, 'siguiente' => true])
            @include('peticion.peticion_dia_panel_1')
         @endcomponent  
         @component('componentes.componente_carousel_panel',['previo' => true, 'siguiente' => true])
            @include('peticion.peticion_dia_panel_2')
         @endcomponent  
         @component('componentes.componente_carousel_panel',['previo' => true, 'siguiente' => false])
            @include('peticion.peticion_dia_panel_3')
         @endcomponent  
      @endcomponent
        
   </section>

   <!-- Modal Info -->
   <div id="modal-peticion-informacion" class="modal">
      <div class="modal-content">
      </div>
   </div>

   <!--buscador-->
   @include('peticion.peticion_dia_buscador')
@endsection

@section('js')
{{-- <script src="{{asset('/js/peticiones/peticion_accion.js')}}"></script> --}}
<script src="{{asset('/js/general/sidenav_buscador.js')}}"></script>
<script src="{{asset('/js/modelo/get_modelo.js')}}"></script>
<script src="{{asset('/js/peticion/peticion_informacion.js')}}"></script>
<script src="{{asset('/js/peticiones/peticion_eliminar.js')}}"></script>
<script src="{{asset('/js/especialidad/especialidad_solicitudes.js')}}"></script>
<script src="{{asset('/js/materialize/carousel_panel.js')}}"></script>
<script src="{{asset('/js/peticion/peticion_buscador.js')}}"></script>
@endsection
