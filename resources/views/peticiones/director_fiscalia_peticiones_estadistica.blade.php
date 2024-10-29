@extends( ( Auth::user()->tipo == 'coordinador' ) ? 'plantillas.peticiones.plantilla_coordinador' : 'plantillas.plantilla_director')

@section('seccion', 'REGISTRO DE PETICIÓN')

@section('titulo','REGISTRAR-CADENA')

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

    .td-izq{
        width: 80% !important;
        text-align:left;
        padding-left:3% !important;
    }
    .td-der{
        width:20% !important;
        text-align:right;
        padding-right:10% !important;
    }
    .td-izq-total{
        width: 80% !important;
        text-align:center;
        padding-left:3% !important;
        background-color:#c09f77;
        color:#394049 !important;
    }
    .td-der-total{
        width:20% !important;
        text-align:right;
        padding-right:10% !important;
        background-color:#394049;
        color:white !important;
    }
    .td-sub{
        background-color: #c6c6c6;
        color: white;
    }
</style>
@endsection

@section('contenido')
    #buscar
    <section>
        <form class="col s12">
            <div class="row">
                <div class="input-field col s2 offset-s6">
                    @isset($fecha_inicio)
                        <input type="date" name="fecha_inicio" value="{{$fecha_inicio}}">
                    @endisset
                    @empty($fecha_inicio)
                        <input type="date" name="fecha_inicio" >
                    @endempty
                </div>
                <div class="input-field col s2">
                    @isset($fecha_fin)
                        <input type="date" name="fecha_fin" value="{{$fecha_fin}}">
                    @endisset
                    @empty($fecha_fin)
                        <input type="date" name="fecha_fin" >
                    @endempty
                </div>
                <div class="input-field col s1">
                    <button class="btn waves-effect waves-light" type="submit" name="buscar_btn"
                        value="buscar"><i style="color:#394049;" class="fas fa-search"></i></button>
                </div>
				{{--
                <div class="input-field col s1">
                    <button class="btn waves-effect waves-light" type="submit" name="buscar_btn"
                        value="pdf">pdf</button>
                </div>
				--}}
            </div>
        </form>
    </section>
    #encabezado
    <section>
        <div class="row">
            <div class="fecha-encabezado col s12" style="margin-bottom:0 !important;">
                <h5 style="margin-bottom:0 !important;"> <b>PETICIONES {{$fecha_encabezado}}</b> </h5>
            </div>
            <div class="fecha-encabezado col s12" style="margin-top:0 !important;">
                <h5 style="margin-top:0 !important;"> <b>{{$fiscalia->nombre}}</b> </h5>
            </div>
        </div>
    </section>
    #peticiones
    <div class="row">
        <!--Solicitudes-->
        <div class="col s12">
            <table id="tabla-entradas" class="responsive-table highlight bordered">
                <caption><b>PETICIONES</b></caption>
                <tbody>
                    <tr>
                        <td class="td-izq">Recibidas</td>
                        <td class="td-der">{{$peticiones_total->count()}}</td>
                    </tr>
                    <tr>
                        <td class="td-izq">Atendidas</td>
                        <td class="td-der">
                            {{$peticiones_total->whereIn('estado',['atendida','entregada'])->count()}}
                        </td>
                    </tr>
                    <tr>
                        <td class="td-izq">Pendientes</td>
                        <td class="td-der">
                            {{$peticiones_total->whereIn('estado','pendiente')->count()}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    #documento_emitido
    <div class="row">
        <!--Documento emitido-->
        <div class="col s12">
        <table id="tabla-entradas" class="responsive-table highlight bordered">
            <caption><b>DOCUMENTO EMITIDO</b></caption>
            <tbody>
                <tr>
                    <td class="td-izq">Dictamenes</td>
                    <td class="td-der">
                    {{$peticiones_total->where('documento_emitido','dictamen')
                                        ->count()
                    }}
                    </td>
                </tr>
                <tr>
                    <td class="td-izq">Informes</td>
                    <td class="td-der">
                        {{$peticiones_total->where('documento_emitido','informe')
                                            ->count()
                        }}
                    </td>
                </tr>
                <tr>
                    <td class="td-izq">Juzgados</td>
                    <td class="td-der">
                        {{$peticiones_total->where('documento_emitido','salida_juzgado')
                                            ->count()
                        }}
                    </td>
                </tr>
                <tr>
                    <td class="td-izq">Certificados</td>
                    <td class="td-der">
                    {{$peticiones_total->where('documento_emitido','certificado')
                                        ->count()
                    }}
                    </td>
                </tr>
                <tr>
                    <td class="td-izq-total"><b>Total de documentos emitidos</b></td>
                    <td class="td-der-total">
                       <b>
                       {{$peticiones_total->whereIn('documento_emitido',['dictamen','informe','salida_juzgado','certificado'])->count()}}
                       </b>   
                    </td>
                 </tr>
            </tbody>
        </table>
        </div>
    </div>
        
    <div class="row">
        <div class="col s12">
            <table>
                <caption><b>PETICIONES ATENDIDAS POR ESPECIALIDAD</b></caption>
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Especialidad</th>
                        <th>Dictamen</th>
                        <th>Informe</th>
                        <th>Certificado</th>
                        <th>Salida a Juzgado</th>
                        <th>Total</th>
                        <th>Atendidas</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $n = 1;
                        $especialidades_array = [];
                        $total_atendidas = 0;
                        foreach ($especialidades as $key => $especialidad) {
                            $especialidades_array[$especialidad->nombre] = ['dictamen'=>0,'informe'=>0,'certificado'=>0,'salida_juzgado'=>0,'atendidas'=>0];   
                        }

                        foreach ($peticiones_total->whereIn('estado',['atendida','entregada']) as $peticion){
                            $especialidades_array[$peticion->solicitud->especialidad->nombre][$peticion->documento_emitido] += 1;    
                            $especialidades_array[$peticion->solicitud->especialidad->nombre]['atendidas'] += 1;    
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
                            <td><b>{{array_sum($especialidades_array[$especialidad->nombre]) - $especialidades_array[$especialidad->nombre]['atendidas']}}</b></td>
                            <td>{{$especialidades_array[$especialidad->nombre]['atendidas']}}</td>
                        </tr>
                        @php
                            $total_atendidas = $total_atendidas + array_sum($especialidades_array[$especialidad->nombre]) - $especialidades_array[$especialidad->nombre]['atendidas']; 
                        @endphp
                    @endforeach
                    <tr style="background-color:#c09f77;">
                        <td colspan="2"> <b>TOTAL</b> </td>
                        <td><b>{{array_sum(array_column($especialidades_array,'dictamen'))}}</b></td>
                        <td><b>{{array_sum(array_column($especialidades_array,'informe'))}}</b></td>
                        <td><b>{{array_sum(array_column($especialidades_array,'certificado'))}}</b></td>
                        <td><b>{{array_sum(array_column($especialidades_array,'salida_juzgado'))}}</b></td>
                        <td> <b>{{$total_atendidas}}</b> </td>
                        <td> <b>{{ array_sum( array_column( $especialidades_array,'atendidas' ) ) }}</b> </td>
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
