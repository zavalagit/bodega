<!DOCTYPE html>
<html lang="es-MX">
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
      <link rel="stylesheet" href="{{asset('fuentes/fontawesome/css/all.min.css')}}">


      
      <link rel="stylesheet" href="{{asset('css/materialize.css')}}">

      <!--alertify-->
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.core.css')}}">
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.default.css')}}">

      <!--JS Marker [CSS]-->
      <link rel="stylesheet" href="{{asset('css/js_maker.css')}}">


      <link rel="stylesheet" href="{{asset('css/tabla-scroll.css')}}">

      <!--Colores de los iconos del menu-->
      <link rel="stylesheet" href="{{asset('css/colorIcon.css')}}">


      <link rel="stylesheet" href="{{asset('css/colores.css')}}">

      <!--css para las vistas-->
      @yield('css')


      <style media="screen">

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
  background-color: #c09f77;
  color: #304049;
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
    background-color: #304049;
  }



  #datos-usuario{
        background-color: #152f4a;
        /*
        background: -webkit-linear-gradient(-135deg, #304049, #c09f77);
    background: -o-linear-gradient(-135deg, #304049, #c09f77);
    background: -moz-linear-gradient(-135deg, #304049, #c09f77);
    background: linear-gradient(-135deg, #304049, #c09f77);
    margin: 0;
    */
      }
      #datos-usuario h6{
        margin:0;
        padding-top: 4px;
        color: #c6c6c6;
      }

      .link a{
        padding: 0 0 0 20px !important;
        color: #c6c6c6 !important;
        font-weight: bold !important;
      }

      .link a:hover{
        
        color: #c09f77 !important;
      }

      .link a i{
        margin: 0 20px 0 0 !important;
        
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

      <div id="datos-usuario">
         <li><h6 class="center-align"><b>{{Auth::user()->fiscalia->nombre}}</b></h6></li>
         <li><h6 class="center-align"><b>{{Auth::user()->name}}</b></h6></li>
         <li><h6 class="center-align"><b>{{Auth::user()->cargo->nombre}}</b></h6></li>
      </div>

      <div class="enlaces">
            <ul class="collapsible collapsible-accordion">

               <li class="li-cadenas"><a href="/administrador/fiscalia" class="indigo-text text-darken-4"><i class="fa fa-building" aria-hidden="true"></i>FISCALIAS</a></li>
               <!--Proyetos-->
               <li class="">
                  <a class="collapsible-header waves-effect" href="#"><i class="fa fa-key fa-building" aria-hidden="true"></i>ADMINISTRACIÓN</a>
                 <div class="collapsible-body sub-lista">
                   <ul>
                     <li><a href="/administrador/cadenas"><i class="fa fa-user-circle" aria-hidden="true"></i>CADENAS</a></li>
                     <li><a href="/administrador/usuarios"><i class="fa fa-user-circle" aria-hidden="true"></i>USUARIOS</a></li>
                     <li><a href="/administrador/resguardantes"><i class="fa fa-user-secret" aria-hidden="true"></i>SERVIDORES PUBLICOS</a></li>
                     <li><a href="/administrador/instituciones">INSTITUCIONES</a></li>
                     <li><a href="/administrador/cargos"><i class="fa fa-briefcase" aria-hidden="true"></i>CARGOS</a></li>
                     <li><a href="/bodega/adscripciones">ADSCRIPCIONES</a></li>
                     <li><a href="/administrador/naturalezas"><i class="fa fa-leaf" aria-hidden="true"></i>NATURALEZAS </a></li>
                     <li><a href="/administrador/unidades">UNIDADES</a></li>
                     <li><a href="/administrador/fiscalias">FISCALIAS</a></li>
                   </ul>
                 </div>
               </li>

               <li><a href="usuario-password-reset" class="collapsible-header waves-effect"><i class="fa fa-building fa-2x" aria-hidden="true"></i>RESETPASS</a></li>
            </ul>
         </div>
      <li class="link li-bodega"><a href="{{ route('logout') }}" onclick="event.preventDefault();
               document.getElementById('logout-form').submit();"><i style="color:#00796b" class="fas fa-sign-out-alt"></i>SALIR</a></li>
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


      <script src="{{asset('js/nota.js')}}"></script>
      <script src="{{asset('js/validar.js')}}"></script>

      <script src="{{asset('js/foranea.js')}}"></script>
      <!--js para las vistas-->
      @yield('js')

</body>
</html>
