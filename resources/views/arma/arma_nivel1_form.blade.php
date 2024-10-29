<div class="row">
   @component('componentes.componente_seccion_titulo')
      @slot('mensaje','3. DATOS EXTENDIDOS DEL INDICIOS DE ARMAS DE FUEGOS ~ ')
      @slot('icono','fas fa-edit')
   @endcomponent
   <!--btn añadir parentesco-->
   @if ( !in_array($accion, ['validar','entregar']) )
   <div class="col s12 m12 l12">
      <a href="" style="color: #152f4a; display: block;" class="right-align" id="colectivo-parentesco-agregar" data-accion="{{$accion}}"><i class="fas fa-plus-circle fa-2x" style="color: #c09f77;"></i><b><span style="vertical-align: super !important"> - AÑADIR PARENTESCO</span></b></a>
   </div>
   @endif
   <!--hr-->
   <div class="col s12">
      <hr class="hr-1">
   </div>
</div>

@if ($accion == 'registrar')
      @include('arma.nivel1_form')

@endif
<div class="row">
   <div class="col s12">
      <hr class="hr-3">
   </div>
</div>