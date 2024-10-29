@extends('plantilla.template')

{{-- nombre vista --}}
@section('nombre_pagina','vista-caratula-entradas')
@section('nombre_submenu','submenu-reportes')

@section('seccion', 'CARATULA DE INGRESOS')

@section('css')
   
@endsection

@section('contenido')
   

      <form action="{{ url('/bodega/caratula-pdf') }}" method="GET" target="_blanck">

        
         <div class="row">
            <div class="input-field col s8 m2 l2">
               Fecha caratula
               <input type="date" name="fecha">
            </div>
            <div class="input-field col s12 m4 l1">
               <button class="btn-guardar" type="submit">
                     Generar
                  </button>
            </div>  
         </div>
         
      </form>
   </div>
@endsection

@section('js')
   <script type="text/javascript">
      $('.li-bodega').removeClass('active');
      $('#li-prestamos').addClass('active').css({'font-weight':'bold'});
   </script>
@endsection