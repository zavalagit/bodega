@component('componentes.componente_seccion_titulo')
   @slot('mensaje','1. PARAMETROS DE BUSQUEDA')
   @slot('icono','fas fa-search')
@endcomponent
<!--region-->
@if (Auth::user()->tipo == 'administrador_peticiones')
   <!--region-->
   <div class="col l2 chip" style="margin-left: 11px !important">
      <span><b>REGIÓN:</b></span> {{(old('b_region') ? $regiones->where('id',old('b_region',1))->first()->nombre : '---')}}</p>
   </div>
   <!--unidad-->
   <div class="col l3    chip {{!old('b_unidad') ? 'hide' : ''}}">
      <span><b>UNIDAD:</b></span> {{(old('b_unidad') ? $unidades->where('id',old('b_unidad'))->first()->nombre : '---')}}</p>
   </div>
@endif
<!--fecha inicio-->
<div class="col l2 chip" style="{{Auth::user()->tipo != 'administrador_peticiones' ? 'margin-left: 11px !important' : ''}}">
   <span><b>FECHA INICIO:</b></span> {{date( 'd-m-Y',strtotime( old('b_fecha_inicio',date('Y-m-d')) ) )}}</p>
</div>
<!--fecha termino-->
<div class="col l2 chip">
   <span><b>FECHA TERMINO:</b></span> {{old('b_fecha_fin') ? date( 'd-m-Y',strtotime( old('b_fecha_fin') ) ) : '---' }}</p>
</div>
@if (Auth::user()->tipo == 'administrador_peticiones')
   <!--especialidad-->
   <div class="col l2 chip">
      <span><b>ESPECIALIDAD:</b></span> {{(old('p_especialidad') > 0 ) ? $especialidades->where('id',old('p_especialidad'))->first()->nombre : '---' }}</p>
   </div>
   <!--solicitud-->
   <div class="col l2 chip" style="{{(Auth::user()->tipo == 'apn') ? 'margin-left: 10px !important' : ''}}">
      <span><b>SOLICITUD:</b></span> {{(old('p_solicitud') > 0 ) ? $solicitudes->where('id',old('p_solicitud'))->first()->nombre : '---' }}</p>
   </div>
   <!--usuario-->
   <div class="col l2 chip">
      <span><b>USUARIO:</b></span> {{old('b_user') ?: '---'}}</p>
   </div>
@endif