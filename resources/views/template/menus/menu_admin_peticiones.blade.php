<li class="item-menu"><a href="/peticion-consultar" id="vista-colectivo-revision"><i class="fa fa-question-circle"></i><span>CONSULTAR</span></a></li>
<li class="item-menu"><a href="/peticion-diaria-compacta" id="vista-colectivo-revision"><i class="fa fa-question-circle"></i><span>DIARIO COMPACTA</span></a></li>

@php
   if ( Auth::user()->tipo == 'usuario' ) {
      $modelo = 'usuario';
      $modelo_id = Auth::id();
   }
   elseif ( Auth::user()->tipo == 'coordinador_peticiones_unidad' ){
      $modelo = 'unidad';
      $modelo_id = Auth::user()->unidad_id;         
   }
   elseif ( Auth::user()->tipo == 'coordinador_peticiones_unidad' ){
      $modelo = 'region';
      $modelo_id = Auth::user()->fiscalia_id;
   }
@endphp

<li class="item-menu {{request()->route()->named('peticion_estadistica') ? 'item-selected' : ''}}">
   <a href="/peticion2-estadistica/{{ Auth::user()->tipo != 'administrador_peticiones' ? $modelo.'/'.$modelo_id : 'administrador' }}">
      <i class="fa fa-question-circle"></i><span>PETICIÓN ESTADISTICA</span>
   </a>
</li>
<li class="item-menu {{request()->route()->named('peticion_dia') ? 'item-selected' : ''}}">
   <a href="/peticion2-dia/{{ Auth::user()->tipo != 'administrador_peticiones' ? $modelo.'/'.$modelo_id : 'administrador' }}">
      <i class="fa fa-question-circle"></i><span>PETICIÓN DÍA</span>
   </a>
</li>
<!--colectivo-estadistica-->
<li class="item-menu {{request()->route()->named('colectivo_estadistica') ? 'item-selected' : ''}}">
   <a href="/colectivo-estadistica/{{ Auth::user()->tipo != 'administrador_peticiones' ? $modelo.'/'.$modelo_id : 'administrador' }}">
      <i class="fa fa-question-circle"></i><span>COLECTIVO ESTADISTICA</span>
   </a>
</li>