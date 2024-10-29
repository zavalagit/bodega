<div class="col s12 div-objeto-aportado">
   <div class="row">
      <!--objeto donado-->
      <div class="input-field col s12 m12 l11">
         <input type="text" id="colectivo-muestreo-objeto" class="input-objeto-aportado"
            {{in_array($accion, ['validar','entregar']) ? 'disabled' : ''}}
            {{$accion == 'editar' && $colectivo->colectivo_estado != 'revision' ? 'disabled' : ''}}
            name="ausente_objeto_aportado[{{$i ?? 0}}][{{$j ?? 0}}]"
            value="{{ $objeto ?? '' }}"
         >
         <label for="colectivo-muestreo-objeto"><i class="fas fa-brush"></i> ~ OBJETO APORTADO{{in_array($accion, ['validar','entregar']) ? '' : '** [1]'}}</label>
      </div>
      <!--eliminar objeto-->
      @if ( in_array($accion, ['registrar','clonar']) || ($accion == 'editar' && $colectivo->colectivo_estado == 'revision') )
         <div class="input-field col s12 m12 l1 div-btn-objeto-eleminar {{ isset($parentesco) ? (( count(explode('~', $parentesco->pivot->ausente_objeto_aportado)) > 1 ) ? '' : 'hide') : 'hide' }}">
            <a href="" class="btn-objeto-eliminar right-align" style="display: block !important; margin-top:15px;"><i class="fas fa-times-circle fa-lg"></i></a>
         </div>
      @endif
   </div>
</div>