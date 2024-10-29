@php
   $entrada_estado = '';
   $entrada_estado .= $cadena->indicios->whereIn('estado',['activo','activo_baja'])->count() > 0 ? 'activo' : ''; 
   $entrada_estado .= $cadena->indicios->whereIn('estado',['prestamo','prestamo_baja'])->count() > 0 ? '_prestamo' : ''; 
   $entrada_estado .= $cadena->indicios->whereIn('estado',['baja','baja_duplicada','activo_baja','prestamo_baja'])->count() > 0 ? '_baja' : '';
   
   if(strpos($entrada_estado,'_') === 0) $entrada_estado = substr($entrada_estado,1);
@endphp

<!--cadena_estado-->
@if (Auth::user()->tipo == 'administrador')    
   @if ($cadena->estado == 'revision')
      <i style="color: #fff;" class="fas fa-square cadena-estado-revision"></i> 
   @elseif ($cadena->estado == 'bloqueada')
      <i style="color: #000;" class="fas fa-square cadena-estado-bloqueada"></i> 
   @endif
@endif

 
@if ($entrada_estado === 'activo')
   <i style="color: #76ff03;" class="fas fa-square"></i>
@elseif($entrada_estado === 'prestamo')
   <i style="color: #0d47a1;" class="fas fa-square cadena-estado-prestamo"></i>
@elseif($entrada_estado === 'baja')
   <i style="color: #b71c1c;" class="fas fa-square cadena-estado-baja"></i>
@elseif($entrada_estado === 'baja_duplicada')
   <i style="color: #b71c1c;" class="fas fa-square cadena-estado-baja"></i>
@elseif($entrada_estado === 'activo_prestamo')
   <i style="color: #18ffff;" class="fas fa-square"></i>
@elseif($entrada_estado === 'activo_baja')
   <i style="color: #ffff00;" class="fas fa-square"></i>
@elseif($entrada_estado === 'prestamo_baja')
   <i style="color: #d500f9;" class="fas fa-square"></i>
@elseif($entrada_estado === 'activo_prestamo_baja')
   <i style="color: #fff;" class="fas fa-square"></i>
@endif

<!--cadena_observacion-->
@if(isset($cadena->entrada->observacion) && $cadena->entrada->observacion != '')
   <a href="" class="btn-observacion" data-cadena-folio="{{$cadena->folio_bodega}}" data-cadena-observacion="{{$cadena->entrada->observacion}}">
      <i style="color:indigo;" class="fas fa-square cadena-estado-observacion"></i>
   </a>
@endif
<!--cadena_habilitada-->
@if ( ($cadena->editar == 'si') && ($cadena->estado == 'validada' ) )
{{-- @php $estado = false; @endphp --}}
<a href="" class="btn-inhabilitar" data-cadena-folio="{{$cadena->folio_bodega}}" data-cadena-id="{{$cadena->id}}">
   <i style="color: #ff9800;" class="fas fa-square cadena-estado-editar"></i>
</a>
@endif

{{-- 
@php $estado = true; @endphp
<!--estados de la cadena-->
@if (Auth::user()->tipo == 'administrador')    
   @if ($cadena->estado == 'revision')
      @php $estado = false; @endphp
      <i style="color: #fff;" class="fas fa-square cadena-estado-revision"></i> 
   @elseif ($cadena->estado == 'espera')
      @php $estado = false; @endphp
      <i style="color: #ffff00;" class="fas fa-square cadena-estado-espera"></i> 
   @elseif ($cadena->estado == 'rechazada')
      @php $estado = false; @endphp
      <i style="color: #dd2c00;" class="fas fa-square cadena-estado-rechazada"></i> 
   @elseif ($cadena->estado == 'bloqueada')
      @php $estado = false; @endphp
      <i style="color: #000;" class="fas fa-square cadena-estado-bloqueada"></i> 
   @endif
@endif
<!--estados de la entrada-->
@if ( ($cadena->editar == 'si') && ($cadena->estado == 'validada' ) )
   @php $estado = false; @endphp
   <a href="" class="btn-inhabilitar" data-cadena-folio="{{$cadena->folio_bodega}}" data-cadena-id="{{$cadena->id}}">
      <i style="color: #ff9800;" class="fas fa-square cadena-estado-editar"></i>
   </a>
@endif
@if ($cadena->bajas->count())
   @php $estado = false; @endphp
   <i style="color: red;" class="fas fa-square cadena-estado-baja"></i>
@endif
@if ($cadena->prestamos->count() && ($cadena->prestamos->last()->estado == 'activo'))
   @php $estado = false; @endphp
   <i style="color: #42a5f5;" class="fas fa-square cadena-estado-prestamo"></i>
@endif
@if ($estado)
   <i style="color: #76ff03;" class="fas fa-square cadena-estado-activo"></i>
@endif
@isset($cadena->entrada)
   @if($cadena->entrada->observacion != '')
      <a href="" class="btn-observacion" data-cadena-folio="{{$cadena->folio_bodega}}" data-cadena-observacion="{{$cadena->entrada->observacion}}">
         <i style="color: #b388ff;" class="fas fa-square cadena-estado-observacion"></i>
      </a>
   @endif
@endisset --}}