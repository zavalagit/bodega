@php
   $plantilla = "";
   if(Auth::user()->tipo === 'coordinador')
      $plantilla = 'plantillas.peticiones.plantilla_coordinador';
   elseif(Auth::user()->tipo === 'director_unidad')
      $plantilla = 'plantillas.plantilla_director';
   elseif(Auth::user()->tipo === 'director_fiscalia')
      $plantilla = 'plantillas.plantilla_director';
   elseif(Auth::user()->tipo === 'usuario')
      $plantilla = 'plantilla.template';
@endphp
@extends($plantilla)

@if (Auth::user()->tipo === 'usuario')
    {{--item menu selected--}}
   @section('nombre_pagina','vista-peticion-concentrado-diario')
   @section('nombre_submenu','submenu-peticiones')
@endif

@section('seccion', "CONCENTRADO POR DÍA")
@section('titulo','CONCENTRADO-DIA')

@section('css')
<link rel="stylesheet" href="{{asset('css/cadenas/registrar.css')}}">
    
   <style media="screen">
      body{
         zoom: 73% !important;
      }
      caption{
         color: #c6c6c6 !important;
         background-color: #152F4A !important;
      }

      .col{
         margin-bottom: 2%;
      }

      .div-fiscalia{
         background-color: #394049;
         color: #c09f77;
         border-radius: 25px 25px 0 25px;
         padding: 10px 0 10px 15px;
      }
      .div-fiscalia:hover{
         background-color: #152f4a;
      }

      th,td{
        text-align: left;
        padding-left: 10px !important;
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

    .tabla-peticiones td{
        width:50%; 
        text-align:left;
    }

    caption{
        padding-top: 5px !important;
        padding-bottom: 5px !important;
    }

    .td-izq{
        width: 80% !important;
        text-align:left;
        padding-left:3% !important;
    }
    .td-der{
        width:20% !important;
        text-align:right;
        padding-right:10% !important;
    }
    .td-izq-total{
        width: 80% !important;
        text-align:center;
        padding-left:3% !important;
        background-color:#c09f77;
        color:#394049 !important;
        font-weight: bold;
    }
    .td-der-total{
        width:20% !important;
        text-align:right;
        padding-right:10% !important;
        background-color:#394049;
        color:white !important;
    }
    .td-sub{
        background-color: #c6c6c6;
        color: white;
    }
   </style>
@endsection

@section('contenido')

   <!--buscar-->
   <section>
      <form class="col s12">
         <div class="row">

            @if (Auth::user()->tipo === 'coordinador')
               <div id="div-fiscalias" class="input-field col s2">
                  <select id="fiscalia-select" name="buscar_fiscalia">
                  @foreach ($fiscalias->sortBy('nombre') as $f)
                        <option value="{{$f->id}}" {{ ($f->id === $fiscalia->id) ? 'selected' : '' }}>{{$f->nombre}}</option>
                  @endforeach
                  </select>
                  <label>Seleccione Fiscalía</label>
               </div>
               
               @if ($lugar === 'unidad')
                  <div id="div-unidades" class="input-field col s2">
                        <select id="unidad-select" name="buscar_unidad">
                        @foreach ($unidades->sortBy('nombre') as $u)
                           <option value="{{$u->id}}" {{ ($u->id === $unidad->id) ? 'selected' : '' }}>{{$u->nombre}}</option>
                        @endforeach
                        </select>
                        <label>Seleccione Unidad</label>
                  </div>
               @endif
            @endif
            
            <div class="input-field col s2">
               @isset($fecha_inicio)
                  <input type="date" name="fecha_inicio" value="{{$fecha_inicio}}">
               @endisset
               @empty($fecha_inicio)
                  <input type="date" name="fecha_inicio" >
               @endempty
            </div>

            <div class="input-field col s2">
               @isset($fecha_fin)
                  <input type="date" name="fecha_fin" value="{{$fecha_fin}}">
               @endisset
               @empty($fecha_fin)
                  <input type="date" name="fecha_fin" >
               @endempty
            </div>
            
            <div class="input-field col s1">
                  <button class="btn waves-effect waves-light" type="submit" name="btn_buscar" value="buscar">
                     <i style="color:#394049;" class="fas fa-search"></i>
                  </button>
            </div>
           
         </div>
      </form>
   </section>

   <!--encabezado-->
   <section>
      <div class="row">
          <div class="fecha-encabezado col s12" style="margin-bottom:0 !important;">
              <h5 style="margin-bottom:0 !important;"> <b>PETICIONES {{$fecha_encabezado}}</b> </h5>
          </div>

          <div class="fecha-encabezado col s12" style="margin-top:0 !important;">
              @if ($lugar === 'unidad')
                  <h5 style="margin-top:0 !important;"> <b>{{$unidad->nombre}}</b> </h5>
              @elseif($lugar === 'fiscalia')
                  <h5 style="margin-top:0 !important;"> <b>{{$fiscalia->nombre}}</b> </h5>
              @elseif( Auth::user()->tipo === 'usuario')
                  <h5 style="margin-top:0 !important;"><b>{{Auth::user()->nombre}}</b></h5>
              @endif
          </div>
      </div>
  </section>
 
   <div class="row">
      <div class="col s12 m12 l6">
         <table class="bordered highlight">
            <thead>
               <tr>
                  <th>Tipo</th>
                  <th>Cantidad</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Solicitudes</td>
                  <td>{{$solicitudes->count()}}</td>
               </tr>
               <tr>
                  <td>Atendidas</td>
                  <td>{{$atendidas->count()}}</td>
               </tr>
               <tr>
                  <td>Dictamen</td>
                  <td>{{$atendidas->where('documento_emitido','dictamen')->count()}}</td>
               </tr>
               <tr>
                  <td>Certificado</td>
                  <td>{{$atendidas->where('documento_emitido','certificado')->count()}}</td>
               </tr>
               <tr>
                  <td>Informe</td>
                  <td>{{$atendidas->where('documento_emitido','informe')->count()}}</td>
               </tr>
               <tr>
                  <td>Juzgado</td>
                  <td>{{$atendidas->where('documento_emitido','salida_juzgado')->count()}}</td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>


   <div class="row">
      @php
          $dia = $fecha_inicio;
      @endphp
      @while ( strtotime($dia) <= strtotime($fecha_fin) )
         @break( strtotime($dia) > strtotime('now') )
         <div class="col s4 m4 l2">
            <div class="div-fiscalia">
               <h6 style="font-size: 18px;"><b>{{ strtoupper(strftime('%A',strtotime($dia))) }} ~ {{ date('d-m-Y',strtotime($dia)) }}</b></h6>
               <p>Solicitudes: {{$solicitudes->where('created_at','>=',"{$dia} 00:00:00")->where('created_at','<=',"{$dia} 23:59:59")->count()}}</p>
               <p>Atendidas: {{$atendidas->where('fecha_sistema',$dia)->count()}}</p>
               <p>Dictamen: {{$atendidas->where('fecha_sistema',$dia)->where('documento_emitido','dictamen')->count()}}</p>
               <p>Certificado: {{$atendidas->where('fecha_sistema',$dia)->where('documento_emitido','certificado')->count()}}</p>
               <p>Informe: {{$atendidas->where('fecha_sistema',$dia)->where('documento_emitido','informe')->count()}}</p>
               <p>Juzgado: {{$atendidas->where('fecha_sistema',$dia)->where('documento_emitido','salida_juzgado')->count()}}</p>
               <p><a href="/peticion-dia/{{$lugar}}/{{$lugar_id}}?especialidad_buscar=0&texto_buscar=&fecha_inicio={{$dia}}&btn_buscar=buscar" target="_blank">Ver...</a></p>
            </div>
         </div>
         @php
             $dia = date("Y-m-d", strtotime("{$dia} +1 day"));
         @endphp
      @endwhile
   </div>
  
@endsection

@section('js')
<script src="{{asset('js/get_tablas/get_unidades.js')}}"></script>


@endsection
