@extends('plantillas.plantilla_fiscal')

@section('seccion', "INFROME DE SOLICITUDES DEL ".date('d-m-Y',strtotime($fecha_peticiones))." - REGIÓN {$fiscalias->firstwhere('id',$buscar_fiscalia)->nombre}")
@section('titulo','')
@section('css')
   <style>
      caption{
         color: #c6c6c6 !important;
         background-color: #152F4A !important;
      }

      td{
         padding-left: 20px !important;
      }
   </style>
@endsection
@section('contenido')

<!--div busqueda-->
<div class="row">
   <form class="col s12" autocomplete="off">
      <div class="row">
         <div class="input-field col s2">
            <select name="buscar_fiscalia">
               <option value="0">---</option>
               @foreach ($fiscalias as $fiscalia)
                  @if ($buscar_fiscalia == $fiscalia->id)
                     <option value="{{$fiscalia->id}}" selected>{{$fiscalia->nombre}}</option>
                  @else
                     <option value="{{$fiscalia->id}}">{{$fiscalia->nombre}}</option>
                  @endif
               @endforeach
            </select>
            <label>FISCALÍA</label>
         </div>
         <div class="input-field col s2">
            @isset($fecha_peticiones)
               <input id="fecha-inicio" type="date" name="fecha_peticiones" value="{{$fecha_peticiones}}">
            @endisset
            @empty($fecha_peticiones)
               <input id="fecha-inicio" type="date" name="fecha_peticiones">
            @endempty
            <label class="active" for="fecha-inicio">FECHA</label>
         </div>
         
         

         <div class="col s2">
            <button class="" type="submit" name="buscar_btn" value="buscar"><i class="fas fa-search fa-lg"></i></button>
            <!--
            <button class="" type="submit" name="buscar_btn" value="pdf"><i style="color:red;" class="fas fa-file-pdf fa-lg"></i></button>
            <button class="" type="submit" name="buscar_btn" value="excel"><i style="color:darkgreen;" class="fas fa-file-excel fa-lg"></i></button>
            -->
         </div>

      </div>
   </form>
</div>
<!--div busqueda-->

@isset($buscar_fiscalia)
   <div class="row row-descarga">
      <div class="col s1 offset-s10">
         <span><b>Descarga:</b></span>
      </div>
      <div class="col s1">
         <a href="/reporte-solicitudes-fiscal/{{$buscar_fiscalia}}/{{$fecha_peticiones}}" target="_blanck"><i class="fas fa-file-pdf fa-lg" style="color:red;"></i></a>
         <!--
         &nbsp;&nbsp;
         <a href=""><i class="fas fa-file-excel fa-lg" style="color:green;"></i></a>
         -->
      </div>
   </div>

   <div class="row">
      <!--Solicitudes-->
      <div class="col s6">
         <table id="tabla-entradas" class="responsive-table highlight bordered">
            <caption><b>SOLICITUDES</b></caption>
            <tbody>
            <tr>
               <td>Solicitudes recibidas</td>
               <td>{{$peticiones_recibidas->count()}}</td>
            </tr>
            <tr>
               <td>Solicitudes atendidas en el día</td>
               <td>
                  {{$peticiones_recibidas->whereIn('estado',['atendida','entregada'])
                                          ->where('fecha_elaboracion',$fecha_peticiones)
                                          ->count()}}
               </td>
            </tr>
            <tr>
               <td>Solicitudes atendidas en fecha posterior</td>
               <td>
                  {{$peticiones_recibidas->whereIn('estado',['atendida','entregada'])
                                          ->where('fecha_elaboracion','>',$fecha_peticiones)
                                          ->count()}}
               </td>
            </tr>
            <tr>
               <td style="background-color:#c09f77; color:#394049 !important;"><b>Total de solicitudes atendidas</b></td>
               <td style="background-color:#394049; color:white !important;">
                  <b>
                  {{$peticiones_recibidas->whereIn('estado',['atendida','entregada'])
                                          ->where('fecha_peticion',$fecha_peticiones)
                                          ->count()}}
                  </b>   
            </td>
            </tr>
            </tbody>
         </table>
      </div>
      <!--Documento emitido-->
      <div class="col s6">
         <table id="tabla-entradas" class="responsive-table highlight bordered">
            <caption><b>DOCUMENTO EMITIDO</b></caption>
            <tbody>
               <tr>
                  <td>Dictamenes</td>
                  <td>
                     {{$peticiones_recibidas->where('documento_emitido','dictamen')
                                             //->where('fecha_elaboracion',$fecha_peticiones)
                                             ->count()}}
                  </td>
               </tr>
               <tr>
                  <td>Informes</td>
                  <td>
                     {{$peticiones_recibidas->where('documento_emitido','informe')
                                             //->where('fecha_elaboracion',$fecha_peticiones)
                                             ->count()}}
                  </td>
               </tr>
               <tr>
                  <td>Juzgados</td>
                  <td>
                     {{$peticiones_recibidas->where('documento_emitido','salida_juzgado')
                                             //->where('fecha_elaboracion',$fecha_peticiones)
                                             ->count()}}
                  </td>
               </tr>
               <tr>
                  <td>Certificados</td>
                  <td>
                     {{$peticiones_recibidas->where('documento_emitido','certificado')
                                             //->where('fecha_elaboracion',$fecha_peticiones)
                                             ->count()}}
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>

   <div class="row">
      <!--necropsias-->
      <div class="col s6">
         @php
             $array_necropsia_tipo = array(
                'suicidio' => 0,
                'dolosa' => 0,
                'hecho_transito' => 0,
                'patologia_otra' => 0
             );
         @endphp
         @foreach ($peticiones_recibidas as $peticion)
            @isset($peticion->necropsia_id)
                @php
                    $array_necropsia_tipo[$peticion->necropsia->necropsia_tipo] += 1;
                @endphp
            @endisset
         @endforeach

         <table id="tabla-entradas" class="responsive-table highlight bordered">
            <caption><b>NECROPSIAS</b></caption>
            <tbody>
               <tr>
                  <td><b>Cantidad de necropsias</b></td>
                  <td><b>{{$peticiones_recibidas->where('solicitud_id',61)->count()}}</b></td>
               </tr>
               <tr>
                  <td>Suicidio</td>
                  <td>{{$array_necropsia_tipo['suicidio']}}</td>
               </tr>
               <tr>
                  <td>Doloso</td>
                  <td>{{$array_necropsia_tipo['dolosa']}}</td>
               </tr>
               <tr>
                  <td>Hecho de tránsito</td>
                  <td>{{$array_necropsia_tipo['hecho_transito']}}</td>
               </tr>
               <tr>
                  <td>Patología u otra</td>
                  <td>{{$array_necropsia_tipo['patologia_otra']}}</td>
               </tr>
            </tbody>
         </table>
      </div>
      <!--Rezago-->
      <div class="col s6">
         <table id="tabla-entradas" class="responsive-table highlight bordered">
            <caption><b>REZAGO<b></caption>
            <tbody>
            <tr>
               <td>Rezago del día</td>
               <td>{{$peticiones_recibidas->where('estado','pendiente')->count()}}</td>
            </tr>
            <tr>
               <td>Rezago atendido</td>
               <td>{{$peticiones_rezago_atendido->count()}}</td>
            </tr>
            <tr>
               <td>Rezago acomuldo</td>
               <td>{{$peticiones_rezago->count()}}</td>
            </tr>
            </tbody>
         </table>
      </div>
   </div>
   
@endisset
@empty($buscar_fiscalia)
   <div class="row">
      <div class="col s12">
         <blockquote>Seleccione una Fiscalía y de click en <span><i class="fas fa-search"></i></span></blockquote>
      </div>
   </div>
@endempty







@endsection
@section('js')
@endsection
