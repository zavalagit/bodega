@extends('plantillas.plantilla_sin_menu')

@section('css')
   <link rel="stylesheet" href="{{asset('/css/tablas.css')}}">
   <link rel="stylesheet" href="{{asset('/css/block.css')}}">
   <link rel="stylesheet" href="{{asset('/css/btn.css')}}">
   <link rel="stylesheet" href="{{asset('/css/hr.css')}}">
   <link rel="stylesheet" href="{{asset('/css/colores.css')}}">
   <style media="screen">
      /*code css*/
   </style>
@endsection


@section('titulo')
   Reingreso
@endsection

@section('seccion')
    REINGRESO DE CADENA CON FOLIO {{$prestamo->cadena->folio_bodega}}
@endsection

@section('contenido')

   <div class="row">
      <form class="" id="form-reingreso">
         <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
         <input type="hidden" name="prestamos[]" value="{{$prestamo->id}}">
         <input type="hidden" id="prestamo-etapa" name="prestamo_etapa" value="reingreso">
      
         <div class="col s12">
            <table>
               <thead>
                  <tr>                                       
                     <th>IDENTIFICADOR</th>
                     <th>DESCRIPCIÓN</th>
                     <th>NÚMERO DE INDICIOS</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($prestamo->indicios as $key => $indicio)
                     <tr>                        
                        <td width="10%">{{$indicio->identificador}}</td>
                        <td>{{$indicio->descripcion}}</td>
                        <td width="10%"><input type="text" name="numero_indicios[]" value="{{$indicio->numero_indicios}}"></td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         @include('prestamo.reingreso_datos')
      </form>
   </div>

@endsection

@section('js')
   <script src="{{asset('js/general/hora_fecha_actual.js')}}"></script>
   <script src="{{asset('js/modelo/get_modelo.js')}}"></script>
   <script src="{{asset('js/prestamo/reingreso_save.js')}}"></script>
   {{-- <script src="{{asset('js/reingreso.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/rb_cambiar.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/resguardante.js')}}"></script> --}}
@endsection
