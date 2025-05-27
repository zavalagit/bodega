<section x-data="regiones()" id="baja-datos">
   <div class="row">
   
      @component('componentes.componente_seccion_titulo')
         @slot('mensaje','1. DATOS SOLICITUD DEPURACION ~ ')
         @slot('icono','fas fa-file-alt')
      @endcomponent
	  
	  <!--nuc-->
      <div class="input-field col s12 m6 l6">
         <input type="text" id="nuc" name="nuc" value="{{ isset($solicitud->id) ? $solicitud->nuc : '' }}">
         <label for="solicitud_id">NUC</label>
      </div>

      <!--fecha de la solicitud-->
      <div class="input-field col s12 m6 l6">
         <input type="date" id="fecha_solicitud" name="fecha_solicitud" value="{{ isset($solicitud->id) ? $solicitud->fecha_solicitud : date('Y-m-d') }}">
         <label class="active" for="registro_fecha">Fecha de la Solicitud</label>
      </div>

      <!--Servidor publico que lo solicita-->
      <div class="input-field col s12 m5 l5">
         <input type="text" id="M_P_solicitud" name="M_P_solicitud" value="{{ isset($solicitud->id) ? $solicitud->M_P_solicitud : '' }}">
         <label for="solicitud_id">Servidor Publico de la Solicitud</label>
      </div>

      <!--Unidad de la solicitud-->
      <div class="input-field col s12 m5 l5">
         <input type="text" id="unidad_solicitud" name="unidad_solicitud" value="{{ isset($solicitud->id) ? $solicitud->unidad_solicitud : '' }}">
         <label for="solicitud_id">Unidad de la Solicitud</label>
      </div>

      <!--fecha de recepcion de la solicitud-->
      <div class="input-field col s12 m2 l2">
         <input type="date" id="fecha_recepcion_solicitud" name="fecha_recepcion_solicitud" value="{{ isset($solicitud->id) ? $solicitud->fecha_recepcion_solicitud : date('Y-m-d') }}">
         <label class="active" for="registro_fecha">Fecha de recepción</label>
      </div>

   <!--observaciones-->
      <div class="input-field col s12">
         <textarea id="textarea2" class="materialize-textarea" name="registro_observaciones">{{ isset($solicitud->id) ? $solicitud->observaciones : '' }}</textarea>
         <label for="textarea2">OBSERVACIONES</label>
      </div>

   </div>
</section>