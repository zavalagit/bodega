<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <!--CSS-->
      <!--css materialize-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="{{asset('plugins/materialize/css/materialize.min.css')}}">
      <!--font-awesome-->
      <link rel="stylesheet" href="{{asset('fuentes/font-awesome/css/font-awesome.min.css')}}">

      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">

      <link rel="stylesheet" href="{{asset('css/materialize.css')}}">

      <!--alertify-->
      {{--
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.css')}}">
--}}

      <link rel="stylesheet" href="{{asset('css/tabla-scroll.css')}}">

      <!--Colores de los iconos del menu-->
      <link rel="stylesheet" href="{{asset('css/colorIcon.css')}}">

      <!--css para las vistas-->
      @yield('css')


      <style media="screen">
         .icon-revisar{
            color: rgb(156, 31, 9)s;
         }
         .saludo{
            margin: 0px !important;
            padding: 5px 0px !important;
         }

         .li-slider{
            margin: 0 !important;
            padding: 10px !important;
         }
         .fa-key{
            color: #ffab00 !important;
         }
         a{
            margin: 0 !important;
            padding: 0 20px !important;
         }
      </style>

   <title>@yield('titulo')</title>
</head>
<body>
   <ul id="slide-out" class="side-nav fixed white">
      <div class="slider">
         <ul class="slides center-align" style="background-color:#112046">
            <li class="li-slider">
               <img class="responsive-img circle" style="width:180px; height:180px" src="{{asset('logos/pgj-mich.png')}}"> <!-- random image -->
            </li>
            <li class="li-slider">
               <img class="responsive-img circle" style="width:180px; height:180px" src="{{asset('logos/gob-mich.jpg')}}"> <!-- random image -->
            </li>
         </ul>
      </div>

      <li class="amber"><h6 class="saludo center-align white-text"><b></b></h6></li>
      <li class="amber"><h6 class="saludo center-align white-text"><b>{{Auth::user()->name}}</b></h6></li>
      <li class="amber"><h6 class="saludo center-align white-text"><b>{{Auth::user()->cargo->nombre}}</b></h6></li>

      <li class="li-cadenas"><a href="/administrador/inicio" class="indigo-text text-darken-4"><i class="fa fa-key" aria-hidden="true"></i>ADMINISTRADOR</a></li>

      <li class="li-cadenas"><a href="/bodega/alta-foranea" class="indigo-text text-darken-4"><i style="color:#81d4fa" class="fa fa-arrow-circle-right" aria-hidden="true"></i>CAPTURAR</a></li>

      <li class="li-cadenas"><a href="/administrador/fiscalia/{{config('fiscalia.nombre')}}/revisar" class="indigo-text text-darken-4"><i style="color:#ffeb3b" class="fa fa-question-circle" aria-hidden="true"></i>POR REVISAR</a></li>

      <li class="li-cadenas"><a href="/bodega/cadenas-rechazadas" class="indigo-text text-darken-4"><i style="color:#f44336" class="fa fa-times-circle" aria-hidden="true"></i>RECHAZADAS</a></li>

      <li class="li-cadenas"><a href="/bodega/cadenas-espera" class="indigo-text text-darken-4"><i style="color:#ff9800" class="fa fa-check-circle" aria-hidden="true"></i>ESPERA</a></li>
      <li class="li-cedulas"><a href="/administrador/fiscalia/{{config('fiscalia.nombre')}}/entradas" class="indigo-text text-darken-4"><i style="color:#64dd17" class="fa fa-check-circle" aria-hidden="true"></i>ENTRADAS</a></li>

      <li class="li-cedulas"><a href="/bodega/prestamos" class="indigo-text text-darken-4"><i class="fa fa-check-circle" aria-hidden="true"></i>PRESTAMOS</a></li>

      <li class="li-cedulas"><a href="/bodega/bajas" class="indigo-text text-darken-4"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i>BAJAS</a></li>

      <li class="li-salir"><a href="{{ route('logout') }}" onclick="event.preventDefault();
               document.getElementById('logout-form').submit();" class="indigo-text text-darken-4"><i class="fas fa-sign-out-alt"></i>SALIR</a></li>
    </ul>
    <a href="#" data-activates="slide-out" class="button-collapse hide"><i class="material-icons">menu</i></a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
   </form>

   <main>
      @yield('contenido')
   </main>

   <!--JS-->
      <!--jQuey-->
      <script src="{{asset('plugins/jQuery/jquery.min.js')}}"></script>
      <!--js materialize-->
      <script src="{{asset('plugins/materialize/js/materialize.js')}}"></script>
      <!--alertify-->
      <script src="{{asset('plugins/alertify/js/alertify.js')}}"></script>
      <!--funciones jQuery de materialize-->
      <script src="{{asset('js/funcionesMaterialize.js')}}"></script>

      {{--
      <script src="{{asset('js/cedula.js')}}"></script>
      <script src="{{asset('js/perito_entrega.js')}}"></script>

      <script src="{{asset('js/resguardante.js')}}"></script>
      <script src="{{asset('js/validar.js')}}"></script>
      <script src="{{asset('js/foranea.js')}}"></script>
      --}}
      <script src="{{asset('js/nota.js')}}"></script>


      <!--js para las vistas-->
      @yield('js')

</body>
</html>
