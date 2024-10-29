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

     table {
       display: inline-block;
     }
   }

   </style>
@endsection

@section('contenido')

   <div class="row">
      <div align="center">
         <div>
            <h2>Bienvenido al Sistema
            </h2>
         </div>
         <b>
         <b>
         <div>
		 {{--
            <img class="responsive-img circle" style="width:400px; height:400px" src="{{asset('logos/logo_fge.png')}}"> <!-- random image -->
		 --}}
         </div>      
   </div>

@endsection

@section('js')
   <script type="text/javascript">
      $('.li-cadenas').removeClass('active');
      $('.li-cedulas').addClass('active').css({'font-weight':'bold'});
   </script>
@endsection
