@extends( ( Auth::user()->tipo == 'coordinador' ) ? 'plantillas.peticiones.plantilla_coordinador' : 'plantillas.plantilla_director')

@section('seccion', "REPORTE SOLICITUDES")
@section('titulo','REPORTE SOLICITUDES')

@section('css')

    <link rel="stylesheet" href="{{asset('css/botones/btn_icon.css')}}">
   <style media="screen">
      body{
         zoom: 80% !important;
      }



      .fa-search{
         color: #4db6ac;
      }

      .fa-file-pdf-o{
         color: #b71c1c;
      }

     .div-buscador{
      margin: 0 !important;
      padding: 0 !important;
     }
     .fa-file-pdf{
       color: red;
     }
     .fa-copy{
       color: #607d8b;
     }
     .fa-file-pdf:hover,.fa-copy:hover,.fa-pen:hover{
       font-size: 117%;
     }

     table {
      /*width: 220% !important;*/
      overflow-x: scroll;
      overflow-y: hidden;
   }

   .td-total{
      font-weight: bold;
      background-color:#c09f77;
      color:#394049;
      width: 20%;
   }

   .td-total-rezago{
      font-weight: bold;
      background-color:#c09f77;
      color:#394049;
      width: 45%;
   }
   .td-total-cantidad{
      background-color: #394049;
      color: #fff !important;
   }
   .fecha-encabezado{
        margin: 0 !important;
    }
    .fecha-encabezado h5{
        text-align: center;
        background-color: #152f4a;
        color: #c09f77;
        padding-top: 6px;
        padding-bottom: 6px;
    }

   </style>
@endsection

@section('contenido')

   <span id="span-csrf" data-csrf="{{csrf_token()}}"></span>

    <!--buscar-->
    <section>
      <form class="col s12">

         <p>
            <input class="with-gap" name="reporte_tipo" value='reporte_general' type="radio" id="test1" checked />
            <label for="test1">Reporte general</label>
          </p>
          
          <p>
            <input class="with-gap" name="reporte_tipo" value="reporte_solicitud" type="radio" id="test2" />
            <label for="test2">Reporte por solicitud</label>
          </p>
          

         @if (Auth::user()->unidad_id == 2)
            <p>
               <input class="with-gap" name="reporte_tipo" value="reporte_necropsias_general" type="radio" id="test3"  />
               <label for="test3">Reporte Necropsias general</label>
            </p>
            
            <p>
               <input class="with-gap" name="reporte_tipo" value="reporte_necropsias_mecanica" type="radio" id="test4"  />
               <label for="test4">Reporte Necropsias por mecanica</label>
            </p>
         
         @endif

          <br>

         <div class="row">
            <div class="input-field col s2">
               <input type="date" name="fecha_inicio" value="{{$fecha_inicio}}">
               <label class="active" for="fecha-inicio">FECHA INICIO</label>
            </div>
            <div class="input-field col s2">
               <input type="date" name="fecha_fin" value="{{$fecha_fin}}">
               <label class="active" for="fecha-fin">FECHA FIN</label>
            </div>
            <div class="input-field col s1">
               <button class="btn waves-effect waves-light" type="submit" name="btn-buscar" value="btn-pdf">
                  <i style="color:#394049;" class="far fa-file-pdf"></i>
               </button>
           </div>
         </div>
      </form>
   </section>










@endsection

@section('js')
   <script type="text/javascript">
      $('.li-registrar-cadena').removeClass('active');
      $('.li-consultar-cadena').addClass('active');
      $('.a-disabled').bind('click', false);
   </script>

   <script type="text/javascript" src="{{asset('js/etiqueta.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/etiqueta.js')}}" ></script>
  
   <script type="text/javascript" src="{{asset('js/peticiones/peticion_diaria.js')}}" ></script>


@endsection
