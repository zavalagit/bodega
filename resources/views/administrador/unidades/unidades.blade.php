@extends('bodega.plantilla')


@section('css')
   <style media="screen">
      

   </style>
@endsection


@section('contenido')

   <div class="row">
     <div class="col s12">
       <a href="/administrador/unidad-formulario">Agregar unidad</a>
     </div>
   </div>

   <div class="row">
      <div align="center">
        <table class="responsive-table highlight bordered">
          <caption  class="amber"><b>UNIDADES</b></caption>
          <thead class=" blue lighten-5">
             <tr>     
                  <th>Nombre</th>                                
                  <th>Editar</th>  
            </tr>  
          </thead>  
          <thead>         
            @foreach ($unidades as $key => $unidad)
            <tr>  
                <td>{{$unidad->nombre}}</td>                
                <td>
                  <a class="" href="/administrador/unidad-formulario/{{$unidad->id}}"><i class="fas fa-pen-square"></i></a>
                </td>
            </tr>    
            @endforeach            
          </thead> 
      </table> 
   </div>
 </div>

@endsection

@section('js')
   <script type="text/javascript">
      $('.li-cadenas').removeClass('active');
      $('.li-cedulas').addClass('active').css({'font-weight':'bold'});
   </script>
@endsection
