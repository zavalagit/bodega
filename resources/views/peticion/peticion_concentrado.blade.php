@extends('template.template')

@section('css')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css"> --}}
<link rel="stylesheet" href="{{asset('/css/materialize/chips.css')}}">
<link rel="stylesheet" href="{{asset('/css/nav/sidenav_buscador.css')}}">
<link rel="stylesheet" href="{{asset('/css/btn.css')}}">
<link rel="stylesheet" href="{{asset('/css/table.css')}}">
<link rel="stylesheet" href="{{asset('/css/tablas/tabla_modal.css')}}">
<link rel="stylesheet" href="{{asset('/css/buscador/buscador_parametros_busqueda.css')}}">
@endsection

@section('titulo','CONSULTAR-CADENA')

@section('header')
<div class="col s1 l1 offset-l11 offset-s11 center-align" style="padding-top: 3px;">
   {{-- <a href="#" class="btn-sidenav-buscador-open pulse"><i class="fas fa-search" style="color: #fff;"></i></a> --}}
</div>
@endsection

@section('main')
   <section>
       <div class="row">
         <form class="col s12">
            <div class="row">
               <div class="input-field col s12">
                  <!--peticion_fecha-->
                  <div class="input-field col s4">
                     <input id="fecha-inicio" type="date" name="b_fecha_inicio" value="{{old('b_fecha_inicio',date('Y-m-d'))}}">
                     <label class="active" for="fecha-inicio">FECHA INICIO</label>
                  </div>
                  {{-- <div class="input-field col s4">
                     <input id="fecha-fin" type="date" name="b_fecha_fin" value="{{old('b_fecha_fin')}}">
                     <label class="active" for="fecha-fin">FECHA TERMINO</label>
                  </div> --}}
                  <!--peticion_btn_buscar-->
                  <div class="input-field col s3">
                     <button type="submit" class="" name="btn_buscar" value="buscar">Buscar</button>
                  </div>
               </div>
            </div>
      </div>
   </section>

   <section>
      <div class="row">
         <div class="col s12">
            <table>
               <thead>
                  <tr>
                     <th>N°</th>
                     <th>REGIÓN / UNIDAD</th>
                     <th>RECIBIDAS</th>
                     <th>ATENDIDAS</th>
                     {{-- <th>PENDIENTES</th> --}}
                     <th>DICTAMEN</th>
                     <th>CERTIFICADO</th>
                     <th>INFORME</th>
                     <th>JUZGADO</th>
                     <th>ARCHIVO</th>
					 <th>COLABORACIONES</th>
                     <th>NECROPSIAS</th>
                     <th>ESTUDIOS</th>
                  </tr>
               </thead>
               <tbody>
                  {{-- @isset($peticiones) --}}
                     @foreach ($regiones->values() as $i => $region)
                        <tr>
                           <td>{{ $i+1 }}</td>
                           <td>{{ $region->nombre }}</td>
                           <!--peticiones del día-->
                           <td>{{ $recibidas->where('fiscalia2_id',$region->id)->count() }}</td>
                           <!--atendidas en el día-->
                           <td>{{ $atendidas->where('fiscalia2_id',$region->id)->count() }}</td>
                           <!--pendientes del día-->
                           {{-- <td>{{$recibidas->where('estado','pendiente')->where('fiscalia2_id',$region->id)->count() + $recibidas->where('fecha_sistema','>',old('b_fecha_inicio',date('Y-m-d')))->where('fiscalia2_id',$region->id)->count()}}</td> --}}
                           <!--dictamenes-->
                           <td>{{ $atendidas->where('fiscalia2_id',$region->id)->where('documento_emitido','dictamen')->count() }}</td>
                           <!--certificado-->
                           <td>{{ $atendidas->where('fiscalia2_id',$region->id)->where('documento_emitido','certificado')->count() }}</td>
                           <!--informe-->
                           <td>{{ $atendidas->where('fiscalia2_id',$region->id)->where('documento_emitido','informe')->count() }}</td>
                           <!--juzgado-->
                           <td>{{ $atendidas->where('fiscalia2_id',$region->id)->where('documento_emitido','salida_juzgado')->count() }}</td>
                           <!--archivo-->
                           <td>{{ $atendidas->where('fiscalia2_id',$region->id)->where('documento_emitido','archivo')->count() }}</td>
						   <!--colaboraciones-->
                           <td>{{ $atendidas->where('fiscalia2_id',$region->id)->where('documento_emitido','colaboraciones')->count() }}</td>
                           <!--necros-->
                           <td>{{ $necros->where('fiscalia2_id',$region->id)->count() }}</td>
                           <!--estudios-->
                           <td>{{ $atendidas->where('fiscalia2_id',$region->id)->sum('cantidad_estudios') }}</td>
                        </tr>
                     @endforeach
                     @foreach ($unidades->sortBy('nombre')->values() as $n => $unidad)
                        <tr>
                           <td>{{$n+12}}</td>
                           <td>{{$unidad->nombre}}</td>
                           <!--peticiones del día-->
                           <td>{{ $recibidas->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->count() }}</td>
                           <!--atendidas en el día-->
                           <td>{{ $atendidas->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->count() }}</td>
                           <!--pendientes del día-->
                           {{-- <td>{{$recibidas->where('estado','pendiente')->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->count() + $recibidas->where('fecha_sistema','>',old('b_fecha_inicio',date('Y-m-d')))->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->count()}}</td> --}}
                           <!--dictamenes-->
                           <td>{{ $atendidas->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('documento_emitido','dictamen')->count() }}</td>
                           <!--certificado-->
                           <td>{{ $atendidas->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('documento_emitido','certificado')->count() }}</td>
                           <!--informe-->
                           <td>{{ $atendidas->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('documento_emitido','informe')->count() }}</td>
                           <!--juzgado-->
                           <td>{{ $atendidas->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('documento_emitido','salida_juzgado')->count() }}</td>
                           <!--archivo-->
                           <td>{{ $atendidas->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('documento_emitido','archivo')->count() }}</td>
						   <!--colaboraciones-->
                           <td>{{ $atendidas->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('documento_emitido','colaboraciones')->count() }}</td>
                           <!--necros-->
                           <td>{{ $necros->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->count() }}</td>
                           <!--estudios-->
                           <td>{{ $atendidas->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->sum('cantidad_estudios') }}</td>
                        </tr>
                     @endforeach
                     <!--total-->
                     <tr>
                        <td>14</td>
                        <td>TOTAL</td>
                        <!--peticiones del día-->
                        <td> {{ $recibidas->whereIn('fiscalia2_id',$regiones->pluck('id'))->count() + $recibidas->where('fiscalia2_id',4)->whereIn('unidad_id',$unidades->pluck('id'))->count() }} </td>
                        <!--atendidas en el día-->
                        <td> {{ $atendidas->whereIn('fiscalia2_id',$regiones->pluck('id'))->count() + $atendidas->where('fiscalia2_id',4)->whereIn('unidad_id',$unidades->pluck('id'))->count() }} </td>
                        <!--pendientes del día-->
                        {{-- <td>{{ $atendidas->whereIn('fiscalia2_id',$regiones->pluck('id'))-> + $atendidas->where('fiscalia2_id',4)->whereIn('unidad_id',$unidades->pluck('id')) }}</td> --}}
                        {{-- <td>{{ $peticiones->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('created_at','<=',old('b_inicio_fecha').' 23:59:59')->where('estado','pendiente')->count() }}</td> --}}
                        <!--dictamenes-->
                        <td>{{ $atendidas->whereIn('fiscalia2_id',$regiones->pluck('id'))->where('documento_emitido','dictamen')->count() + $atendidas->where('fiscalia2_id',4)->whereIn('unidad_id',$unidades->pluck('id'))->where('documento_emitido','dictamen')->count() }}</td>
                        <!--certificado-->
                        <td>{{ $atendidas->whereIn('fiscalia2_id',$regiones->pluck('id'))->where('documento_emitido','certificado')->count() + $atendidas->where('fiscalia2_id',4)->whereIn('unidad_id',$unidades->pluck('id'))->where('documento_emitido','certificado')->count() }}</td>                        
                        <!--informe-->
                        <td>{{ $atendidas->whereIn('fiscalia2_id',$regiones->pluck('id'))->where('documento_emitido','informe')->count() + $atendidas->where('fiscalia2_id',4)->whereIn('unidad_id',$unidades->pluck('id'))->where('documento_emitido','informe')->count() }}</td>
                        <!--juzgado-->
                        <td>{{ $atendidas->whereIn('fiscalia2_id',$regiones->pluck('id'))->where('documento_emitido','salida_juzgado')->count() + $atendidas->where('fiscalia2_id',4)->whereIn('unidad_id',$unidades->pluck('id'))->where('documento_emitido','salida_juzgado')->count() }}</td>                        
                        <!--archivo-->
                        <td>{{ $atendidas->whereIn('fiscalia2_id',$regiones->pluck('id'))->where('documento_emitido','archivo')->count() + $atendidas->where('fiscalia2_id',4)->whereIn('unidad_id',$unidades->pluck('id'))->where('documento_emitido','archivo')->count() }}</td>
						<!--colaboraciones-->
                        <td>{{ $atendidas->whereIn('fiscalia2_id',$regiones->pluck('id'))->where('documento_emitido','colaboraciones')->count() + $atendidas->where('fiscalia2_id',4)->whereIn('unidad_id',$unidades->pluck('id'))->where('documento_emitido','colaboraciones')->count() }}</td>
                        <!--necros-->
                        <td>{{ $necros->whereIn('fiscalia2_id',$regiones->pluck('id'))->count() + $necros->where('fiscalia2_id',4)->whereIn('unidad_id',$unidades->pluck('id'))->count() }}</td>
                        <!--estudios-->
                        <td>{{ $atendidas->whereIn('fiscalia2_id',$regiones->pluck('id'))->sum('cantidad_estudios') + $atendidas->where('fiscalia2_id',4)->whereIn('unidad_id',$unidades->pluck('id'))->sum('cantidad_estudios') }}</td>
                     </tr>
                     {{-- @endisset
                     @empty($peticiones)
                        <tr>
                           <td colspan="12" class="td-aviso">Elija un a fecha</td>
                        </tr>
                     @endempty --}}
               </tbody>
            </table>
         </div>
      </div>
   </section>
   

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
{{-- <script src="{{asset('/js/peticiones/peticion_accion.js')}}"></script> --}}
<script src="{{asset('/js/general/sidenav_buscador.js')}}"></script>
<script src="{{asset('/js/modelo/get_modelo.js')}}"></script>
<script src="{{asset('/js/peticiones/peticion_informacion.js')}}"></script>
<script src="{{asset('/js/peticiones/peticion_eliminar.js')}}"></script>
<script src="{{asset('/js/especialidad/especialidad_solicitudes.js')}}"></script>
@endsection
