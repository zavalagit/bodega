@extends('bodega.plantilla')


@section('css')
   <style media="screen">
      

   </style>
@endsection


@section('contenido')

   <div class="row">
     <div class="col s12">
       <a href="/administrador/fiscalia-formulario">Agregar fiscalia</a>
     </div>
   </div>

   <div class="row">
      <div align="center">
        <table class="responsive-table highlight bordered">
          <caption  class="amber"><b>FISCALÍAS</b></caption>
          <thead class=" blue lighten-5">
            <tr>     
              <th>Nombre</th>                                
              <th>Editar</th>  
            </tr>  
          </thead>  
          <thead>         
            @foreach ($fiscalias as $key => $fiscalia)
            <tr>  
                <td>{{$fiscalia->nombre}}</td>                
                <td>
                  <a class="" href="/administrador/fiscalia-formulario/{{$fiscalia->id}}"><i class="fas fa-pen-square"></i></a>
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
