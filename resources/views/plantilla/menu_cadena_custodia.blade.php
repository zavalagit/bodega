<!--Datos Sistema-->
{{-- <div id="datos-sistema">
   <h6 class="center-align"> <b>REGISTRO/CONSULTA DE CADENA DE CUSTODIA</b> </h6>
 </div> --}}

<!--submenu-->
<li class="item-menu">
   <ul class="collapsible" data-collapsible="expandable">
      <li id="submenu-cadenas" class="submenu">
         <div class="collapsible-header" style="margin-bottom:10px;"><i class="fas fa-circle"></i>CADENA DE CUSTODIA</div>
         
         <div class="collapsible-body">
            <a href="/registrar-cadena" id="vista-cadena-registrar" class=""><i class="fas fa-pen"></i><span>REGISTRAR</span></a>
         </div>
         <div class="collapsible-body">
            <a href="/consultar-cadena" id="vista-cadena-consultar" class=""><i class="fas fa-file-alt"></i><span>CONSULTAR</span></a>
         </div>
      </li>
   </ul>
</li>
<hr class="hr-menu">
 {{-- @if (Auth::user()->unidad->coordinacion == 'si')
 <li class="link"><a href="/peticion-registrar" class=""><i class="fas fa-exchange-alt"></i>PETICIONES</a></li>         
@endif --}}