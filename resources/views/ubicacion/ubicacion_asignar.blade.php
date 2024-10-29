@extends('plantillas.plantilla_sin_menu')

@section('seccion', "ASIGNAR UBICACIÓN $cadena->folio_bodega")

@section('titulo','REGISTRAR-UBICACION')

@section('css')
<link rel="stylesheet" href="{{asset('css/cadenas/registrar.css')}}">

<style>
    .modal{
        background-color: #c6c6c6;
    }
    .modal-footer{
        background-color: #c09f77 !important;
    }
    ::placeholder{
        color: #152f4a;
    }
</style>
@endsection

@section('scripts')

@endsection

@section('contenido')

    @if ($cadena->indicios->count() > 1)
        <section id="identidad">
            <div class="row">
                <div class="col s12">
                    <blockquote class="center-align">
                        <h6><b>• UBICACIÓN GENERAL</b></h6>
                    </blockquote>
                </div>
                <div class="col s12">
                    <span>Asingar ubicación general</span> <a class="modal-trigger" href="#modal-ubicacion-general"><i
                            class="fas fa-pen"></i></a>
                </div>
            </div>
        </section>
    @endif

    <section id="identidad">
        <div class="row">
            <div class="col s12">
                <blockquote class="center-align">
                    <h6><b>• UBICACIÓN POR IDENTIFICADOR </b></h6>
                </blockquote>
            </div>

            <div class="col s12">
                <table>
                    <thead>
                        <tr>
                            <th>IDENTIFICADOR</th>
                            <th>DESCRIPCIÓN</th>
                            <th>UBICACIÓN</th>
                            <th>ASIGNAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cadena->indicios as $indicio)
                        <tr>
                            <td width='10%'>{{$indicio->identificador}}</td>
                            <td width='70%'>{{$indicio->descripcion}}</td>
                            <td width='20%'>
                                @isset($indicio->ubicacion_id)
                                {{$indicio->ubicacion->nombre}}
                                @endisset
                                @empty($indicio->ubicacion_id)
                                <span style="color:red;">---</span>
                                @endempty
                            </td>
                            <td>
                                <a class="modal-open-indicio" href="" data-indicio-id="{{$indicio->id}}"><i class="fas fa-pen"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal Ubicacion General -->
    <div id="modal-ubicacion-general" class="modal">
        <div class="modal-content">
            <h5 style="text-align:center; color:#152f4a;"> <b>UBICACIÓN GENERAL - {{$cadena->folio_bodega}}</b></h5>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" placeholder="Buscar Ubicacion" id="ubicacion-general-input">
                </div>
                <div class="col s12">
                    <div id="ubicacion-general-lista" class="collection">
                        <!--Esperando datos de ubicacion_general.js [evento: $('#ubicacion-general-input').keyup]-->
                    </div>
                </div>
            </div>
            <form class="col s12" id="form-ubicacion-general">
                {{csrf_field()}}
                <input type="hidden" value="{{$cadena->id}}" name="id_cadena">
                <!--Esperando datos de ubicacion_asignar_general.js [evento: $('body').on('click', '.ubicacion-general-item']-->
            </form>
        </div>
        <div class="modal-footer">
        </div>
    </div>



    <!-- Modal Ubicacion individual -->
    <div id="modal-ubicacion-indicio" class="modal">
        <div class="modal-content">
            <h5 style="text-align:center; color:#152f4a;"> <b>UBICACIÓN POR INDICIO - {{$cadena->folio_bodega}} - <span id="indicio-identifiador"></span></b></h5>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" placeholder="Buscar Ubicacion" id="ubicacion-indicio-input">
                </div>
                <div class="col s12">
                    <div id="ubicacion-indicio-lista" class="collection">
                        <!--Esperando datos de ubicacion_indicio.js [evento: $('#ubicacion-indicio-input').keyup]-->
                    </div>
                </div>
            </div>
            <form class="col s12" id="form-ubicacion-indicio">
                {{csrf_field()}}
                <!--Esperando datos de ubicacion_asignar_general.js [evento: $('body').on('click', '.ubicacion-indicio-item']-->
            </form>
        </div>
        <div class="modal-footer">
        </div>
    </div>



@endsection

@section('js')
    <script src="{{asset('js/ubicacion/ubicacion_general.js')}}"></script>
    <script src="{{asset('js/ubicacion/ubicacion_indicio.js')}}"></script>
@endsection
