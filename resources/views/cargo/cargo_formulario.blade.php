@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      

    

   </style>
@endsection

@section('contenido')

<div class="row">
   <form class="col s12" id="form-cargo">
      {{ csrf_field() }}
      <input type="hidden" id="id-cargo" value="{{ ($cargo_bandera) ? "{$cargo->id}" : 0 }}">
      <div class="row">
         <div class="input-field col s12">
            <input id="nombre" type="text" name="nombre" value="{{ ($cargo_bandera) ? "{$cargo->nombre}" : '' }}">
            <label for="nombre">NOMBRE</label>
         </div>
      </div>
      
      <div class="row">
         <div class="input-field col s6">
            <button id="btn-cargo-guardar" class="btn waves-effect waves-light" type="submit" name="action">guardar
            </button>
         </div>
      </div>
   </form>
 </div>
   
@endsection

@section('js')

   <script src="{{asset('js/cargo/cargo_guardar.js')}}" charset="utf-8"></script>

@endsection
