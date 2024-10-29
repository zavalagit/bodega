   @extends('bodega.plantilla')

@section('css')
   <style media="screen">
      

    

   </style>
@endsection

@section('contenido')

<div class="row">
   <form class="col s12" id="form-usuario-editar">
      {{ csrf_field() }}
      <input type="hidden" name="id_user" value="{{$user->id}}">
      <div class="row">
         <div class="input-field col s6">
            <input id="folio" type="text" name="folio" value="{{$user->folio}}">
            <label for="folio">FOLIO</label>
         </div>
         <div class="input-field col s6">
            <input id="name" type="text" name="name" value="{{$user->name}}">
            <label for="name">NOMBRE</label>
         </div>
         <div class="input-field col s6">
            <select name="cargo">
               @foreach ($cargos as $cargo)
                  <option value="{{$cargo->id}}" {{($cargo->id == $user->cargo_id) ? 'selected' : ''}}>{{$cargo->nombre}}</option>
               @endforeach
            </select>
            <label>CARGO</label>
         </div>
         <div class="input-field col s6">
            <select name="unidad">
               @foreach ($unidades->sortBy('nombre')->values() as $i => $unidad)
                  <option value="{{$unidad->id}}" {{($unidad->id == $user->unidad_id) ? 'selected' : ''}}>{{$i+1}}. {{$unidad->nombre}}</option>
               @endforeach
            </select>
            <label>UNIDAD</label>
         </div>
         <div class="input-field col s6">
            <select name="fiscalia">
               @foreach ($fiscalias as $fiscalia)
                  <option value="{{$fiscalia->id}}" {{($fiscalia->id == $user->fiscalia_id) ? 'selected' : ''}}>{{$fiscalia->nombre}}</option>
               @endforeach
            </select>
            <label>FISCALÍA</label>
         </div>
         <div class="input-field col s6">
            <button id="btn-usuario-editar" class="btn waves-effect waves-light" type="submit" name="action">guardar</button>
         </div>
      </div>
   </form>
 </div>
   
@endsection

@section('js')


   <script src="{{asset('js/administrador/usuarios/password.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/administrador/usuarios/usuario_editar.js')}}" charset="utf-8"></script>

@endsection
