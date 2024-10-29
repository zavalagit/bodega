<li class="item-menu">
   <ul class="collapsible expandable">
      <li>
         @php $modelo = Auth::user()->tipo == 'usuario' ? 'user' : (Auth::user()->tipo == 'coordinador_peticiones_unidad' ? 'unidad' : 'region'); 
               $modelo_id = Auth::user()->tipo == 'usuario' ? Auth::user()->id : (Auth::user()->tipo == 'coordinador_peticiones_unidad' ? Auth::user()->unidad_id : Auth::user()->fiscalia_id); @endphp

         <div class="menu-header collapsible-header" style="margin-bottom:10px;"><i class="fas fa-circle"></i>PETICIONES</div>

         <div class="menu-body collapsible-body">
            <ul>

               {{-- <hr class="hr-2"> --}}

               <li class="{{request()->route()->named('peticion_form') ? 'item-selected' : ''}}">
                  <a href="{{route('peticion_form',['formAccion'=>'registrar'])}}"><i class="fas fa-edit"></i><span>REGISTRAR</span></a>
               </li>
               
               <hr class="hr-2">

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

               <li class="{{request()->route()->named('peticion_estadistica') ? 'item-selected' : ''}}">
                  <a href="{{route('peticion_estadistica')}}"><i class="fas fa-chart-bar"></i><span>ESTADISTICA</span></a>
               </li>
               
               <hr class="hr-2">

               <li class="{{request()->route()->named('peticion_reporte') ? 'item-selected' : ''}}">
                  <a href="{{route('peticion_reporte',['modelo'=>$modelo,'modelo_id'=>$modelo_id])}}"><i class="fas fa-file-pdf"></i><span>REPORTES</span></a>
               </li>

            </ul>
         </div>
      </li>
   </ul>
</li>
<hr class="hr-4">


