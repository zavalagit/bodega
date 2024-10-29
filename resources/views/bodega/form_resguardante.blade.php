
@extends('bodega.plantilla')

@section('css')
@endsection

@section('titulo')
   Registrar Resguardante
@endsection

@section('contenido')

<div class="row">
    <form class="col s12" id="form-resguardante">
      <div class="row">
         <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

         <div class="input-field col s6">
            <input id="nombre" type="text" class="validate" name="nombre">
            <label for="nombre">Nombre</label>
         </div>
         <div class="input-field col s6">
            <input id="gafete" type="text" class="validate" name="credencial">
            <label for="gafete">Folio Credencial</label>
         </div>
      </div>    
      <div class="row">
         <div class="input-field col s12">
            <select name="adscripcion">
            <option value="" disabled selected></option>
               @foreach($adscripciones as $key => $adscripcion)
                  <option value="{{$adscripcion->id}}">{{$adscripcion->nombre}}</option>   
               @endforeach
            </select>
            <label>Lugar de Adscripción</label>
         </div>
      </div>
      <div class="row">
         <div class="input-field col s12">
            <div class="input-field col s12">
            <select name="cargo">
            <option value="" disabled selected></option>
            @foreach($cargos as $key => $cargo)
                  <option value="{{$cargo->id}}">{{$cargo->nombre}}</option>   
               @endforeach
            </select>
            <label>Cargo del Resguardante</label>
         </div>
         </div>
      </div>
      <div class="row">
         <div class="input-field col s12">         
            <div class="file-field input-field">
               <div class="btn">
                  <span>Identificación</span>
                  <input type="file">
               </div>
               <div class="file-path-wrapper">
                  <input class="file-path validate" type="text">
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col s3 offset-s10">
            <button class="btn waves-effect waves-light" type="submit" name="action" id="btn-resguardante">
               Registar
            </button>
         </div>
      </div>
    </form>
  </div>

{{--}}
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
         <div class="input-field col s6 offset-s3">
            <select name="tipo">
               <option value="" disabled selected>Tipo de usuario</option>
               <option value="administrador">Administrador</option>
               <option value="responsable_de_bodega">Responsable de Bodega</option>
               <option value="profesional_espespecializado">Profesional Especializado</option>
               <option value="usuario">Usuario</option>
            </select>
         </div>
      </div>
      <div class="row">
         <div class="input-field col s3 offset-s3">
            <input id="folio" type="text" required value="{{old('folio')}}" name="folio">
            <label for="folio">Folio</label>
         </div>
         <div class="input-field col s3">
            <select name="unidad">
            <option value="" disabled selected>Unidad</option>
               @foreach ($unidades as $key => $unidad)
                  <option value="{{$unidad->id}}">{{$unidad->nombre}}</option>
               @endforeach
            </select>
         </div>
      </div>
      <div class="row">
         <div class="input-field col s6 offset-s3">
            <input id="usuario" type="text" required value="{{old('name')}}" name="name">
            <label for="usuario">Nombre</label>
         </div>
      </div>
      <div class="row">
         <div class="input-field col s6 offset-s3">
            <select name="cargo">
            <option value="" disabled selected>Cargo</option>
               @foreach ($cargos as $key => $cargo)
                  <option value="{{$cargo->id}}">{{$cargo->nombre}}</option>
               @endforeach
            </select>
         </div>
      </div>
      <div class="row">
         <div class="input-field col s6 offset-s3">
            <input id="password" type="password" required name="password">
            <label for="password">Contraseña</label>
         </div>
      </div>
      <div class="row">
         <div class="input-field col s6 offset-s3">
            <input id="password-confirm" type="password" required name="password_confirmation">
            <label for="password">Confirmar contraseña</label>
         </div>
      </div>
      <div class="row">
         <div class="col s3 offset-s7">
            <button class="btn waves-effect waves-light" type="submit" name="action">
               Registar
            </button>
         </div>
      </div>
   </form>
--}}   
@endsection

@section('js')
   <script type="text/javascript">
      $('.li-cedulas').removeClass('active');
      $('.li-cadenas').addClass('active').css({'font-weight':'bold'});
   </script>


@endsection
