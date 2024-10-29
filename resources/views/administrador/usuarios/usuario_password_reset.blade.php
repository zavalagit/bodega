@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      blockquote{
         padding: 1px 0 !important;
         background-color: #152f4a !important;
         color: #c6c6c6 !important;
         border-left: 5px solid #c09f77 !important;
      }

    

   </style>
@endsection

@section('titulo')
   Cambiar contraseña
@endsection
@section('seccion', 'CAMBIAR CONTRASEÑA')

@section('contenido')

<div class="row">
   
     <div class="row">
       <div class="input-field col s6">
         <input id="folio" type="text" name="folio" value="{{$user->folio}}" readonly>
         <label for="folio">FOLIO</label>
       </div>
       <div class="input-field col s6">
         <input id="name" type="text" name="name" value="{{$user->name}}" readonly>
         <label for="name">NOMBRE</label>
       </div>
       <div class="input-field col s6">
         <input id="cargo" type="text" name="cargo" value="{{$user->cargo->nombre}}" readonly>
         
          <label>CARGO</label>
       </div>
       <div class="input-field col s6">
         <input id="unidad" type="text" name="unidad" value="{{$user->unidad->nombre}}" readonly>
         
          <label>UNIDAD</label>
       </div>
       <div class="input-field col s6">
         <input id="fiscalia" type="text" name="fiscalia" value="{{$user->fiscalia->nombre}}" readonly>
         
          <label>FISCALÍA</label>
       </div>
      </div> 
      <section id="identidad">
         <blockquote class="center-align">
           <h6><b>NUEVA CONTRASEÑA (REGISTRE SU NUEVA CONTRASEÑA)</b></h6>
         </blockquote> 
   <form class="col s12" id="form-usuario-editar-password" action="POST" >
      {{ csrf_field() }}
         <input type="hidden" name="id_user" value="{{$user->id}}">
               <div class="row">
                  <div class="input-field col s8 offset-s2">
                     <input id="password" type="text" required name="password">
                     <label for="password">Contraseña</label>
                  </div>
               </div>
               <div class="row">
                  <div class="input-field col s8 offset-s2">
                     <input id="password-confirm" type="text" required name="password_confirmation">
                     <label for="password">Confirmar contraseña</label>
                  </div>
               </div>
               <div class="input-field col s6">
                  <button id="btn-usuario-reset-password" class="btn waves-effect waves-light" type="submit" name="action">guardar
                  </button>
               </div>
      </section>         
     
   </form>
 </div>
   
@endsection

@section('js')


   <script src="{{asset('js/administrador/usuarios/password.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/administrador/usuarios/usuario_editar.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/administrador/usuarios/usuario_editar_passwor.js')}}" charset="utf-8"></script>
@endsection
