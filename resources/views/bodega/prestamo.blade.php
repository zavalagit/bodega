@extends('plantillas.plantilla_sin_menu')

@section('css')
   <link rel="stylesheet" href="{{asset('/css/tablas.css')}}">
   <link rel="stylesheet" href="{{asset('/css/block.css')}}">
   <link rel="stylesheet" href="{{asset('/css/btn.css')}}">
   <link rel="stylesheet" href="{{asset('/css/hr.css')}}">
   <link rel="stylesheet" href="{{asset('/css/colores.css')}}">

   <style>
   
   </style>

@endsection

@section('seccion')
    PRESTAMO DE CADENA CON FOLIO {{$cadena->folio_bodega}}
@endsection

@section('contenido')
   {{-- <div class="amber">
      <h5 class="center-align">
         <b>PRESTAMO CADENA {{$cadena->folio_bodega}}</b>
      </h5>
   </div> --}}

   <div class="row">
      <form class="" id="form-prestamo" >
         <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
         <input type="hidden" name="id_cadena" value="{{$cadena->id}}">
         <input type="hidden" id="prestamo-tipo" name="prestamo_unico" value="prestamo_unico" data-prestamo-tipo="prestamo-unico">
         <input type="hidden" id="prestamo-etapa" name="prestamo_etapa" value="prestamo">

         <div class="col s12">
            <table>
               @if ($cadena->indicios->count() > 3)
                  <thead>
                     <tr>
                        <th width="6%" class="th-center">
                           <input class="filled-in" type="checkbox" id="select-indicios" data-cantidad-identificadores="{{$cadena->indicios->count()}}" data-num="{{$cadena->indicios->sum('numero_indicios')}}" name=""/>
                           <label for="select-indicios"></label>
                        </th>
                        <th colspan="3"><b>SELECCIONA TODOS LOS INDICIO/EVIDENCIAS</b></th>
                     </tr>
                  </thead>
               @endif
               <thead>
                  <tr>
                     <th class="th-center">SELECCIONAR</th>
                     <th>IDENTIFICADOR</th>
                     <th>DESCRIPCIÓN</th>
                     <th class="th-center">NO. INDICIOS</th>
                     {{-- <th>ESTADO</th> --}}
                  </tr>
               </thead>
               <tbody>
                  @foreach($cadena->indicios as $key => $indicio)
                     <tr style="{{($indicio->estado != 'activo') ? 'background-color:#c6c6c6' : ''}}">
                        <td width="6%" class="td-center">
                           <input type="checkbox" id="indicio-{{$indicio->id}}" class="indicio-checkbox filled-in" data-num="{{$indicio->numero_indicios}}" name="indicios[]" value={{$indicio->id}} {{($indicio->estado != 'activo') ? 'disabled' : ''}}/>
                           <label for="indicio-{{$indicio->id}}"></label>
                        </td>
                        <td width="10%">{{$indicio->identificador}}</td>
                        <td>{{$indicio->descripcion}}</td>
                        <td width="10%" class="td-center">{{$indicio->numero_indicios}}</td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>

         @include('prestamo.prestamo_datos')

      </form>
   </div>


@endsection

@section('js')
   <script src="{{asset('js/numero_indicios.js')}}"></script>
   <script src="{{asset('js/general/hora_fecha_actual.js')}}"></script>
   <script src="{{asset('js/modelo/get_modelo.js')}}"></script>
   <script src="{{asset('js/modelo/input_autocomplete.js')}}"></script>
   <script src="{{asset('js/indicio/indicios_select_todo.js')}}"></script>
   <script src="{{asset('js/prestamo/prestamo_crear.js')}}"></script>
@endsection
