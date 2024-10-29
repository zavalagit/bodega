@extends('cadenas.plantilla')

@section('seccion', 'REGISTRO DE PETICIÓN')

@section('titulo','REGISTRAR-CADENA')

@section('css')
<link rel="stylesheet" href="{{asset('css/cadenas/registrar.css')}}">

<style>
    th{
        padding-left: 10px !important;
        width: 50%;
    }
    td{
        text-align: center;
    }
    .fecha-encabezado{
        margin: 0 !important;
    }
    .fecha-encabezado h5{
        text-align: center;
        background-color: #152f4a;
        color: #c09f77;
        padding-top: 6px;
        padding-bottom: 6px;
    }
</style>
@endsection

@section('contenido')

    <section>
        <form class="col s12">
            <div class="row">
                <div class="input-field col s2">
                    {{--
                    @isset($buscar_fecha)
                    <input type="date" name="buscar_fecha" value="{{$buscar_fecha}}">
                    @endisset
                    @empty($buscar_fecha)
                    --}}
                    <input type="date" name="fecha_inicio" >
                    {{--
                        @endempty
                    --}}
                </div>
                <div class="input-field col s2">
                    {{--
                    @isset($buscar_fecha)
                    <input type="date" name="buscar_fecha" value="{{$buscar_fecha}}">
                    @endisset
                    @empty($buscar_fecha)
                    --}}
                    <input type="date" name="fecha_fin" >
                    {{--
                        @endempty
                    --}}
                </div>
                <div class="input-field col s7">
                    @isset($buscar_texto)
                    <input id="buscar-input" type="text" name="buscar_texto" value="{{$buscar_texto}}">
                    @endisset
                    @empty($buscar_texto)
                    <input id="buscar-input" type="text"
                        placeholder="BUSCAR... (NUC, NÚMERO OFICIO, M. P. SOLICITA O RECIBE)" name="buscar_texto">
                    @endempty
                </div>
                <div class="input-field col s1">
                    <button class="btn waves-effect waves-light" type="submit" name="buscar_btn"
                        value="buscar"><i style="color:#394049;" class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </section>

    <section>
        <div class="row">
            <div class="fecha-encabezado col s12">
                <h5> <b>PETICIONES {{$fecha_encabezado}}</b> </h5>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col s12">
            <table>
                <caption><b>PETICIONES</b></caption>
                <tbody>
                    <tr>
                        <th>RECIBIDAS</th>
                        <td>{{$recibidas->count()}}</td>
                    </tr>
                    <tr>
                        <th>ATENDIDAS</th>
                        <td>{{$atendidas->count()}}</td>
                    </tr>
                    <tr>
                        <th>PENDIENTES</th>
                        <td>{{$pendientes->count()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col s12">
            <table>
                <caption> <b>DOCUMENTO EMITIDO</b> </caption>
                <tbody>
                    <tr>
                        <th>DICTAMEN</th>
                        <td>{{$dictamenes->count()}}</td>
                    </tr>
                    <tr>
                        <th>INFORME</th>
                        <td>{{$informes->count()}}</td>
                    </tr>
                    <tr>
                        <th>SALIDA A JUZGADO</th>
                        <td>{{$salidas_juzgado->count()}}</td>
                    </tr>
                    <tr>
                        <th>CERTIFICADO</th>
                        <td>{{$certificados->count()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js')

<script src="{{asset('js/peticiones/peticion_editar.js')}}"></script>

  <script type="text/javascript">
    $('.li-consultar-cadena').removeClass('active');
    $('.li-registrar-cadena').addClass('active');
  </script>
@endsection
