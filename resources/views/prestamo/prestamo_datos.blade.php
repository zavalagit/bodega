<div class="row">
   <!--Datos del prestamo-->
      @component('componentes.componente_seccion_titulo')
         @slot('mensaje','2. DATOS DEL PRESTAMO ~ ')
         @slot('icono','fas fa-edit')
      @endcomponent
      <!--hora-->
      <div class="input-field col s12 m6 l4">
         <input type="time" class="{{isset($prestamo->id) ? '' : 'hora-actual'}}" id="hora" name="prestamo_hora" value="{{ isset($prestamo->id) ? date('H:i:s',strtotime($prestamo->prestamo_hora)) : '' }}">
         <label class="active" for="hora">HORA
            <span class="asterisco-obligatorio">*</span>
            <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
         </label>
      </div>
      <!--fecha-->
      <div class="input-field col s12 m6 l4">
         <input type="date" class="{{isset($prestamo->id) ? '' : 'fecha-actual'}}" id="fecha" name="prestamo_fecha" value="{{ isset($prestamo->id) ? date('Y-m-d',strtotime($prestamo->prestamo_fecha)) : '' }}">
         <label class="active" for="hora">FECHA
            <span class="asterisco-obligatorio">*</span>
            <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
         </label>
      </div>
      <div class="input-field col s12 m12 l4">
         <input id="prestamo-autoriza" type="text" name="prestamo_autoriza" value="{{ isset($prestamo->id) ? $prestamo->prestamo_ordena : '' }}">
         <label for="prestamo-autoriza">AUTORIZA
            <span class="asterisco-obligatorio">*</span>
            <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
         </label>
      </div>
      <!--Datos del responsable de bodega-->
      @component('componentes.componente_subseccion_titulo')
         @slot('mensaje','2.1. RESPONSABLE DE BODEGA (ENTREGA)')
      @endcomponent
      <div class="input-field col s1">
         <a href="" class="btn-limpiar-input-autocomplete" 
            data-input-hidden="prestamo-responsable-bodega"
            data-input-autocomplete="prestamo-responsable-bodega-autocomplete"> 
            <i class="fas fa-times-circle fa-lg" ></i>
         </a>
      </div>
      <div class="input-field col s11">
         <input type="hidden" id="prestamo-responsable-bodega" name="prestamo_responsable_bodega"  value="{{ isset($prestamo->id) ? $prestamo->user1_id : Auth::user()->id }}">
         <input type="text" id="prestamo-responsable-bodega-autocomplete" class="autocomplete" readonly data-input-hidden="prestamo-responsable-bodega" data-tabla="users" data-user-tipo="responsable_bodega" data-user-fiscalia="{{Auth::user()->fiscalia_id}}" value="{{ isset($prestamo->id) ? "{$prestamo->user1->folio} - {$prestamo->user1->name}" : Auth::user()->folio.' - '.Auth::user()->name }}">
         <label for="reingreso-responsable-bodega-autocomplete">Responsable de Bodega
            <span class="asterisco-obligatorio">*</span>
            <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
         </label>
      </div>
      <!--Datos del resguardante-->
      @component('componentes.componente_subseccion_titulo')
         @slot('mensaje','2.2. RESGUARDANTE (RECIBE)')
      @endcomponent
      <div class="input-field col s1">
         <a href="" class="btn-limpiar-input-autocomplete"
            data-input-hidden="prestamo-resguardante"
            data-input-autocomplete="prestamo-resguardante-autocomplete">
            <i class="fas fa-times-circle fa-lg" ></i>
         </a>
      </div>
      <div class="input-field col s11">
         <input type="hidden" id="prestamo-resguardante" name="prestamo_resguardante" value="{{ isset($prestamo->id) ? $prestamo->perito1_id : '' }}">
         <input type="text" class="autocomplete" id="prestamo-resguardante-autocomplete" data-tabla="peritos" data-input-hidden="prestamo-resguardante" value="{{ isset($prestamo->id) ? "{$prestamo->perito1->folio} - {$prestamo->perito1->nombre}" : '' }}">
         <label for="prestamo-resguardante-autocomplete">Resguardante
            <span class="asterisco-obligatorio">*</span>
            <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
         </label>
      </div>
   
      @if($formAccion == 'prestar' || ($formAccion == 'editar' && $prestamo->estado == 'activo'))
         <!--hr-->
         <div class="col s12">
            <hr class="hr-main">
         </div>
   
         <!--Boton prestamo-->
         <div class="col s12 l1 offset-l11 scale-transition">
            <button type="submit" class="btn-guardar" id="btn-prestar" style="display: inline-block !important; width:100%;" name="btn_prestamo" value="prestamo">
               {{$formAccion}}
            </button>
         </div>
      @endif
</div>




