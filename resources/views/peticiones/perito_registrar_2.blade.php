@extends('peticiones.plantilla_perito')

@section('seccion', 'REGISTRO DE PETICIÓN (Datos de Elaboración)')

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
    <form class="col s12" id="form-peticion-2-registrar" autocomplete="off">
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

        <!--1ra etapa-->
        <div class="row">
            <div class="col s12">
                <blockquote>1.- Datos de la Petición</blockquote>
            </div>
            <div class="input-field col s12 m12 l12">
                <input id="nuc" type="text" name="nuc" value="{{$peticion->nuc}}" disabled>
                <label for="nuc">N.U.C.*</label>
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="fecha_peticion" type="date" class="center-align" name="fecha_peticion" value="{{$peticion->fecha_peticion}}" disabled>
                <label class="active" for="fecha_peticion">FECHA DE PETICIÓN*</label>
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="oficio_numero" type="text" name="oficio_numero" value="{{$peticion->oficio_numero}}" disabled>
                <label for="oficio_numero">NO. OFICIO*</label>
            </div>
            <div class="input-field col s12 m12 l12">
                <input id="sp_solicita" type="text" name="sp_solicita" value="{{$peticion->sp_solicita}}" disabled>
                <label for="sp_solicita">M. P. o Servidor Público recibe*</label>
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
            <div class="col s12 m12 l3">
                <p><b>TIPO DE ESTUDIO</b></p>
            </div>
            <p class="col s12 m4 l3">
                <input name="estudio_tipo" type="radio" id="dictamen" value="dictamen" />
                <label for="dictamen">DICTAMEN</label>
            </p>
            <p class="col s12 m4 l3">
                <input name="estudio_tipo" type="radio" id="informe" value="informe" />
                <label for="informe">INFORME</label>
            </p>
            <p class="col s12 m4 l3">
                <input name="estudio_tipo" type="radio" id="salida_juzgado" value="salida_juzgado" />
                <label for="salida_juzgado">SALIDA A JUZGADO</label>
            </p>
        </div>
        <div class="row">
            <div class="input-field col s12 m12 l6">
                <select name="solicitud">
                    <option value="" disabled selected>SELECCIONA EL TIPO DE SOLICITUD</option>
                    @foreach ($solicitudes as $solicitud)
                        <option value="{{$solicitud->id}}">{{$solicitud->nombre}}</option>
                    @endforeach
                </select>
                <label>SOLICITUD</label>
            </div>
            <div class="input-field col s12 m6 l6">
                <select name="especialidad">
                    <option value="" disabled selected>SELECCIONA LA ESPECIALIDAD</option>
                    @foreach ($especialidades as $especialidad)
                        <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                    @endforeach
                </select>
                <label>ESPECIALIDAD</label>
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

        <div class="row">
            <div class="col s12">
                <button class="btn-peticion-2-guardar btn-100" type="submit">GUARDAR</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('js')

<script src="{{asset('js/peticiones/peticion_registrar.js')}}"></script>

  <script type="text/javascript">
    $('.li-consultar-cadena').removeClass('active');
    $('.li-registrar-cadena').addClass('active');
  </script>
@endsection
