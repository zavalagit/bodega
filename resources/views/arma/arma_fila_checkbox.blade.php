<tr>
   <td class="td-indice-armas td-contador">{{$indice + 1}}</td>
   <td class="indicio-identificador">{{$indicio->identificador ?? '---'}}</td>
   {{-- <td class="td-input">
      <input type="checkbox" id="indicio-arma-{{$indice}}" name="indicio_arma[]" value="indicio_arma_{{$indice}}" />
      <label for="indicio-arma-{{$indice}}"></label>
   </td> --}}
   <td class="td-input-arma">
      <label for="indicio-arma-{{ 2 * $indice }}">
         <input type="radio" id="indicio-arma-{{ 2 * $indice }}" {{isset($indicio) ? ($indicio->indicio_is_arma ? 'checked' : '' ) : ''}} name="indicio_arma[{{$indice}}]" value="si"/>
         <span></span>
      </label>
   </td>
   <td class="td-input-arma">
      <label for="indicio-arma-{{ (2 * $indice) + 1 }}">
         <input type="radio" id="indicio-arma-{{ (2 * $indice) + 1 }}" {{isset($indicio) ? ($indicio->indicio_is_arma ? 'checked' : '') : 'checked'}}  name="indicio_arma[{{$indice}}]" value="no"/>
         <span></span>
      </label>
   </td>
</tr>