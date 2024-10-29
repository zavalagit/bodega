<option value="" selected disabled>SELECCIONE LA ESPECIALIDAD</option>
@foreach ($especialidades->sortBy('nombre')->values() as $i => $especialidad)
<option value="{{$especialidad->id}}"
   {{(old('b_especialidad') == $especialidad->id) ? 'selected' : ''}}
   {{isset($peticion->id) && $peticion->solicitud->especialidad_id == $especialidad->id ? 'selected' : ''}}
   >{{$i+1}}.- {{$especialidad->nombre}}</option>
@endforeach
  