<!DOCTYPE html>
<html lang="es-MX">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta id="meta-csrf-token" name="csrf-token" content="{{ csrf_token() }}">
   <span id="nombre-pagina" data-nombre-pagina="@yield('nombre_pagina')"></span>

   <!--CSS-->
      <!--css materialize-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="{{asset('plugins/materialize/css/materialize.min.css')}}">
      <!--font-awesome-->
      <link rel="stylesheet" href="{{asset('fuentes/fontawesome/css/all.min.css')}}">
    
      <link rel="stylesheet" href="{{asset('css/materialize.css')}}">

      <!--alertify-->
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.core.css')}}">
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.default.css')}}">


      <link rel="stylesheet" href="{{asset('css/tabla-scroll.css')}}">

      <!--Mark.js-->
      <link rel="stylesheet" href="{{asset('css/js_maker.css')}}">

      <!--Colores de los iconos del menu-->
      <link rel="stylesheet" href="{{asset('css/colorIcon.css')}}">


      <link rel="stylesheet" href="{{asset('css/colores.css')}}">
      <link rel="stylesheet" href="{{asset('/css/btn.css')}}">
      <link rel="stylesheet" href="{{asset('/css/hr.css')}}">
      
      <!--plantilla-->
      <link rel="stylesheet" href="{{asset('/css/plantilla/plantilla_menu.css')}}">
      <link rel="stylesheet" href="{{asset('/css/plantilla/plantilla_menu_item.css')}}">

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

@media only screen and (max-width : 992px) {
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

         .side-nav{
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
   <ul id="slide-out" class="side-nav fixed">
      <div class="slider">
         <ul id="nav-imgs" class="slides center-align">
		 
            <li class="li-slider">
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
            <li><h6 class="center-align" style="padding-bottom: 5px;"><b>{{Auth::user()->fiscalia->nombre}}</b></h6></li>  
          @endif
          <li><h6 class="center-align" style="padding-bottom: 7px;"><b>{{Auth::user()->name}}</b></h6></li>
          @if (Auth::user()->tipo == 'administrador')
            <li><h6 class="center-align"><b>ADMINISTRADOR</b></h6></li>
          @else  
            <li><h6 class="center-align"><b>{{Auth::user()->cargo->nombre}}</b></h6></li>
          @endif
        </div>
      </div>

      <li id="li-entradas" class="item-menu"><a href="/bodega/entradas" id="vista-entradas" ><i class="fa fa-check-circle"></i><span>ENTRADAS</span></a></li>
      <li id="li-revisar" class="item-menu"><a href="/bodega/revisar" id="vista-cadena-revisar"><i class="fa fa-question-circle"></i><span>POR REVISAR</span></a></li>
      <li id="li-capturar" class="item-menu"><a href="/bodega/capturar" id="vista-cadena-capturar"><i class="fa fa-arrow-circle-right"></i><span>CAPTURAR</span></a></li>


      {{-- <li id="li-rechazadas" class="item-menu"><a href="/bodega/cadenas-rechazadas"><i class="fa fa-times-circle"></i><span>RECHAZADAS</span></a></li> --}}

      {{-- <li id="li-espera" class="item-menu"><a href="/bodega/cadenas-espera"><i class="fas fa-pause-circle"></i><span>ESPERA</span></a></li> --}}

      <li id="li-prestamos" class="item-menu"><a href="/bodega/prestamos" id="vista-prestamos"><i class="fa fa-arrow-circle-left"></i><span>PRESTAMOS</span></a></li>

      <li class="item-menu"><a href="/bodega/bajas"><i class="fa fa-arrow-circle-down"></i><span>BAJAS</span></a></li>

      <li class="item-menu"><a href="/bodega/capturar-perito" target="_blank"><i class="fas fa-user-plus"></i><span>Registrar S. Público</span></a></li>

      {{-- <hr class="hr-menu"> --}}

      <li class="item-menu submenu">
        <ul class="collapsible" data-collapsible="expandable">
          <li>
            <div class="collapsible-header" style="margin-bottom:10px;"><i class="fas fa-file"></i>REPORTES / LISTADOS</div>
            <div class="collapsible-body">
              <a href="/bodega/reporte" id="vista-reporte-diario"><i class="fas fa-sun"></i><span>Reporte Diario</span></a>
            </div>
            <div class="collapsible-body">
              <a href="/bodega/caratula" id="ruta-caratula-entradas"><i class="fas fa-file-alt"></i><span>(Caratula) Lista-entradas</span></a>
            </div>
            <div class="collapsible-body">
              <a href="/bodega/lista-cadenas"><i class="fas fa-file-alt"></i><span>Listado General</span></a>
            </div>
            {{-- <div class="collapsible-body">
              <a href="/bodega/listado-copias-cadenas"><i class="fas fa-file-alt"></i><span>Oficio</span></a>
            </div> --}}
            <div class="collapsible-body">
              <a href="/reporte-armas"><i class="fas fa-fire"></i><span>Reporte de armas</span></a>
            </div>
          </li>
        </ul>
      </li>
      <hr class="hr-menu">
      <li class="item-menu submenu">
        <ul class="collapsible" data-collapsible="expandable">
          <li>
            <div class="collapsible-header"><i class="fa fa-ban"></i> DESTRUCCIÓN</div>
            <div class="collapsible-body">
              <a href="/indicio-destruccion"><i class="fas fa-list-ol"></i><span>Listado General</span></a>
            </div>
            <div class="collapsible-body">
              <a href="/registro-destruccion"><i class="fas fa-file-alt"></i><span>Registrar</span></a>
            </div>
            <div class="collapsible-body">
              <a href="/reporte-destruccion"><i class="fas fa-chart-line"></i><span>Reportes</span></a>
            </div>
          </li>
        </ul>
      </li>
      <hr class="hr-menu">
      @if (Auth::user()->tipo == 'administrador')
        <li class="item-menu submenu">
          <ul class="collapsible" data-collapsible="expandable">
            <li>
              <div class="collapsible-header"><i class="fas fa-flask"></i> RESGUARDO I/E</div>
              <div class="collapsible-body">
                <a href="/ubicacion-administrar"><i class="fas fa-file-alt"></i><span>ñadir lugar - ubicación</span></a>
              </div>
              <div class="collapsible-body">
                <a href="/ubicacion-consultar"><i class="fas fa-file-alt"></i><span>signar lugar - ubiación</span></a>
              </div>
            </li>
          </ul>
        </li>
        <hr class="hr-menu">
        <li class="item-menu submenu">
          <ul class="collapsible" data-collapsible="expandable">
            <li>
              <div class="collapsible-header"><i class="fas fa-chart-pie"></i> ESTADÍSTICA</div>
              <div class="collapsible-body">
                <a href="/indicio-inventario"><i class="fas fa-chart-line"></i><span>Inventario General</span></a>
              </div>
			  <!--
              <div class="collapsible-body">
                <a href="/estadistica-ie"><i class="fas fa-chart-bar"></i><span>Estadística e/s</span></a>
              </div>
			  -->
            </li>
          </ul>
        </li>
        <hr class="hr-menu">
        <li class="item-menu submenu">
          <ul class="collapsible" data-collapsible="expandable">
            <li>
              <div class="collapsible-header"><i class="fas fa-key"></i> ADMINISTRACIÓN</div>
              <div class="collapsible-body">
                <a href="/administrador/cadenas"><i class="fa fa-user-circle" aria-hidden="true"></i>CADENAS</a>
              </div>
              <div class="collapsible-body">
                <a href="/administrador/usuarios"><i class="fa fa-user-circle" aria-hidden="true"></i>USUARIOS</a>
              </div>
              <div class="collapsible-body">
                <a href="/administrador/resguardantes"><i class="fa fa-user-secret" aria-hidden="true"></i>SERVIDORES PUBLICOS</a>
              </div>
              <div class="collapsible-body">
                <a href="/administrador/instituciones">INSTITUCIONES</a>
              </div>
              <div class="collapsible-body">
                <a href="/administrador/cargos"><i class="fa fa-briefcase" aria-hidden="true"></i>CARGOS</a>
              </div>
              <div class="collapsible-body">
                <a href="/bodega/adscripciones">ADSCRIPCIONES</a>
              </div>
              <div class="collapsible-body">
                <a href="/administrador/naturalezas"><i class="fa fa-leaf" aria-hidden="true"></i>NATURALEZAS </a>
              </div>
              <div class="collapsible-body">
                <a href="/administrador/unidades">UNIDADES</a>
              </div>
              <div class="collapsible-body">
                <a href="/administrador/fiscalias">FISCALIAS</a>
              </div>
            </li>
          </ul>
        </li>
        <hr class="hr-menu">
      @endif

      <li class="item-menu"><a href="{{ route('logout') }}" onclick="event.preventDefault();
               document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>SALIR</a></li>
    </ul>
    <a href="#" data-activates="slide-out" class="button-collapse hide"><i class="material-icons">menu</i></a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
   </form>

   <header>
         <div id="header-menu" class="center-align">
           <a href="#" data-activates="slide-out" class="button-collapse">
             <b><i style="color:#c09f77;" class="fas fa-bars fa-lg"></i></b>
           </a>
         </div>
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
      <script src="{{asset('plugins/materialize/js/materialize.js')}}"></script>
      <!--alertify-->
      <script src="{{asset('plugins/alertify/js/alertify.min.js')}}"></script>
      <!--funciones jQuery de materialize-->
      <script src="{{asset('js/sesion_rbi/materialize.js')}}"></script>
      <!--JS Maker-->
      <script src="{{asset('plugins/js_maker/jquery.mark.min.js')}}" charset="UTF-8"></script>


      <!--plantilla-->
      <script src="{{asset('js/plantilla/plantilla_item_selected.js')}}"></script>
      

      {{-- <script src="{{asset('js/foranea.js')}}"></script> --}}
      <!--js para las vistas-->
      @yield('js')

</body>
</html>
