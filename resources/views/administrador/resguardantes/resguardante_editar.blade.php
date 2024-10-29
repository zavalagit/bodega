@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      

    

   </style>
@endsection

@section('contenido')

<div class="row">
   <form class="col s12" id="form-resguardante-editar">
      {{ csrf_field() }}
      <input type="hidden" id="id-resguardante" name="id_resguardante" value="{{$resguardante->id}}">
     <div class="row">
       <div class="input-field col s6">
         <input id="folio" type="text" name="folio" value="{{$resguardante->folio}}">
         <label for="folio">FOLIO</label>
       </div>
       <div class="input-field col s6">
         <input id="nombre" type="text" name="nombre" value="{{$resguardante->nombre}}">
         <label for="nombre">NOMBRE</label>
       </div>
       <div class="input-field col s6">
         <select name="cargo">
            @foreach ($cargos as $cargo)
               @if ($cargo->id == $resguardante->cargo_id)
                  <option value="{{$cargo->id}}" selected>{{$cargo->nombre}}</option>
               @else
                  <option value="{{$cargo->id}}">{{$cargo->nombre}}</option>
               @endif
            @endforeach
          </select>
          <label>CARGO</label>
       </div>
       {{-- <div class="input-field col s6">
         <select name="unidad">
            @foreach ($unidades as $unidad)
               @if ($unidad->id == $resguardante->unidad_id)
                  <option value="{{$unidad->id}}" selected>{{$unidad->nombre}}</option>
               @else
                  <option value="{{$unidad->id}}">{{$unidad->nombre}}</option>
               @endif
            @endforeach
          </select>
          <label>UNIDAD</label>
       </div>
       <div class="input-field col s6">
         <select name="fiscalia">
            @foreach ($fiscalias as $fiscalia)
               @if ($fiscalia->id == $resguardante->fiscalia_id)
                  <option value="{{$fiscalia->id}}" selected>{{$fiscalia->nombre}}</option>
               @else
                  <option value="{{$fiscalia->id}}">{{$fiscalia->nombre}}</option>
               @endif
            @endforeach
          </select>
          <label>FISCALÍA</label>
       </div> --}}
       <div class="input-field col s6">
         <button id="btn-usuario-editar" class="btn waves-effect waves-light" type="submit" name="action">guardar
          </button>
       </div>
     </div>
   </form>
 </div>
   
@endsection

@section('js')

   <script src="{{asset('js/resguardantes/resguardante_editar.js')}}" charset="utf-8"></script>

@endsection
