<tr id="reingreso-descripcion-disponible-{{$indicio->id}}">
   <td width="9%"><b>{{$indicio->identificador}}</b></td>
   <td width="">
      <input type="text"
         {{isset($prestamo->id) ? 'disabled' : ''}}
         name="reingreso_descripcion_disponible[{{$indicio->id}}]"
         value="{{isset($prestamo->id) ? $indicio->pivot->prestamo_descripcion : ''}}"
      >
   </td>
</tr>