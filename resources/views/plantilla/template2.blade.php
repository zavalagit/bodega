<!DOCTYPE html>
<html lang="es-MX">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
   <meta id="meta-csrf-token" name="csrf-token" content="{{ csrf_token() }}">
   <span id="nombre-pagina" data-nombre-pagina="@yield('nombre_pagina')" data-submenu="@yield('nombre_submenu')"></span>
  <!--css-->
  @include('plantilla.maquetado.css')
   


      <style media="screen">
/* body{
  background-color: #c6c6c6;
} */
main{
  padding-top: 30px;
}


header{
  position: fixed;
  width: 100%;
  height: 30px;
  z-index: 500;
  /* display:flex;
  flex-direction: row !important;
  flex-wrap: nowrap !important;
  justify-content: center !important;
  align-items: center !important; */
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
  /* height: 36px; */
  padding-top: 5px;
}

@media only screen and (max-width : 992px) {
    header, main, footer {
        padding-left: 0;
    }
    /* #header-menu{
        display:block;
        width: 6%;
        padding-top: 8px;
    }
    #header-seccion{
      width: 94%;
      padding-top: 4px;
    } */
}

#header-seccion h5{
    margin: 0 !important;
    padding: 0 !important;
    width: 100% !important;
    height: 36px;
    font-size: 23px;
    font-family:monospace;
  }


         #nav-imgs{
    background: -webkit-linear-gradient(-135deg, #c6c6c6, #c09f77);
    background: -o-linear-gradient(-135deg, #c6c6c6, #c09f77);
    background: -moz-linear-gradient(-135deg, #c6c6c6, #c09f77);
    background: linear-gradient(-135deg, #c6c6c6, #c09f77);
  }

         #sidenav-menu{
    background-color: #394049;
  }



  #datos-usuario{
        background-color: #152f4a;
        padding: 14px 10px 14px 10px;
        border-radius: 0px 0 40px 0;
        /*
        background: -webkit-linear-gradient(-135deg, #394049, #c09f77);
    background: -o-linear-gradient(-135deg, #394049, #c09f77);
    background: -moz-linear-gradient(-135deg, #394049, #c09f77);
    background: linear-gradient(-135deg, #394049, #c09f77);
    margin: 0;
    */
      }
      #datos-usuario h6{
        margin:0;
        /* padding-top: 4px; */
        color: #c6c6c6  ;
        /* height: 20px !important; */
      }

      

      
      .menu-body{
        background-color: #394049 !important;
      }
      .menu-body a{
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
   <ul id="sidenav-menu" class="sidenav sidenav-fixed" style="width:270px !important;">
      <div id="slider-sidenav-menu" class="slider">
         <ul id="nav-imgs" class="slides center-align">
            <li>
               <img class="responsive-img" style="width:180px; height:180px; background-size: contain; background-repeat: no-repeat;" src="{{asset('logos/fge_etiqueta.png')}}"> <!-- random image -->
            </li>
            {{--
            <li class="li-slider">
               <img class="responsive-img circle" style="width:180px; height:180px" src="{{asset('logos/gob-mich.jpg')}}"> <!-- random image -->
            </li>
            --}}
         </ul>
      </div>

      <div  style="margin-bottom:10px; background-color:#152f4a;">
        <div id="datos-usuario">
          @if (Auth::user()->tipo != 'administrador')
            {{-- <li><h6 class="center-align" style="padding-bottom: 5px;"><b>{{Auth::user()->fiscalia->nombre}}</b></h6></li>   --}}
          @endif
          <li><h6 class="center-align" style="padding-bottom: 7px;"><b>{{Auth::user()->name}}</b></h6></li>
          @if (Auth::user()->tipo == 'administrador')
            <li><h6 class="center-align"><b>ADMINISTRADOR</b></h6></li>
          @else
            <li><h6 class="center-align"><b>{{Auth::user()->cargo->nombre}}</b></h6></li>
          @endif
        </div>
      </div>

      <!--menu responsable-->
      @if ( in_array(Auth::user()->tipo, ['administrador','responsable_bodega']) )
        @include('plantilla.menu_responsable_bodega')
        {{-- @include('plantilla.menu_armas')  --}}
      <!--menu usuario-->
      @elseif( Auth::user()->tipo == 'usuario' )
        @include('plantilla.menu_cadena_custodia')
        @if ( Auth::user()->unidad->coordinacion == 'si' )
          @include('plantilla.menu_peticiones')
        @endif
          
        @if ( Auth::user()->unidad_id == 1 )
          @include('plantilla.menu_colectivos')  
        @endif
      <!--menu admin_peticiones-->
      @elseif( in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_unidad','coordinador_peticiones_region']) )
        {{-- @include('plantilla.menu_admin_peticiones') --}}
        @include('plantilla.menu_peticiones')
      <!--menu admin_colectivos-->
      @elseif( Auth::user()->tipo == 'admin_colectivos' )
        @include('plantilla.menu_admin_colectivos')  
      @endif
      
      <li>
        <a href="{{route('cerrar-sesion')}}"><i style="color: #c09f77; font-size:35px;" class="fas fa-sign-out-alt"></i> <span style="color:tomato; font-size: 15px;">CERRAR SESIÓN</span></a>
      </li>
      {{-- <hr class="hr-4"> --}}
    </ul>

    <header style="background-color:#152f4a;">
      @yield('header')
   </header>

   <main>
      @yield('contenido')
   </main>

   @include('plantilla.maquetado.js')

</body>
</html>

<!-- <head> -->
  <!--css - css-->
<!-- </head-->
<!-- <body> -->
  <!--header - seccion-->
  <!--main - contenido-->
  <!--js - js-->
<!-- </body> -->
