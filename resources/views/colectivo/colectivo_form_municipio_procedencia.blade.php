<option value="" selected>Selecciona el municipio de procedencia*</option>
@foreach ($delegaciones->sortBy('nombre')->values() as $i => $delegacion)
   <option value="{{$delegacion->id}}">{{$i+1}}.- {{$delegacion->nombre}}</option>
@endforeach