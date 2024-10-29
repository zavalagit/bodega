@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      

    

   </style>
@endsection

@section('contenido')

   <section>
      <div class="row">
         <form class="col s12" autocomplete="off">
            <div class="row">
               <div class="input-field col s8" id="input-buscar">
                  @isset($buscar_resguardante)
                     <input type="text" name="buscar_resguardante" value="{{$buscar_resguardante}}">
                  @endisset
                  @empty($buscar_resguardante)
                     <input type="text" placeholder="Buscar..." name="buscar_resguardante">
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
               <th>Cargo</th>
               <th>Unidad</th>
               <th>Institución</th>
               <th>Editar</th>
            </tr>
         </thead>
         <tbody>
            @isset($resguardantes)
               @forelse ($resguardantes as $key => $reguardante)
                  <tr>
                     <td>{{$key+1}}</td>
                     <td>{{$reguardante->folio}}</td>
                     <td>{{$reguardante->nombre}}</td>
                     <td>{{$reguardante->cargo->nombre}}</td>
                     <td>{{$reguardante->unidad->nombre}}</td>
                     <td>{{$reguardante->institucion->nombre}}</td>
                     <td>
                        <a href="/administrador/resguardante-editar/{{$reguardante->id}}">
                           <i class="fas fa-pen"></i>
                        </a>
                     </td>
                  </tr>
               @empty
                  <tr>
                     <td colspan="11"> No hay coincidencias </td>
                  </tr>
               @endforelse
            @endisset
            @empty($resguardantes)
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
