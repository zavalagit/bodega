<div class="row">
   
   <!--clasificacion-->
    <div class="input-field col s12 m12 l3">
      <select  class="clasificacion-select" data-accion="{{$formAccion}}" name="clasificacion[]">
         <option value="" selected>Selecciona clasificacion del arma</option>
         <option value="corta" >Arma corta</option>
         <option value="larga" >Arma larga</option>
      </select>
      <label for="clasificacion"><i class="fas fa-user"></i> ~ CLASIFICACION DEL ARMA</label>
   </div>
   <!--tipo de arma-->
   <div class="input-field col s12 m12 l3">
      <input type="text" id="tipo-arma" name="tipo_arma[]" value="{{ isset($arma) ? $arma->tipo_arma : '' }}" placeholder="escopeta,rifle,escuadra,hechizas">
      <label for="tipo-arma"><i class="fas fa-user"></i> ~ TIPO DE ARMA</label>
   </div>
   <!--fabricante-->
   <div class="input-field col s12 m12 l3">
      <input type="text" id="fabricante" name="fabricante[]" value="{{ isset($arma) ? $arma->fabricante : '' }}">
      <label for="fabricante"><i class="fas fa-user"></i> ~ FABRICANTE DEL ARMA</label>
   </div>
   <!--modelo-->
   <div class="input-field col s12 m12 l3">
      <input type="text" id="modelo" name="modelo[]" value="{{ isset($arma) ? $arma->modelo : '' }}">
      <label for="modelo"><i class="fas fa-user"></i> ~ MODELO DEL ARMA</label>
   </div>
   <!--serie-->
   <div class="input-field col s12 m12 l3">
      <input type="text" id="serie" name="serie[]" value="{{ isset($arma) ? $arma->serie : '' }}">
      <label for="serie"><i class="fas fa-user"></i> ~ SERIE DEL ARMA</label>
   </div>
   <!--calibre-->
   <div class="input-field col s12 m12 l3">
      <input type="text" id="calibre" name="calibre[]" value="{{ isset($arma) ? $arma->calibre : '' }}">
      <label for="calibre"><i class="fas fa-user"></i> ~ CALIBRE DEL ARMA</label>
   </div>
   <!--PAIS-->
   <div class="input-field col s12 m12 l3">
      <select  class="pais-select" data-accion="{{$formAccion}}" name="pais[]">
         <option value="" selected>Selecciona el pais de fabricacion</option>
        @foreach ($paises->sortBy('nombre')->values() as $i => $p)
            <option value="{{$p->id}}" {{ ( $formAccion == 'editar' && ($arma->id == $p->id) ) ? 'selected' : '' }}>{{$i+1}}.- {{$p->nombre}}</option>
        @endforeach
      </select>
      <label><i class="fas fa-user-friends"></i> ~ PAIS DEL ARMA</label>
   </div>
    <!--importador-->
    <div class="input-field col s12 m12 l3">
      <input type="text" id="importador" name="importador[]" value="{{ isset($arma) ? $arma->importador : '' }}">
      <label for="importador"><i class="fas fa-user"></i> ~ IMPORTADOR DEL ARMA</label>
   </div>
   <!--domicilio-->
   <div class="input-field col s12 m12 l12">
      <input type="text" id="domicilio" name="domicilio[]" value="{{ isset($arma) ? $arma->domicilio : '' }}">
      <label for="domicilio"><i class="fas fa-user"></i> ~ DOMICILIO DEL ARMA</label>
   </div>  
  
   
   
  
   
   <div class="col s12">
      <hr class="hr-1">
   </div>
</div>