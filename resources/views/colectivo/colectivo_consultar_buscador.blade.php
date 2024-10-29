@component('componentes.componente_sidenav_buscador')
   <form id="form-colectivo-consultar" class="col s12" action="{{route('colectivo_consultar',['colectivo_estado' => $colectivo_estado])}}" method="GET">
      <div class="row">
         <!--Grupo familiar-->
         {{-- @if (Auth::user()->tipo != 'usuario')
         <div class="input-field col s12">
            <input id="b-grupo-familiar" type="text" name="b_grupo_familiar" value="{{old('b_grupo_familiar')}}">
            <label class="active" for="b-grupo-familiar">GRUPO FAMILIAR</label>
         </div>
         <div class="col s12">
            <hr class="hr-2">
         </div>
         @endif --}}
         <!--nombre-->
         <div class="input-field col s12">
            <input type="text" id="b-nombre" placeholder="Nombre del donante o persona desaparecida" name="b_nombre" value="{{old('b_nombre')}}">
            <label for="b-nombre">NOMBRE</label>
         </div>
         <div class="col s12">
            <hr class="hr-2">
         </div>
         <!--región en don se realiza el registro-->
         @if (Auth::user()->tipo != 'usuario')
         <div class="input-field col s12">
            <select name="b_fiscalia">
               <option value="0" selected>---</option>
               @foreach ($fiscalias->sortBy('nombre')->values() as $i => $fiscalia)
                  <option value="{{$fiscalia->id}}" {{ ( old('b_fiscalia') == $fiscalia->id ) ? 'selected' : '' }}>{{$i+1}}.- {{$fiscalia->nombre}}</option>
               @endforeach
            </select>
            <label><i class="fas fa-map-marker"></i> ~ REGIÓN EN DONDE SE REALIZA EL MUESTREO</label>
         </div>
         <div class="col s12">
            <hr class="hr-2">
         </div>
         @endif
         <!--fecha inicio-->
         <div class="input-field col s12">
            <input id="b-fecha-inicio" type="date" name="b_fecha_inicio" value="{{old('b_fecha_inicio')}}">
            <label class="active" for="b-fecha-inicio">FECHA DE MUESTREO (Intervalo incio)</label>
         </div>
         <div class="col s12">
            <hr class="hr-2">
         </div>
         <!--fecha termino-->
         <div class="input-field col s12">
            <input id="b-fecha-fin" type="date" {{ old('b_fecha_inicio') ? '' : 'disabled' }} name="b_fecha_fin" value="{{old('b_fecha_fin')}}">
            <label class="active" for="b-fecha-fin">FECHA DE MUESTREO (Intervalo fin)</label>
         </div>
         <div class="col s12">
            <hr class="hr-2">
         </div>
         <!--btn submit-->
         <div class="input-field col s12">
            <button type="submit" id="btn-colectivo-consultar" class="btn-consultar btn-guardar" style="font-size: 18px;" name="btn_colectivo_consultar" value="consultar">consultar</button>
         </div>
      </div>
   </form>
@endcomponent

