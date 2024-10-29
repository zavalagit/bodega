@extends('bodega.plantilla')

@section('css')
@endsection

@section('contenido')

   <form class="col s12" method="post" id="form-capturar-perito">
      <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
      
      <div class="row">
         <div class="input-field col s8 offset-s2">
            <input id="folio" type="text" autocomplete="off" required value="{{old('folio')}}" name="folio">
            <label for="folio">FOLIO CREDENCIAL</label>
         </div>
         <div class="input-field col s8 offset-s2">
            <input id="nombre" type="text" autocomplete="off" required value="{{old('nombre')}}" name="nombre">
            <label for="nombre">NOMBRE</label>
         </div>         
      </div>
      <div class="row">
         <div class="input-field col s2 offset-s2">
            <select name="institucion">
            <option value="" disabled selected></option>
               @foreach ($instituciones as $key => $institucion)
                  <option value="{{$institucion->id}}">{{$institucion->nombre}}</option>
               @endforeach
            </select>
            <label>Institución</label>
         </div>
         <div class="input-field col s2">
            <select name="fiscalia">
            <option value="" disabled selected></option>
               @foreach ($fiscalias as $key => $fiscalia)
                  <option value="{{$fiscalia->id}}">{{$fiscalia->nombre}}</option>
               @endforeach
            </select>
            <label>Fiscalia</label>
         </div>
         <div class="input-field col s2">
            <select name="unidad">
            <option value="" disabled selected></option>
               @foreach ($unidades as $key => $unidad)
                  <option value="{{$unidad->id}}">{{$unidad->nombre}}</option>
               @endforeach
            </select>
            <label>Unidad</label>
         </div>
         <div class="input-field col s2">
            <select name="cargo">
            <option value="" disabled selected></option>
               @foreach ($cargos as $key => $cargo)
                  <option value="{{$cargo->id}}">{{$cargo->nombre}}</option>
               @endforeach
            </select>
            <label>cargo</label>
         </div>
      </div>
   
      <div class="row">
         <div class="col s3 offset-s8">
            <button class="btn waves-effect waves-light" type="submit" id="btn-guardar-perito">
               Registar
            </button>
         </div>
      </div>
   </form>

@endsection

@section('js')
   <script src="{{asset('js/perito.js')}}" charset="utf-8"></script>
@endsection
