@component('componentes.componente_sidenav_buscador')
<form class="col s12">
   {{-- <div class="row">
      <div class="col s12">
         <p style="line-height: 25px;"><i style="color:#152f4a;" class="fas fa-certificate"></i> El parametro por "fecha" es de acuedo a la fecha en que se realizó el registro. 
      </div>
   </div> --}}

   <div class="row">
      <div class="col s12">
         <p style="line-height: 25px;"><i style="color: tomato;" class="fas fa-sticky-note fa-sm"></i> <span><b>El parametro "fecha" es de acuerdo a la fecha en que se realizó el registro.</b></span> 
      </div>
      <div class="col s12">
         <hr class="hr-2">
      </div>

      @if ( (Auth::user()->tipo == 'administrador_peticiones') || (Auth::user()->tipo == 'coordinador_peticiones_unidad' && Auth::user()->unidad_id == 2) )
         <div class="col s12">
            <label for="violencia-familiar">
               <input type="checkbox" id="violencia-familiar" class="filled-in" {{old('violencia_familiar') ? 'checked' : ''}} name="violencia_familiar"/>
               <span>F. Violencia familiar</span>
            </label>
         </div>
      @endif
      
      @if (Auth::user()->tipo == 'administrador_peticiones')
         <!--region-->
         <div id="select-region" class="input-field col s12">
            <select id="b-region" name="b_region">
               <option value="0" selected>---</option>
               @foreach ($regiones->sortBy('nombre')->values() as $i => $region)
                  <option {{old('b_region') == $region->id ? 'selected' : '' }} value="{{$region->id}}">{{$i+1}}.- {{$region->nombre}}</option>
               @endforeach
            </select>
            <label>REGIÓN</label>
         </div>
         <div id="hr-modelo-region" class="col s12">
            <hr class="hr-2">
         </div>
          <!--unidad-->
          <div id="select-unidad" class="input-field col s12 {{old('b_region') != 4 ? 'hide' : ''}}">
            <select id="b-unidad" name="b_unidad">
               <option value="0" selected>---</option>
               @foreach ($unidades->sortBy('nombre')->values() as $i => $unidad)
                  <option {{old('b_unidad') == $unidad->id ? 'selected' : '' }} value="{{$unidad->id}}">{{$i+1}}.- {{$unidad->nombre}}</option>
               @endforeach
            </select>
            <label>UNIDAD</label>
         </div>
         <div id="hr-select-unidad" class="col s12 {{old('b_unidad') ? '' : 'hide'}}">
            <hr class="hr-2">
         </div>
      @endif
      <!--especilidad-->
      <div class="input-field col s12">
         <select id="b-especialidad" name="b_especialidad">
            <option value="0" selected>---</option>
            @foreach ($especialidades->sortBy('nombre')->values() as $i => $especialidad)
               <option value="{{$especialidad->id}}" {{(old('b_especialidad') == $especialidad->id) ? 'selected' : ''}}>{{$i+1}}.- {{$especialidad->nombre}}</option>
            @endforeach
         </select>
         <label>ESPECIALIDAD</label>
      </div>
      <div class="col s12">
         <hr class="hr-2">
      </div>
      <!--solicitud-->
      <div id="select-solicitud" class="input-field col s12 {{!old('b_especialidad') ? 'hide' : ''}}">
         <select id="b-solicitud" name="b_solicitud">            
            @includeWhen(old('b_especialidad'), 'solicitud.solicitud_form_select_options', ['solicitudes' => $solicitudes->where('especialidad_id',old('b_especialidad'))])
         </select>
         <label>SOLICITUD</label>
      </div>
      <div id="hr-select-solicitud" class="col s12 {{!old('b_especialidad') ? 'hide' : ''}}">
         <hr class="hr-2">
      </div>
      <!--b_fecha_inicio-->
      <div class="input-field col s12">
         <input id="fecha-inicio" type="date" name="b_fecha_inicio" value="{{old('b_fecha_inicio',date('Y-m-d'))}}">
         <label class="active" for="fecha-inicio">FECHA INICIO</label>
      </div>
      <div class="col s12">
         <hr class="hr-2">
      </div>
      <!--peticion_btn_buscar-->
      <div class="input-field col s12">
        <button type="submit" class="btn-sidenav-buscar" name="btn_buscar" value="buscar">Buscar</button>
      </div>
   </div>
</form>
@endcomponent