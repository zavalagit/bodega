@extends('plantilla.template')

{{--item menu selected--}}
@section('nombre_pagina','vista-peticion-registrar')
@section('nombre_submenu','submenu-peticiones')

@section('seccion')
    @if ($bandera === 'registrar')
        REGISTRAR PETICIÓN
    @elseif($bandera === 'continuar')
        CONTINUAR REGISTRO
    @elseif($bandera === 'clonar')    
        CLONAR PETICIÓN
    @endif
@endsection

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
    <span id="accion" data-accion="{{$bandera}}"></span>

<!--
<div class="row">
    <div class="col s12 m12 l6">
        <h1>Reglamento de la Ley Orgánica (De las páginas 3-7 está la estructura de las Fiscalías y áreas de Adscripción)</h1>
    </div>
    <div class="col s12 m12 l6">
        <a href="{{asset('/documentos/reglamento_ley_organica')}}"><i class="fas fa-file-alt"></i></a>
    </div>
</div>
-->

{{-- <span id="peticion-datos" data-peticion-accion="{{$bandera}}" data-peticion-estado="{{$peticion->estado}}" data-peticion-solicitud="{{$peticion->solicitud_id}}"></span> --}}
@isset($peticion)
<span id="peticion-datos" data-peticion=@json($peticion) data-fecha-hoy="{{$fecha_hoy}}"></span>
@endisset


<div class="row">
    <form class="col s12" id="form-peticion-registrar" autocomplete="off">
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

            @if ( $bandera == 'continuar' )
                <input type="hidden" id="" name="peticion_id" value="{{$peticion->id}}">
            @endif


        {{-- @if ( (Auth::user()->fiscalia_id == 4) && (Auth::user()->unidad_id != 3) )
            @if ( ($bandera == 'registrar') )
                <p>
                    <input type="checkbox" class="filled-in" id="filled-in-box" name="peticion_antigua" />
                    <label for="filled-in-box"><span style="background-color:red; color:white; font-size:18px; padding:4px; border-radius:20px;">Seleccionar solo si se va a registrar una Petición que ya se reportó o se dio por enterado a fecha anterior a hoy ({{$fecha_hoy}})</span></label>
                </p>
                <p style="color:#152f4a; padding-left:30px !important; font-weight: bold;">
                    {{-- <i style="color:#152f4a;" class="fas fa-square"></i> <span style="color:#c09f77;">Seleccione para registrar una Petición si pertenece alguno de los siguientes meses: Enero, Febrero, Marzo y Abril del presente año 2020 <br> --}}
                    {{-- <i style="color:#152f4a;" class="fas fa-square"></i> <span style="">Seleccione para registrar una Petición si usted ya había reportado en los días del 10 al 14 de Julio del presente año 2020
                </p>
            @elseif( ($bandera == 'continuar') && ($peticion->estado == 'pendiente') )
                <p>
                    <input type="checkbox" class="filled-in" id="filled-in-box" name="peticion_antigua" />
                    <label for="filled-in-box"><span style="background-color:red; color:white; font-size:18px; padding:4px; border-radius:20px;">Seleccionar solo si el <span style="color:blue;">"documento emitido"</span> se reportó en los dias del 10 al 14 de julio)</span></label>
                </p>
                <p style="color:#152f4a; padding-left:30px !important; font-weight: bold;">
                    {{-- <i style="color:#152f4a;" class="fas fa-square"></i> <span style="color:#c09f77;">Seleccione si la fecha de elaboración pertenece a alguno de los siguientes meses: Enero, Febrero, Marzo y Abril del presente año 2020 <br> --}}
                    {{-- <i style="color:#152f4a;" class="fas fa-square"></i> <span style="">Seleccione si la fecha de elaboración pertenece a los días del 10 al 14 de Julio del presente año 2020</span>
                </p>
            @endif
        @endif --}}

		{{--
            @if ( (Auth::user()->fiscalia_id == 4) && (Auth::user()->unidad_id == 1) )
            @if ( ($bandera == 'registrar') || ($bandera == 'continuar') )
                <p>
                    <input type="checkbox" class="filled-in" id="filled-in-box" name="peticion_antigua" />
                    <label for="filled-in-box"><span style="background-color:red; color:white; font-size:18px; padding:4px; border-radius:20px;">(Solo Genética) Seleccionar solo si se va a registrar una Solicitud con fecha anterior al mes o año actual</span></label>
                </p>
            @endif
        @endif
		--}}
            <!--1ra etapa-->
            @include('peticiones.datos_peticion')
            <!--2da etapa-->
            @include('peticiones.datos_elaboracion')
            <!--3ra etapa-->
            @include('peticiones.datos_entrega')
      


        <div class="row">
            <div class="col s12">
                <button class="btn-peticion-guardar btn-100" type="submit">GUARDAR</button>
            </div>
        </div>
    </form>
        
</div>



<!--Modal Servidor Público-->
<div id="modal-sp" class="modal">
    <div class="modal-content modal-contenido-sp">
       <h4>Modal Header</h4>
       <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
       <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
 </div>
@endsection

@section('js')

{{--
@if ( (Auth::user()->unidad_id == 1) && (Auth::user()->fiscalia_id == 4) )
<script src="{{asset('js/peticiones/peticion_registrar_quimica.js')}}"></script>
@else
<script src="{{asset('js/peticiones/peticion_registrar.js')}}"></script>
@endif
--}}
<script src="{{asset('js/peticiones/peticion_registrar.js')}}"></script>

<script src="{{asset('js/peticiones/petadscripcion.js')}}"></script>
<script src="{{asset('js/peticiones/peticion_especialidad.js')}}"></script>
<script src="{{asset('js/peticiones/solicitudes.js')}}"></script>
<script src="{{asset('js/peticiones/peticion_necropsia.js')}}"></script>
<script src="{{asset('js/peticiones/peticion_necropsia_dictamen.js')}}"></script>
<script src="{{asset('js/peticiones/peticion_necropsia_fecha.js')}}"></script>
<script src="{{asset('js/servidores_publicos/servidor_publico_agregar.js')}}"></script>

@isset($peticion)
<script src="{{asset('js/peticiones/peticion_etapas.js')}}"></script>
@endisset

  <script type="text/javascript">
    $('.li-consultar-cadena').removeClass('active');
    $('.li-registrar-cadena').addClass('active');
  </script>
@endsection
