<option value="0" selected>---</option>
@foreach ($solicitudes->sortBy('nombre')->values() as $i => $solicitud)
   <option value="{{$solicitud->id}}"
      {{(old('b_solicitud') == $solicitud->id) ? 'selected' : ''}}
      {{isset($peticion) && $peticion->solicitud_id == $solicitud->id ? 'selected' : ''}}
   >{{$i+1}}.- {{$solicitud->nombre}}</option>
@endforeach
