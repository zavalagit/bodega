@extends('plantilla.template')

@section('seccion', 'EDITAR PETICIÓN')

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
    <form class="col s12" id="form-peticion-editar" autocomplete="off">
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
        <input type="hidden" id="" name="peticion_id" value="{{$peticion->id}}">

        <!--1ra etapa-->
        @include('peticiones.datos_peticion')
        <!--2da etapa-->
        @if ($peticion->estado === 'atendida' || $peticion->estado === 'entregada')
            @include('peticiones.datos_elaboracion')
        @endif
        <!--3ra etapa-->        
        @if($peticion->estado === 'entregada')
            @include('peticiones.datos_entrega')
        @endif

        <div class="row">
            <div class="col s12">
                <button class="btn-peticion-editar btn-100" type="submit">EDITAR</button>
            </div>
        </div>
    </form>
        
</div>
@endsection

@section('js')

<script src="{{asset('js/peticiones/peticion_editar.js')}}"></script>
<script src="{{asset('js/peticiones/petadscripcion.js')}}"></script>
<script src="{{asset('js/peticiones/peticion_especialidad.js')}}"></script>
<script src="{{asset('js/peticiones/solicitudes.js')}}"></script>
<script src="{{asset('js/peticiones/peticion_necropsia.js')}}"></script>

  <script type="text/javascript">
    $('.li-consultar-cadena').removeClass('active');
    $('.li-registrar-cadena').addClass('active');
  </script>
@endsection
