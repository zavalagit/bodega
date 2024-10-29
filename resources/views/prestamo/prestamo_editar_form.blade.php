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

@section('seccion')
  EDITAR PRESTAMO - CADENA CON FOLIO {{$prestamo->cadena->folio_bodega}}
@endsection

@section('contenido')
  
  <div class="row">
    <div class="col s12">
      <table>
        <thead>
          <tr>
            <th>IDENTIFICADOR</th>
            <th>DESCRIPCIÓN</th>
            <th>NO. INDICIOS</th>
          </tr>
        </thead>
        <tbody>
          @foreach($prestamo->indicios as $key => $indicio)
            <tr>
              <td width="10%"><b>{{$indicio->identificador}}</b></td>
              <td>{{$indicio->descripcion}}</td>
              <td width="10%">{{$indicio->numero_indicios}}</td>                     
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <form class="" id="form-prestamo-editar">
      <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
      <input type="hidden" id="id-prestamo" name="prestamos[]" value="{{$prestamo->id}}">
      {{-- <input type="hidden" id="prestamo-editar-tipo" name="prestamo_editar_tipo" value="unico"> --}}
      <input type="hidden" id="prestamo-etapa" name="prestamo_etapa" value="editar">
      <input type="hidden" id="prestamo-estado" name="prestamo_estado" value="{{$prestamo->estado}}">
      <!--prestamo datos-->
      @include('prestamo.prestamo_datos')
      
      <div class="col s12">
        <hr class="hr-main">
      </div>
      
      <!--reingreso datos-->
      @if($prestamo->estado == 'concluso')
        @include('prestamo.reingreso_datos')

        <div class="col s12">
          <hr class="hr-main">
        </div>
      @endif 

      <div class="col s12 l1 offset-l11">
        <button class="btn-guardar" id="btn-prestamo-editar" style="display: inline-block !important; width:100%;" type="submit" >editar</button>
      </div>
    </form>
  </div>

@endsection

@section('js')
  <script src="{{asset('js/prestamo/prestamo_editar.js')}}"></script>
  <script src="{{asset('js/modelo/get_modelo.js')}}"></script>
  <script src="{{asset('js/modelo/input_autocomplete.js')}}"></script>
@endsection