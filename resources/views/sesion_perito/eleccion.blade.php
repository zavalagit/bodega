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
    
	<style type="text/css">	
	  .logo-fondo2{
            margin: auto;
            background: -webkit-linear-gradient(-135deg, #c6c6c6, #c09f77);
            background: -o-linear-gradient(-135deg, #c6c6c6, #c09f77);
            background: -moz-linear-gradient(-135deg, #c6c6c6, #c09f77);
            background: linear-gradient(-135deg, #c6c6c6, #c09f77);
            width: 960px;
            height: 800px;
        }

        
        .container-login100-form-btn {
            width: 100%;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding-top: 20px;
        }

        .login100-form-btn {
            font-family: Montserrat-Bold;
            font-size: 15px;
            line-height: 1.5;
            color: #fff;
            text-transform: uppercase;
            

            width: 25%;
            height: 50px;
            border-radius: 25px;
            background: #9e9e9e;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 25px;

            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }

        .login100-form-btn:hover {
            background: #333333;
        }

   </style>

     
      

</head>

<body class="brown lighten-5">

   <div class="center-align logo-fondo2">
                <span class="z-depth-5" style="color:#fff">
                        ELIJA UN SISTEMA DE LAS OPCIONES 
                    </span>
                    
                         
                        <div class="container-login100-form-btn">
                                <img src="{{asset('_login/images/fge.png')}}" class="responsive-img" width="200" height="200"/>
                        </div>
                                
                        <div class="container-login100-form-btn">
                                <button class="login100-form-btn" onclick="location.href = '/peticion-registrar'">
                                        Registrar Cadena Custodia
                                </button>
                        </div>

                              
                        <div class="container-login100-form-btn">
                                <button class="login100-form-btn" onclick="location.href = '/peticion-consultar'">
                                        Registrar Consultar Peticiones
                                </button>
                        </div>


                        
                                        

                                   
                    
                
               
        </div>	

   



   


   <!--JS-->
      <!--jQuey-->
      <script src="{{asset('plugins/jQuery/jquery.min.js')}}"></script>
      <!--js materialize-->
      <script src="{{asset('plugins/materialize/js/materialize.js')}}"></script>
      <!--alertify-->
      <script src="{{asset('plugins/alertify/js/alertify.min.js')}}"></script>
      <!--funciones jQuery de materialize-->
      <script src="{{asset('js/funcionesMaterialize.js')}}"></script>

      
      
     
      <!--js para las vistas-->
      @yield('js')

</body>
</html>
