<option value="" selected disabled>LUGAR DE ADSCRIPCIÓN DEL M.P. O SERVIDOR PÚBLICO</option>
@foreach ($unidades->sortBy('nombre')->values() as $i => $unidad)
   <option value="{{$unidad->id}}"
      {{-- {{(old('b_necropsia') == $necropsia->id) ? 'selected' : ''}} --}}
      {{isset($peticion->unidad2_id) && $peticion->unidad2_id == $unidad->id ? 'selected' : ''}}
   >{{$i+1}}.- {{$unidad->nombre}}</option>
@endforeach
  