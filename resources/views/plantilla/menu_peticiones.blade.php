{{-- <li class="item-menu">
   <ul class="collapsible" data-collapsible="expandable">
      <li id="submenu-peticiones" class="submenu">
         <div class="collapsible-header" style="margin-bottom:10px;"><i class="fas fa-circle"></i>PETICIONES</div>

         <div class="collapsible-body">
            <a href="/peticion-registrar" id="vista-peticion-registrar"><i class="fas fa-pen"></i><span>REGISTRAR</span></a>
         </div>
         <div class="collapsible-body">
            <a href="/peticion-consultar" id="vista-peticion-consultar"><i class="fas fa-file-alt"></i><span>CONSULTAR</span></a>
         </div>
         <div class="collapsible-body">
            <a href="/peticion-dia/usuario/{{Auth::user()->id}}" id="vista-peticion-dia"><i class="fas fa-file-alt"></i><span>REGISTROS DEL DÍA</span></a>
         </div>
         <div class="collapsible-body">
            <a href="/concentrado-dia/usuario/{{Auth::user()->id}}" id="vista-peticion-concentrado-diario"><i class="fas fa-file-alt"></i><span>CONC. DIARIO</span></a>
         </div>
         <div class="collapsible-body">
            <a href="/peticion-estadistica/usuario/{{Auth::user()->id}}" id="vista-peticion-estadistica"><i class="fas fa-file-alt"></i><span>MI ESTADISTICA</span></a>
         </div>
      </li>
   </ul>
</li>
<hr class="hr-menu"> --}}

<li class="item-menu">
   <ul class="collapsible expandable">
      <li>
         

         <div class="menu-header collapsible-header" style="margin-bottom:10px;"><i class="fas fa-circle"></i>PETICIONES</div>

         <div class="menu-body collapsible-body">
            <ul>

               {{-- <hr class="hr-2"> --}}

               
				@if( in_array(Auth::user()->tipo,['usuario','administrador_peticiones']) )
                  <li class="{{request()->route()->named('peticion_form') ? 'item-selected' : ''}}">
                     <a href="{{route('peticion_form',['formAccion'=>'registrar'])}}"><i class="fas fa-edit"></i><span>REGISTRAR</span></a>
                  </li>

                  <hr class="hr-2">
               @endif
               

               <li class="{{request()->route()->named('peticion_consultar') ? 'item-selected' : ''}}">
                  <a href="{{route('peticion_consultar')}}"><i class="fas fa-book-open"></i><span>CONSULTAR</span></a>
               </li>
               
               <hr class="hr-2">

               <li class="{{request()->route()->named('peticion_consultar_necropsias') ? 'item-selected' : ''}}">
                  <a href="{{route('peticion_consultar_necropsias')}}"><i class="fas fa-book-open"></i><span>NECROPSIAS</span></a>
               </li>

               <hr class="hr-2">

               <li class="{{request()->route()->named('peticion_dia') ? 'item-selected' : ''}}">
                  <a href="{{route('peticion_dia')}}"><i class="fas fa-sun"></i><span>REGISTROS DEL DÍA</span></a>
               </li>

               <hr class="hr-2">
               
               @if (Auth::user()->tipo == 'administrador_peticiones')
                  <li class="{{request()->route()->named('peticion_concentrado') ? 'item-selected' : ''}}">
                     <a href="{{route('peticion_concentrado')}}"><i class="fas fa-sun"></i><span>CONCENTRADO</span></a>
                  </li>

                  <hr class="hr-2">                   
               @endif

               <li class="{{request()->route()->named('peticion_estadistica') ? 'item-selected' : ''}}">
                  <a href="{{route('peticion_estadistica')}}"><i class="fas fa-chart-bar"></i><span>ESTADISTICA</span></a>
               </li>

			@if( Auth::user()->tipo == 'coordinador_peticiones_unidad' )
               <hr class="hr-2">


               <li class="{{request()->route()->named('peticion_reporte') ? 'item-selected' : ''}}">
                  <a href="{{route('peticion_reporte')}}"><i class="fas fa-file-pdf"></i><span>REPORTES</span></a>
               </li>
			@endif

            </ul>
         </div>
      </li>
   </ul>
</li>
<hr class="hr-4">




