<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <!--CSS-->
      <!--css materialize-->
      <link rel="stylesheet" href="{{asset('plugins/materialize/css/materialize.min.css')}}">
      <!--font-awesome-->
      <link rel="stylesheet" href="{{asset('fuentes/font-awesome/css/font-awesome.min.css')}}">

      <link rel="stylesheet" href="{{asset('css/logoNav.css')}}">
      <!--alertify-->
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.css')}}">
      <!--css para las vistas-->
      @yield('css')

      <style media="screen">
         .navegador{
            border-bottom: 2.5px #1a237e solid;
         }
      </style>

   <title>Document</title>
</head>
<body>

   <div class="navbar-fixed">
      <nav class="navegador z-depth-0 white">{{--indigo accent-1--}}
         <div class="nav-wrapper">
            <ul id="nav-mobile" class="right hide-on-med-and-down">
               <li class="li-registrar-cadena"><a href="/registrar-cadena" class="indigo-text text-darken-4">Registrar Cadena</a></li>
               <li class="li-consultar-cadena"><a href="/consultar-cadena" class="indigo-text text-darken-4">Consultar Cadena</a></li>
               <li class=""><a href="/bodega/cadenas" class="indigo-text text-darken-4">Cadenas para alta</a></li>
               <li class=""><a href="/bodega/cadenas" class="indigo-text    text-darken-4">Ultimas cadenas alta</a></li>
            </ul>
         </div>
      </nav>
   </div>


   @yield('contenido')


   <!--JS-->
      <!--jQuey-->
      <script src="{{asset('plugins/jQuery/jquery.min.js')}}"></script>
      <!--js materialize-->
      <script src="{{asset('plugins/materialize/js/materialize.js')}}"></script>
      <!--alertify-->
      <script src="{{asset('plugins/alertify/js/alertify.js')}}"></script>
      <!--funciones jQuery de materialize-->
      <script src="{{asset('js/funcionesMaterialize.js')}}"></script>
      <script src="{{asset('js/registroCadena.js')}}"></script>
      <!--js para las vistas-->
      @yield('js')

</body>
</html>
