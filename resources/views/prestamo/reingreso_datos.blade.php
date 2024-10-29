<div class="row">
   @component('componentes.componente_seccion_titulo')
      @slot('mensaje','3. DATOS DEL REINGRESO')
      @slot('icono','fas fa-edit')
   @endcomponent
   
   <!--hora reingreso-->
   <div class="input-field col s12 m6 l6">
      <input type="time" class="{{isset($prestamo->id) ? '' : 'hora-actual'}}" id="reingreso-hora" name="reingreso_hora" value="{{ ($prestamo->estado == 'concluso') ? date('H:i:s',strtotime($prestamo->reingreso_hora)) : '' }}">
      <label class="active" for="reingreso-hora">HORA
         <span class="asterisco-obligatorio">*</span>
         <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
      </label>
   </div>
   <!--fecha prestamo-->
   <div class="input-field col s12 m6 l6">
      <input type="date" class="{{isset($prestamo->id) ? '' : 'fecha-actual'}}" id="reingreso-fecha" name="reingreso_fecha" value="{{ ($prestamo->estado == 'concluso') ? date('Y-m-d',strtotime($prestamo->reingreso_fecha)) : '' }}">
      <label class="active" for="reingreso-fecha">FECHA
         <span class="asterisco-obligatorio">*</span>
         <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
      </label>
   </div>
   <!--Datos del resguardante-->
   @component('componentes.componente_subseccion_titulo')
      @slot('mensaje','3.1. RESGUARDANTE (ENTREGA)')
   @endcomponent
   <div class="input-field col s1">
      <a href="" class="btn-limpiar-input-autocomplete" data-input-autocomplete="reingreso-resguardante-autocomplete" data-input-hidden="reingreso-resguardante">
         <i class="fas fa-times-circle fa-lg" ></i>
      </a>
   </div>
   <div class="input-field col s11">
      <input type="hidden" id="reingreso-resguardante" name="reingreso_resguardante" value="{{ ($prestamo->estado == 'concluso') ? $prestamo->perito2_id : '' }}">
      <input type="text" class="autocomplete" id="reingreso-resguardante-autocomplete" data-tabla="peritos" data-input-hidden="reingreso-resguardante" value="{{ ($prestamo->estado == 'concluso') ? "{$prestamo->perito2->folio} - {$prestamo->perito2->nombre}" : '' }}">
      <label for="reingreso-resguardante-autocomplete">Resguardante
         <span class="asterisco-obligatorio">*</span>
         <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
      </label>
   </div>
   <!--Datos del responsable de bodega-->
   @component('componentes.componente_subseccion_titulo')
      @slot('mensaje','3.2. RESPONSABLE DE BODEGA (RE)')
   @endcomponent
   <div class="input-field col s1">
      <a href="" class="btn-limpiar-input-autocomplete" 
         data-input-hidden="responsable-bodega-recibe"
         data-input-autocomplete="reingreso-responsable-bodega-autocomplete">
         <i class="fas fa-times-circle fa-lg" ></i>
      </a>
   </div>
   <div class="input-field col s11">
      <input type="hidden" id="responsable-bodega-recibe" name="reingreso_responsable_bodega" value="{{ ($prestamo->estado == 'concluso') ? $prestamo->user2_id : Auth::user()->id }}">
      <input type="text" class="autocomplete" id="reingreso-responsable-bodega-autocomplete" data-input-hidden="responsable-bodega-recibe" data-tabla="users" data-user-tipo="responsable_bodega" data-user-fiscalia="{{Auth::user()->fiscalia_id}}" value="{{ ($prestamo->estado == 'concluso') ? "{$prestamo->user2->folio} - {$prestamo->user2->name}" : Auth::user()->folio.' - '.Auth::user()->name }}">
      <label for="reingreso-responsable-bodega-autocomplete">Responsable de Bodega
         <span class="asterisco-obligatorio">*</span>
         <span class="asterisco-editar {{$formAccion == 'editar' ? '' : 'ocultar'}}">*</span>
      </label>
   </div>
   <!--hr-->
   <div class="col s12">
      <hr class="hr-main">
   </div>
   <!--Boton reingreso-->
   <div class="col s12 l2 offset-l10">
      <button type="submit" class="btn-guardar" id="btn-reingresar" style="display: inline-block !important; width:100%;" >
         REINGRESAR
      </button>
   </div>
</div>
   