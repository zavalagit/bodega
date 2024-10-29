@extends( ( Auth::user()->tipo == 'administrador' ) ? 'administrador.plantillafiscalia' : 'bodega.plantilla')

@section('css')
   <style media="screen">
      textarea{
         padding: 0 !important;
      }
      blockquote{
         padding: 1px 0 !important;
         color: #fff !important;
         background-color: #112046 !important;
      }
      hr{
         border-color: #2196f3;
      }
      #btn-editar{
         background-color: #aaa !important;
         color: #fff;
      }
      #btn-editar:hover{
         background-color: #112046 !important;
      }
   </style>

@endsection

@section('contenido')

   <div class="row">
      <form class="col s12" id="form-edit-cad-perito">
         <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
         <input type="hidden" name="folio" value="{{$cadena->bodega}}">


         <div class="row">
            <div class="input-field col s4">
               <input id="nuc" type="text" name="nuc" value="{{$cadena->nuc}}">
               <label for="nuc">NUC*</label>
            </div>
            <div class="input-field col s4">
               <select name="unidad">
                  <option value="" disabled selected></option>
                  @foreach ($unidades as $unidad)
                     @if ($cadena->unidad_id == $unidad->id)
                        <option selected value={{$unidad->id}}>{{$unidad->nombre}}</option>
                     @else
                        <option value={{$unidad->id}}>{{$unidad->nombre}}</option>
                     @endif
                  @endforeach
               </select>
               <label>Unidad administrativa*</label>
            </div>
            <div class="input-field col s4">
               <input id="folio" type="text" name="folio" value="{{$cadena->folio}}">
               <label for="folio">Folio</label>
            </div>
         </div>

         <div class="row">
            <div class="input-field col s4">
               <textarea id="lugarIntervencion" class="materialize-textarea" name="intervencion_lugar">{{$cadena->intervencion_lugar}}</textarea>
               <label for="lugarIntervencion">Lugar de intervención*</label>
            </div>
            <div class="input-field col s4">
               <input id="horaIntervencion" type="time" class="center-align" name="intervencion_hora" value="{{$cadena->intervencion_hora}}">
               <label class="active" for="horaIntervencion">Hora de intervención</label>
            </div>
            <div class="input-field col s4">
               <input id="fechaIntervencion" type="date" name="intervencion_fecha" value="{{$cadena->intervencion_fecha}}">
               <label class="active" for="fechaIntervencion">Fecha de intervención</label>
            </div>
         </div>

         <div class="row">
            <div class="col s3">
               <p><b>Motivo del registro</b></p>
            </div>
            <p class="col s2">
               @if ($cadena->motivo == 'localizacion')
                  <input name="motivo" type="radio" id="localizacion" value="localizacion" checked/>
               @else
                  <input name="motivo" type="radio" id="localizacion" value="localizacion"/>
               @endif
               <label for="localizacion">Localización</label>
            </p>
            <p class="col s2">
               @if ($cadena->motivo == 'descubrimiento')
                  <input name="motivo" type="radio" id="descubrimiento" value="descubrimiento" checked/>
               @else
                  <input name="motivo" type="radio" id="descubrimiento" value="descubrimiento" />
               @endif
               <label for="descubrimiento">Descubrimiento</label>
            </p>
            <p class="col s2">
               @if ($cadena->motivo == 'aportacion')
                  <input name="motivo" type="radio" id="aportacion" value="aportacion" checked/>
               @else
                  <input name="motivo" type="radio" id="aportacion" value="aportacion" />
               @endif
               <label for="aportacion">Aportación</label>
            </p>
         </div>

         <!--1. Identidad-->
         <section id="identidad">
            <blockquote class="center-align">
               <h6><b>1. Identidad (Únicamente registrar indicios que presenten la misma naturaleza)</b></h6>
            </blockquote>
            <div class="row">
               <div class="col s2">
                 <a href="" id="add-desc"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
               </div>
            </div>

            @foreach ($cadena->indicios as $p => $i)
               <div class="row">
                  @if ($p != 0)
                     <hr>
                  @endif
                  <div class="input-field col s2">
                     <input id="identificador" type="text" class="center-align" name="identificador[]" value="{{$i->identificador}}">
                     <label for="identificador">IDENTIFICADOR*</label>
                  </div>
                  <div class="input-field col s9">
                     <textarea id="descripcion" class="materialize-textarea" name="descripcion[]">{{$i->descripcion}}</textarea>
                     <label for="descripcion">DESCRIPCIÓN*</label>
                  </div>
                  @if(Auth::user()->unidad_id == 1)
                  <div class="input-field col s12 m4 l6">
                     <textarea id="ubicacion" class="materialize-textarea" name="ubicacion[]">{{$i->ubicacion}}</textarea>
                     <label for="ubicacion">UBICACIÓN DEL LUGAR*</label>
                  </div>
                  <div class="input-field col s12 m4 l5">
                     <textarea id="recolectado_de" class="materialize-textarea" name="recolectado_de[]">{{$i->recolectado_de}}</textarea>
                     <label for="recolectado_de">RECOLECTADO DE*</label>
                  </div>
                  <div class="input-field col s12 m4 l2">
                     <!--hora de recoleccion-->
                     <input id="hora-rec" type="time" class="center-align" name="recoleccion_hora[]" value="{{$i->hora}}">
                     <label class="active" for="hora-rec">HORA DE RECOLECCIÓN*</label>
                  </div>
                  <div class="input-field col s6 m4 l2">
                     <!--fecha de recoleccion-->
                     <input id="fecha-rec" type="date" class="center-align" name="recoleccion_fecha[]" value="{{$i->fecha}}">
                     <label class="active" for="fecha-rec">FECHA DE RECOLECCIÓN*</label>
                  </div>
                  <div class="input-field col s6 m4 l2">
                     <input id="estado_indicio" type="text" name="estado_indicio[]" value="{{$i->condicion}}">
                     <label for="estado_indicio">ESTADO DEL INDICIO</label>
                  </div>
                  <div class="input-field col s12 m6 l5">
                     <textarea id="observacion" class="materialize-textarea" name="observacion[]">{{$i->observacion}}</textarea>
                     <label for="observacion">OBSERVACIÓN EN ETIQUETA</label>
                  </div>
               @else
                  <div class="input-field col s12 m4 l5">
                     <textarea id="ubicacion" class="materialize-textarea" name="ubicacion[]">{{$i->ubicacion}}</textarea>
                     <label for="ubicacion">UBICACIÓN DEL LUGAR*</label>
                  </div>
                  <div class="input-field col s12 m4 l2">
                     <!--hora de recoleccion-->
                     <input id="hora-rec" type="time" class="center-align" name="recoleccion_hora[]" value="{{$i->hora}}">
                     <label class="active" for="hora-rec">HORA DE RECOLECCIÓN*</label>
                  </div>
                  <div class="input-field col s6 m4 l2">
                     <!--fecha de recoleccion-->
                     <input id="fecha-rec" type="date" class="center-align" name="recoleccion_fecha[]" value="{{$i->fecha}}">
                     <label class="active" for="fecha-rec">FECHA DE RECOLECCIÓN*</label>
                  </div>
                  <div class="input-field col s6 m4 l2">
                     <input id="estado_indicio" type="text" name="estado_indicio[]" value="{{$i->condicion}}">
                     <label for="estado_indicio">ESTADO DEL INDICIO</label>
                  </div>
                  <div class="input-field col s12 m6 l9">
                     <textarea id="observacion" class="materialize-textarea" name="observacion[]">{{$i->observacion}}</textarea>
                     <label for="observacion">OBSERVACIÓN EN ETIQUETA</label>
                  </div>
               @endif
                  @if ($p != 0)
                     <div class="input-field col s1 center-align">
                        <button type="button" name="button" id="x-desc">
                           <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                     </div>
                  @endif
               </div>
            @endforeach
         </section>


         <!--2. Documentación-->
         <blockquote class="center-align" id="blockquote-documentacion">
            <h6><b>2. Documentación</b></i></h6>
         </blockquote>
         <div class="row">
            <div class="col s1">
               <p><b>Escrito:</b></p>
            </div>
            <p class="col s1">
               @if ($cadena->escrito == 'si')
                  <input name="escrito" type="radio" id="escritoSi" value="si" checked/>
               @else
                  <input name="escrito" type="radio" id="escritoSi" value="si"/>
               @endif
               <label for="escritoSi">Si</label>
            </p>
            <p class="col s1">
               @if ($cadena->escrito == 'no')
                  <input name="escrito" type="radio" id="escritoNo" value="no" checked/>
               @else
                  <input name="escrito" type="radio" id="escritoNo" value="no" />
               @endif
               <label for="escritoNo">No</label>
            </p>
            <div class="col s1">
               <p><b>Fotográfico:</b></p>
            </div>
            <p class="col s1">
               @if ($cadena->fotografico == 'si')
                  <input name="fotografico" type="radio" id="fotograficoSi" value="si" checked/>
               @else
                  <input name="fotografico" type="radio" id="fotograficoSi" value="si" />
               @endif
               <label for="fotograficoSi">Si</label>
            </p>
            <p class="col s1">
               @if ($cadena->fotografico == 'no')
                  <input name="fotografico" type="radio" id="fotograficoNo" value="no" checked/>
               @else
                  <input name="fotografico" type="radio" id="fotograficoNo" value="no" />
               @endif
               <label for="fotograficoNo">No</label>
            </p>
            <div class="col s1">
               <p><b>Croquis:</b></p>
            </div>
            <p class="col s1">
               @if ($cadena->croquis == 'si')
                  <input name="croquis" type="radio" id="croquisSi" value="si" checked/>
               @else
                  <input name="croquis" type="radio" id="croquisSi" value="si" />
               @endif
               <label for="croquisSi">Si</label>
            </p>
            <p class="col s1">
               @if ($cadena->croquis == 'no')
                  <input name="croquis" type="radio" id="croquisNo" value="no" checked/>
               @else
                  <input name="croquis" type="radio" id="croquisNo" value="no" />
               @endif
               <label for="croquisNo">No</label>
            </p>
         </div>
         <div class="row">
            <div class="col s1">
               <p><b>Otro:</b></p>
            </div>
            <p class="col s1">
               @if ($cadena->otro == 'si')
                  <input name="otro" type="radio" id="otroSi" value="si" checked/>
               @else
                  <input name="otro" type="radio" id="otroSi" value="si" />
               @endif
               <label for="otroSi">Si</label>
            </p>
            <p class="col s1">
               @if ($cadena->otro == 'no')
                  <input name="otro" type="radio" id="otroNo" value="no" checked/>
               @else
                  <input name="otro" type="radio" id="otroNo" value="no" />
               @endif
               <label for="otroNo">No</label>
            </p>
            <div class="input-field col s8">
               <input disabled id="especifique" type="text" name="especifique" value="{{$cadena->especifique}}">
               <label for="especifique">Especifique</label>
            </div>
         </div>

         <!--3. Recoleccióin-->
         <blockquote class="center-align">
            <h6><b>3. Recolección</b> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></h6>
         </blockquote>
         <div class="row">
            <div class="col s2">
               <a href="" id="refresh-recoleccion"><i class="fa fa-refresh fa-2x" aria-hidden="true"></i></a>
            </div>
         </div>
         <div class="row">
            <div class="input-field col s6">
               <select multiple id="manual" name="manual[]">
                  <option value="" disabled selected>Selecciona los identificador(es)</option>
                  @foreach ($cadena->indicios as $key => $indicio)
                     @if ($indicio->recoleccion === 'manual')
                        <option selected value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
                     @else
                        <option value="{{$indicio->identificador}}" >{{$indicio->identificador}}</option>
                     @endif
                  @endforeach
               </select>
               <label>Manual</label>
            </div>
            <div class="input-field col s6">
               <select multiple id="instrumental" name="instrumental[]">
                  <option value="" disabled selected>Selecciona los identificador(es)</option>
                  @foreach ($cadena->indicios as $key => $indicio)
                     @if ($indicio->recoleccion === 'instrumental')
                        <option selected value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
                     @else
                        <option value="{{$indicio->identificador}}" >{{$indicio->identificador}}</option>
                     @endif
                  @endforeach
               </select>
               <label>Instrumental</label>
            </div>
         </div>

         <!--4. Empaque/embalaje-->
         <blockquote class="center-align">
            <h6><b>4. Empaque/embalaje</b> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></h6>
         </blockquote>
         <div class="row">
            <div class="input-field col s4">
               <select multiple id="bolsa" name="bolsa[]">
                  <option value="" disabled selected>Selecciona los identificador(es)</option>
                  @foreach ($cadena->indicios as $key => $indicio)
                     @if ($indicio->embalaje === 'bolsa')
                        <option selected value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
                     @else
                        <option value="{{$indicio->identificador}}" >{{$indicio->identificador}}</option>
                     @endif
                  @endforeach
               </select>
               <label>Bolsa</label>
            </div>
            <div class="input-field col s4">
               <select multiple id="caja" name="caja[]">
                  <option value="" disabled selected>Selecciona los identificador(es)</option>
                  @foreach ($cadena->indicios as $key => $indicio)
                     @if ($indicio->embalaje === 'caja')
                        <option selected value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
                     @else
                        <option value="{{$indicio->identificador}}" >{{$indicio->identificador}}</option>
                     @endif
                  @endforeach
               </select>
               <label>Caja</label>
            </div>
            <div class="input-field col s4">
               <select multiple id="recipiente" name="recipiente[]">
                  <option value="" disabled selected>Selecciona los identificador(es)</option>
                  @foreach ($cadena->indicios as $key => $indicio)
                     @if ($indicio->embalaje === 'recipiente')
                        <option selected value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
                     @else
                        <option value="{{$indicio->identificador}}" >{{$indicio->identificador}}</option>
                     @endif
                  @endforeach
               </select>
               <label>Recipiente</label>
            </div>
         </div>

         <!--5. Servidores públicos-->
         <blockquote class="center-align">
            <h6><b>5. Servidores públicos</b> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></h6>
         </blockquote>
         <div class="row">

            <div class="input-field col s2">
               <input id="input_sp" type="text" autocomplete="off" name="servidor_publico" placeholder="Agregar Servido Público">
               <label for="input_sp"></label>
            </div>

            <div class="input-field col s4">
               <ul id="lista-sp">
                  
               </ul>
            </div>

         </div>

         <div class="row" id="sp-div">
         @foreach($cadena->users as $u => $user)
            <div class="row">            
               @if($u == 0)
                  <h6><b>Persona que inicia la cadena</b></h6>
               @else
                  <h6><b>Persona que interviene en la cadena</b></h6>   
               @endif

               <input type="hidden" id="" name="id_perito" value="{{$user->id}}">
               <input type="hidden" id="" name="id_sp[]" value="{{$user->id}}">

               <div class="input-field col s1">
                  <input id="folioPersona" type="text" name="folioPersona" value="{{$user->folio}}" disabled>
                  <label for="folioPersona">Folio</label>
               </div>
               <div class="input-field col s3">
                  <input id="nombre" type="text" name="nombre[]" value="{{$user->name}}" disabled>
                  <label for="nombre">Nombre</label>
               </div>
               <div class="input-field col s2">
                  <input id="institucion" type="text" name="institucion[]" value="PGJ" disabled>
                  <label for="institucion">Institución</label>
               </div>
               <div class="input-field col s2">
                  <input id="nombre" type="text" name="cargo[]" value="{{$user->cargo->nombre}}" disabled>
                  <label for="nombre">Cargo</label>
               </div>
               <div class="input-field col s2">
                  <input id="etapa" type="text" name="etapa[]" value="{{$user->pivot->etapa}}">
                  <label for="etapa">Etapa</label>
               </div>
               @if($u != 0)
               <div class="input-field col s2 center-align">
                  <button type="button" name="button" id="x-sp">
                     <i class="fa fa-times" aria-hidden="true"></i>
                  </button>
               @endif   
               </div>
            </div>

         @endforeach
            </div>


         <!--6. Traslado-->
         <blockquote class="center-align" id="blockquote-traslado">
            <h6><b>6. Traslado</b> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></h6>
         </blockquote>
         <div class="row">
            <div class="col s1">
               <p><b>Vía:</b></p>
            </div>
            <p class="col s1">
               @if ($cadena->traslado === 'terrestre')
                  <input name="traslado" type="radio" id="terrestre" value="terrestre" checked/>
               @else
                  <input name="traslado" type="radio" id="terrestre" value="terrestre" />
               @endif
               <label for="terrestre">Terrestre</label>
            </p>
            <p class="col s1">
               @if ($cadena->traslado === 'area')
                  <input name="traslado" type="radio" id="aerea" value="aerea" checked/>
               @else
                  <input name="traslado" type="radio" id="aerea" value="aerea" />
               @endif
               <label for="aerea">Aérea</label>
            </p>
            <p class="col s1">
               @if ($cadena->traslado === 'maritima')
                  <input name="traslado" type="radio" id="maritima" value="maritima" checked/>
               @else
                  <input name="traslado" type="radio" id="maritima" value="maritima" />
               @endif
               <label for="maritima">Marítima</label>
            </p>
         </div>
         <div class="row">
            <div class="col s4">
               <p><b>Se requieren condiciones especiales para su traslado:</b></p>
            </div>
            <p class="col s1">
               @if ($cadena->trasladoCondiciones === 'si')
                  <input name="trasladoCondiciones" type="radio" id="condicionesSi" value="si" checked/>
               @else
                  <input name="trasladoCondiciones" type="radio" id="condicionesSi" value="si" />
               @endif
               <label for="condicionesSi">Si</label>
            </p>
            <p class="col s1">
               @if ($cadena->trasladoCondiciones === 'no')
                  <input name="trasladoCondiciones" type="radio" id="condicionesNo" value="no" checked/>
               @else
                  <input name="trasladoCondiciones" type="radio" id="condicionesNo" value="no" />
               @endif
               <label for="condicionesNo">No</label>
            </p>
         </div>
         <div class="row">
            <div class="input-field col s12">
               <input id="recomendaciones" disabled="true" type="text" name="trasladoRecomendaciones">
               <label for="recomendaciones">Recomendaciones</label>
            </div>
         </div>

         <!--Anexo 4-->
         <blockquote class="center-align">
            <h6><b>ANEXO 4</b></h6>
         </blockquote>
         <div class="row">
            <div class="input-field col s12">
               <p><b>Señale las condiciones en las que se encuentran los embalajes. Cuando alguno de ellos presente alteración, deterioro o cualquier otra anomalía, especifique dicha condición.*</b></p>
               <textarea id="embalaje" class="materialize-textarea" name="embalaje">{{$cadena->embalaje}}</textarea>
               <label for="embalaje"></label>
            </div>
         </div>        

         <div class="row" id="botones">

{{--
            <div class="col s2 offset-s4">
               <a href="/anexo-3/{{$cadena->id}}" class="waves-effect waves-light btn" target="_blank" id="btn-anexo3">anexo 3</a>
            </div>
            <div class="col s2">
               <a href="/anexo-4/{{$cadena->id}}" class="waves-effect waves-light btn" target="_blank" id="btn-anexo4">anexo 4</a>
            </div>
            <div class="col s2">
               <a href="/etiqueta/{{$cadena->id}}" class="waves-effect waves-light btn" target="_blank" id="btn-etiqueta">etiqueta</a>
            </div>
--}}
            <div class="fixed-action-btn">
               <button class="btn waves-effect waves-light" type="submit" id="btn-editar" data-id="{{$cadena->id}}" name="action">
                  Editar
               </button>
            </div>
         </div>



      </form>
   </div>
@endsection

@section('js')
<script src="{{asset('js/cadtemp.js')}}"></script>
<script src="{{asset('js/editar_sp.js')}}"></script>
<script type="text/javascript">
      var int=self.setInterval("refresh()",5000);
      function refresh(){
         var motivo = $("input:radio[name=motivo]:checked").val();
       
         if(motivo=='localizacion' || motivo=='descubrimiento'){               
            var fecha1 = $('#intervencion_fecha').val();
            if(fecha1!=''){
               $('input[name^="recoleccion_fecha"').each(function (){
                  if($(this).val() !=''){
                     if(fecha1 > $(this).val()){
                        alertify.logPosition("top right");
                        alertify.error("Verifica la fecha");
                     }
                     else if(fecha1 == $(this).val()){
                        var hora1 = $('#intervencion_hora').val();
                        if(hora1!=''){
                           $('input[name^="recoleccion_hora"').each(function (){
                              if($(this).val() !=''){
                                 if(hora1 >= $(this).val()){
                                    alertify.logPosition("top right");
                                    alertify.error("Verifica la hora");
                                 }                           
                              }                     
                           });
                        }
                     }                     
                  }
               });            
            }           
         }
         else if(motivo=='aportacion'){            
            var fecha1 = $('#intervencion_fecha').val();
            console.log(fecha1);
            if(fecha1!=''){
               $('input[name^="recoleccion_fecha"').each(function (){
                  if($(this).val() !=''){
                     if(fecha1 > $(this).val()){
                        alertify.logPosition("top right");
                        alertify.error("Verifica la fecha");
                     }
                     else if(fecha1 == $(this.val())){
                        var hora1 = $('#intervencion_hora').val();
                        if(hora1!=''){
                           $('input[name^="recoleccion_hora"').each(function (){
                              if($(this).val() !=''){
                                 if(hora1 > $(this).val()){
                                    alertify.logPosition("top right");
                                    alertify.error("Verifica la hora");
                                 }                           
                              }
                           });
                        }
                     }
                  }
               });            
            }  

         }
      }
      </script> 
@endsection
