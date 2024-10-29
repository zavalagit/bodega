<tr id="baja-parcial-{{$indicio->id}}">
   <td width="9%"><b>{{$indicio->identificador}}</b></td>
   <td width="40.5%">
      <input type="text"
         {{isset($baja->id) ? 'disabled' : ''}}
         name="baja_parcial_descripcion[{{$indicio->id}}]"
         value="{{isset($baja->id) ? $indicio->pivot->baja_descripcion : ''}}"
      >
   </td>
   <td width="10%">
      <input type="number"
         class="baja-cantidad-indicios"
         min="1"
         max="{{$indicio->bajas->count() > 0 ? $indicio->indicio_cantidad_disponible : $indicio->numero_indicios-1}}"
         data-indicio-id="{{$indicio->id}}"
         {{isset($baja->id) ? 'disabled' : ''}}
         name="baja_parcial_cantidad_indicios[{{$indicio->id}}]"
         value="{{isset($baja->id) ? $indicio->pivot->baja_cantidad_indicios : ''}}"
      >
   </td>

   <td width="40.5%">
      <input type="text" id="descripcion-disponible-{{$indicio->id}}" class="baja-descripcion-disponible" disabled name="baja_descripcion_disponible[{{$indicio->id}}]">
   </td>

   {{-- <td width="10%">
      <input type="number" id=""
         min="{{$indicio->bajas->count() > 0 ? 0 : 1}}"
         max="{{$indicio->bajas->count() > 0 ? $indicio->indicio_cantidad_disponible : $indicio->numero_indicios-1}}"
         name=""
      >
   </td> --}}
</tr>