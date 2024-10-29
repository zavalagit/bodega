@extends('cadenas.plantilla')

@section('seccion', 'REGISTRO DE PETICIÓN')

@section('titulo','REGISTRAR-CADENA')

@section('css')
<link rel="stylesheet" href="{{asset('css/cadenas/registrar.css')}}">

<style>
    .btn-100{
        width: 100%;
        border: 0px;
        font-weight: bold;
        background-color: #c6c6c6;
    }
    .btn-100:hover{
        background-color: #c09f77;
    }
</style>
@endsection

@section('contenido')

<div class="row">
    <form class="col s12" id="form-peticion-registrar" autocomplete="off">
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
        
        @isset($peticion)
            <input type="hidden" name="peticion_id" value="{{$peticion->id}}">
            <!--1ra etapa-->
            <div class="row">
                <div class="col s12">
                    <blockquote>1.- Datos de la Petición</blockquote>
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="nuc" type="text" name="nuc" value="{{$peticion->nuc}}">
                    <label for="nuc">N.U.C.*</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <select id="fiscalia-select" name="fiscalia">
                        <option value="" disabled>SELECCIONA LA FISCAÍA A LA QUE PERTENECE LA PETICIÓN</option>
                        @foreach ($fiscalias as $fiscalia)
                            @if ($peticion->fiscalia_id == $fiscalia->id)
                                <option selected value="{{$fiscalia->id}}">{{$fiscalia->nombre}}</option>
                            @else
                                <option value="{{$fiscalia->id}}">{{$fiscalia->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label>FISCALÍA A LA QUE  PERTENECE LA PETICIÓN</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="fecha_peticion" type="date" class="center-align" name="fecha_peticion" value="{{$peticion->fecha_peticion}}">
                    <label class="active" for="fecha_peticion">FECHA DE PETICIÓN*</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="oficio_numero" type="text" name="oficio_numero" value="{{$peticion->oficio_numero}}">
                    <label for="oficio_numero">NO. OFICIO*</label>
                </div>
                <div class="input-field col s12 m12 l4">
                    <input id="sp_solicita" type="text" name="sp_solicita" value="{{$peticion->sp_solicita}}">
                    <label for="sp_solicita">M. P. o Servidor Público Solicita*</label>
                </div>

                <div class="input-field col s12 m12 l4">
                    <select id="petfiscalia-select" name="petfiscalia">
                        <option value="" disabled>SELECCIONA LUGAR DE ADSCRIPCIÓN DEL SERVIDOR PÚBLICO</option>
                        @foreach ($petfiscalias as $petfiscalia)
                            @if ($peticion->petfiscalia_id == $petfiscalia->id)
                                <option selected value="{{$petfiscalia->id}}">{{$petfiscalia->nombre}}</option>
                            @else
                                <option value="{{$petfiscalia->id}}">{{$petfiscalia->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label>FISCALÍA DEL M.P. O SERVIDOR PÚBLICO</label>
                </div>
                <div class="input-field col s12 m12 l4">
                    <select id="petadscripcion-select" name="petadscripcion">
                        @foreach ($peticion->petfiscalia->petadscripciones as $petadscripcion)
                            @if ($peticion->petadscripcion_id == $petadscripcion->id)
                                <option selected value="{{$petadscripcion->id}}">{{$petadscripcion->nombre}}</option>
                            @else
                                <option value="{{$petadscripcion->id}}">{{$petadscripcion->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label>LUGAR DE ADSCRIPCIÓN DEL M.P. O SERVIDOR PÚBLICO</label>
                </div>
            </div>
            <!--2da etapa-->
            @if ($peticion->estado === 'pendiente')
                <div class="row">
                    <div class="col s12">
                        <blockquote>2.- Datos de la elaboración de la Petición</blockquote>
                    </div>
                    <div class="input-field col s12 m12 l12">
                        <input id="fecha_elaboracion" type="date" class="center-align" name="fecha_elaboracion">
                        <label class="active" for="fecha_elaboracion">FECHA DE ELABORACIÓN</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l2">
                        <p><b>TIPO DE ESTUDIO</b></p>
                    </div>
                    <p class="col s12 m4 l2">
                        <input name="documento_emitido" type="radio" id="dictamen" value="dictamen" />
                        <label for="dictamen">DICTAMEN</label>
                    </p>
                    <p class="col s12 m4 l2">
                        <input name="documento_emitido" type="radio" id="informe" value="informe" />
                        <label for="informe">INFORME</label>
                    </p>
                    <p class="col s12 m4 l2">
                        <input name="documento_emitido" type="radio" id="certificado" value="certificado" />
                        <label for="certificado">CERTIFICADO</label>
                    </p>
                    <p class="col s12 m4 l2">
                        <input name="documento_emitido" type="radio" id="salida_juzgado" value="salida_juzgado" />
                        <label for="salida_juzgado">SALIDA A JUZGADO</label>
                    </p>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <select id="especialidad-select" name="especialidad">
                            <option value="" selected>SELECCIONA LA ESPECIALIDAD</option>
                            @foreach ($especialidades as $especialidad)
                                <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                            @endforeach
                        </select>
                        <label>ESPECIALIDAD</label>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <select id="solicitud-select" name="solicitud">
                            
                        </select>
                        <label>SOLICITUD</label>
                    </div>
                </div>
            @elseif($peticion->estado === 'atendida')
                <div class="row">
                    <div class="col s12">
                        <blockquote>2.- Datos de la elaboración de la Petición</blockquote>
                    </div>
                    <div class="input-field col s12 m12 l12">
                        <input id="fecha_elaboracion" type="date" class="center-align" name="fecha_elaboracion" value="{{$peticion->fecha_elaboracion}}">
                        <label class="active" for="fecha_elaboracion">FECHA DE ELABORACIÓN</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l2">
                        <p><b>DOCUMENTO EMITIDO</b></p>
                    </div>
                    <p class="col s12 m4 l2">
                        @if ($peticion->documento_emitido === 'dictamen')
                            <input name="documento_emitido" type="radio" id="dictamen" value="dictamen" checked/>
                        @else
                            <input name="documento_emitido" type="radio" id="dictamen" value="dictamen"/>
                        @endif
                        <label for="dictamen">DICTAMEN</label>
                    </p>
                    <p class="col s12 m4 l2">
                        @if ($peticion->documento_emitido === 'informe')
                            <input name="documento_emitido" type="radio" id="informe" value="informe" checked/>
                        @else
                            <input name="documento_emitido" type="radio" id="informe" value="informe"/>
                        @endif
                        <label for="informe">INFORME</label>
                    </p>
                    <p class="col s12 m4 l2">
                        @if ($peticion->documento_emitido === 'certificado')
                            <input name="documento_emitido" type="radio" id="certificado" value="certificado" checked/>
                        @else
                            <input name="documento_emitido" type="radio" id="certificado" value="certificado"/>
                        @endif
                        <label for="certificado">CERTIFICADO</label>
                    </p>
                    <p class="col s12 m4 l2">
                        @if ($peticion->documento_emitido === 'salida_juzgado')
                            <input name="documento_emitido" type="radio" id="salida_juzgado" value="salida_juzgado" checked/>
                        @else
                            <input name="documento_emitido" type="radio" id="salida_juzgado" value="salida_juzgado"/>
                        @endif
                        <label for="salida_juzgado">SALIDA A JUZGADO</label>
                    </p>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <select name="especialidad">
                            @foreach ($especialidades as $especialidad)
                                @if ($peticion->especialidad_id == $especialidad->id)
                                    <option selected value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                                @else
                                    <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                        <label>ESPECIALIDAD</label>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <select name="solicitud">
                            @foreach ($solicitudes as $solicitud)
                                @if ($peticion->solicitud_id == $solicitud->id)
                                    <option selected value="{{$solicitud->id}}">{{$solicitud->nombre}}</option>
                                @else
                                    <option value="{{$solicitud->id}}">{{$solicitud->nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                        <label>SOLICITUD</label>
                    </div>
                </div>
            @endif
            <!--3ra etapa-->
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

            
        @endisset

        @empty($peticion)
            <!--1ra etapa-->
            <div class="row">
                <div class="col s12">
                    <blockquote>1.- Datos de la Petición</blockquote>
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="nuc" type="text" name="nuc">
                    <label for="nuc">N.U.C.*</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <select id="fiscalia-select" name="fiscalia">
                        <option value="" disabled>SELECCIONA LA FISCAÍA A LA QUE PERTENECE LA PETICIÓN</option>
                        @foreach ($fiscalias as $fiscalia)
                            @if (Auth::user()->fiscalia->id === $fiscalia->id)
                                <option selected value="{{$fiscalia->id}}">{{$fiscalia->nombre}}</option>
                            @else
                                <option value="{{$fiscalia->id}}">{{$fiscalia->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label>FISCALÍA A LA QUE  PERTENECE LA PETICIÓN</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="fecha_peticion" type="date" class="center-align" name="fecha_peticion">
                    <label class="active" for="fecha_peticion">FECHA DE PETICIÓN*</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <input id="oficio_numero" type="text" name="oficio_numero">
                    <label for="oficio_numero">NO. OFICIO*</label>
                </div>
                <div class="input-field col s12 m12 l4">
                    <input id="sp_solicita" type="text" name="sp_solicita">
                    <label for="sp_solicita">M. P. o Servidor Público Solicita*</label>
                </div>
                <div class="input-field col s12 m12 l4">
                    <select id="petfiscalia-select" name="petfiscalia">
                        <option value="" disabled>SELECCIONA LUGAR DE ADSCRIPCIÓN DEL SERVIDOR PÚBLICO</option>
                        @foreach ($petfiscalias as $petfiscalia)
                            @if ($petfiscalia->fiscalia->id === Auth::user()->fiscalia->id)
                                <option selected value="{{$petfiscalia->id}}">{{$petfiscalia->nombre}}</option>
                            @else
                                <option value="{{$petfiscalia->id}}">{{$petfiscalia->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label>FISCALÍA DEL M.P. O SERVIDOR PÚBLICO</label>
                </div>
                <div class="input-field col s12 m12 l4">
                    <select id="petadscripcion-select" name="petadscripcion">
                        <!-- -->
                    </select>
                    <label>LUGAR DE ADSCRIPCIÓN DEL M.P. O SERVIDOR PÚBLICO</label>
                </div>
            </div>
            <!--2da etapa-->
            <div class="row">
                <div class="col s12">
                    <blockquote>2.- Datos de la elaboración de la Petición</blockquote>
                </div>
                <div class="input-field col s12 m12 l12">
                    <input id="fecha_elaboracion" type="date" class="center-align" name="fecha_elaboracion">
                    <label class="active" for="fecha_elaboracion">FECHA DE ELABORACIÓN</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l2">
                    <p><b>DOCUMENTO EMITIDO</b></p>
                </div>
                <p class="col s12 m4 l2">
                    <input name="documento_emitido" type="radio" id="dictamen" value="dictamen" />
                    <label for="dictamen">DICTAMEN</label>
                </p>
                <p class="col s12 m4 l2">
                    <input name="documento_emitido" type="radio" id="informe" value="informe" />
                    <label for="informe">INFORME</label>
                </p>
                <p class="col s12 m4 l2">
                    <input name="documento_emitido" type="radio" id="certificado" value="certificado" />
                    <label for="certificado">CERTIFICADO</label>
                </p>
                <p class="col s12 m4 l2">
                    <input name="documento_emitido" type="radio" id="salida_juzgado" value="salida_juzgado" />
                    <label for="salida_juzgado">SALIDA A JUZGADO</label>
                </p>
            </div>
            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <select id="especialidad-select" name="especialidad">
                        <option value="" selected>SELECCIONA LA ESPECIALIDAD</option>
                        @foreach ($especialidades as $especialidad)
                            <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                        @endforeach
                    </select>
                    <label>ESPECIALIDAD</label>
                </div>
                <div class="input-field col s12 m12 l6">
                    <select id="solicitud-select" name="solicitud">
                        
                    </select>
                    <label>SOLICITUD</label>
                </div>
            </div>
            <!--3ra etapa-->
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


        <div class="row">
            <div class="col s12">
                <button class="btn-peticion-guardar btn-100" type="submit">GUARDAR</button>
            </div>
        </div>
    </form>
        
</div>
@endsection

@section('js')

<script src="{{asset('js/peticiones/peticion_registrar.js')}}"></script>
<script src="{{asset('js/peticiones/petadscripcion.js')}}"></script>
<script src="{{asset('js/peticiones/solicitudes.js')}}"></script>

  <script type="text/javascript">
    $('.li-consultar-cadena').removeClass('active');
    $('.li-registrar-cadena').addClass('active');
  </script>
@endsection
