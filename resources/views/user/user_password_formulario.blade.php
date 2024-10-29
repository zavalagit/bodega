@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      

    

   </style>
@endsection

@section('contenido')

   <h4>{{$user->folio}} - {{$user->name}}</h4>

   <div class="row">
      <form class="col s12" id="form-user-password" >
         {{ csrf_field() }}
         <input type="hidden" id="id-user" name="id_user" value="{{$user->id}}">
         <div class="row">
            <div class="input-field col s8 offset-s2">
               <input id="password" type="text" required name="password">
               <label for="password">Contraseña</label>
            </div>
            <div class="input-field col s8 offset-s2">
               <input id="password-confirm" type="text" required name="password_confirmation">
               <label for="password">Confirmar contraseña</label>
            </div>
         </div>
         <div class="row">
            <div class="input-field col s6">
               <button class="" id="btn-user-password-guardar" type="submit" name="action">guardar</button>
            </div>         
         </div>
      </form>
   </div>


  


@endsection

@section('js')


   <script src="{{asset('js/user/user_password_guardar.js')}}" charset="utf-8"></script>

@endsection
