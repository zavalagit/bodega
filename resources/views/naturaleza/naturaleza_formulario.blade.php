@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      

    

   </style>
@endsection

@section('contenido')

<div class="row">
   <form class="col s12" id="form-naturaleza">
      {{ csrf_field() }}
      <input type="hidden" id="id-naturaleza" value="{{ ($naturaleza_bandera) ? "{$naturaleza->id}" : 0 }}">
      <div class="row">
         <div class="input-field col s12">
            <input id="nombre" type="text" name="nombre" value="{{ ($naturaleza_bandera) ? "{$naturaleza->nombre}" : '' }}">
            <label for="nombre">NOMBRE</label>
         </div>
      </div>
      
      <div class="row">
         <div class="input-field col s6">
            <button id="btn-naturaleza-guardar" class="btn waves-effect waves-light" type="submit" name="action">guardar
            </button>
         </div>
      </div>
   </form>
 </div>
   
@endsection

@section('js')

   <script src="{{asset('js/naturaleza/naturaleza_guardar.js')}}" charset="utf-8"></script>

@endsection
