<div class="row">
   @component('componentes.componente_seccion_titulo')
      @slot('mensaje','2. DATOS DEL DONANTE ~ ')
      @slot('icono','fas fa-edit')
   @endcomponent

   @if ( in_array($accion,['registrar','editar','clonar']) )
      <div class="col s12">
         @component('componentes.componente_nota')
            Debe indicar por lo menos el <strong><em>nombre del donante</em></strong> o el <strong><em>objeto donado</em></strong>, puede ser ambos.
         @endcomponent         
         @component('componentes.componente_nota')
            El <strong><em>municipio</em></strong> de procedencia solo será requerido cuando la entidad federativa sea <q><strong>Michoacán</strong></q>
         @endcomponent
         <hr class="hr-1">
      </div>
   @endif

   <!--nombre del donante-->
   <div class="input-field col s12 m12 l12">
      <input type="text" id="colectivo-muestreo-persona"
         {{in_array($accion, ['validar','entregar']) ? 'readonly' : ''}}
         {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}}
         name="colectivo_donante"
         value="{{ isset($colectivo) ? $colectivo->colectivo_donante : '' }}"
      >
      <label for="colectivo-muestreo-persona"><i class="fas fa-user"></i> ~ NOMBRE DEL DONANTE{{in_array($accion, ['validar','entregar']) ? '' : '** [1]'}}</label>
   </div>
   <!--fecha de muestreo-->
   <div class="input-field col s12 m12 l2">
      <input type="date" id="colectivo-muestreo-fecha" class="{{($accion == 'registrar') ? 'fecha-actual' : ''}}"
         {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}}
         {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}}
         name="colectivo_fecha"
         value="{{ (isset($colectivo)) ? $colectivo->colectivo_fecha : '' }}"
      >
      <label class="active" for="colectivo-muestreo-fecha"><i class="fas fa-calendar-alt"></i> ~ FECHA DEL MUESTREO{{in_array($accion, ['validar','entregar']) ? '' : '*'}}</label>
   </div>
   <!--lugar-estado de procedencia-->
   <div class="input-field col s12 m12 l5">
      <select id="colectivo-entidad-select"
         {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}}
         {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}}
         name="colectivo_procedencia_entidad"
      >
        <option value="" selected>Seleccione la entidad federativo de procedencia</option>
        @foreach ($entidades->sortBy('nombre')->values() as $i => $entidad)
            <option value="{{$entidad->id}}" {{ ($accion == 'registrar' && $entidad->id == 16) ? 'selected' : '' }} {{ (isset($colectivo) && $entidad->id == $colectivo->entidad_id) ? 'selected' : '' }}>{{$i+1}}.- {{$entidad->nombre}}</option>
        @endforeach
      </select>
      <label><i class="fas fa-map-marker-alt"></i> ~ LUGAR DE PROCEDENCIA DEL DONANTE (ENTIDAD FEDERATIVA)</label>
   </div>
   <!--lugar-municipio de procedencia-->
   <div class="input-field col s12 m12 l5">
      <select id="colectivo-delegacion-select"
         {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}}
         {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}}
         {{-- {{isset($colectivo) && $colectivo->entidad_id != 16 ? 'disabled' : ''}} --}}
         name="colectivo_procedencia_municipio">
         <option value="" selected>Selecciona el municipio de procedencia</option>
         @foreach ($delegaciones->sortBy('nombre')->values() as $i => $delegacion)
            <option value="{{$delegacion->id}}" {{ ($accion == 'registrar' && $delegacion->id == 16) ? 'selected' : '' }} {{ (isset($colectivo) && $delegacion->id == $colectivo->delegacion_id) ? 'selected' : '' }}>{{$i+1}}.- {{$delegacion->nombre}}</option>
         @endforeach
      </select>
      <label><i class="fas fa-map-marker-alt"></i> ~ LUGAR DE PROCEDENCIA DEL DONANTE (MUNICIPIO)</label>
   </div>

   <div class="col s12">
      <hr class="hr-3">
   </div>
</div>