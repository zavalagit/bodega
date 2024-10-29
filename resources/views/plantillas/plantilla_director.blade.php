<!DOCTYPE html>
<html lang="es-MX">
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
      <!--css plantilla-->
      <link rel="stylesheet" href="{{asset('css/plantillas/plantilla.css')}}">
      <!--Colores de los formularios (REVISAR)-->
      <link rel="stylesheet" href="{{asset('css/colores.css')}}">
      <!--alertify-->
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.core.css')}}">
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.default.css')}}">
      <!--css nav-->
      <link rel="stylesheet" href="{{asset('css/cadenas/nav.css')}}">
      <!--css tablas-->
      <link rel="stylesheet" href="{{asset('css/tablas.css')}}">
      <!--css nav_mobile-->
      <link rel="stylesheet" href="{{asset('css/nav/nav_mobile.css')}}">
      <!--css para las vistas-->
      @yield('css')

      <style>
         .side-nav li>a>i{
            margin: 0 10px 0 0 !important;
         }
      </style>

</head>

<body class="brown lighten-5">

   <ul id="slide-out" class="side-nav fixed barra-lateral">
      <div class="slider">
         <ul class="slides center-align logo-fondo">
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
      <div class="barra-titulos" >

         @if (Auth::user()->tipo == 'director_unidad')
            <h6 class="datos-usuario center-align white-text"><b>DIRECTOR(A)</b></h6>
            <h6 class="datos-usuario center-align white-text"><b>{{Auth::user()->unidad->nombre}}</b></h6>
         @elseif(Auth::user()->tipo == 'director_fiscalia')
            <h6 class="datos-usuario center-align white-text"><b>DIRECTOR(A)</b></h6>
            <h6 class="datos-usuario center-align white-text"><b>{{Auth::user()->fiscalia->nombre}}</b></h6>
         @endif

        
      </div>

      <!--Peticiones del día-->
      @if (Auth::user()->tipo === 'director_fiscalia')
         <li class="li-cadenas li-menu"><a href="/peticion-dia/fiscalia/{{Auth::user()->fiscalia_id}}" class="brown-text a-menu"><i style="color:#394049;" class="fas fa-sun"></i>PETICIÓN DEL DÍA</a></li>
         <li class="li-cadenas li-menu"><a href="/concentrado-dia/fiscalia/{{Auth::user()->fiscalia_id}}" class="brown-text a-menu"><i style="color:#394049;" class="fas fa-sun"></i>CONC. DIARIO</a></li>
         {{-- <li class="li-cadenas li-menu"><a href="/peticion-necropsias/fiscalia/{{Auth::user()->fiscalia_id}}" class="brown-text a-menu"><i class="fas fa-skull-crossbones"></i>NECROPSIAS</a></li> --}}
         <li class="li-cadenas li-menu"><a href="/peticion-estadistica/fiscalia/{{Auth::user()->fiscalia_id}}" class="brown-text a-menu"><i class="fas fa-chart-bar"></i>ESTADISTICA</a></li>
      @elseif(Auth::user()->tipo === 'director_unidad')
         <li class="li-cadenas li-menu"><a href="/peticion-dia/unidad/{{Auth::user()->unidad_id}}" class="brown-text a-menu"><i style="color:#394049;" class="fas fa-sun"></i>PETICIÓN DEL DÍA</a></li>
         <li class="li-cadenas li-menu"><a href="/concentrado-dia/unidad/{{Auth::user()->unidad_id}}" class="brown-text a-menu"><i style="color:#394049;" class="fas fa-sun"></i>CONC. DIARIO</a></li>
         {{-- <li class="li-cadenas li-menu"><a href="/peticion-necropsias/unidad/{{Auth::user()->unidad_id}}" class="brown-text a-menu"><i class="fas fa-skull-crossbones"></i>NECROPSIAS</a></li> --}}
         <li class="li-cadenas li-menu"><a href="/peticion-estadistica/unidad/{{Auth::user()->unidad_id}}" class="brown-text a-menu"><i class="fas fa-chart-bar"></i>ESTADISTICA</a></li>
      @endif
      
      
      
      
      <li class="li-cadenas li-menu"><a href="/peticion-buscar" class="brown-text a-menu"><i style="color:#394049;" class="fas fa-search"></i>BUSQUEDA</a></li>
      
      <!--Consultar (Cadena)-->
      
      
      <!--Reportes-->
      @if ( (Auth::user()->tipo === 'director_unidad') )
      <li class="li-cadenas li-menu"><a href="/peticion-reporte" class="brown-text a-menu"><i class="fas fa-file-pdf"></i>REPORTES</a></li>
          
      @endif
      
      
      <!--Salir-->
      <li class="li-salir"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="brown-text a-menu"><i style="color:maroon;" class="fas fa-sign-out-alt i-menu" aria-hidden="true"></i>SALIR</a></li>

   </ul>

   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
   </form>

   <header>
     <div class="row">
       <div class="col s12 btn-sidenav nav-mobile">
         <a href="#" data-activates="slide-out" class="button-collapse">
            <b><i style="color:#c09f77;" class="fas fa-bars fa-lg"></i></b>
          </a>
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

      
      
      <!--Input Voz 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.es6.js" charset="utf-8"></script>
      <script src="{{asset('js/input_voz/input_voz.js')}}"></script>
      -->
      <!--js para las vistas-->
      @yield('js')

</body>
</html>
