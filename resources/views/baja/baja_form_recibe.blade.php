<section id="baja-recibe">
   <!--radio btns-->
   <div class="row">
      @component('componentes.componente_seccion_titulo')
         @slot('mensaje','4. RECIBE (CIVIL O SERVIDOR PÚBLICO) ~ ')
         @slot('icono','fas fa-user-tie')
      @endcomponent
      <div class="col s6 m6 l2">
         <label for="servidor-publico">
            <input type="radio" id="servidor-publico" checked name="input_radio_baja_recibe" value="servidor_publico"/>
            <span>Servidor público</span>
         </label>
      </div>
      <div class="col s6 m6 l2">
         <label for="civil">
            <input type="radio" id="civil" {{ ($formAccion == 'editar' && $baja->quien_recibe != null) ? 'checked' : '' }}  name="input_radio_baja_recibe" value="civil"/>
            <span>Identificación</span>
         </label>
      </div>
   </div>
   <!--dtos persona recibe-->
   <div class="row" id="datos-baja-recibe" data-baja-recibe="{{ ($formAccion == 'editar' && $baja->quien_recibe != null) ? 'civil' : 'servidor_publico' }}">
      @if ($formAccion == 'editar' && $baja->quien_recibe != null)
      <div class="input-field col s4">
         <input type="text" id="civil-identificacion" name="baja_recibe_civil_identificacion" value="{{$baja->identificacion}}">
         <label for="civil-identificacion">Identificación</label>
      </div>
      <div class="input-field col s8">
         <input type="text" id="civil-nombre" name="baja_recibe_civil_nombre" value="{{$baja->quien_recibe}}">
         <label for="civil-nombre">Nombre</label>
      </div>
      @else
         <div class="input-field col s11">
            <input id="baja_recibe-servidor-publico" type="hidden" name="baja_recibe" value="{{ ($formAccion == 'editar') ? $baja->perito_id : ''}}">
            <input type="text" id="baja-recibe-autocomplete" class="autocomplete" data-tabla="peritos" data-input-hidden="baja_recibe-servidor-publico" value="{{ ($formAccion == 'editar' && $baja->perito_id != null) ? "{$baja->perito->folio} - {$baja->perito->nombre}" : ''}}">
            <label for="baja-recibe-autocomplete">Servidor público</label>
         </div>
         <div class="input-field col s1">
            <a href="" class="btn-limpiar-input-autocomplete" data-input-autocomplete="baja-recibe-autocomplete" data-input-hidden="baja-recibe-servidor-publico">
               <i class="fas fa-times-circle fa-lg" ></i>
            </a>
         </div>
      @endif
   </div>
</section>