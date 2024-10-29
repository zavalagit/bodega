<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>@yield('titulo')</title>

   <!--CSS-->
      <!--css materialize-->
      <link rel="stylesheet" href="{{asset('plugins/materialize/css/materialize.min.css')}}">
      <!--fontawesome-->
      <link rel="stylesheet" href="{{asset('fuentes/fontawesome/css/all.css')}}">
      <!--Colores de los formularios (REVISAR)-->
      <link rel="stylesheet" href="{{asset('css/colores.css')}}">
      <!--alertify-->
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.core.css')}}">
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.default.css')}}">
      <!--css nav-->
      <link rel="stylesheet" href="{{asset('css/cadenas/nav.css')}}">
      <!--css tablas-->
      <link rel="stylesheet" href="{{asset('css/tablas.css')}}">
      <!--css para las vistas-->
      @yield('css')

      <style media="screen">
        header, main, footer {
          padding-left: 200px;
        }
        .btn-sidenav{
          display: none;
        }
        @media only screen and (max-width : 992px) {
          header, main, footer {
            padding-left: 0;
          }
          .btn-sidenav{
            display:block;
          }
        }
        li.li-slider.active{
          padding: 0 !important;
        }
      </style>


</head>

<body class="brown lighten-5">

   <ul id="slide-out" class="side-nav fixed" style="background-color:#c6c6c6;">
      <div class="slider">
         <ul class="slides center-align" style="background: -webkit-linear-gradient(-135deg, #c6c6c6, #c09f77);
         background: -o-linear-gradient(-135deg, #c6c6c6, #c09f77);
         background: -moz-linear-gradient(-135deg, #c6c6c6, #c09f77);
         background: linear-gradient(-135deg, #c6c6c6, #c09f77);">
            <li class="li-slider">
               <img class="responsive-img" style="width: 180px; background-size: contain; background-repeat: no-repeat;" src="{{asset('logos/fge.png')}}"> <!-- random image -->
            </li>
            {{--
            <li class="li-slider">
               <img class="responsive-img circle" style="width:180px; height:180px" src="{{asset('logos/gob-mich.jpg')}}"> <!-- random image -->
            </li>
            --}}
         </ul>
      </div>
      <div class="" style="background-color:#152f4a;" >
        <h6 class="datos-usuario center-align white-text"><b>VISTA PERITO</b></h6>
        
      </div>
      <!--Nombre Usuario (Perito)-->

      <!--Registrar (Cadena)-->
      <li><a href="/registrar-cadena" class="brown-text a-menu"><i class="fas fa-pen"></i>REGISTRO</a></li>
      <!--Consultar (Cadena)-->
      <li class="li-cadenas li-menu"><a href="/consultar-cadena" class="brown-text a-menu"><i class="fas fa-file-alt"></i></i>CONSULTA</a></li>
      <!--Mis Prestamos-->
      
      <!--Datos del Usuario
      <li class="li-cadenas"><a href="/mis-datos" class="brown-text a-menu"><i style="color:midnightblue" class="fas fa-user i-menu"></i>MIS DATOS</a></li>
      -->
      <!--Salir-->
      <li class="li-salir"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="brown-text a-menu"><i style="color:maroon;" class="fas fa-sign-out-alt i-menu" aria-hidden="true"></i>SALIR</a></li>

   </ul>

{{--
   <div class="row nav-row" style="background-color: #3e2723">
      <div class="nav center-align col s12" style="background-color: #3e2723">
        <div class="nav-bar">
          <a href="#" data-activates="slide-out" class="button-collapse right-align"><b><i style="color:#112046" class="fas fa-bars fa-lg"></i></b></a>
        </div>
        <div class="nav-titulo">
          <span class=""><b>@yield('seccion')</b></span>
        </div>
      </div>
   </div>
--}}


   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
   </form>

   <header>
     <div class="row">
       <div class="col s12 btn-sidenav" style="background-color: #3e2723">
         <a href="#" data-activates="slide-out" class="button-collapse"><b><i style="color:#ffffff" class="fas fa-bars fa-lg"></i></b></a>
       </div>
       <div class="vista-seccion col s12 nav-titulo center-align">
         <span class=""><b>@yield('seccion')</b></span>
       </div>
     </div>
   </header>



   <main class="">
     @yield('contenido')
   </main>


   <!--JS-->
      <!--jQuey-->
      <script src="{{asset('plugins/jQuery/jquery.min.js')}}"></script>
      <!--js materialize-->
      <script src="{{asset('plugins/materialize/js/materialize.js')}}"></script>
      <!--alertify-->
      <script src="{{asset('plugins/alertify/js/alertify.min.js')}}"></script>
      <!--funciones jQuery de materialize-->
      <script src="{{asset('js/funcionesMaterialize.js')}}"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.es6.js" charset="utf-8"></script>


      <!--Input Voz 
      <script src="{{asset('js/input_voz/input_voz.js')}}"></script>
      -->
      <!--js para las vistas-->
      @yield('js')

</body>
</html>
