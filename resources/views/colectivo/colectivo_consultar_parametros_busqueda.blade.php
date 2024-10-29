<div class="row">
   @component('componentes.componente_seccion_titulo')
       @slot('mensaje','1. PARÁMETROS DE BUSQUEDA')
       @slot('icono','fas fa-search')
   @endcomponent
   {{-- @if (Auth::user()->tipo != 'usuario')
   <div class="chip col s2" style="margin-left: 10px !important;">
      <span><b>GRUPO FAMILIAR:</b></span> {{old('b_grupo_familiar') ?: '---'}}
   </div>
   @endif --}}
   <div class="chip col s2" style="margin-left: 10px !important;"{{--style="{{(Auth::user()->tipo == 'usuario') ? 'margin-left: 10px !important' : ''}}"--}}>
      <span><b>NOMBRE:</b></span> {{old('b_nombre') ?: '---'}}
   </div>
   @if (Auth::user()->tipo != 'usuario')
   <div class="chip col s2">
      <span><b>REGIÓN:</b></span> {{old('b_fiscalia') ? $fiscalias->where('id',old('b_fiscalia'))->first()->nombre : '---'}}
   </div>
   @endif
   <div class="chip col s2">
      <span><b>FECHA INICIO:</b></span> {{old('b_fecha_inicio') ? date('d-m-Y',strtotime(old('b_fecha_inicio'))) : '---'}}
    </div>
   <div class="chip col s2">
      <span><b>FECHA TERMINO:</b></span> {{old('b_fecha_termino') ? date('d-m-Y',strtotime(old('b_fecha_termino'))) : '---'}}
    </div>
</div>