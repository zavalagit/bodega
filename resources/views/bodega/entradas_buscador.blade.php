@component('componentes.componente_sidenav_buscador')
<form class="col s12" autocomplete="off">
   <div class="row">
      <div class="input-field col s12" id="input-buscar">
         @isset($buscar_texto)
            <input type="text" id="buscar-texto" name="buscar_texto" value="{{$buscar_texto}}">
         @endisset
         @empty($buscar_texto)
            <input type="text" id="buscar-texto" placeholder="Folio ~ N.U.C. ~ Descripción" name="buscar_texto">
         @endempty
      </div>
      <div class="input-field col s12">
         @isset($buscar_fecha_inicio)
            <input id="fecha-inicio" type="date" name="buscar_fecha_inicio" value="{{$buscar_fecha_inicio}}">
         @endisset
         @empty($buscar_fecha_inicio)
            <input id="fecha-inicio" type="date" name="buscar_fecha_inicio">
         @endempty
         <label class="active" for="fecha-inicio">FECHA INICIO</label>
      </div>
      <div class="input-field col s12">
         @isset($buscar_fecha_fin)
            <input id="fecha-fin" type="date" name="buscar_fecha_fin" value="{{$buscar_fecha_fin}}">
         @endisset
         @empty($buscar_fecha_fin)
            <input id="fecha-fin" type="date" name="buscar_fecha_fin">
         @endempty
         <label class="active" for="fecha-fin">FECHA FIN</label>
      </div>
      <div class="input-field col s12">
         <select name="buscar_naturaleza">
            <option value="0">---</option>
            @foreach ($naturalezas as $naturaleza)
               @if ($buscar_naturaleza == $naturaleza->id)
                  <option value="{{$naturaleza->id}}" selected>{{$naturaleza->nombre}}</option>
               @else
                  <option value="{{$naturaleza->id}}">{{$naturaleza->nombre}}</option>
               @endif
            @endforeach
         </select>
         <label>NATURALEZA</label>
      </div>
      <!--Si administrador-->
      @if (Auth::user()->tipo == 'administrador')
         <div class="input-field col s12">
            <select name="buscar_region">
               <option value="0" disabled selected>---</option>
               @foreach ($regiones->sortBy('nombre')->values() as $i => $region)
                     <option value="{{$region->id}}" {{ ($region->id == $buscar_region) ? 'selected' : '' }}>{{$i+1}}. {{$region->nombre}}</option>
               @endforeach
            </select>
            <label>REGIÓN</label>
         </div>
      @endif
      <div class="col s12" style="margin-bottom: 20px;">
         <label for="prestamo-multiple" style="color: #152f4a !important;">
            <input type="checkbox" class="filled-in" id="prestamo-multiple" name="prestamo_multiple" value="prestamo_multiple"/>
            <span>Prestamo multiple</span>
         </label>
      </div>

      <div class="col s12">
         <hr class="hr-main">
      </div>

      <div class="input-field col s12">
         <button class="btn-guardar" id="btn-buscar" style="display: inline-block !important; width:100%;" type="submit" name="btn" value="buscar">Buscar</button>
      </div>
   </div>
</form>
@endcomponent