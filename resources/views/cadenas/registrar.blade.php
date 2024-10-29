@extends('plantilla.template')

{{--item menu selected--}}
@section('nombre_pagina','vista-cadena-registrar')
@section('nombre_submenu','submenu-cadenas')

@section('seccion', 'REGISTRO CADENA DE CUSTODIA')

@section('titulo','REGISTRAR-CADENA')

@section('css')
<link rel="stylesheet" href="{{asset('css/cadenas/registrar.css')}}">
@endsection

@section('contenido')

<div class="row">
  <form class="col s12" id="form-registrar-cadena" autocomplete="off">
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

    <div class="row">
      <div class="input-field col s12 m6 l4">
        <input type="text" name="nuc" value="1003">
        <label for="nuc">NUC*</label>
      </div>
      <div class="input-field col s12 m6 l4">
        <select name="unidad">
          <option value="" disabled selected></option>
          @foreach ($unidades as $unidad)
          <option value="{{$unidad->id}}">{{$unidad->nombre}}</option>
          @endforeach
        </select>
        <label>UNIDAD ADMINISTRATIVA*</label>
      </div>
      <div class="input-field col s12 m4 l4">
        <input id="folio" type="text" name="folio">
        <label for="folio">FOLIO</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12 m4 l4">
        <textarea id="lugarIntervencion" class="materialize-textarea" name="intervencion_lugar"></textarea>
        <label for="lugarIntervencion">LUGAR DE INTERVENCIÓN*</label>
      </div>
      <div class="input-field col s6 m4 l4">
        <input id="intervencion_hora" type="time" class="center-align" name="intervencion_hora">
        <label class="active" for="horaIntervencion">HORA DE INTERVENCIÓN*</label>
      </div>
      <div class="input-field col s6 m4 l4">
        <input id="intervencion_fecha" type="date" class="center-align" name="intervencion_fecha">
        <label class="active" for="fechaIntervencion">FECHA DE INTERVENCION*</label>
      </div>
    </div>

    <div class="row">
      <div class="col s3">
        <p><b>MOTIVO DEL REGISTRO*</b></p>
      </div>
      <p class="col s8 m4 l3">
        <input name="motivo" type="radio" id="localizacion" value="localizacion" />
        <label for="localizacion">LOCALIZACIÓN</label>
      </p>
      <p class="col s8 m4 l3">
        <input name="motivo" type="radio" id="descubrimiento" value="descubrimiento" />
        <label for="descubrimiento">DESCUBRIMIENTO</label>
      </p>
      <p class="col s8 offset-s3 m4 l3">
        <input name="motivo" type="radio" id="aportacion" value="aportacion" />
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
      <div class="row div-indicio">
        <hr>
        <div class="input-field col s12 m3 l2">
          <input id="identificador" type="text" class="center-align" name="identificador[]">
          <label for="identificador">IDENTIFICADOR*</label>
        </div>
        <div class="input-field col s12 m9 l9">
          <textarea id="descripcion" class="materialize-textarea" name="descripcion[]"></textarea>
          <label for="descripcion">DESCRIPCIÓN*</label>
        </div>
        @if(Auth::user()->unidad_id == 1)
          <div class="input-field col s12 m12 l6">
            <textarea id="ubicacion" class="materialize-textarea" name="ubicacion[]"></textarea>
            <label for="ubicacion">UBICACIÓN DEL LUGAR*</label>
          </div>
          <div class="input-field col s12 m12 l5">
            <textarea id="recolectado_de" class="materialize-textarea" name="recolectado_de[]"></textarea>
            <label for="recolectado_de">RECOLECTADO DE*</label>
          </div>
          <div class="input-field col s6 m6 l2">
            <!--hora de recoleccion-->
            <input id="hora-rec" type="time" class="center-align" name="recoleccion_hora[]">
            <label class="active" for="hora-rec">HORA DE RECOLECCIÓN*</label>
          </div>
          <div class="input-field col s6 m6 l2">
            <!--fecha de recoleccion-->
            <input id="fecha-rec" type="date" class="center-align" name="recoleccion_fecha[]">
            <label class="active" for="fecha-rec">FECHA DE RECOLECCIÓN*</label>
          </div>
          <div class="input-field col s12 m6 l2">
            <input id="estado_indicio" type="text" name="estado_indicio[]">
            <label for="estado_indicio">ESTADO DEL INDICIO</label>
          </div>
          <div class="input-field col s12 m6 l3">
            <textarea id="observacion" class="materialize-textarea" name="observacion[]"></textarea>
            <label for="observacion">OBSERVACIÓN EN ETIQUETA</label>
          </div>
          @else
          <div class="input-field col s12 m12 l5">
            <textarea id="ubicacion" class="materialize-textarea" name="ubicacion[]"></textarea>
            <label for="ubicacion">UBICACIÓN DEL LUGAR*</label>
          </div>
          <div class="input-field col s6 m6 l2">
            <!--hora de recoleccion-->
            <input id="hora-rec" type="time" class="center-align" name="recoleccion_hora[]">
            <label class="active" for="hora-rec">HORA DE RECOLECCIÓN*</label>
          </div>
          <div class="input-field col s6 m6 l2">
            <!--fecha de recoleccion-->
            <input id="fecha-rec" type="date" class="center-align" name="recoleccion_fecha[]">
            <label class="active" for="fecha-rec">FECHA DE RECOLECCIÓN*</label>
          </div>
          <div class="input-field col s12 m4 l2">
            <input id="estado_indicio" type="text" name="estado_indicio[]">
            <label for="estado_indicio">ESTADO DEL INDICIO</label>
          </div>
          <div class="input-field col s12 m8 l9">
            <textarea id="observacion" class="materialize-textarea" name="observacion[]"></textarea>
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
        <input name="escrito" type="radio" id="escritoSi" value="si" />
        <label for="escritoSi">SI</label>
      </p>
      <p class="col s4 m4 l4">
        <input name="escrito" type="radio" id="escritoNo" value="no" />
        <label for="escritoNo">NO</label>
      </p>
      <div class="col s4 m4 l4">
        <p><b>FOTOGRÁFICO: *</b></p>
      </div>
      <p class="col s4 m4 l4">
        <input name="fotografico" type="radio" id="fotograficoSi" value="si" />
        <label for="fotograficoSi">SI</label>
      </p>
      <p class="col s4 m4 l4">
        <input name="fotografico" type="radio" id="fotograficoNo" value="no" />
        <label for="fotograficoNo">NO</label>
      </p>
      <div class="col s4 m4 l4">
        <p><b>CROQUIS: *</b></p>
      </div>
      <p class="col s4 m4 l4">
        <input name="croquis" type="radio" id="croquisSi" value="si" />
        <label for="croquisSi">SI</label>
      </p>
      <p class="col s4 m4 l4">
        <input name="croquis" type="radio" id="croquisNo" value="no" />
        <label for="croquisNo">NO</label>
      </p>
    </div>
    <div class="row">
      <div class="col s4 m4 l4">
        <p><b>OTRO: *</b></p>
      </div>
      <p class="col s4 m4 l4">
        <input name="otro" type="radio" id="otroSi" value="si" />
        <label for="otroSi">SI</label>
      </p>
      <p class=" col s4 m4 l4">
        <input name="otro" type="radio" id="otroNo" value="no" />
        <label for="otroNo">NO</label>
      </p>
      <div class="input-field col s11 m12 l12">
        <input disabled id="especifique" type="text" name="especifique">
        <label for="especifique">ESPECIFIQUE</label>
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
      <div class="input-field col s12 m6 l6">
        <select multiple id="manual" name="manual[]">
          <option disabled selected>SELECCIONA LOS IDENTIFICADORES</option>
        </select>
        <label>MANUAL</label>
      </div>
      <div class="input-field col s12 m6 l6">
        <select multiple id="instrumental" name="instrumental[]">
          <option disabled selected>SELECCIONA LOS IDENTIFICADORES</option>
        </select>
        <label>INSTRUMENTAL</label>
      </div>
    </div>

    <!--4 EMPAQUE/EMBALAJE-->
    <blockquote class="center-align">
      <h6><b>4. EMPAQUE/EMBALAJE</b></h6>
    </blockquote>
    <div class="row">
      <div class="input-field col s12 m4 l4">
        <select multiple id="bolsa" name="bolsa[]">
          <option value="" disabled selected>SELECCIONA LOS IDENTIFICADORES</option>
        </select>
        <label>BOLSA</label>
      </div>
      <div class="input-field col s12 m4 l4">
        <select multiple id="caja" name="caja[]">
          <option value="" disabled selected>SELECCIONA LOS IDENTIFICADORES</option>
        </select>
        <label>CAJA</label>
      </div>
      <div class="input-field col s12 m4 l4">
        <select multiple id="recipiente" name="recipiente[]">
          <option value="" disabled selected>SELECCIONA LOS IDENTIFICADORES</option>
        </select>
        <label>RECIPIENTE</label>
      </div>
    </div>

    <!--5 SERVIDORES PÚBLICOS-->
    <blockquote class="center-align">
      <h6><b>5. SERVIDORES PÚBLICOS</b></h6>
    </blockquote>
    <div class="row">
      <div class="input-field col s12 m6 l4">
        <input id="input_sp" type="text" autocomplete="off" name="servidor_publico" placeholder="Agregar Servido Público">
        <label for="input_sp"></label>
      </div>

      <div class="input-field col s12 m12 l8">
        <ul id="lista-sp">
        </ul>
      </div>
    </div>

    <section id="section-sp">
      <div class="row">
        <h6><b>SERVIDOR PÚBLICO INICIA CADENA</b></h6>

        <input type="hidden" id="" name="id_perito" value="{{Auth::user()->id}}">
        <input type="hidden" id="" name="id_sp[]" value="{{Auth::user()->id}}">

        <div class="input-field col s12 m3 l1">
          <input id="folioPersona" type="text" disabled name="folioPersona" value="{{Auth::user()->folio}}">
          <label for="folioPersona">FOLIO</label>
        </div>
        <div class="input-field col s12 m9 l3">
          <input id="nombre" type="text" disabled name="nombre[]" value="{{Auth::user()->name}}">
          <label for="nombre">NOMBRE</label>
        </div>
        <div class="input-field col s12 m6 l2">
          <input id="institucion" type="text" disabled name="institucion[]" value="PGJ">
          <label for="institucion">INSTITUCIÓN</label>
        </div>
        <div class="input-field col s12 m6 l2">
          <input id="nombre" type="text" disabled name="cargo[]" value="{{Auth::user()->cargo->nombre}}">
          <label for="nombre">CARGO</label>
        </div>
        <div class="input-field col s12 m12 l3">
          <input id="etapa" type="text" name="etapa[]">
          <label for="etapa">ETAPA *</label>
        </div>
      </div>
    </section>

    <!--6 TRASLADO-->
    <blockquote class="center-align" id="blockquote-traslado">
      <h6><b>6. TRASLADO</b></h6>
    </blockquote>
    <div class="row">
      <div class="col s12 m3 l3">
        <p><b>VÍA: *</b></p>
      </div>
      <p class="col s12 m3 l3">
        <input name="traslado" type="radio" id="terrestre" value="terrestre" />
        <label for="terrestre">TERRESTRE</label>
      </p>
      <p class="col s12 m3 l3">
        <input name="traslado" type="radio" id="aerea" value="aerea" />
        <label for="aerea">AÉREA</label>
      </p>
      <p class="col s12 m3 l3">
        <input name="traslado" type="radio" id="maritima" value="maritima" />
        <label for="maritima">MARÍTIMA</label>
      </p>
    </div>
    <div class="row">
      <div class="col s12 m12 l12">
        <p><b>SE REQIEREN CONDICIONES ESPECIALES PARA SU TRASLADO: *</b></p>
      </div>
      <p class="col s6 m6 l1 offset-l3">
        <input name="trasladoCondiciones" type="radio" id="condicionesSi" value="si" />
        <label for="condicionesSi">SI</label>
      </p>
      <p class="col s6 m6 l1 offset-l2">
        <input name="trasladoCondiciones" type="radio" id="condicionesNo" value="no" />
        <label for="condicionesNo">NO</label>
      </p>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="recomendaciones" disabled="true" type="text" name="trasladoRecomendaciones">
        <label for="recomendaciones">RECOMENDACIONES</label>
      </div>
    </div>


    <!--ANEXO 4-->
    <blockquote class="center-align">
      <h6><b>ANEXO 4</b></h6>
    </blockquote>
    <div class="row">
      <div class="input-field col s12">
        <p><b>SEÑALE LAS CONDICIONES EN LAS QUE SE ENCUENTRAN LOS EMBALAJES. CUANDO ALGUNO DE ELLOS PRESENTE ALTERACIÓN, DETERIORO O CUALQUIER OTRA ANOMALÍA, ESPECIFIQUE DICHA CONDICIÓN *</b></p>
        <textarea id="embalaje" class="materialize-textarea" name="embalaje"></textarea>
        <label for="embalaje"></label>
      </div>
    </div>


    <div class="row">
      <div class="col s2 offset-s3 m2 offset-m4 l2 offset-l10">
        <button class="btn waves-effect waves-light" type="submit" id="btn-registrar-cadena" name="action">
          Registrar
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
  <!--Fecha actual para los formularios type date-->
  <script src="{{asset('js/fecha_actual.js')}}"></script>
  <!--Registro Cadena Custodia-->
  <script src="{{asset('js/cadenas/cadena_registrar.js')}}"></script>

  <script type="text/javascript">
    $('.li-consultar-cadena').removeClass('active');
    $('.li-registrar-cadena').addClass('active');
  </script>
@endsection
