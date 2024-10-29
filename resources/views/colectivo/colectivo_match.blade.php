@extends('plantilla.template_sin_menu')

{{--item menu selected--}}
@section('nombre_pagina','vista-colectivo-registrar')
@section('nombre_submenu','submenu-colectivos')

@section('seccion',"Coincidencia de registros")

@section('css')
   <link rel="stylesheet" href="{{asset('css/hr.css')}}">
   <link rel="stylesheet" href="{{asset('css/btn.css')}}">
   <link rel="stylesheet" href="{{asset('css/tablas.css')}}">
@endsection

@section('contenido')

<div class="row">
   <form id="form-grupo-familiar" class="col s12" action="{{route('colectivo_grupo_familiar_save')}}" method="POST">
      {{ csrf_field() }}
      <div class="row">
         <!--input grupo familiar-->
         <div class="input-field col s5">
            <input type="text" id="colectivo-grupo-familiar" autofocus name="colectivo_grupo_familiar" value="">
            <label for="colectivo-grupo-familiar"><i class="fas fa-users"></i> ~ GRUPO FAMILIAR*</label>
         </div>
         <!--checkbox-->
         <div class="col s12">
            <p>
               <label>
                 <input type="checkbox" class="filled-in" checked name="colectivo_id[]" value="{{$colectivo->id}}"/>
                 <span>{{$colectivo->created_at}} ~ {{$colectivo->fiscalia->nombre}} ~ {{$colectivo->colectivo_donante}}</span>
               </label>
            </p>
            @foreach ($colectivos as $c)
            <p>
               <label>
                 <input type="checkbox" class="filled-in" name="colectivo_id[]" value="{{$c->id}}"/>
                 <span>{{$c->created_at}} ~ {{$c->fiscalia->nombre}} ~ {{$c->colectivo_donante}}</span>
               </label>
             </p>
            @endforeach
         </div>
         <!--btn submit-->
         <div class="input-field col s12 m12 l1">
            <button type="submit" id="btn-grupo-familiar" class="btn-grupo-familiar">GUARDAR</button>
         </div>
      </div>
   </form>
   <div class="col s12">
      <hr class="hr-3">
   </div>
</div>

<div class="row">
   <div class="col s12">
      <table class="tabla bordered">
         <caption>REFERENCIA</caption>
         <thead>
            <tr>
               <th rowspan="2" class="th-center">Nº</th>
               <th>GRUPO FAMILIAR</th>
               <th>FECHA DE REGISTRO</th>
               <th>REGIÓN</th>
               <th>NOMBRE DEL CIUDADANO</th>
               <th>FECHA DE TOMA DE MUESTRA</th>
               <th>PRUEBAS</th>
            </tr>
            <tr>
               <th colspan="2">PERSONA DESAPARECIDA</th>
               <th colspan="2">PARENTESCO</th>
               <th>OTRO PARENTESCO</th>
               <th>FECHA DE DESAPARICIÓN</th>
            </tr>
         </thead>
            <tbody>
               @php $filas = $colectivo->pruebas->count(); @endphp
               <tr>
                  <!--nº-->
                  <td rowspan="{{$filas + $colectivo->parentescos->count()}}" width="2%" class="td-contador">1</td>
                  <!--grupo familiar-->
                  <td rowspan="{{$filas}}">{{$colectivo->colectivo_grupo_familiar ?? '---'}}</td>
                  <!--fecha de registro-->
                  <td rowspan="{{$filas}}" width="10%">{{date('H:i:s ~ d-m-Y',strtotime($colectivo->created_at))}}</td>
                  <!--región-->
                  <td rowspan="{{$filas}}" width="10%">{{$colectivo->fiscalia->nombre}}</td>
                  <!--persona muestreo-->
                  <td rowspan="{{$filas}}" width="20%">{{$colectivo->colectivo_donante}}</td>
                  <!--fecha muestreo-->
                  <td rowspan="{{$filas}}" width="10%">{{($colectivo->colectivo_fecha)}}</td>
                  <!--pruebas-->
                  @foreach ($colectivo->pruebas->sortBy('nombre') as $prueba)
                     @if (!$loop->first)
                     <tr>
                     @endif
                     <td width="20%" class="{{ ($loop->first) ? '' : 'td-no-border-left' }}">{{$prueba->nombre}}</td>
                     </tr>
                  @endforeach

               @foreach ($colectivo->parentescos as $parentesco)
                   <tr>
                      <td colspan="2">{{$parentesco->pivot->ausente_nombre}}</td>
                      <td colspan="2">{{$parentesco->nombre}}</td>
                      <td>{{$parentesco->pivot->parentesco_otro ?? '---'}}</td>
                      <td>{{$parentesco->pivot->ausente_fecha_desaparicion ?? '---'}}</td>
                   </tr>
               @endforeach
            </tbody>
         </tbody>
      </table>
   </div>
   <div class="col s12">
      <hr class="hr-3">
   </div>
</div>

<div class="row">
   <div class="col s12 right-align">
      <span style="background-color: #c09f77; font-weight:bold; padding: 5px; color:#152f4a">
         Conincidencia con {{$colectivos->count()}} {{($colectivos->count() > 1) ? 'registros' : 'registro'}}
      </span>
   </div>
</div>

<!-- regitros match-->
<div class="row">
   <div class="col s12">
      <table class="tabla bordered">
         <caption>COINCIDENCIAS</caption>
         <thead>
            <tr>
               <th rowspan="2" class="th-center">Nº</th>
               <th>GRUPO FAMILIAR</th>
               <th>FECHA DE REGISTRO</th>
               <th>REGIÓN</th>
               <th>NOMBRE DEL CIUDADANO</th>
               <th>FECHA DE TOMA DE MUESTRA</th>
               <th>PRUEBAS</th>
            </tr>
            <tr>
               <th colspan="2">PERSONA DESAPARECIDA</th>
               <th colspan="2">PARENTESCO</th>
               <th>OTRO PARENTESCO</th>
               <th>FECHA DE DESAPARICIÓN</th>
            </tr>
         </thead>
         @forelse ($colectivos->sortBy('created_at')->values() as $key => $colectivo)
            <tbody>
               @php $filas = $colectivo->pruebas->count(); @endphp
               <tr class="{{ ( ($key+1)%2 ) ? '' : 'row-color' }}">
                  <!--nº-->
                  <td rowspan="{{$filas + $colectivo->parentescos->count()}}" width="2%" class="td-contador">{{$key+1}}</td>
                  <!--grupo familiar-->
                  <td rowspan="{{$filas}}">{{$colectivo->colectivo_grupo_familiar ?? '---'}}</td>
                  <!--fecha de registro-->
                  <td rowspan="{{$filas}}" width="10%">{{date('H:i:s ~ d-m-Y',strtotime($colectivo->created_at))}}</td>
                  <!--región-->
                  <td rowspan="{{$filas}}" width="10%">{{$colectivo->fiscalia->nombre}}</td>
                  <!--persona muestreo-->
                  <td rowspan="{{$filas}}" width="20%">{{$colectivo->colectivo_donante}}</td>
                  <!--fecha muestreo-->
                  <td rowspan="{{$filas}}" width="10%">{{($colectivo->colectivo_fecha)}}</td>
                  <!--pruebas-->
                  @foreach ($colectivo->pruebas->sortBy('nombre') as $prueba)
                     @if (!$loop->first)
                     <tr class="{{ ( ($key+1)%2 ) ? '' : 'row-color' }}">
                     @endif
                     <td width="20%" class="{{ ($loop->first) ? '' : 'td-no-border-left' }}">{{$prueba->nombre}}</td>
                     </tr>
                  @endforeach

               @foreach ($colectivo->parentescos as $parentesco)
                   <tr class="{{ ( ($key+1)%2 ) ? '' : 'row-color' }}">
                      <td colspan="2">{{$parentesco->pivot->ausente_nombre}}</td>
                      <td colspan="2">{{$parentesco->nombre}}</td>
                      <td>{{$parentesco->pivot->parentesco_otro ?? '---'}}</td>
                      <td>{{$parentesco->pivot->ausente_fecha_desaparicion ?? '---'}}</td>
                   </tr>
               @endforeach
            </tbody>
            @empty
               <tr><td colspan="13">No hay nada :(</td></tr>
            @endforelse
         
         </tbody>
      </table>
   </div>
</div>
   

@endsection

@section('js')
<script src="{{asset('js/colectivo/colectivo_form_grupo_familiar.js')}}"></script>
   {{-- <script src="{{asset('js/materialize/materialize_select.js')}}"></script> --}}
   {{-- <script src="{{asset('js/colectivo/colectivo_form.js')}}"></script> --}}
   {{-- <script src="{{asset('js/colectivo/colectivo_form_lugar_procedencia.js')}}"></script> --}}
   {{-- <script src="{{asset('js/colectivo/colectivo_form_pruebas.js')}}"></script> --}}
   {{-- <script src="{{asset('js/colectivo/colectivo_parentesco.js')}}"></script> --}}
   {{-- <script src="{{asset('js/colectivo/colectivo_parentesco_otro.js')}}"></script> --}}
   {{-- <script src="{{asset('js/general/hora_fecha_actual.js')}}"></script> --}}
@endsection