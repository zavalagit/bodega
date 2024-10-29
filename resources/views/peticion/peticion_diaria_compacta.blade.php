@extends('plantilla.template')

{{--item menu selected--}}
,'vista-peticion-consultar')


@section('seccion', 'CONSULTA DE PETICIONES')
@section('titulo','CONSULTAR-CADENA')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<link rel="stylesheet" href="{{asset('/css/materialize/chips.css')}}">
<link rel="stylesheet" href="{{asset('/css/nav/sidenav_buscador.css')}}">
<link rel="stylesheet" href="{{asset('/css/btn.css')}}">
<link rel="stylesheet" href="{{asset('/css/tablas.css')}}">
<link rel="stylesheet" href="{{asset('/css/tablas/tabla_modal.css')}}">
<link rel="stylesheet" href="{{asset('/css/buscador/buscador_parametros_busqueda.css')}}">
@endsection

@section('contenido')
   <section>
       <div class="row">
         <form class="col s12">
            <div class="row">
               <div class="input-field col s12">
                  <!--peticion_fecha-->
                  <div class="input-field col s4">
                     <input id="fecha-inicio" type="date" name="b_fecha_inicio" value="{{old('b_fecha_inicio')}}">
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
                     <th>REGIÓN</th>
                     <th>PETICIONES</th>
                     <th>ATENDIDAS</th>
                     {{-- <th>PENDIENTES</th> --}}
                     <th>DICTAMEN</th>
                     <th>CERTIFICADO</th>
                     <th>INFORME</th>
                     <th>JUZGADO</th>
                     <th>ARCHIVO</th>
                     {{-- <th>NECROPSIAS</th> --}}
                     <th>ESTUDIOS</th>
                  </tr>
               </thead>
               <tbody>
                  @isset($peticiones)
                     @foreach ($regiones->values() as $n => $region)
                        <tr>
                           <td>{{ $n+1 }}</td>
                           <td>{{ $region->nombre }}</td>
                           <!--peticiones del día-->
                           <td>{{ $peticiones->where('fiscalia2_id',$region->id)->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('created_at','<=',old('b_fecha_inicio').' 23:59:59')->count() }}</td>
                           <!--atendidas en el día-->
                           <td>{{ $peticiones->where('fiscalia2_id',$region->id)->where('fecha_sistema',old('b_fecha_inicio'))->count() }}</td>
                           <!--pendientes del día-->
                           {{-- <td>{{ $peticiones->where('fiscalia2_id',$region->id)->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('created_at','<=',old('b_inicio_fecha').' 23:59:59')->where('estado','pendiente')->count() }}</td> --}}
                           <!--dictamenes-->
                           <td>{{ $peticiones->where('fiscalia2_id',$region->id)->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','dictamen')->count() }}</td>
                           <!--certificado-->
                           <td>{{ $peticiones->where('fiscalia2_id',$region->id)->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','certificado')->count() }}</td>
                           <!--informe-->
                           <td>{{ $peticiones->where('fiscalia2_id',$region->id)->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','informe')->count() }}</td>
                           <!--juzgado-->
                           <td>{{ $peticiones->where('fiscalia2_id',$region->id)->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','salida_juzgado')->count() }}</td>
                           <!--archivo-->
                           <td>{{ $peticiones->where('fiscalia2_id',$region->id)->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','archivo')->count() }}</td>
                           <!--necros-->
                           {{-- <td>{{ $peticiones->where('fiscalia2_id',$region->id)->where('fecha_sistema',old('b_fecha_inicio'))->whereIn('solicitud_id',[61,62])->count() }}</td> --}}
                           <!--estudios-->
                           <td>{{ $peticiones->where('fiscalia2_id',$region->id)->where('fecha_sistema',old('b_fecha_inicio'))->sum('cantidad_estudios') }}</td>
                        </tr>
                     @endforeach
                     @foreach ($unidades->values() as $n => $unidad)
                        <tr>
                           <td>{{$n+11}}</td>
                           <td>{{$unidad->nombre}}</td>
                           <!--peticiones del día-->
                           <td>{{ $peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('created_at','<=',old('b_fecha_inicio').' 23:59:59')->count() }}</td>
                           <!--atendidas en el día-->
                           <td>{{ $peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('fecha_sistema',old('b_fecha_inicio'))->count() }}</td>
                           <!--pendientes del día-->
                           {{-- <td>{{ $peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('created_at','<=',old('b_inicio_fecha').' 23:59:59')->where('estado','pendiente')->count() }}</td> --}}
                           <!--dictamenes-->
                           <td>{{ $peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','dictamen')->count() }}</td>
                           <!--certificado-->
                           <td>{{ $peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','certificado')->count() }}</td>
                           <!--informe-->
                           <td>{{ $peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','informe')->count() }}</td>
                           <!--juzgado-->
                           <td>{{ $peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','salida_juzgado')->count() }}</td>
                           <!--archivo-->
                           <td>{{ $peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','archivo')->count() }}</td>
                           <!--necros-->
                           {{-- <td>{{ $peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('fecha_sistema',old('b_fecha_inicio'))->whereIn('solicitud_id',['61','62'])->count() }}</td> --}}
                           <!--estudios-->
                           <td>{{ $peticiones->where('fiscalia2_id',4)->where('unidad_id',$unidad->id)->where('fecha_sistema',old('b_fecha_inicio'))->sum('cantidad_estudios') }}</td>
                        </tr>
                     @endforeach
                     <!--total-->
                     <tr>
                        <td>14</td>
                        <td>TOTAL</td>
                        <!--peticiones del día-->
                        <td>{{ $peticiones->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('created_at','<=',old('b_fecha_inicio').' 23:59:59')->whereNotIn('unidad_id',[6,7])->count() }}</td>
                        <!--atendidas en el día-->
                        <td>{{ $peticiones->where('fecha_sistema',old('b_fecha_inicio'))->count() }}</td>
                        <!--pendientes del día-->
                        {{-- <td>{{ $peticiones->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('created_at','<=',old('b_inicio_fecha').' 23:59:59')->where('estado','pendiente')->count() }}</td> --}}
                        <!--dictamenes-->
                        <td>{{ $peticiones->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','dictamen')->whereNotIn('unidad_id',[6,7])->count() }}</td>
                        <!--certificado-->
                        <td>{{ $peticiones->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','certificado')->whereNotIn('unidad_id',[6,7])->count() }}</td>
                        <!--informe-->
                        <td>{{ $peticiones->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','informe')->whereNotIn('unidad_id',[6,7])->count() }}</td>
                        <!--juzgado-->
                        <td>{{ $peticiones->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','salida_juzgado')->whereNotIn('unidad_id',[6,7])->count() }}</td>
                        <!--archivo-->
                        <td>{{ $peticiones->where('fecha_sistema',old('b_fecha_inicio'))->where('documento_emitido','archivo')->whereNotIn('unidad_id',[6,7])->count() }}</td>
                        <!--necros-->
                        {{-- <td>{{ $peticiones->where('fecha_sistema',old('b_fecha_inicio'))->whereIn('solicitud_id',['61','62'])->whereNotIn('unidad_id',[6,7])->count() }}</td> --}}
                        <!--estudios-->
                        <td>{{ $peticiones->where('fecha_sistema',old('b_fecha_inicio'))->whereNotIn('unidad_id',[6,7])->sum('cantidad_estudios') }}</td>
                     </tr>
                  @endisset
                  @empty($peticiones)
                     <tr>
                        <td colspan="11">Elija un a fecha</td>
                     </tr>
                  @endempty
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
