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
     @include('plantilla.menu_armas') 
   <!--menu usuario-->
   @elseif( Auth::user()->tipo == 'usuario' )
     @include('plantilla.menu_cadena_custodia')
     {{-- @if ( Auth::user()->unidad->peticion == 'si' ||  Auth::user()->unidad1->peticion == 'si' ||  Auth::user()->unidad2->peticion == 'si') --}}
     @if ( Auth::user()->unidad->peticion == 'si')
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