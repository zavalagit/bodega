<!DOCTYPE html>
<html lang="es-MX">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta id="meta-csrf-token" name="csrf-token" content="{{ csrf_token() }}">
   {{-- <span id="nombre-pagina" data-nombre-pagina="@yield('nombre_pagina')"></span> --}}

   <!--CSS-->
      <!--css materialize-->
      {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
      {{-- <link rel="stylesheet" href="{{asset('plugins/materialize/css/materialize.min.css')}}"> --}}
      <link rel="stylesheet" href="{{asset('plugins/materialize-v1.0.0/css/materialize.min.css')}}">
      <!--font-awesome-->
      <link rel="stylesheet" href="{{asset('fuentes/fontawesome/css/all.min.css')}}">
    
      {{-- <link rel="stylesheet" href="{{asset('css/materialize.css')}}"> --}}

      <!--alertify-->
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.core.css')}}">
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.default.css')}}">


      {{-- <link rel="stylesheet" href="{{asset('css/tabla-scroll.css')}}"> --}}

      <!--Mark.js-->
      <link rel="stylesheet" href="{{asset('css/js_maker.css')}}">

      <!--Colores de los iconos del menu-->
      <link rel="stylesheet" href="{{asset('css/colorIcon.css')}}">


      <link rel="stylesheet" href="{{asset('css/colores.css')}}">
      <link rel="stylesheet" href="{{asset('/css/btn.css')}}">
      <link rel="stylesheet" href="{{asset('/css/hr.css')}}">
      
      <!--plantilla-->
      {{-- <link rel="stylesheet" href="{{asset('/css/plantilla/plantilla_menu.css')}}">
      <link rel="stylesheet" href="{{asset('/css/plantilla/plantilla_menu_item.css')}}"> --}}

      <!--css para las vistas-->
      @yield('css')


      <style media="screen">
/* body{
  background-color: #c6c6c6;
} */
main{
  padding-top: 50px;
}


header{
  position: fixed;
  width: 100%;
  height: 36px;
  z-index: 500;
  display:flex;
  flex-direction: row !important;
  flex-wrap: nowrap !important;
  justify-content: center !important;
  align-items: center !important;
}

#header-menu{
    display: none;
    background-color: #152f4a;
    height: 36px;
}
#header-seccion{
  margin: 0;
  padding: 0;
  width: 100%;
  background-color: #394049;
  color: #c09f77;
  height: 36px;
  padding-top: 5px;
}

/* @media only screen and (max-width : 992px) {
    header, main, footer {
        padding-left: 0;
    }
    #header-menu{
        display:block;
        width: 6%;
        padding-top: 8px;
    }
    #header-seccion{
      width: 94%;
      padding-top: 4px;
    }
} */

#header-seccion h5{
    margin: 0 !important;
    padding: 0 !important;
    width: 100% !important;
    height: 36px;
    font-size: 23px;
    font-family:monospace;
  }


     

         .side-nav{
    background-color: #394049;
  }




      #datos-usuario h6{
        margin:0;
        /* padding-top: 4px; */
        color: #c6c6c6  ;
        /* height: 20px !important; */
      }

      

      .collapsible-header{
        background-color: #c6c6c6 !important;
        color: #152f4a;
        font-weight: bold;
        font-size: 13px;
        border-radius: 20px 0 20px 0;
      }
      .collapsible-header i{
        color: #c09f77;
        font-size: 15px;
      }
      .collapsible-body{
        background-color: #394049 !important;
      }
      .collapsible-body a{
        /* background-color: #c6c6c6 !important; */
        color: #c6c6c6 !important;
      }

      .hr-menu{
        border: 1px solid #c09f77;
        border-radius: 5px;
      }
      
      </style>

   <title>@yield('titulo')</title>
</head>
<body>
   <header>
      <div id="header-seccion" class="center-align">
         <h5 class=""><b> @yield('seccion') </b></h5>
      </div>
    </header>

   <main>
      @yield('contenido')
   </main>

   <!--JS-->
      <!--jQuey-->
      <script src="{{asset('plugins/jQuery/jquery.min.js')}}"></script>
      <!--js materialize-->
      {{-- <script src="{{asset('plugins/materialize/js/materialize.js')}}"></script> --}}
      <script src="{{asset('plugins/materialize-v1.0.0/js/materialize.js')}}"></script>
      <!--funciones jQuery de materialize-->
      <script src="{{asset('js/materialize/materialize_select.js')}}"></script>
      <!--alertify-->
      <script src="{{asset('plugins/alertify/js/alertify.min.js')}}"></script>
      <!--JS Maker-->
      <script src="{{asset('plugins/js_maker/jquery.mark.min.js')}}" charset="UTF-8"></script>


      <!--plantilla-->
      <script src="{{asset('js/plantilla/plantilla_item_selected.js')}}"></script>
      

      {{-- <script src="{{asset('js/foranea.js')}}"></script> --}}
      <!--js para las vistas-->
      @yield('js')

</body>
</html>
