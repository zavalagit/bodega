<!--otro parentesco-->
<div class="input-field col s12 m12 l3 parentesco-otro">
   <input type="text" id="colectivo-parentesco-otro"
      {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}}
      {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}}
      name="colectivo_parentesco_otro[]"
      value="{{ isset($parentesco) ? $parentesco->pivot->parentesco_otro : '' }}"
   >
   <label for="colectivo-parentesco-otro"><i class="fas fa-user-friends"></i> ~ ESPECIFIQUE EL "OTRO" PARENTESCO{{in_array($accion, ['validar','entregar']) ? '' : '*'}}</label>
</div>