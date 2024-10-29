<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!--CSS-->
      <!--css materialize-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="{{asset('plugins/materialize/css/materialize.min.css')}}">
      <!--font-awesome-->
      <link rel="stylesheet" href="{{asset('fuentes/fontawesome/css/all.css')}}">

      <link rel="stylesheet" href="{{asset('css/materialize.css')}}">

      <!--alertify-->
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.core.css')}}">
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.default.css')}}">

      <!--Colores de los iconos del menu-->
      <link rel="stylesheet" href="{{asset('css/colorIcon.css')}}">

      <link rel="stylesheet" href="{{asset('css/colores.css')}}">
      <!--css tablas-->
      <link rel="stylesheet" href="{{asset('css/tablas.css')}}">
      <!--css encabezado-->
      <link rel="stylesheet" href="{{asset('css/encabezado.css')}}">

      <!--css para las vistas-->
      @yield('css')

      <style media="screen">
         .icon-revisar{
            color: rgb(156, 31, 9);
         }
         .saludo{
            margin: 0px !important;
            padding: 5px 0px !important;
         }

         .li-slider{
            margin: 0 !important;
            padding: 10px !important;
         }
         a{
            margin: 0 !important;
            padding: 0 20px !important;
         }
         i.fas,i.fa,i.far{
           margin:0 !important;
         }
      </style>

   <title>@yield('titulo')</title>
</head>
<body class="brown lighten-5">
   <ul id="slide-out" class="side-nav fixed brown darken-4">
      <div class="slider">
         <ul class="slides center-align" style="background: #112046;
         background: -webkit-linear-gradient(-135deg, #062F43, #430630);
         background: -o-linear-gradient(-135deg, #062F43, #430630);
         background: -moz-linear-gradient(-135deg, #062F43, #430630);
         background: linear-gradient(-135deg, #062F43, #430630);">
            <li class="li-slider">
               <img class="responsive-img" style="width: 180px; background-size: contain; background-repeat: no-repeat;" src="{{asset('logos/syscac.png')}}"> <!-- random image -->
            </li>
            {{--
            <li class="li-slider">
               <img class="responsive-img circle" style="width:180px; height:180px" src="{{asset('logos/gob-mich.jpg')}}"> <!-- random image -->
            </li>
            --}}
         </ul>
      </div>

      <div class="brown lighten-1" style="border-radius: 20px 0 25px 5px;">
         <!--
        <h6 class="saludo center-align white-text"><b>{{Auth::user()->fiscalia->nombre}}</b></h6>
      -->
      <h6 class="saludo center-align white-text"><b>FISCALÍA</b></h6>
        <h6 class="saludo center-align white-text"><b>{{Auth::user()->name}}</b></h6>
        <!--
        <h6 class="saludo center-align white-text"><b>{{Auth::user()->cargo->nombre}}</b></h6>
        -->
      </div>

      <div class="folio-ultimo-div teal darken-3" style="border-radius: 25px 5px 25px 5px;">
        @php
        $cadenas = App\Cadena::where('fiscalia_id',Auth::user()->fiscalia_id)->where(function($q){
          $q->where('estado','validada')->orWhere('estado','espera');
        })->latest()->take(1000)->get();
        $cadena = $cadenas->sortByDesc('folio_bodega')->first();
        @endphp
        {{--
        <h5 class="saludo center-align white-text"><b>{{$cadena->folio_bodega}}</b></h5>
         --}}
      </div>

      <li id="li-entradas"><a href="/bodega/entradas" class="white-text"><i style="color:#64dd17" class="fas fa-check-circle"></i>ENTRADAS</a></li>
      <li id="li-capturar"><a href="/bodega/capturar" class="white-text"><i style="color:#4fc3f7" class="fa fa-arrow-circle-right" aria-hidden="true"></i>CAPTURAR</a></li>
      <li id="li-revisar"><a href="/bodega/revisar" class="white-text"><i style="color:#ffd600" class="fa fa-question-circle" aria-hidden="true"></i>POR REVISAR</a></li>

      <li id="li-rechazadas"><a href="/bodega/cadenas-rechazadas" class="white-text"><i style="color:#f44336" class="fa fa-times-circle" aria-hidden="true"></i>RECHAZADAS</a></li>
      <li id="li-espera"><a href="/bodega/cadenas-espera" class="white-text"><i style="color:#ff9800" class="fa fa-check-circle" aria-hidden="true"></i>ESPERA</a></li>

      <li id="li-prestamos"><a href="/bodega/prestamos" class="white-text"><i style="color:#0d47a1" class="fa fa-arrow-circle-left" aria-hidden="true"></i>PRESTAMOS</a></li>
      <li class=""><a href="/bodega/bajas" class="white-text"><i style="color:#d50000" class="fa fa-arrow-circle-down" aria-hidden="true"></i>BAJAS</a></li>
      <li class=""><a href="/bodega/inventario-indicios-evidencias" class="white-text"><i class="fas fa-th"></i>INVENTARIO</a></li>

      @if(Auth::user()->fiscalia_id == 4)
         <ul class="collapsible" data-collapsible="accordion">
            <li>
              <div class="collapsible-header white-text"><i style="font-size:20px; color:#ffc107" class="fas fa-folder"></i> <b>REPORTES</b> </div>
              <div class="collapsible-body sub-lista brown darken-4">
                <ul class="brown lighten-4" style="border-radius: 20px 0 25px 5px;">
                  <li><a href="/bodega/reporte" class="blue-grey-text text-darken-2"><i style="color:#0d47a1" class="fas fa-file-alt"></i>REPORTE DIARIO</a></li>
                  <li><a href="/bodega/inventario" class="blue-grey-text text-darken-2"><i class="fas fa-th"></i>INVENTARIO</a></li>
                  <li><a href="/reporte-armas" class="blue-grey-text text-darken-2"><i style="color:#d50000" class="fas fa-fire-alt"></i>REPORTE ARMAS</a></li>
                  <li><a href="/bodega/estadistica" class="blue-grey-text text-darken-2"><i class="fas fa-chart-line"></i>ESTADISTICA</a></li>
                  <li><a href="/bodega/caratula" class="blue-grey-text text-darken-2"><i style="color:#000" class="fas fa-square-full"></i>CARATULA</a></li>
                  <li><a href="/bodega/lista-cadenas" class="blue-grey-text text-darken-2"><i style="color:#d84315" class="far fa-list-alt"></i>LISTA CADENAS</a></li>
                  <li><a href="/reporte-lista-ie" class="blue-grey-text text-darken-2"><i style="color:#d84315" class="far fa-list-alt"></i>REPORTE ESPECIAL</a></li>
                </ul>
              </div>
            </li>
         </ul>
      @endif

      <li class=""><a href="/buscar-qr" class="white-text"><i style="color:#64dd17" class="fas fa-search"></i>BUSQUEDA QR</a></li>
      <li class="li-salir"><a href="{{ route('logout') }}" onclick="event.preventDefault();
               document.getElementById('logout-form').submit();" class="white-text"><i style="color:#00796b" class="fas fa-sign-out-alt"></i>SALIR</a></li>
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
      <script src="{{asset('plugins/alertify/js/alertify.min.js')}}"></script>
      <!--funciones jQuery de materialize-->
      <script src="{{asset('js/materialize_bodega.js')}}"></script>

   <!--
      <script src="{{asset('js/cedula.js')}}"></script>

      <script src="{{asset('js/resguardante.js')}}"></script>

-->
      <script src="{{asset('js/nota.js')}}"></script>
      <script src="{{asset('js/validar.js')}}"></script>



      <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.es6.js" charset="utf-8"></script>
      <!--js para las vistas-->
      @yield('js')

</body>
</html>
