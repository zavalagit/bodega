@extends('bodega.plantilla')

@section('css')
@endsection

@section('contenido')

   
   @if ($errors->has('tipo'))
      <div class="row">
         <div class="col s6 offset-s3 red lighten-1 center-align">
            <strong class="white-text">{{ $errors->first('tipo') }}</strong>
         </div>
      </div>
   @elseif ($errors->has('folio'))
      <div class="row">
         <div class="col s6 offset-s3 red lighten-1 center-align">
            <strong class="white-text">{{ $errors->first('folio') }}</strong>
         </div>
      </div>
   @elseif ($errors->has('name'))
      <div class="row">
         <div class="col s6 offset-s3 red lighten-1 center-align">
            <strong class="white-text">{{ $errors->first('name') }}</strong>
         </div>
      </div>
   @elseif ($errors->has('institucion'))
      <div class="row">
         <div class="col s6 offset-s3 red lighten-1 center-align">
            <strong class="white-text">{{ $errors->first('institucion') }}</strong>
         </div>
      </div>
   @elseif ($errors->has('fiscalia'))
      <div class="row">
         <div class="col s6 offset-s3 red lighten-1 center-align">
            <strong class="white-text">{{ $errors->first('fiscalia') }}</strong>
         </div>
      </div>
   @elseif ($errors->has('unidad'))
      <div class="row">
         <div class="col s6 offset-s3 red lighten-1 center-align">
            <strong class="white-text">{{ $errors->first('unidad') }}</strong>
         </div>
      </div>
   @elseif ($errors->has('cargo'))
      <div class="row">
         <div class="col s6 offset-s3 red lighten-1 center-align">
            <strong class="white-text">{{ $errors->first('cargo') }}</strong>
         </div>
      </div>
   @elseif ($errors->has('password'))
      <div class="row">
         <div class="col s6 offset-s3 red lighten-1 center-align">
            <strong class="white-text">{{ $errors->first('password') }}</strong>
         </div>
      </div>
   @endif


   <form class="col s12" method="post" action="{{ route('register') }}">
      {{ csrf_field() }}
      <div class="row">
         <div class="input-field col s8 offset-s2">
            <select name="tipo">
               @if(Auth::user()->folio === 'S0502')
                  <option value="" disabled selected>Tipo de usuario</option>
                  <option value="administrador">Administrador</option>
                  <option value="responsable_bodega">Responsable de Bodega</option>
                  <option value="admin_peticiones">Administrador de peticiones</option>
                  <option value="profesional_espespecializado">Profesional Especializado</option>
               @endif
               <option value="usuario">Usuario</option>
            </select>
         </div>
      </div>
      <div class="row">
         <div class="input-field col s2 offset-s2">
            <input id="folio" type="text" autocomplete="off" required value="{{old('folio')}}" name="folio">
            <label for="folio">Folio Credencial</label>
         </div>
         <div class="input-field col s6">
            <input id="usuario" type="text" autocomplete="off" required value="{{old('name')}}" name="name">
            <label for="usuario">Nombre</label>
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
         
      </div>
      <div class="row">
         <div class="input-field col s8 offset-s2">
            <input id="password" type="password" required name="password">
            <label for="password">Contraseña</label>
         </div>
      </div>
      <div class="row">
         <div class="input-field col s8 offset-s2">
            <input id="password-confirm" type="password" required name="password_confirmation">
            <label for="password">Confirmar contraseña</label>
         </div>
      </div>
      <div class="row">
         <div class="col s3 offset-s8">
            <button class="btn waves-effect waves-light" type="submit" name="action">
               Registar
            </button>
         </div>
      </div>
   </form>

@endsection

@section('js')
@endsection
