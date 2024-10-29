@extends('cadenas.plantilla_peticiones')

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
        <!--Solicitudes-->
        <div class="col s6">
           <table id="tabla-entradas" class="responsive-table highlight bordered">
              <caption><b>SOLICITUDES</b></caption>
              <tbody>
              <tr>
                 <td>Solicitudes recibidas</td>
                 <td>{{$peticiones_recibidas->count()}}</td>
              </tr>
              <tr>
                 <td>Solicitudes atendidas en el día</td>
                 <td>
                    {{$peticiones_recibidas->whereIn('estado',['atendida','entregada'])
                                            ->where('fecha_elaboracion',$fecha_peticiones)
                                            ->count()}}
                 </td>
              </tr>
              <tr>
                 <td>Solicitudes atendidas en fecha posterior</td>
                 <td>
                    {{$peticiones_recibidas->whereIn('estado',['atendida','entregada'])
                                            ->where('fecha_elaboracion','>',$fecha_peticiones)
                                            ->count()}}
                 </td>
              </tr>
              <tr>
                 <td style="background-color:#c09f77; color:#394049 !important;"><b>Total de solicitudes atendidas</b></td>
                 <td style="background-color:#394049; color:white !important;">
                    <b>
                    {{$peticiones_recibidas->whereIn('estado',['atendida','entregada'])
                                            ->where('fecha_peticion',$fecha_peticiones)
                                            ->count()}}
                    </b>   
              </td>
              </tr>
              </tbody>
           </table>
        </div>
        <!--Documento emitido-->
        <div class="col s6">
           <table id="tabla-entradas" class="responsive-table highlight bordered">
              <caption><b>DOCUMENTO EMITIDO</b></caption>
              <tbody>
                 <tr>
                    <td>Dictamenes</td>
                    <td>
                       {{$peticiones_recibidas->where('documento_emitido','dictamen')
                                               //->where('fecha_elaboracion',$fecha_peticiones)
                                               ->count()}}
                    </td>
                 </tr>
                 <tr>
                    <td>Certificados</td>
                    <td>
                       {{$peticiones_recibidas->where('documento_emitido','certificado')
                                               //->where('fecha_elaboracion',$fecha_peticiones)
                                               ->count()}}
                    </td>
                 </tr>
                 <tr>
                    <td>Informes</td>
                    <td>
                       {{$peticiones_recibidas->where('documento_emitido','informe')
                                               //->where('fecha_elaboracion',$fecha_peticiones)
                                               ->count()}}
                    </td>
                 </tr>
                 <tr>
                    <td>Juzgados</td>
                    <td>
                       {{$peticiones_recibidas->where('documento_emitido','salida_juzgado')
                                               //->where('fecha_elaboracion',$fecha_peticiones)
                                               ->count()}}
                    </td>
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
