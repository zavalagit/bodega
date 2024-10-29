@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      .fa-search{
         color: #4db6ac;
      }
      .row{
         margin: 0 !important;
         padding: 0 !important;
      }
      .fa-file-pdf-o{
         color: #d50000;
      }
      thead{
         background-color:
      }
      .fa-check{
         color: #4caf50;
      }
      .fa:hover{
         font-size: 1.3em;
      }
      .icon-check:hover{
         font-size: 1.5em;
      }

      .tabla {
       overflow-x: scroll;
       overflow-y: hidden;
       white-space: nowrap;
      }

     table {
       display: inline-block;
     }

   </style>
@endsection

@section('contenido')

   <div class="row">
      <div align="center">
        <table class="responsive-table highlight bordered">
          <caption  class="amber"><b>Fiscalias</b></caption>
          <thead class=" blue lighten-5">
             <tr>                             
                  <th width="850">Nombre</th>
                  <th width="250">Seleccionar</th>
            </tr>  
          </thead>  
          <thead>         
            @foreach ($fiscalias as $key => $fiscalia)
            <tr>  
                <td>{{$fiscalia->nombre}}</td>
                <td>
                  <a href="fiscalia/{{$fiscalia->nombre}}/revisar" class="" data-csrf="{{csrf_token()}}" data-id="{{$fiscalia->id}}" data-nombre="{{$fiscalia->nombre}}"><i class="fa fa-share" aria-hidden="true"></i></a>
                </td>                
            </tr>    
            @endforeach            
          </thead> 
      </table> 
   </div>

@endsection

@section('js')
   <script type="text/javascript">
      $('.li-cadenas').removeClass('active');
      $('.li-cedulas').addClass('active').css({'font-weight':'bold'});
   </script>

   <script src="{{asset('js/fiscalia_seleccionar.js')}}" charset="utf-8"></script>
@endsection