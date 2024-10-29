@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      

    

   </style>
@endsection

@section('contenido')

<div class="row">
   <form class="col s12" id="form-unidad">
      {{ csrf_field() }}
      <input type="hidden" id="id-unidad" value="{{ ($unidad_bandera) ? "{$unidad->id}" : 0 }}">
      <div class="row">
         <div class="input-field col s12">
            <input id="nombre" type="text" name="nombre" value="{{ ($unidad_bandera) ? "{$unidad->nombre}" : '' }}">
            <label for="nombre">NOMBRE</label>
         </div>
      </div>
      <div class="row">
         <div class="col s12">
            <blockquote>
               <h6> <b>¿Pertenece a la Coordinación?</b> </h6>
            </blockquote>
         </div>
         <div class="col s6">
            <p>
              <input type="radio" id="coordinacion-si" name="coordinacion" value="si" {{ ( $unidad_bandera && ($unidad->coordinacion == 'si') ) ? 'checked="checked"' : '' }}/>
              <label for="coordinacion-si">Si</label>
            </p>
         </div>
         <div class=" col s6">
            <p>
              <input type="radio" id="coordinacion-no" name="coordinacion" value="no" {{ ( $unidad_bandera && ($unidad->coordinacion == 'no') ) ? 'checked="checked"' : '' }}/>
              <label for="coordinacion-no">No</label>
            </p>
         </div>
      </div>
      <div class="row">
         <div class="col s12">
            <blockquote>
               <h6> <b>¿Debe figurar en Peticiones?</b> </h6>
            </blockquote>
         </div>
         <div class="col s6">
            <p>
              <input type="radio" id="peticion-si" name="peticion" value="si" {{ ( $unidad_bandera && ($unidad->peticion == 'si') ) ? 'checked="checked"' : '' }}/>
              <label for="peticion-si">Si</label>
            </p>
         </div>
         <div class=" col s6">
            <p>
              <input type="radio" id="peticion-no" name="peticion" value="no" {{ ( $unidad_bandera && ($unidad->peticion == 'no') ) ? 'checked="checked"' : '' }}/>
              <label for="peticion-no">No</label>
            </p>
         </div>
      </div>
      <div class="row">
         <div class="input-field col s6">
            <button id="btn-unidad-guardar" class="btn waves-effect waves-light" type="submit" name="action">guardar
            </button>
         </div>
      </div>
   </form>
 </div>
   
@endsection

@section('js')

   <script src="{{asset('js/unidad/unidad_guardar.js')}}" charset="utf-8"></script>

@endsection
