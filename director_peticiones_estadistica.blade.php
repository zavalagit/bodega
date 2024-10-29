@extends('plantillas.plantilla_director')

@section('seccion', 'ESTADISTICA')

@section('titulo','ESTADISCA')

@section('css')
<link rel="stylesheet" href="{{asset('css/cadenas/registrar.css')}}">

<style>
    th{
        
    }
    td{
        text-align: center;
        padding-left: 10px !important;
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

    .tabla-peticiones td{
        width:50%; 
        text-align:left;
    }
</style>
@endsection

@section('contenido')

    <section>
        <form class="col s12">
            <div class="row">
                <div class="input-field col s2 offset-s7">
                    @isset($fecha_inicio)
                        <input type="date" name="buscar_fecha" value="{{$fecha_inicio}}">
                    @endisset
                    @empty($fecha_inicio)
                        <input type="date" name="fecha_inicio" >
                    @endempty
                </div>
                <div class="input-field col s2">
                    @isset($fecha_fin)
                        <input type="date" name="buscar_fecha" value="{{$fecha_fin}}">
                    @endisset
                    @empty($fecha_fin)
                        <input type="date" name="fecha_fin" >
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
            <table class="tabla-peticiones">
                <caption><b>PETICIONES</b></caption>
                <tbody>
                    <tr>
                        <td>RECIBIDAS</td>
                        <td style="text-align:center;">{{$recibidas->count()}}</td>
                    </tr>
                    <tr>
                        <td>ATENDIDAS</td>
                        <td style="text-align:center;">{{$atendidas->count()}}</td>
                    </tr>
                    <tr>
                        <td>PENDIENTES</td>
                        <td style="text-align:center;">{{$pendientes->count()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col s12">
            <table>
                <caption> <b>DOCUMENTO EMITIDO</b> </caption>
                <tbody>
                    <tr>
                        <td style="text-align:left; width:50%;">DICTAMEN</td>
                        <td style="text-align:center;">{{$dictamenes->count()}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">INFORME</td>
                        <td style="text-align:center;">{{$informes->count()}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">SALIDA A JUZGADO</td>
                        <td style="text-align:center;">{{$salidas_juzgado->count()}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">CERTIFICADO</td>
                        <td style="text-align:center;">{{$certificados->count()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        
        <div class="col s12">
            <table>
                <caption><b>PETICIONES ATENDIDAS POR ESPECIALIDAD</b></caption>
                <thead>
                    <tr>
                        <th style="text-align:center;">Nº</th>
                        <th style="text-align:center;">Especialidad</th>
                        <th style="text-align:center;">Dictamen</th>
                        <th style="text-align:center;">Informe</th>
                        <th style="text-align:center;">Certificado</th>
                        <th style="text-align:center;">Salida a Juzgado</th>
                        <th style="text-align:center;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $n = 1;
                        $especialidades_array = [];
                        $otro_array = [];
                        $total_atendidas = 0;
                        foreach ($especialidades as $key => $especialidad) {
                            $especialidades_array[$especialidad->nombre] = ['dictamen'=>0,'informe'=>0,'certificado'=>0,'salida_juzgado'=>0];   
                        }

                        foreach ($atendidas as $peticion){
                            if ( array_key_exists($peticion->solicitud->especialidad->nombre,$especialidades_array) ){
                                $especialidades_array[$peticion->solicitud->especialidad->nombre][$peticion->documento_emitido] += 1;    
                            }
                            else {
                                array_push($otro_array,$peticion);
                            }
                        }
                    @endphp

                    @foreach ($especialidades as $especialidad)
                        <tr>
                            <td>{{$n++}}</td>
                            <td style="text-align:left;">{{$especialidad->nombre}}</td>
                            <td>{{$especialidades_array[$especialidad->nombre]['dictamen']}}</td>
                            <td>{{$especialidades_array[$especialidad->nombre]['informe']}}</td>
                            <td>{{$especialidades_array[$especialidad->nombre]['certificado']}}</td>
                            <td>{{$especialidades_array[$especialidad->nombre]['salida_juzgado']}}</td>
                            <td><b>{{array_sum($especialidades_array[$especialidad->nombre])}}</b></td>
                        </tr>
                        @php
                            $total_atendidas += array_sum($especialidades_array[$especialidad->nombre]); 
                        @endphp
                    @endforeach
                    <tr style="background-color:#c09f77;">
                        <td colspan="2"> <b>TOTAL</b> </td>
                        <td><b>{{array_sum(array_column($especialidades_array,'dictamen'))}}</b></td>
                        <td><b>{{array_sum(array_column($especialidades_array,'informe'))}}</b></td>
                        <td><b>{{array_sum(array_column($especialidades_array,'certificado'))}}</b></td>
                        <td><b>{{array_sum(array_column($especialidades_array,'salida_juzgado'))}}</b></td>
                        <td> <b>{{$total_atendidas}}</b> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        

        @if (!empty($otro_array))
            <div class="col s12">
                <table>
                    <caption><b>OTROS</b></caption>
                    <thead>
                        <tr>
                            <th style="text-align:center;">N°</th>
                            <th style="text-align:center;">Especialidad</th>
                            <th style="text-align:center;">Dictamen</th>
                            <th style="text-align:center;">Informe</th>
                            <th style="text-align:center;">Certificado</th>
                            <th style="text-align:center;">Salida a Juzgado</th>
                            <th style="text-align:center;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $n = 1;
                            $total_atendidas_otras = 0;
                            $especialidades_otras_array = [];
                            foreach ($otro_array as $key => $peticion) {
                                if ( !array_key_exists($peticion->solicitud->especialidad->nombre,$especialidades_otras_array) ){
                                    $especialidades_otras_array[$peticion->solicitud->especialidad->nombre] = ['dictamen'=>0,'informe'=>0,'certificado'=>0,'salida_juzgado'=>0];
                                    $especialidades_otras_array[$peticion->solicitud->especialidad->nombre][$peticion->documento_emitido] += 1;
                                }
                                else{
                                    $especialidades_otras_array[$peticion->solicitud->especialidad->nombre][$peticion->documento_emitido] += 1;
                                }
                            }

    /*
                            $perito_array = [];
                            foreach ($otro_array as $key => $peticion) {
                                if ( !array_key_exists($peticion->user->nombre,$perito_array) ) {
                                    $perito_array[$peticion->user->nombre]
                                }
                            }
    */
                        @endphp
                        @foreach ($especialidades_otras_array as $key => $peticion)
                            <tr>
                                <td>{{$n++}}</td>
                                <td>{{$key}}</td>
                                <td>{{$peticion['dictamen']}}</td>
                                <td>{{$peticion['informe']}}</td>
                                <td>{{$peticion['certificado']}}</td>
                                <td>{{$peticion['salida_juzgado']}}</td>
                                <td>{{array_sum($especialidades_otras_array[$key])}}</td>
                            </tr>
                            @php
                                $total_atendidas_otras += array_sum($especialidades_otras_array[$key]);
                            @endphp
                        @endforeach
                            <tr style="background-color:#c09f77;">
                                <td colspan="2"> <b>TOTAL</b> </td>
                                <td>{{array_sum(array_column($especialidades_otras_array,'dictamen'))}}</td>
                                <td>{{array_sum(array_column($especialidades_otras_array,'informe'))}}</td>
                                <td>{{array_sum(array_column($especialidades_otras_array,'certificado'))}}</td>
                                <td>{{array_sum(array_column($especialidades_otras_array,'salida_juzgado'))}}</td>
                                <td>{{$total_atendidas_otras}}</td>
                            </tr>
                        
                    </tbody>
                </table>
            </div>
        @endif


        

    </div>

@endsection

@section('js')

<script src="{{asset('js/peticiones/peticion_editar.js')}}"></script>

  <script type="text/javascript">
    $('.li-consultar-cadena').removeClass('active');
    $('.li-registrar-cadena').addClass('active');
  </script>
@endsection
