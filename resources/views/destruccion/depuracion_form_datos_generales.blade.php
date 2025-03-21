<section x-data="regiones()" id="baja-datos">
   <div class="row">
   
      @component('componentes.componente_seccion_titulo')
         @slot('mensaje','2. DATOS DEPURACION ~ ')
         @slot('icono','fas fa-file-alt')
      @endcomponent
	  
	  <!--Solicitud id-->
      <div class="input-field col s12 m6 l6">
         <input type="text" id="solicitud_id" name="solictud_id" value="{{ isset($baja->id) ? $baja->concepto : '' }}">
         <label for="solicitud_id">Solicitud id</label>
      </div>
     <!--Cadenas id-->
      <div class="input-field col s12 m6 l6">
         <input type="text" id="cadena_id" name="cadena_id" value="{{ isset($baja->id) ? $baja->concepto : '' }}">
         <label for="cadena_id">Cadenas id</label>
      </div>

     <!--User id-->
      <div class="input-field col s12 m4 l4">
         <input type="text" id="user_id" name="user_id" value="{{ isset($baja->id) ? $baja->concepto : '' }}">
         <label for="user_id">User id</label>
      </div>
   <!--hora de registro-->
      <div class="input-field col s12 m4 l4">
         <input type="time" id="registro_hora" name="registro_hora" value="{{ isset($baja->id) ? date('H:i:s',strtotime($baja->hora)) : date('H:i')}}">
         <label class="active" for="registro_hora">Hora</label>
      </div>
   <!--fecha de registro-->
      <div class="input-field col s12 m4 l4">
         <input type="date" id="registro_fecha" name="registro_fecha" value="{{ isset($baja->id) ? $baja->fecha : date('Y-m-d') }}">
         <label class="active" for="registro_fecha">Fecha</label>
      </div>

   <!--observaciones-->
      <div class="input-field col s12">
         <textarea id="textarea2" class="materialize-textarea" name="registro_observaciones">{{ isset($baja->id) ? $baja->observaciones : '' }}</textarea>
         <label for="textarea2">OBSERVACIONES</label>
      </div>

	  
	  {{-- <div class="input-field col s12 m12 l2">
         <select name="motivo">
            <option value="" disabled selected>---</option>
			<option value="desglose" {{ isset($baja->id) && $baja->motivo == 'desglose' ? 'selected' : '' }}>1. Desglose</option>
            <option value="devolucion" {{ isset($baja->id) && $baja->motivo == 'devolucion' ? 'selected' : '' }}>2. Devolución</option>
            <option value="destruccion" {{ isset($baja->id) && $baja->motivo == 'destruccion' ? 'selected' : '' }}>3. Destrucción</option>
            <option value="depuracion" {{ isset($baja->id) && $baja->motivo == 'depuracion' ? 'selected' : '' }}>4. Depuración</option>
			<option value="traslado" {{ isset($baja->id) && $baja->motivo == 'traslado' ? 'selected' : '' }}>5. Traslado</option>
         </select>
         <label>MOTIVO DE LA BAJA</label>
      </div> --}}
	  
	  {{-- <div class="input-field col s12 m12 l2">
         <select x-model="option_value" @change="mostrar_select_regiones()" name="institucion_id">
            <option value="" selected disabled>---</option>
            @foreach($instituciones->sortBy('nombre')->values() as $i => $institucion)
				<option value="{{$institucion->id}}" {{ isset($baja->id) && $baja->institucion_id == $institucion->id ? 'selected' : '' }}>{{$i+1}}. {{$institucion->nombre}}</option>
			@endforeach
         </select>
         <label>A DONDE SE VA</label>
      </div> --}}
	  
	  {{-- <div x-show="mostrar" class="input-field col s12 m12 l2">
         <select name="fiscalia_id">
            <option value="" disabled selected>---</option>
            @foreach($regiones->sortBy('nombre')->values() as $i => $region)
				<option value="{{$region->id}}" {{ isset($baja->id) && $baja->fiscalia_id == $region->id ? 'selected' : '' }}>{{$i+1}}. {{$region->nombre}}</option>
			@endforeach
         </select>
         <label>Región</label>
      </div> --}}
	  
      
      {{-- <div class="input-field col s2">
         <input type="text" id="numindicios" name="numindicios" disabled>
         <label for="numindicios">Num. Indicios</label>
      </div> --}}
      <!--hora baja-->
      {{-- <div class="input-field col s12 m12 l2">
         <input type="time" id="baja-hora" name="baja_hora" value="{{ isset($baja->id) ? date('H:i:s',strtotime($baja->hora)) : date('H:i')}}">
         <label class="active" for="baja-hora">Hora</label>
      </div> --}}
      <!--fecha baja-->
      {{-- <div class="input-field col s12 m12 l2">
         <input type="date" id="baja-fecha" name="baja_fecha" value="{{ isset($baja->id) ? $baja->fecha : date('Y-m-d') }}">
         <label class="active" for="baja-fecha">Fecha</label>
      </div> --}}
      <!--tipo de baja-->
      {{-- <div class="input-field col s12 m12 l2">
         <select name="baja_tipo">
            <option value="" disabled selected></option>
            <option value="definitiva" {{ isset($baja->id && $baja->tipo == 'definitiva') ? 'selected' : '' }}>DEFINITIVA</option>
            <option value="parcial" {{ isset($baja->id && $baja->tipo == 'parcial') ? 'selected' : '' }}>PARCIAL</option>
            <option value="pertenencia" {{ isset($baja->id && $baja->tipo == 'pertenencias') ? 'selected' : '' }}>PERTENENCIA</option>
         </select>
         <label>Tipo de Baja</label>
      </div> --}}
      <!--estado de la cadena-->
      {{-- <div class="input-field col s12 m12 l2">
         <select name="baja_cadena_estado">
            <option value="" disabled selected></option>
            <option value="x" {{ isset($baja->id) && ($baja->estado_cadena == 'x') ? 'selected' : '' }}>Entregada</option>
            <option value="o" {{ isset($baja->id) && ($baja->estado_cadena == 'o') ? 'selected' : '' }}>No entregada</option>
         </select>
         <label>Estado de la cadena</label>
      </div> --}}
      <!--embajale-->
      {{-- <div class="input-field col s12">
         <textarea id="textarea1" class="materialize-textarea" name="baja_embalaje">{{ isset($baja->id) ? $baja->embalaje : 'SE APERTURA EMBALAJE PARA SU ENTREGA FINAL' }}</textarea>
         <label for="textarea1">EMBALAJE</label>
      </div> --}}
      <!--observaciones-->
      {{-- <div class="input-field col s12">
         <textarea id="textarea2" class="materialize-textarea" name="baja_observaciones">{{ isset($baja->id) ? $baja->observaciones : '' }}</textarea>
         <label for="textarea2">OBSERVACIONES</label>
      </div> --}}
   </div>
</section>