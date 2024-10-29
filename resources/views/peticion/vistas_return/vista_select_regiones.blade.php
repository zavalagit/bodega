<select name="b_modelo_id">
   <option value="0" selected>---</option>
   @foreach ($regiones->sortBy('nombre')->values() as $i => $region)
      <option value="{{$region->id}}" {{(old('b_region') == $region->id) ? 'selected' : ''}}>{{$i+1}}.- {{$region->nombre}}</option>
   @endforeach
</select>
<label>REGIÓN</label>