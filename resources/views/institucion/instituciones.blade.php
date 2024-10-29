@extends('bodega.plantilla')


@section('css')
   <style media="screen">
      

   </style>
@endsection


@section('contenido')

   <div class="row">
     <div class="col s12">
       <a href="/administrador/institucion-formulario">Agregar institucion</a>
     </div>
   </div>

   <div class="row">
      <div align="center">
        <table class="responsive-table highlight bordered">
          <caption  class="amber"><b>CARGOS</b></caption>
          <thead class=" blue lighten-5">
            <tr>     
              <th>Nombre</th>                                
              <th>Editar</th>  
            </tr>  
          </thead>  
          <thead>         
            @foreach ($instituciones as $key => $institucion)
            <tr>  
                <td>{{$institucion->nombre}}</td>                
                <td>
                  <a class="" href="/administrador/institucion-formulario/{{$institucion->id}}"><i class="fas fa-pen-square"></i></a>
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
