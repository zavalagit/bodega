@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      

    

   </style>
@endsection

@section('titulo')
   Reset contraseña
@endsection
@section('seccion', 'RESET CONTRASEÑA')

@section('contenido')

   <section>
      <div class="row">
         <form class="col s12" autocomplete="off">
            <div class="row">
               <div class="input-field col s8" id="input-buscar">
                  @isset($buscar_usuario)
                     <input type="text" name="buscar_usuario" value="{{$buscar_usuario}}">
                  @endisset
                  @empty($buscar_usuario)
                     <input type="text" placeholder="Buscar..." name="buscar_usuario">
                  @endempty
               </div>
               <div class="input-field col s2">
                  <button class="" type="submit"><i class="fas fa-search"></i></button>
               </div>

            </div>
         </form>
      </div>
   </section>

   <div class="row">
      <table class="responsive-table highlight bordered">
         <caption  class="amber"><b>Usuarios</b></caption>
         <thead class=" blue lighten-5">
            <tr>
               <th>No.</th>
               <th>Folio</th>
               <th width="300">Nombre</th>
               <th>Tipo</th>
               <th>Cargo</th>
               <th>Unidad</th>
               <th>Fiscalia</th>
               <th>Institución</th>
               <th>Cadenas</th>
               <th>Editar</th>
               <th>Reset Pass</th>

            </tr>
         </thead>
         <tbody>
            @isset($usuarios)
               @foreach ($usuarios as $key => $user)
               <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$user->folio}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->tipo}}</td>
                  <td>{{$user->cargo->nombre}}</td>
                  <td>{{$user->unidad->nombre}}</td>
                  <td>{{$user->fiscalia->nombre}}</td>
                  <td>{{$user->institucion->nombre}}</td>
                  <td>
                     <a href="/usuario-cadenas/{{$user->id}}"><i class="fas fa-file-pdf"></i></a>
                  </td>
                  <td>
                     <a href="/administrador/usuario-editar/{{$user->id}}">
                        <i class="fas fa-pen"></i>
                     </a>
                  </td>
                  <td>
                     <a href="/administrador/usuario-reset/{{$user->id}}"><i class="fas fa-redo"></i></a>
                  </td>
               </tr>
               @endforeach
            @endisset
            @empty($usuarios)
               <tr>
                  <td colspan="11"> Realice una busqueda </td>
               </tr>
            @endempty
         </tbody>
      </table>
   </div>


  


@endsection

@section('js')


   <script src="{{asset('js/administrador/usuarios/password.js')}}" charset="utf-8"></script>

@endsection
