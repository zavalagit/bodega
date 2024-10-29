@if ( /*accion*/$accion == 'entregar' ||
      /*estado*/$colectivo->colectivo_estado == 'entregada' )

   <div class="row">
      @component('componentes.componente_seccion_titulo')
         @slot('mensaje','6. DATOS DE ENTREGA')
         @slot('icono','fas fa-edit')
      @endcomponent

      @if ( $accion == 'editar' && $colectivo->colectivo_emision_fecha < date('Y-m-d') )
         <div class="col s12">
            @component('componentes.componente_nota')
               La <q><strong>fehca de entrega</strong></q> ya <strong>NO</strong> puede ser modificada.
            @endcomponent
            <hr class="hr-1">
         </div>          
      @endif

      <div class="input-field col s12 m12 l6">
         <input type="date" id="colectivo-emision-fecha" 
            {{$accion == 'entregar' ? 'autofocus' : ''}}
            {{ ( isset($colectivo->colectivo_emision_fecha) && $colectivo->colectivo_emision_fecha < date('Y-m-d') ) ? 'readonly' : '' }}
            name="colectivo_emision_fecha" 
            value="{{ $colectivo->colectivo_emision_fecha ?? '' }}"
         >
         <label class="active" for="colectivo-emision-fecha">FECHA DE ENTREGA*</label>
      </div>
      <div class="input-field col s12 m12 l6">
         <input type="text" id="colectivo-entrega-persona" name="colectivo_emision_persona" value="{{ (isset($colectivo)) ? $colectivo->colectivo_emision_persona : '' }}">
         <label for="colectivo-entrega-persona"><i class="fas fa-user"></i> ~ NOMBRE DE LA PERSONA A QUIÉN SE ENTREGA</label>
      </div>

      <div class="col s12">
         <hr class="hr-3">
      </div>
   </div>
    
@endif
