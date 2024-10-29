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
<div class="col l2 chip" style="{{Auth::user()->tipo != 'administrador_peticiones' ? 'margin-left: 11px !important' : ''}}">
   <span><b>N.U.C.:</b></span> {{old('b_nuc') ?: '---' }}</p>
</div>
<div class="col l2 chip">
   <span><b>ESPECIALIDAD:</b></span> {{old('b_especialidad') != 0 ? $especialidades->where('id',old('b_especialidad'))->first()->nombre : '---' }}</p>
</div>
<div class="col l5 chip">
   <span><b>SOLICITUD:</b></span> {{old('b_solicitud') != 0 ? $solicitudes->where('id',old('b_solicitud'))->first()->nombre : '---' }}</p>
</div>
<div class="col l2 chip" style="{{Auth::user()->tipo == 'administrador_peticiones' ? 'margin-left: 11px !important' : ''}}">
   <span><b>FECHA INICIO:</b></span> {{old('b_fecha_inicio') ? date( 'd-m-Y',strtotime( old('b_fecha_inicio') ) ) : '---' }}</p>
</div>
<!--fecha termino-->
<div class="col l2 chip">
   <span><b>FECHA TERMINO:</b></span> {{old('b_fecha_termino') ? date( 'd-m-Y',strtotime( old('b_fecha_termino') ) ) : '---' }}</p>
</div>
