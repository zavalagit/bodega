@extends('bodega.plantilla')


@section('css')
   <style media="screen">
      

   </style>
@endsection


@section('contenido')

   <div class="row">
      <div align="center">
        <table class="responsive-table highlight bordered">
          <caption  class="amber"><b>NATURALEZAS</b></caption>
          <thead class=" blue lighten-5">
             <tr>     
                  <th>Nombre</th>                                
                  <th>Modificar</th>
                  <th>Eliminar</th>  
            </tr>  
          </thead>  
          <thead>         
            @foreach ($naturalezas as $key => $naturaleza)
            <tr>  
                <td>{{$naturaleza->nombre}}</td>                
                <td>
                  <a class="accion waves-effect waves-light btn z-depth-0" href="/bodega/reguardanteguamo/{{$naturaleza->id}}">click</a>
                </td>
                <td>
                  <a class="accion waves-effect waves-light btn z-depth-0" href="/bodega/reguardanteguael/{{$naturaleza->id}}">click</a>
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
