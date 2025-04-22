   {{-- <li id="li-entradas" class="item-menu"><a href="" id="btn-guia-colores"><i class="fas fa-palette"></i><span>Guía de colores</span></a></li> --}}
   <li class="item-menu {{request()->route()->named('entradas') ? 'item-selected' : ''}}"><a href="/bodega/entradas" id="vista-entradas" ><i class="fa fa-check-circle"></i><span>ENTRADAS</span></a></li>

   {{-- <li class="item-menu"> <hr class="hr-2"> </li> --}}

   <li class="item-menu"><a href="/bodega/revisar" id="vista-cadena-revisar"><i class="fa fa-question-circle"></i><span>POR REVISAR</span></a></li>

   {{-- <li class="item-menu"> <hr class="hr-2"> </li> --}}

   <li id="li-capturar" class="item-menu"><a href="/bodega/capturar" id="vista-cadena-capturar"><i class="fa fa-arrow-circle-right"></i><span>CAPTURAR</span></a></li>
   {{-- <li id="li-rechazadas" class="item-menu"><a href="/bodega/cadenas-rechazadas"><i class="fa fa-times-circle"></i><span>RECHAZADAS</span></a></li> --}}
   {{-- <li id="li-espera" class="item-menu"><a href="/bodega/cadenas-espera"><i class="fas fa-pause-circle"></i><span>ESPERA</span></a></li> --}}

   {{-- <li class="item-menu"> <hr class="hr-2"> </li> --}}


   <li id="li-prestamos" class="item-menu"><a href="/bodega/prestamos" id="vista-prestamos"><i class="fa fa-arrow-circle-left"></i><span>PRESTAMOS</span></a></li>

   {{-- <li class="item-menu"> <hr class="hr-2"> </li> --}}

   <li class="item-menu"><a href="/bodega/bajas"><i class="fa fa-arrow-circle-down"></i><span>BAJAS</span></a></li>

   {{-- <li class="item-menu"> <hr class="hr-2"> </li> --}}

   <li class="item-menu"><a href="/bodega/capturar-perito" target="_blank"><i class="fas fa-user-plus"></i><span>Registrar S. Público</span></a></li>

   {{-- <li class="item-menu"> <hr class="hr-4"> </li> --}}
   <hr class="hr-4">

<!--submenu-->
   <li class="item-menu">
      <ul class="collapsible expandable">
         <li>
            <div class="menu-header collapsible-header" style="margin-bottom:10px;"><i class="fas fa-file"></i>REPORTES / LISTADOS</div>
            
            <div class="menu-body collapsible-body">
               <a href="/bodega/reporte" id="vista-reporte-diario"><i class="fas fa-sun"></i><span>Reporte Diario</span></a>
            </div>

            <div class="menu-body collapsible-body">
               <hr class="hr-2">
            </div>

            <div class="menu-body collapsible-body">
               <a href="/bodega/caratula" id="vista-caratula-entradas"><i class="fas fa-file-alt"></i><span>Lista-entradas (Caratula)</span></a>
            </div>

            <div class="menu-body collapsible-body">
               <hr class="hr-2">
            </div>

            <div class="menu-body collapsible-body">
               <a href="/bodega/lista-cadenas" id="vista-listado-cadenas"><i class="fas fa-file-alt"></i><span>Listado General</span></a>
            </div>
            
            <div class="menu-body collapsible-body">
               <hr class="hr-2">
            </div>

            <div class="menu-body collapsible-body">
               <a href="/reporte-armas" id="vista-reporte-armas"><i class="fas fa-fire"></i><span>Reporte de armas</span></a>
            </div>
         </li>
      </ul>
   </li>

   <li class="item-menu">
      <ul class="collapsible expandable">
         <li>
            <div class="menu-header collapsible-header" style="margin-bottom:10px;"><i class="fa fa-ban"></i> DEPURACIÓN</div>
            <div class="menu-body collapsible-body">
               <a href="/listado-destruccion"><i class="fas fa-list-ol"></i><span>Listado General</span></a>
            </div>
            <div class="menu-body collapsible-body">
               <a href="/indicio-destruccion"><i class="fas fa-list-ol"></i><span>Asignar Indicio</span></a>
            </div>
            <div class="menu-body collapsible-body">
               <a href="/registro-destruccion"><i class="fas fa-file-alt"></i><span>Registrar</span></a>
            </div>
            <div class="menu-body collapsible-body">
               <a href="/reporte-destruccion"><i class="fas fa-chart-line"></i><span>Reportes</span></a>
            </div>
         </li>
      </ul>
   </li>
   <hr class="hr-4">

<!--administrador-->
   @if (Auth::user()->tipo == 'administrador')
      <li class="item-menu">
         <ul class="collapsible expandable">
            <li>
               <div class="menu-header collapsible-header" style="margin-bottom:10px;"><i class="fas fa-flask"></i> RESGUARDO I/E</div>
               <div class="menu-body collapsible-body">
               <a href="/ubicacion-administrar"><i class="fas fa-file-alt"></i><span>ñadir lugar - ubicación</span></a>
               </div>
               <div class="menu-body collapsible-body">
               <a href="/ubicacion-consultar"><i class="fas fa-file-alt"></i><span>signar lugar - ubiación</span></a>
               </div>
            </li>
         </ul>
      </li>
      <hr class="hr-4">
      <li class="item-menu">
         <ul class="collapsible expandable">
            <li>
               <div class="menu-header collapsible-header" style="margin-bottom:10px;"><i class="fas fa-chart-pie"></i> ESTADÍSTICA</div>
               <div class="menu-body collapsible-body">
               <a href="/indicio-inventario"><i class="fas fa-chart-line"></i><span>Inventario General</span></a>
               </div>
			   
            </li>
         </ul>
      </li>
      <hr class="hr-4">
      <li class="item-menu">
         <ul class="collapsible expandable">
            <li>
               <div class="menu-header collapsible-header" style="margin-bottom:10px;"><i class="fas fa-key"></i> ADMINISTRACIÓN</div>
               <div class="menu-body collapsible-body">
               <a href="/administrador/cadenas"><i class="fa fa-user-circle" aria-hidden="true"></i>CADENAS</a>
               </div>
               <div class="menu-body collapsible-body">
               <a href="/administrador/usuarios"><i class="fa fa-user-circle" aria-hidden="true"></i>USUARIOS</a>
               </div>
               <div class="menu-body collapsible-body">
               <a href="/administrador/resguardantes"><i class="fa fa-user-secret" aria-hidden="true"></i>SERVIDORES PUBLICOS</a>
               </div>
               <div class="menu-body collapsible-body">
               <a href="/administrador/instituciones">INSTITUCIONES</a>
               </div>
               <div class="menu-body collapsible-body">
               <a href="/administrador/cargos"><i class="fa fa-briefcase" aria-hidden="true"></i>CARGOS</a>
               </div>
               <div class="menu-body collapsible-body">
               <a href="/bodega/adscripciones">ADSCRIPCIONES</a>
               </div>
               <div class="menu-body collapsible-body">
               <a href="/administrador/naturalezas"><i class="fa fa-leaf" aria-hidden="true"></i>NATURALEZAS </a>
               </div>
               <div class="menu-body collapsible-body">
               <a href="/administrador/unidades">UNIDADES</a>
               </div>
               <div class="menu-body collapsible-body">
               <a href="/administrador/fiscalias">FISCALIAS</a>
               </div>
            </li>
         </ul>
      </li>
      <hr class="hr-4">
   @endif
   