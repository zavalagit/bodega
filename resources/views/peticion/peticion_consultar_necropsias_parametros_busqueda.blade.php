@component('componentes.componente_seccion_titulo')
   @slot('mensaje','· PARAMETROS DE BUSQUEDA')
   @slot('icono','fas fa-search')
@endcomponent
<!--region-->
@if (Auth::user()->tipo == 'administrador_peticiones')
   <div class="col l2 chip" style="margin-left: 11px !important">
      <span><b>REGIÓN:</b></span> {{(old('b_region') ? $regiones->where('id',old('b_region'))->first()->nombre : '---')}}</p>
   </div>
@endif
<!--fecha_inidio-->
<div class="col l2 chip" style="{{Auth::user()->tipo == 'administrador_peticiones' ? 'margin-left: 11px !important' : ''}}">
   <span><b>FECHA INICIO:</b></span> {{old('b_fecha_inicio') ? date( 'd-m-Y',strtotime( old('b_fecha_inicio') ) ) : date('d-m-Y') }}</p>
</div>
<!--fecha_termino-->
<div class="col l2 chip">
   <span><b>FECHA TERMINO:</b></span> {{old('b_fecha_fin') ? date( 'd-m-Y',strtotime( old('b_fecha_termino') ) ) : '---' }}</p>
</div>
