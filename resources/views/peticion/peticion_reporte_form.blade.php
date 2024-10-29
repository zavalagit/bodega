{{-- @extends( ( Auth::user()->tipo == 'coordinador' ) ? 'plantillas.peticiones.plantilla_coordinador' : 'plantillas.plantilla_director') --}}

@extends('template.template')

@section('css')
   <style media="screen">
      /* css */
   </style>
@endsection

@section('title','REPORTE SOLICITUDES')

@section('header')
    
@endsection

@section('main')

   @if ( Auth::user()->tipo == 'administrador_peticiones')
      <div class="row">
         <div class="input-field col s3">
            <select name="" id="">
               <option value="">1. Región</option>
               <option value="">2. Unidad</option>
            </select>
            <label>Indique la Región</label>
         </div>
         <div class="input-field col s3">
            <select name="" id="">
               <option value="">1. Región</option>
               <option value="">2. Unidad</option>
            </select>
            <label>Materialize Select</label>
         </div>
      </div>
   @endif

   <div class="row">
      <form action="{{route('peticion_reporte_pdf')}}" method="GET" target="_blank">
         <div class="col s12">
            <p>
               <label for="test1">
                  <input type="radio" name="reporte_tipo" value='reporte_general'  id="test1" checked />
                  <span>1. Reporte general</span>                  
               </label>
             </p>
         </div>
         <div class="col s12">
            <p>
               <label for="test2">
                  <input name="reporte_tipo" value="reporte_solicitud" type="radio" id="test2" />
                  <span>2. Reporte por solicitud</span>
               </label>
             </p>
         </div>

         @if ( (Auth::user()->tipo == 'coordinador_peticiones_unidad') && (Auth::user()->unidad_id == 2) )
            <div class="col s12">
               <p>
                  <label for="test3">
                     <input name="reporte_tipo" value="reporte_necropsias_general" type="radio" id="test3"  />
                     <span>3. Reporte Necropsias general</span>
                  </label>
               </p>            
            </div>
            <div class="col s12">
               <p>
                  <label for="test4">
                     <input name="reporte_tipo" value="reporte_necropsias_mecanica" type="radio" id="test4"  />
                     <span>4. Reporte Necropsias por mecanica</span>
                  </label>
               </p>         
            </div>
         @endif

         <div class="col s12">
            <hr class="hr-1">
         </div>

         <div class="input-field col s2">
            <input type="date" name="b_fecha_inicio" value="">
            <label class="active" for="fecha-inicio">FECHA INICIO</label>
         </div>
         <div class="input-field col s2">
            <input type="date" name="b_fecha_fin" value="">
            <label class="active" for="fecha-fin">FECHA FIN</label>
         </div>
         <div class="input-field col s1">
            <button class="btn waves-effect waves-light" type="submit" name="btn-buscar" value="btn-pdf">
               Reporte
            </button>
        </div>

      </form>
   </div>
    
@endsection

@section('js')
   <script type="text/javascript">
      $('.li-registrar-cadena').removeClass('active');
      $('.li-consultar-cadena').addClass('active');
      $('.a-disabled').bind('click', false);
   </script>

   <script type="text/javascript" src="{{asset('js/etiqueta.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/etiqueta.js')}}" ></script>
  
   <script type="text/javascript" src="{{asset('js/peticiones/peticion_diaria.js')}}" ></script>


@endsection
