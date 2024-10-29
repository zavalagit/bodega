@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      

    

   </style>
@endsection

@section('contenido')

<div class="row">
   <form class="col s12" id="form-fiscalia">
      {{ csrf_field() }}
      <input type="hidden" id="id-fiscalia" value="{{ ($fiscalia_bandera) ? "{$fiscalia->id}" : 0 }}">
      <div class="row">
         <div class="input-field col s12">
            <input id="nombre" type="text" name="nombre" value="{{ ($fiscalia_bandera) ? "{$fiscalia->nombre}" : '' }}">
            <label for="nombre">NOMBRE</label>
         </div>
      </div>
      
      <div class="row">
         <div class="input-field col s6">
            <button id="btn-fiscalia-guardar" class="btn waves-effect waves-light" type="submit" name="action">guardar
            </button>
         </div>
      </div>
   </form>
 </div>
   
@endsection

@section('js')

   <script src="{{asset('js/fiscalia/fiscalia_guardar.js')}}" charset="utf-8"></script>

@endsection
