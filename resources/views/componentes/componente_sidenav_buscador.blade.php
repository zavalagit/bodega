<ul id="sidenav-buscador" class="sidenav">
   <li><div class="subheader"><h5 class="center-align"><b><i class="fas fa-search"></i> Buscar...</b></h5></div></li>
   <!--hr-->
   <li>
      <div class="row">
         <div class="col s12">
            <hr class="hr-3">
         </div>
      </div>
   </li>
   <!--form-->
   <li>
      <div class="row">
         <!--recibe un form con la clase col s12-->
         {{ $slot }}
      </div>
   </li>
</ul>

<!--Este boton activa el sidenav, esto debe ir en la vista que desee llamas al sidenav-->
{{--
   #HTML 
   <div class="row">
      <div class="col s1 l1 offset-s11 offset-l11 right-align">
         <a href="#" class="btn-sidenav-buscador-open pulse"><i class="fas fa-search fa-2x"></i></a>
      </div>
   </div>

   #CSS
   <link rel="stylesheet" href="{{asset('/css/nav/sidenav_buscador.css')}}">
   
   #JS
   <script src="{{asset('/js/general/sidenav_buscador.js')}}"></script>
--}}