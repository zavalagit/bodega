@component('componentes.componente_sidenav_buscador')
<form class="col s12" autocomplete="off">
   <div class="row">
      <!--prestamo estado-->
      <div class="col s12">
         <p><b>Estado Prestamo:</b></p>
      </div>
      <div class="col s4">
         <label for="todo">
            <input type="radio" name="buscar_prestamo_estado" id="todo" checked value="todo"/>
            <span>Todo</span>
         </label>
      </div>
      <div class="col s4">
         <label for="activo">
            <input type="radio" name="buscar_prestamo_estado" id="activo" {{(old('buscar_prestamo_estado') == 'activo') ? 'checked' : ''}} value="activo" />
            <span>Activo</span>
         </label>
      </div>
      <div class="col s4" style="margin-bottom: 20px;">
         <label for="concluso">
            <input type="radio" name="buscar_prestamo_estado" id="concluso" {{(old('buscar_prestamo_estado') == 'concluso') ? 'checked' : ''}} value="concluso" />
            <span>Concluso</span>
         </label>
      </div>
      <!--región-->
      @if (Auth::user()->tipo == 'administrador')
         <div class="input-field col s12">
            <select name="buscar_region">
               <option value="0" disabled selected>---</option>
               @foreach ($regiones->sortBy('nombre')->values() as $i => $region)
                     <option value="{{$region->id}}" {{ ( $region->id == old('buscar_region') ) ? 'selected' : '' }}>{{$i+1}}. {{$region->nombre}}</option>
               @endforeach
            </select>
            <label>REGIÓN</label>
         </div>
      @endif
      <!--prestamo fecha_inicio-->
      <div class="input-field col s12">
         <input id="fecha-inicio" type="date" name="buscar_fecha_inicio" value="{{old('buscar_fecha_inicio')}}">
         <label class="active" for="fecha-inicio">FECHA INICIO</label>
      </div>
      <!--prestamo fecha_fin-->
      <div class="input-field col s12">
         <input id="fecha-fin" type="date" name="buscar_fecha_fin" value="{{old('buscar_fecha_fin')}}">
         <label class="active" for="fecha-fin">FECHA FIN</label>
      </div>
      <!--prestamo texto_buscar-->
      <div class="input-field col s12" id="input-buscar">
         <input type="text" id="buscar-texto" placeholder="Folio, N.U.C." name="buscar_texto" value="{{old('buscar_texto')}}">
      </div>
      <div class="input-field col s12">
         <input type="hidden" id="perito-hidden" name="resguardante" value="{{old('resguardante')}}">
         <input type="text" class="autocomplete" id="autocomplete-resguardante" data-tabla="peritos" data-input-hidden="perito-hidden" name="resguardante_autocomplete" value="{{old('resguardante_autocomplete')}}">
         <label for="autocomplete-resguardante">Resguardante</label>
      </div>
      <!--reingreso multiple-->
      <div class="col s12">
         <input type="checkbox" class="filled-in" id="reingreso-multiple" name="reingreso_multiple" value="reingreso_multiple"/>
         <label for="reingreso-multiple" style="color: #152f4a !important;">Reingreso multiple</label>
      </div>
      <!--hr-->
      <div class="col s12">
         <hr class="hr-main">
      </div>
      <!--btn busca-->
      <div class="input-field col s12">
         <button type="submit" class="btn-guardar" id="btn-buscar" style="display: inline-block !important; width:100%;" name="btn_buscar" value="buscar">buscar</button>
      </div>
   </div>
</form>
@endcomponent