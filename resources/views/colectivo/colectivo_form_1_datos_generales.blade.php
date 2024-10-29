<div class="row">
   @component('componentes.componente_seccion_titulo')
      @slot('mensaje','1. DATOS GENERALES ~ ')
      @slot('icono','fas fa-edit')
   @endcomponent
   <!--control grupo_familiar-->
   {{-- @if ( in_array($accion, ['validar','entregar']) )
   <div class="input-field col s12 m12 l3">
      <input type="text" id="colectivo-grupo-familiar" {{($accion == 'validar') ? '' : 'disabled'}} autofocus name="colectivo_grupo_familiar" value="{{ (isset($colectivo)) ? $colectivo->colectivo_grupo_familiar : '' }}">
      <label for="colectivo-grupo-familiar"><i class="fas fa-users"></i> ~ GRUPO FAMILIAR*</label>
   </div>
   @endif --}}
   <!--región en don se realiza el registro-->
   <div class="input-field col s12 m12 l4">
      <select
         {{in_array($accion, ['validar','entregar']) ? 'readonly' : ''}}
         {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}}
         name="colectivo_fiscalia"
      >
         @foreach ($fiscalias->sortBy('nombre')->values() as $i => $fiscalia)
            <option value="{{$fiscalia->id}}" {{ ( ($accion == 'registrar') && (Auth::user()->fiscalia_id == $fiscalia->id) ) ? 'selected' : '' }} {{ ( ($accion != 'registrar') && ($colectivo->fiscalia_id == $fiscalia->id) ) ? 'selected' : '' }}>{{$i+1}}.- {{$fiscalia->nombre}}</option>
         @endforeach
      </select>
      <label><i class="fas fa-map-marker-alt"></i> ~ REGIÓN EN DONDE SE REALIZA EL MUESTREO{{in_array($accion, ['validar','entregar']) ? '' : '*'}}</label>
   </div>

   <div class="col s12">
      <hr class="hr-3">
   </div>
</div>