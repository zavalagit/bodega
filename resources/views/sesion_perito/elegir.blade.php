<!DOCTYPE html>
<html lang="es-MX">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>@yield('titulo')</title>

    <!--CSS-->
        <!--css materialize-->
        <link rel="stylesheet" href="{{asset('plugins/materialize/css/materialize.min.css')}}">
        



        <style type="text/css">	
            main{
                margin: auto;
                background: -webkit-linear-gradient(-135deg, #c09d77, #152f4a);
                background: -o-linear-gradient(-135deg, #c09d77, #152f4a);
                background: -moz-linear-gradient(-135deg, #c09d77, #152f4a);
                background: linear-gradient(-135deg, #c09d77, #152f4a);
                height: 100vh;
            }
      
              
              .div-btn{
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
      
              .btn {
                  font-family: Montserrat-Bold;
                  font-size: 15px;
                  line-height: 1.5;
                  color: #304049;
                  text-transform: uppercase;
                  
      
                  width: 25%;
                  height: 50px;
                  border-radius: 25px;
                  background: #c6c6c6;
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
      
              .btn:hover {
                  background: #304049;
                  color: #c09d77;
              }

            @media only screen and (max-width : 992px) {
                .btn{
                    width: 80%;
                }
            }
      
         </style>


    </head>

    <body>
        <main>                  
            <div class="div-btn">
                <img  style="margin-top:20px;" src="{{asset('_login/images/fge.png')}}" class="responsive-img" width="230" height="230"/>
            </div>
                                         
            <div class="div-btn" style="margin-top:20px;">
                <a class="btn" href="/registrar-cadena" >Registro-Consulta CadenaCustodia</a>

                <!--
                <button class="login100-form-btn" onclick="location.href = '/registrar-cadena'">
                        REGISTRO-CONSULTA CADENA DE CUSTODIA
                </button>
                -->
            </div>
                                       
            <div class="div-btn">
                <a class="btn" href="{{route('peticion_form',['formAccion'=>'registrar'])}}">Registro-Consulta Peticiones</a>
                <!--
                <button class="login100-form-btn" onclick="location.href = '/peticion-registrar'">
                        REGISTRO-CONSULTA PETICIONES
                </button>
                -->
            </div>

            <div class="div-btn">
                <a class="btn"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    >
                    <i class="fas fa-sign-out-alt"></i>SALIR
                </a>
            </div>

         
         
            <!--formulario logout-->                     
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>         
         
                                              
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
         
               
               
              
               <!--js para las vistas-->
               @yield('js')
         
         </body>
</html>
