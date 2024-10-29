<div class="col s12">
   <p style="font-size: 18px;"><b>- Seleccione el tipo de etiqueta:<b></p>
</div>
<div class="col s12 div-col-padding">
   <input type="checkbox" class="filled-in" id="etiqueta-general" checked name="etiqueta_general"/>
   <label for="etiqueta-general">Etiqueta general (Indicios en una sola etiqueta)</label>
</div>

@if ($cadena->indicios->count() > 1)
   <div class="col s12 div-col-padding">
      <input type="checkbox" class="filled-in" id="etiqueta-identificador" disabled name="etiqueta_identificador"/>
      <label for="etiqueta-identificador">Etiqueta por identificador (Una etiqueta por cada identificador)</label>
   </div>
@endif

@if ($cadena->indicios->count() > 2)
   <div class="col s12">
      <p style="font-size: 18px;"><b>- Etiqueta personalizada ~ seleccione los identificadores de los indicios que quiere que figuren en la etiqueta:<b></p>
   </div>
   @foreach ($cadena->indicios as $indicio)
       <div class="col s12 div-col-padding">
         <input type="checkbox" class="etiqueta-indicio filled-in" id="indicio-{{$indicio->id}}" disabled name="etiqueta_indicios[]" value="{{$indicio->id}}"/>
         <label for="indicio-{{$indicio->id}}">{{$indicio->identificador}}</label>
       </div>
   @endforeach
@endif

<div class="col s12">
   <p style="font-size: 18px;"><b>- Indique el tamaño de la etiqueta:<b></p>
</div>
<div class="col s12 div-col-padding">
   <input type="radio" id="chica" required name="etiqueta_tamano" value="chica"/>
   <label for="chica">Chica</label>
</div>
<div class="col s12 div-col-padding">
   <input type="radio" id="mediana" checked name="etiqueta_tamano" value="mediana"/>
   <label for="mediana">Mediana</label>
</div>
<div class="col s12 div-col-padding">
   <input type="radio" id="grande" name="etiqueta_tamano" value="grande"/>
   <label for="grande">Grande</label>
</div>

<div class="col s12">
   <hr class="hr-main">
</div>

<div class="input-field col s12">
   <button type="submit" class="btn-guardar" id="btn-buscar" style="display: inline-block !important; width:100%;" name="btn" value="buscar">Generar etiqueta</button>
</div>
