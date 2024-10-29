
<div class="col s12" style="margin: 0 !important;">

   {{-- <div class="row" style="border: 5px solid #152F4A;"> --}}
      <div class="col s12" style="background-color:#152f4A; color: #c09f77; padding: 5px 10px; margin-bottom: 10px;">
         <b>IDENTIFICADOR: {{$indicio->identificador}}</b>
      </div>
      <!--clasificacion-->
      <div class="input-field col s12 m12 l3">
         <select  class="clasificacion-select" data-accion="{{$formAccion}}" name="clasificacion[]">
            <option value="" selected disabled>Selecciona clasificacion del arma</option>
            <option value="corta"
               {{isset($arma) ? ( ($arma->clasificacion == 'corta') ? 'selected' : '') : ''}}
            >Corta</option>
            <option value="larga"
               {{isset($arma) ? ( ($arma->clasificacion == 'larga') ? 'selected' : '') : ''}}
            >Larga</option>
         </select>
         <label for="clasificacion"><i class="fas fa-user"></i> ~ CLASIFICACION DEL ARMA*</label>
      </div>
      <!--tipo-->
      <div class="input-field col s12 m12 l3">
         <input type="text" id="arma-tipo-{{$indicio->id}}" name="tipo[]" value="{{ isset($arma) ? $arma->tipo : '' }} {{$indicio->arma()->count() ? $indicio->arma->tipo : ''}}" placeholder="REVOLVER / FUSIL / PISTOLA / METRALLADORA">
         <label for="arma-tipo-{{$indicio->id}}"><i class="fas fa-user"></i> ~ TIPO DE ARMA*</label>
      </div>
      <!--fabricante-->
      <div class="input-field col s12 m12 l3">
         <input type="text" id="fabricante" name="fabricante[]" value="{{ isset($arma) ? $arma->fabricante : '' }}">
         <label for="fabricante"><i class="fas fa-user"></i> ~ FABRICANTE (MARCA)*</label>
      </div>
      <!--serie-->
      <div class="input-field col s12 m12 l3">
         <input type="text" id="serie" name="serie[]" value="{{ isset($arma) ? $arma->serie : '' }}">
         <label for="serie"><i class="fas fa-user"></i> ~ SERIE DEL ARMA*</label>
      </div>
      <!--modelo-->
      <div class="input-field col s12 m12 l3">
         <input type="text" id="arma-modelo-{{$indicio->id}}" name="modelo[]" value="{{ isset($arma) ? $arma->modelo : '' }}">
         <label for="arma-modelo-{{$indicio->id}}"><i class="fas fa-user"></i> ~ MODELO*</label>
      </div>
      <!--calibre-->
      <div class="input-field col s12 m12 l3">
         {{-- <input type="text" id="calibre" name="calibre[]" value="{{ isset($arma) ? $arma->calibre : '' }}">
         <label for="calibre"><i class="fas fa-user"></i> CALIBRE NOMINAL*</label> --}}
      
         <select class="" data-accion="{{$formAccion}}" name="calibre[]">
            <option value="" selected disabled>Indique el calibre del arma</option>
            @foreach ($calibres as $i => $calibre)
                <option value="{{$calibre->id}}" {{isset($arma->id) && ($arma->calibre_id == $calibre->id) ? 'selected' : ''}}>{{++$i}}.- {{$calibre->nombre}}</option>
            @endforeach
         </select>
      </div>
      <!--PAIS-->
      <div class="input-field col s12 m12 l3">
         <select  class="pais-select" data-accion="{{$formAccion}}" name="pais[]">
            <option value="" selected>Selecciona el pais de fabricacion</option>
         @foreach ($paises->sortBy('nombre')->values() as $i => $pais)
               <option value="{{$pais->id}}" 
                  {{isset($arma) ? ( $arma->pais_id == $pais->id ? 'selected' : '') : ''}}
               >{{$i + 1}}.- {{$pais->nombre}}</option>
         @endforeach
         </select>
         <label><i class="fas fa-globe-americas"></i> ~ PAÍS DEL ARMA*</label>
      </div>
      <!--importador-->
      <div class="input-field col s12 m12 l3">
         <input type="text" id="importador" name="importador[]" value="{{ isset($arma) ? $arma->importador : '' }}" placeholder="SDENA, SEMAR, SE DESCONOCE">
         <label for="importador"><i class="fas fa-user"></i> ~ IMPORTADOR DEL ARMA*</label>
      </div>
      <!--domicilio-->
      <div class="input-field col s12 m12 l12">
         <input type="text" id="domicilio" placeholder="DOMICILIO DE FABRICACION O MANOFACTURA" name="domicilio[]" value="{{ isset($arma) ? $arma->domicilio : '' }}">
         <label for="domicilio"><i class="fas fa-map-marked"></i> ~ DOMICILIO*</label>
      </div>  
   {{-- </div> --}}

</div>
