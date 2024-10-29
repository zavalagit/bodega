@component('componentes.componente_sidenav_buscador')
<form class="col s12">
   {{-- <div class="row">
      <div class="col s12">
         <p style="line-height: 25px;"><i style="color:#152f4a;" class="fas fa-certificate"></i> El parametro por "fecha" es de acuedo a la fecha en que se realizó el registro. 
      </div>
   </div> --}}

   <div class="row">
      <div class="col s12">
         <p style="line-height: 25px;"><i style="color: tomato;" class="fas fa-sticky-note fa-sm"></i> <span><b>El parametro "fecha" es de acuerdo a la fecha en que se realizó el registro.</b></span> 
      </div>
      <div class="col s12">
         <hr class="hr-2">
      </div>
      
      @if (Auth::user()->tipo == 'administrador_peticiones')
         <div class="col s6">
            <label>
               <input type="radio" name="b_modelo" value="region"/>
               <span>Región</span>
            </label>
         </div>
         <div class="col s6">
            <label>
               <input type="radio" name="b_modelo" value="unidad"/>
               <span>Unidad</span>
            </label>
         </div>
         <!--region-->
         <div class="input-field col s12">
            <select name="b_modelo_id">
               {{-- <option value="0" selected>---</option> --}}
               @foreach ($regiones->sortBy('nombre')->values() as $i => $region)
                  <option value="{{$region->id}}" {{(old('b_modelo_id') == $region->id) ? 'selected' : ''}}>{{$i+1}}.- {{$region->nombre}}</option>
               @endforeach
            </select>
            <label>REGIÓN</label>
         </div>
         <div class="col s12">
            <hr class="hr-2">
         </div>
         <!--unidad-->
         <div class="input-field col s12">
            <select name="b_modelo_id">
               {{-- <option value="0" selected>---</option> --}}
               @foreach ($unidades->sortBy('nombre')->values() as $i => $unidad)
                  <option value="{{$unidad->id}}" {{(old('b_modelo_id') == $unidad->id) ? 'selected' : ''}}>{{$i+1}}.- {{$unidad->nombre}}</option>
               @endforeach
            </select>
            <label>UNIDAD</label>
         </div>
         <div class="col s12">
            <hr class="hr-2">
         </div>
      @endif
      <!--peticion_fecha-->
      <div class="input-field col s12">
         <input id="fecha-inicio" type="date" name="b_fecha_inicio" value="{{old('b_fecha_inicio')}}">
         <label class="active" for="fecha-inicio">FECHA INICIO</label>
      </div>
      <div class="input-field col s12">
         <input id="fecha-fin" type="date" name="b_fecha_fin" value="{{old('b_fecha_fin')}}">
         <label class="active" for="fecha-fin">FECHA TERMINO</label>
      </div>
      <div class="col s12">
         <hr class="hr-2">
      </div>
      <!--peticion_btn_buscar-->
      <div class="input-field col s12">
        <button type="submit"  name="btn_buscar" value="buscar">Buscar</button>
      </div>
   </div>
</form>
@endcomponent
