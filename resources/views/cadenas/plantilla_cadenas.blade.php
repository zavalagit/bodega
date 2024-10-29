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
      <!--Colores de los formularios (REVISAR)-->
      <link rel="stylesheet" href="{{asset('css/colores.css')}}">
      <!--alertify-->
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.core.css')}}">
      <link rel="stylesheet" href="{{asset('plugins/alertify/css/alertify.default.css')}}">

      <link rel="stylesheet" href="{{asset('css/tablas.css')}}">
      
      <!--css para las vistas-->
      @yield('css')
      <!--css nav
        <link rel="stylesheet" href="{{asset('css/cadenas/nav.css')}}">
      -->

    <style>
      header, main, footer {
    padding-left: 220px;
}

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

      #datos-sistema{
        background-color: #152f4a;
        padding-top: 3px;
        /*
        background: -webkit-linear-gradient(225deg, #304049, #c09f77);
    background: -o-linear-gradient(225deg, #304049, #c09f77);
    background: -moz-linear-gradient(225deg, #304049, #c09f77);
    background: linear-gradient(225deg, #304049, #c09f77);
    margin: 0;
    */
      }
      #datos-sistema h6{
        color: #c09f77;
        margin: 0;
        padding-bottom: 4px;
      }



      /* .fas:hover{
        font-size: 100%;
      } */
      .link a{
        padding: 0 0 0 20px !important;
        color: #c6c6c6 !important;
        font-weight: bold !important;
      }
      .link a i{
        margin: 0 20px 0 0 !important;
        color: #c6c6c6 !important;
      }
      .link a:hover{
        
        color: #c09f77 !important;
      }

    </style>

</head>

<body>

   <ul id="slide-out" class="side-nav fixed">
      <div class="slider">
         <ul id="nav-imgs" class="slides center-align">
            <li class="li-slider">
               <img class="responsive-img" style="width:180px; height:180px; background-size: contain; background-repeat: no-repeat;" src="{{asset('logos/fge.png')}}"> <!-- random image -->
            </li>
            {{--
              <li class="li-slider">
                <img class="responsive-img circle" style="width:180px; height:180px" src="{{asset('logos/gob-mich.jpg')}}"> <!-- random image -->
              </li>
            --}}
         </ul>
      </div>

      <!--Datos Perito-->
      <div id="datos-usuario">
          <h6 class="center-align"><b>{{Auth::user()->name}}</b></h6>
          <h6 class="center-align"><b>{{Auth::user()->cargo->nombre}}</b></h6>
      </div>
      

    
      
      <!--Salir-->
      <li class="link"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class=""><i style="color:red !important;" class="fas fa-sign-out-alt"></i>SALIR</a></li>

   </ul>
   

      
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
      <script src="{{asset('js/funcionesMaterialize.js')}}"></script>
      <!--JS Maker-->
      <script src="{{asset('plugins/js_maker/jquery.mark.min.js')}}" charset="UTF-8"></script>
      <!--js para las vistas-->
      @yield('js')

</body>
</html>
