<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/plugins/materialize/css/materialize.css">
    <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/css/tablas.css">

    <style>
        @page{
          margin-left: 1.5cm !important;
          margin-right: 1.5cm !important;
          margin-top: 10% !important;
          margin-bottom: 10%;
        }
        html{
          margin:0;
        }
        body{
          margin: 0;
          padding: 0;
          margin-top: 1%;
          margin-bottom: 2%
        }
        header{
          margin: 0;
          padding: 0;
          position: fixed;
          top: -8%;
          right:0;
          left: 0%;
          bottom: 0;

        }
        header h3{
          background-color: #152F4A ;
          color: white;
          padding-top: 7px ;
          padding-bottom: 7px ;
          text-align: right;
          padding-right: 7px;
          font-size: 15px;
        }
        .header-img{
          position: fixed;
          top: -8%;
          right:0;
          left: 4%;
          bottom: 0;

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
      /*  hr{
          page-break-after: always;
          color:white;
        }*/
        #titulo h3 {
            background-color: #c09f77;
          color: #152F4A;
          padding-top: 5px;
          padding-bottom: 5px;
          text-align: center;
          font-size: 16px;
          margin:0 !important;

        }
        .encabezado h6{
          background-color: #394049;
          color: #c6c6c6;
          padding-top: 5px;
          padding-bottom: 5px;
          text-align: center;
          font-size: 16px;

        }
        .encabezadofinal h6{

          background-color: #394049;
          color: #c09f77;
          padding-top: 5px;
          padding-bottom: 5px;
          text-align: center;
          font-size: 16px;

        }
        
        table th,table td{
            border: 1px solid #394049 !important;
            font-size: 10px !important;
        }
        table td{
            padding-left: 8px !important;
        }
        caption{
            border: 1px solid #394049 !important;
  background-color: #c09f77 !important;
  color: #c09f77;
}
    </style>

  </head>

<body >

    <header>
      <h3><b>FISCALÍA GENERAL DEL ESTADO DE MICHOACÁN</b></h3>
    </header>
    <div class="header-img">
      <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/logo_fge_pdf.png" alt=""  width="100">
    </div>

    <main>
        <div id="titulo">
            <h3><b>FISCALÍA {{Auth::user()->fiscalia->nombre}}</b></h3>
            <h3><b>PETICIONES {{$fecha_encabezado}}</b></h3>
        </div>

        <table>
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
                $total_atendidas = 0;
                foreach ($especialidades as $key => $especialidad) {
                $especialidades_array[$especialidad->nombre] =
                ['dictamen'=>0,'informe'=>0,'certificado'=>0,'salida_juzgado'=>0];
                }

                foreach ($atendidas as $peticion){
                $especialidades_array[$peticion->solicitud->especialidad->nombre][$peticion->documento_emitido] += 1;
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
            
        
    </main>

</body>
</html>
