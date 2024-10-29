@extends('plantilla.template_sin_menu')

@section('titulo','EDITAR-CADENA')
@section('seccion', 'EDITAR CADENA DE CUSTODIA')

@section('css')
  <link rel="stylesheet" href="{{asset('css/cadenas/registrar.css')}}">
@endsection

@section('contenido')

<div class="row">
  <form class="col s12" id="form-cadena-editar">
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

    <div class="row">
      <div class="input-field col s12 m6 l4">
        <input id="nuc" type="text" name="nuc" value="{{$cadena->nuc}}">
        <label for="nuc">NUC*</label>
      </div>
      <div class="input-field col s12 m6 l4">
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
        <label>UNIDAD ADMINISTRATIVA*</label>
      </div>
      <div class="input-field col s12 m4 l4">
        <input id="folio" type="text" name="folio" value="{{$cadena->folio}}">
        <label for="folio">FOLIO</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12 m4 l4">
        <textarea id="lugarIntervencion" class="materialize-textarea" name="intervencion_lugar">{{$cadena->intervencion_lugar}}</textarea>
        <label for="lugarIntervencion">LUGAR DE INTERVENCIÓN*</label>
      </div>
      <div class="input-field col s6 m4 l4">
        <input id="horaIntervencion" type="time" class="center-align" name="intervencion_hora" value="{{date('H:i:s',strtotime($cadena->intervencion_hora))}}">
        <label class="active" for="horaIntervencion">HORA DE INTERVENCIÓN*</label>
      </div>
      <div class="input-field col s6 m4 l4">
        <input id="fechaIntervencion" type="date" name="intervencion_fecha" value="{{$cadena->intervencion_fecha}}">
        <label class="active" for="fechaIntervencion">FECHA DE INTERVENCIÓN*</label>
      </div>
    </div>

    <div class="row">
      <div class="col s3">
        <p><b>MOTIVO DEL REGISTRO*</b></p>
      </div>
      <p class="col s8 m4 l3">
        @if ($cadena->motivo == 'localizacion')
        <input name="motivo" type="radio" id="localizacion" value="localizacion" checked />
        @else
        <input name="motivo" type="radio" id="localizacion" value="localizacion" />
        @endif
        <label for="localizacion">LOCALIZACIÓN</label>
      </p>
      <p class="col s8 m4 l3">
        @if ($cadena->motivo == 'descubrimiento')
        <input name="motivo" type="radio" id="descubrimiento" value="descubrimiento" checked />
        @else
        <input name="motivo" type="radio" id="descubrimiento" value="descubrimiento" />
        @endif
        <label for="descubrimiento">DESCUBRIMIENTO</label>
      </p>
      <p class="col s8 offset-s3 m4 l3">
        @if ($cadena->motivo == 'aportacion')
        <input name="motivo" type="radio" id="aportacion" value="aportacion" checked />
        @else
        <input name="motivo" type="radio" id="aportacion" value="aportacion" />
        @endif
        <label for="aportacion">APORTACIÓN</label>
      </p>
    </div>

    <!--1 IDENTIDAD-->
    <section id="identidad">
      <blockquote class="center-align">
        <h6><b>1. IDENTIDAD (ÚNICAMENTE REGISTRAR INDICIOS QUE PRESENTEN LA MISMA NATURALEZA)</b></h6>
      </blockquote>
      <div class="row">
        <div class="col s2">
          <a href="" id="add-desc"  class="tooltipped" data-position="right" data-delay="30" data-tooltip="
    AÑADIR INDICIO O EVIDENCIA">
            <i class="fas fa-plus-circle fa-2x" aria-hidden="true"></i>
          </a>
        </div>
      </div>

      @foreach ($cadena->indicios as $p => $i)
      <div class="row div-indicio">
        <hr>
        <div class="input-field col s12 m3 l2">
          <input id="identificador" type="text" class="center-align" name="identificador[]" value="{{$i->identificador}}">
          <label for="identificador">IDENTIFICADOR*</label>
        </div>
        <div class="input-field col s12 m9 l9">
          <textarea id="descripcion" class="materialize-textarea" name="descripcion[]">{{$i->descripcion}}</textarea>
          <label for="descripcion">DESCRIPCIÓN*</label>
        </div>
        @if( ($cadena->user->unidad->id === 1) )
          <div class="input-field col s12 m12 l6">
            <textarea id="ubicacion" class="materialize-textarea" name="ubicacion[]">{{$i->indicio_ubicacion_lugar}}</textarea>
            <label for="ubicacion">UBICACIÓN DEL LUGAR*</label>
          </div>
          <div class="input-field col s12 m12 l5">
            <textarea id="recolectado_de" class="materialize-textarea" name="recolectado_de[]">{{$i->recolectado_de}}</textarea>
            <label for="recolectado_de">RECOLECTADO DE*</label>
          </div>
          <div class="input-field col s6 m6 l2">
            <!--hora de recoleccion-->
            <input id="hora-rec" type="time" class="center-align" name="recoleccion_hora[]" value="{{date('H:i:s',strtotime($i->hora))}}">
            <label class="active" for="hora-rec">HORA DE RECOLECCIÓN*</label>
          </div>
          <div class="input-field col s6 m6 l2">
            <!--fecha de recoleccion-->
            <input id="fecha-rec" type="date" class="center-align" name="recoleccion_fecha[]" value="{{$i->fecha}}">
            <label class="active" for="fecha-rec">FECHA DE RECOLECCIÓN*</label>
          </div>
          <div class="input-field col s12 m6 l2">
            <input id="estado_indicio" type="text" name="estado_indicio[]" value="{{$i->condicion}}">
            <label for="estado_indicio">ESTADO DEL INDICIO</label>
          </div>
          <div class="input-field col s12 m6 l3">
            <textarea id="observacion" class="materialize-textarea" name="observacion[]">{{$i->observacion}}</textarea>
            <label for="observacion">OBSERVACIÓN EN ETIQUETA</label>
          </div>
        @else
          <div class="input-field col s12 m12 l5">
            <textarea id="ubicacion" class="materialize-textarea" name="ubicacion[]">{{$i->indicio_ubicacion_lugar}}</textarea>
            <label for="ubicacion">UBICACIÓN DEL LUGAR*</label>
          </div>
          <div class="input-field col s6 m6 l2">
            <!--hora de recoleccion-->
            <input id="hora-rec" type="time" class="center-align" name="recoleccion_hora[]" value="{{date('H:i:s',strtotime($i->hora))}}">
            <label class="active" for="hora-rec">HORA DE RECOLECCIÓN*</label>
          </div>
          <div class="input-field col s6 m6 l2">
            <!--fecha de recoleccion-->
            <input id="fecha-rec" type="date" class="center-align" name="recoleccion_fecha[]" value="{{$i->fecha}}">
            <label class="active" for="fecha-rec">FECHA DE RECOLECCIÓN*</label>
          </div>
          <div class="input-field col s12 m4 l2">
            <input id="estado_indicio" type="text" name="estado_indicio[]" value="{{$i->condicion}}">
            <label for="estado_indicio">ESTADO DEL INDICIO</label>
          </div>
          <div class="input-field col s12 m8 l9">
            <textarea id="observacion" class="materialize-textarea" name="observacion[]">{{$i->observacion}}</textarea>
            <label for="observacion">OBSERVACIÓN EN ETIQUETA</label>
          </div>
        @endif
          <div class="input-field col s6 m1 l1 center-align">
             <a href="" class="clonar-indicio">
                <i class="fas fa-clone" style="color:orange"></i>
             </a>
          </div>
          <div class="input-field col s6 m1 l1 center-align">
             <a href="" class="x-desc">
                <i class="fas fa-times" style="color:red"></i>
             </a>
          </div>
      </div>
      @endforeach
    </section>


    <!--2 DOCUMENTACIÓN-->
    <blockquote class="center-align" id="blockquote-documentacion">
      <h6><b>2. DOCUMENTACIÓN</b></i></h6>
    </blockquote>
    <div class="row">
      <div class="col s4 m4 l4">
        <p><b>ESCRITO: *</b></p>
      </div>
      <p class="col s4 m4 l4">
        @if ($cadena->escrito == 'si')
        <input name="escrito" type="radio" id="escritoSi" value="si" checked />
        @else
        <input name="escrito" type="radio" id="escritoSi" value="si" />
        @endif
        <label for="escritoSi">SI</label>
      </p>
      <p class="col s4 m4 l4">
        @if ($cadena->escrito == 'no')
        <input name="escrito" type="radio" id="escritoNo" value="no" checked />
        @else
        <input name="escrito" type="radio" id="escritoNo" value="no" />
        @endif
        <label for="escritoNo">NO</label>
      </p>
      <div class="col s4 m4 l4">
        <p><b>FOTOGRÁFICO: *</b></p>
      </div>
      <p class="col s4 m4 l4">
        @if ($cadena->fotografico == 'si')
        <input name="fotografico" type="radio" id="fotograficoSi" value="si" checked />
        @else
        <input name="fotografico" type="radio" id="fotograficoSi" value="si" />
        @endif
        <label for="fotograficoSi">SI</label>
      </p>
      <p class="col s4 m4 l4">
        @if ($cadena->fotografico == 'no')
        <input name="fotografico" type="radio" id="fotograficoNo" value="no" checked />
        @else
        <input name="fotografico" type="radio" id="fotograficoNo" value="no" />
        @endif
        <label for="fotograficoNo">NO</label>
      </p>
      <div class="col s4 m4 l4">
        <p><b>CROQUIS: *</b></p>
      </div>
      <p class="col s4 m4 l4">
        @if ($cadena->croquis == 'si')
        <input name="croquis" type="radio" id="croquisSi" value="si" checked />
        @else
        <input name="croquis" type="radio" id="croquisSi" value="si" />
        @endif
        <label for="croquisSi">SI</label>
      </p>
      <p class="col s4 m4 l4">
        @if ($cadena->croquis == 'no')
        <input name="croquis" type="radio" id="croquisNo" value="no" checked />
        @else
        <input name="croquis" type="radio" id="croquisNo" value="no" />
        @endif
        <label for="croquisNo">NO</label>
      </p>
    </div>
    <div class="row">
      <div class="col s4 m4 l4">
        <p><b>OTRO: *</b></p>
      </div>
      <p class="col s4 m4 l4">
        @if ($cadena->otro == 'si')
        <input name="otro" type="radio" id="otroSi" value="si" checked />
        @else
        <input name="otro" type="radio" id="otroSi" value="si" />
        @endif
        <label for="otroSi">SI</label>
      </p>
      <p class="col s4 m4 l4">
        @if ($cadena->otro == 'no')
        <input name="otro" type="radio" id="otroNo" value="no" checked />
        @else
        <input name="otro" type="radio" id="otroNo" value="no" />
        @endif
        <label for="otroNo">NO</label>
      </p>
      <div class="input-field col s11 m12 l12">
        <input disabled id="especifique" type="text" name="especifique" value="{{$cadena->especifique}}">
        <label for="especifique">Especifique</label>
      </div>
    </div>

    <!--3 RECOLECCIÓN-->
    <blockquote class="center-align">
      <h6><b>3. RECOLECCIÓN</b></h6>
    </blockquote>
    <div class="row">
      <div class="col s2">
        <a href="" id="refresh-recoleccion"  class="tooltipped" data-position="right" data-delay="30" data-tooltip="
  ACTUALIZAR IDENTIFICADORES">
          <i class="fas fa-redo-alt fa-2x"></i>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="input-field col col s12 m6 l6">
        <select multiple id="manual" name="manual[]">
          <option value="" disabled selected>SELECCIONA LOS IDENTIFICADORES</option>
          @foreach ($cadena->indicios as $key => $indicio)
          @if ($indicio->recoleccion === 'manual')
          <option selected value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
          @else
          <option value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
          @endif
          @endforeach
        </select>
        <label>MANUAL</label>
      </div>
      <div class="input-field col s12 m6 l6">
        <select multiple id="instrumental" name="instrumental[]">
          <option value="" disabled selected>SELECCIONA LOS IDENTIFICADORES</option>
          @foreach ($cadena->indicios as $key => $indicio)
          @if ($indicio->recoleccion === 'instrumental')
          <option selected value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
          @else
          <option value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
          @endif
          @endforeach
        </select>
        <label>INSTRUMENTAL</label>
      </div>
    </div>

    <!--4 EMPAQUE/EMBALAJE-->
    <blockquote class="center-align">
      <h6><b>4. EMPAQUE/EMBALAJE</b> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></h6>
    </blockquote>
    <div class="row">
      <div class="input-field col s12 m4 l4">
        <select multiple id="bolsa" name="bolsa[]">
          <option value="" disabled selected>SELECCIONA LOS IDENTIFICADORES</option>
          @foreach ($cadena->indicios as $key => $indicio)
          @if ($indicio->embalaje === 'bolsa')
          <option selected value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
          @else
          <option value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
          @endif
          @endforeach
        </select>
        <label>BOLSA</label>
      </div>
      <div class="input-field col s12 m4 l4">
        <select multiple id="caja" name="caja[]">
          <option value="" disabled selected>SELECCIONA LOS IDENTIFICADORES</option>
          @foreach ($cadena->indicios as $key => $indicio)
          @if ($indicio->embalaje === 'caja')
          <option selected value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
          @else
          <option value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
          @endif
          @endforeach
        </select>
        <label>CAJA</label>
      </div>
      <div class="input-field col s12 m4 l4">
        <select multiple id="recipiente" name="recipiente[]">
          <option value="" disabled selected>SELECCIONA LOS IDENTIFICADORES</option>
          @foreach ($cadena->indicios as $key => $indicio)
          @if ($indicio->embalaje === 'recipiente')
          <option selected value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
          @else
          <option value="{{$indicio->identificador}}">{{$indicio->identificador}}</option>
          @endif
          @endforeach
        </select>
        <label>RECIPIENTE</label>
      </div>
    </div>

    <!--5 SERVIDORES PÚBLICOS-->
    <blockquote class="center-align">
      <h6><b>5. SERVIDORES PÚBLICOS</b> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></h6>
    </blockquote>
    <div class="row">
      <div class="input-field col col s12 m6 l4">
        <input id="input_sp" type="text" autocomplete="off" name="servidor_publico" placeholder="Agregar Servido Público">
        <label for="input_sp"></label>
      </div>

      <div class="input-field col s12 m12 l8">
        <ul id="lista-sp">
        </ul>
      </div>
    </div>

    <section id="section-sp">
      @foreach($cadena->users as $u => $user)
        <div class="row">
          @if($u == 0)
          <h6><b>SERVIDOR PÚBLICO INICIA CADENA</b></h6>
          @else
          <h6><b>SERVIDOR PÚBLICO INTERVIENE EN CADENA</b></h6>
          @endif

          <input type="hidden" name="id_sp[]" value="{{$user->id}}">

          <div class="input-field col s12 m3 l1">
            <input id="folioPersona" type="text" name="folioPersona" value="{{$user->folio}}" disabled>
            <label for="folioPersona">FOLIO</label>
          </div>
          <div class="input-field col s12 m9 l3">
            <input id="nombre" type="text" name="nombre[]" value="{{$user->name}}" disabled>
            <label for="nombre">NOMBRE</label>
          </div>
          <div class="input-field col s12 m6 l2">
            <input id="institucion" type="text" name="institucion[]" value="PGJ" disabled>
            <label for="institucion">INSTITUCIÓN</label>
          </div>
          <div class="input-field col s12 m6 l2">
            <input id="nombre" type="text" name="cargo[]" value="{{$user->cargo->nombre}}" disabled>
            <label for="nombre">CARGO</label>
          </div>
          <div class="input-field col s12 m12 l3">
            <input id="etapa" type="text" name="etapa[]" value="{{$user->pivot->etapa}}">
            <label for="etapa">ETAPA *</label>
          </div>
          @if($u != 0)
            <div class="input-field col s12 m1 l1 center-align">
               <a href="" id="x-sp">
                  <i class="fas fa-times" style="color:red"></i>
               </a>
            </div>
            @endif
        </div>
        @endforeach
    </section>



    <!--6. Traslado-->
    <blockquote class="center-align" id="blockquote-traslado">
      <h6><b>6. TRASLADO</b></h6>
    </blockquote>
    <div class="row">
      <div class="col s12 m3 l3">
        <p><b>VÍA: *</b></p>
      </div>
      <p class="col s12 m3 l3">
        @if ($cadena->traslado === 'terrestre')
        <input name="traslado" type="radio" id="terrestre" value="terrestre" checked />
        @else
        <input name="traslado" type="radio" id="terrestre" value="terrestre" />
        @endif
        <label for="terrestre">TERRESTRE</label>
      </p>
      <p class="col s12 m3 l3">
        @if ($cadena->traslado === 'area')
        <input name="traslado" type="radio" id="aerea" value="aerea" checked />
        @else
        <input name="traslado" type="radio" id="aerea" value="aerea" />
        @endif
        <label for="aerea">AÉREA</label>
      </p>
      <p class="col s12 m3 l3">
        @if ($cadena->traslado === 'maritima')
        <input name="traslado" type="radio" id="maritima" value="maritima" checked />
        @else
        <input name="traslado" type="radio" id="maritima" value="maritima" />
        @endif
        <label for="maritima">MARÍTIMA</label>
      </p>
    </div>
    <div class="row">
      <div class="col s12 m12 l12">
        <p><b>SE REQIEREN CONDICIONES ESPECIALES PARA SU TRASLADO: *</b></p>
      </div>
      <p class="col s6 m6 l1 offset-l3">
        @if ($cadena->trasladoCondiciones === 'si')
        <input name="trasladoCondiciones" type="radio" id="condicionesSi" value="si" checked />
        @else
        <input name="trasladoCondiciones" type="radio" id="condicionesSi" value="si" />
        @endif
        <label for="condicionesSi">SI</label>
      </p>
      <p class="col s6 m6 l1 offset-l2">
        @if ($cadena->trasladoCondiciones === 'no')
        <input name="trasladoCondiciones" type="radio" id="condicionesNo" value="no" checked />
        @else
        <input name="trasladoCondiciones" type="radio" id="condicionesNo" value="no" />
        @endif
        <label for="condicionesNo">NO</label>
      </p>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="recomendaciones" disabled="true" type="text" name="trasladoRecomendaciones">
        <label for="recomendaciones">RECOMENDACIONES</label>
      </div>
    </div>

    <!--Anexo 4-->
    <blockquote class="center-align">
      <h6><b>ANEXO 4</b></h6>
    </blockquote>
    <div class="row">
      <div class="input-field col s12">
        <p><b>SEÑALE LAS CONDICIONES EN LAS QUE SE ENCUENTRAN LOS EMBALAJES. CUANDO ALGUNO DE ELLOS PRESENTE ALTERACIÓN, DETERIORO O CUALQUIER OTRA ANOMALÍA, ESPECIFIQUE DICHA CONDICIÓN *</b></p>
        <textarea id="embalaje" class="materialize-textarea" name="embalaje">{{$cadena->embalaje}}</textarea>
        <label for="embalaje"></label>
      </div>
    </div>

    <div class="row" id="botones">
      <div class="fixed-action-btn">
        <button class="btn waves-effect waves-light" id="btn-editar" type="submit" id="btn-editar" data-id="{{$cadena->id}}" name="action">
          Editar
        </button>
      </div>
    </div>



  </form>
</div>
@endsection

@section('js')

  <!-- 1 IDENTIDAD -->
  @if(Auth::user()->unidad_id == 1 )
    <script src="{{asset('js/cadenas/1_identidad_genetica.js')}}"></script>
  @else
    <script src="{{asset('js/cadenas/1_identidad.js')}}"></script>
  @endif
  <!-- 2 DOCUMENTACIÓN -->
  <script src="{{asset('js/cadenas/2_documentacion.js')}}"></script>
  <!-- 3 RECOLECCIÓN -->
  <script src="{{asset('js/cadenas/3_recoleccion.js')}}"></script>
  <!-- 5 SERVIDORES PÚBLICOS -->
  <script src="{{asset('js/cadenas/5_servidores_publicos.js')}}"></script>
  <!-- 5 TRASLADO -->
  <script src="{{asset('js/cadenas/6_traslado.js')}}"></script>
  <!--Registro Cadena Custodia-->
  <script src="{{asset('js/cadenas/cadena_editar.js')}}"></script>

@endsection
