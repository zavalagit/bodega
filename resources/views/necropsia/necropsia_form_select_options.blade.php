<option value="" selected disabled>INDIQUE EL DIAGNÓSTICO</option>
@foreach ($necropsias->sortBy('nombre')->values() as $i => $necropsia)
   <option value="{{$necropsia->id}}"
      {{(old('b_necropsia') == $necropsia->id) ? 'selected' : ''}}
      {{isset($peticion->necropsia_id) && $peticion->necropsia_id == $necropsia->id ? 'selected' : ''}}
   >{{$i+1}}.- {{$necropsia->nombre}}</option>
@endforeach
  