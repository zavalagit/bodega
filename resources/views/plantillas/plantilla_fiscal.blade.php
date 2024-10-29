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
          .side-nav li>a{
              font-size: 9px !important;
              padding: 0 20px
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
         
         
         <h6 class="datos-usuario center-align white-text"><b>FISCAL</b></h6>
         
         
      </div>
      {{--      

      @php
          $unidades = App\Unidad::where('coordinacion','si')->get();
          $fiscalias = App\Fiscalia::all();
      @endphp

<li>
        <a style="font-size:14px !important;" href="/peticion-diaria-coordinador" >
            <i style="color:orange;" class="fas fa-sun"></i> P. DIARIA
        </a>
    </li>
<li>
        <a style="font-size:14px !important;" href="/concentrado" >
            <i style="color:orange;" class="fas fa-sun"></i> CONCENTRADO
        </a>
    </li>

    <ul class="collapsible" data-collapsible="accordion">
        <li>
            <div class="collapsible-header white-text"><i style="font-size:20px; color:#ffc107"
                    class="fas fa-folder"></i> <b>UNIDADES</b> </div>
            <div class="collapsible-body sub-lista brown darken-4">
                <ul class="brown lighten-4" style="border-radius: 20px 0 25px 5px;">
                    @foreach ($unidades as $unidad)
                        <li>
                            <a href="/estadistica/unidad/{{$unidad->id}}" class="blue-grey-text text-darken-2">
                                {{$unidad->nombre}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
    </ul>
    <ul class="collapsible" data-collapsible="accordion">
        <li>
            <div class="collapsible-header white-text"><i style="font-size:20px; color:#ffc107"
                    class="fas fa-folder"></i> <b>FISCALÍAS</b> </div>
            <div class="collapsible-body sub-lista brown darken-4">
                <ul class="brown lighten-4" style="border-radius: 20px 0 25px 5px;">
                    @foreach ($fiscalias as $fiscalia)
                        @if ($fiscalia->id != 4)
                            <li>
                                <a href="/estadistica/fiscalia/{{$fiscalia->id}}" class="blue-grey-text text-darken-2">
                                    {{$fiscalia->nombre}}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </li>
      </ul>
      --}}    


        <li>
            <a style="font-size:14px !important;" href="/fiscal-vista" >
                <i style="color:#394049;" class="fas fa-home fa-lg"></i> <b>INICIO</b>
            </a>
        </li>

      
      <!--Salir-->
      <li class="li-salir"><a style="font-size:14px !important;" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="brown-text a-menu"><i style="color:maroon;" class="fas fa-sign-out-alt i-menu" aria-hidden="true"></i><b>SALIR</b></a></li>

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
