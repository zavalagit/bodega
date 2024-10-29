@extends('plantilla.template')

{{-- nombre vista --}}
@section('nombre_pagina','vista-reporte-diario')
@section('nombre_submenu','submenu-reportes')

@section('css')
   <link rel="stylesheet" href="{{asset('/css/block.css')}}">
   <link rel="stylesheet" href="{{asset('/css/btn.css')}}">
   <link rel="stylesheet" href="{{asset('/css/hr.css')}}">

   <style>
      
   </style>
@endsection

@section('seccion', 'REPORTE DIARIO')

@section('contenido')
   

      <form action="{{ url('/bodega/reporte-diario') }}" method="get" target="_blank">
         <div class="row">
            <div class="input-field col s6 m6 l3 ">
               Hora de inicio
               <input type="time" value="09:00:00" name="hora1">
            </div>
            <div class="input-field col s6 m6 l3">
               Fecha de inicio
               <input type="date" name="fecha1">
            </div> 

            <div class="input-field col s6 m6 l3">
               Hora de cierre
               <input type="time" value="08:59:59" name="hora2">
            </div>
            <div class="input-field col s6 m6 l3">
               Fecha de cierre
               <input type="date" name="fecha2">
            </div>  
         </div>

         <div class="row">
            <div class="input-field col s6">
               <select name="rb1">
                  <option value="" disabled selected></option>
                  @foreach($users as $key => $usuario)
                     <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                  @endforeach
               </select>
               <label>RESPONSABLE DE GUARDIA</label>
            </div>
            <div class="input-field col s6">
               <select name="rb2">
                  <option value="" disabled selected></option>
                  @foreach($users as $key => $usuario)
                     <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                  @endforeach
               </select>
               <label>RECIBE SIGUIENTE GUARDIA</label>
            </div>
         </div>

         <div class="row">
            <div class="col s12">
               <blockquote>
                  <h6> <b>TIPO DE REPORTE</b> </h6></blockquote>
            </div>
            <div class=" col s4">
               <p>
                 <input type="radio" id="reporte-entradas" name="reporte_tipo" value="reporte_entradas" checked="checked"/>
                 <label for="reporte-entradas"> <b>Entradas</b> </label>
               </p>
            </div>
            <div class=" col s4">
               <p>
                 <input type="radio" id="reporte-prestamos" name="reporte_tipo" value="reporte_prestamos"/>
                 <label for="reporte-prestamos"> <b>Prestamo</b> </label>
               </p>
            </div>
            {{-- <div class=" col s4">
               <p>
                 <input type="radio" id="reporte-reingresos" name="reporte_tipo" value="reporte_reingresos"/>
                 <label for="reporte-reingresos">Reingresos</label>
               </p>
            </div> --}}
            <div class=" col s4">
               <p>
                 <input type="radio" id="reporte-bajas" name="reporte_tipo" value="reporte_bajas"/>
                 <label for="reporte-bajas"> <b>Bajas</b> </label>
               </p>
            </div>
         </div>
         
         {{-- <div class="row">
            <div class="col s12">
               <blockquote>
                  <h6> <b>CAMPOS QUE PUEDE AÑADIR</b> </h6>
               </blockquote>
            </div>
            <div class=" col s4">
               <p>
                 <input type="checkbox" id="campo-folio" name="campo_folio" value="campo_folio""/>
                 <label for="campo-folio">Folio</label>
               </p>
            </div>
         </div> --}}

         <div class="row">
            <div class="col s12">
               <hr class="hr-main">
            </div>
         </div>

         <div class="row">
            <div class="col offset-l11 s12 m4 l1">
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