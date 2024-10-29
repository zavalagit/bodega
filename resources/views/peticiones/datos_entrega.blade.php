@isset($peticion)
<div class="row">
   <div class="col s12">
       <blockquote>3.- Datos de entrega de la Petición</blockquote>
   </div>
   <div class="input-field col s12 m12 l12">
       <input id="fecha_entrega" type="date" class="center-align" name="fecha_entrega" value="{{$peticion->fecha_entrega}}">
       <label class="active" for="fecha_entrega">FECHA DE ENTREGA</label>
   </div>
   <div class="input-field col s12 m12 l12">
       <input id="sp_recibe" type="text" name="sp_recibe" value="{{$peticion->sp_recibe}}">
       <label for="sp_recibe">M. P. o Servidor Público recibe*</label>
   </div>
</div>
@endisset

@empty($peticion)
<div class="row">
   <div class="col s12">
       <blockquote>3.- Datos de entrega de la Petición</blockquote>
   </div>
   <div class="input-field col s12 m12 l12">
       <input id="fecha_entrega" type="date" class="center-align" name="fecha_entrega">
       <label class="active" for="fecha_entrega">FECHA DE ENTREGA</label>
   </div>
   <div class="input-field col s12 m12 l12">
       <input id="sp_recibe" type="text" name="sp_recibe">
       <label for="sp_recibe">M. P. o Servidor Público recibe*</label>
   </div>
</div>
@endempty