<section x-data="regiones()" id="baja-datos">
   <div class="row">
   
      @component('componentes.componente_seccion_titulo')
         @slot('mensaje','1. DATOS SOLICITUD DEPURACION ~ ')
         @slot('icono','fas fa-file-alt')
      @endcomponent
	  
	  <!--nuc-->
      <div class="input-field col s12 m6 l6">
         <input type="text" id="nuc" name="nuc" value="{{ isset($solicitud->id) ? $solicitud->nuc : '' }}" autocomplete="off">
         <label for="nuc">NUC</label>
      </div>

      <!--fecha de la solicitud-->
      <div class="input-field col s12 m6 l6">
         <input type="date" id="fecha_solicitud" name="fecha_solicitud" value="{{ isset($solicitud->id) ? $solicitud->fecha_solicitud : date('Y-m-d') }}">
         <label class="active" for="fecha_solicitud">Fecha de la Solicitud</label>
      </div>

      <!--Servidor publico que lo solicita-->
      <div class="input-field col s12 m6 l6">
         <input type="text" id="M_P_solicitud" name="M_P_solicitud" value="{{ isset($solicitud->id) ? $solicitud->M_P_solicitud : '' }}" autocomplete="off">
         <label for="M_P_solicitud">Servidor Publico de la Solicitud</label>
      </div>

      <!--Cargo del M_p-->
      <div class="input-field col s12 m6 l6">
         <input type="text" id="cargo_M_P" name="cargo_M_P" value="{{ isset($solicitud->id) ? $solicitud->cargo_M_P : '' }}" autocomplete="off">
         <label for="cargo_M_P">Cargo del Servidor Publico</label>
      </div>

      <!--Unidad de la solicitud-->
      <div class="input-field col s12 m8 l8">
         <input type="text" id="unidad_solicitud" name="unidad_solicitud" value="{{ isset($solicitud->id) ? $solicitud->unidad_solicitud : '' }}" autocomplete="off">
         <label for="unidad_solicitud">Unidad de la Solicitud</label>
      </div>

      <!--fecha de recepcion de la solicitud-->
      <div class="input-field col s12 m4 l4">
         <input type="date" id="fecha_recepcion_solicitud" name="fecha_recepcion_solicitud" value="{{ isset($solicitud->id) ? $solicitud->fecha_recepcion_solicitud : date('Y-m-d') }}">
         <label class="active" for="fecha_recepcion_solicitud">Fecha de recepción</label>
      </div>

   <!--observaciones-->
      <div class="input-field col s12">
         <textarea id="textarea2" class="materialize-textarea" name="registro_observaciones">{{ isset($solicitud->id) ? $solicitud->observaciones : '' }}</textarea>
         <label for="textarea2">OBSERVACIONES</label>
      </div>

   </div>
</section>