<!DOCTYPE html>
<html lang="en" dir="ltr">
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
      /*  #header-tabla{
          width: 100% !important;
          margin: auto;
        }
        #header-tabla td{
          background-color: #152F4A;
          color: white;
        }*/
        #titulo h3 {

          background-color: #c09f77;
          color: #152F4A;
          padding-top: 5px;
          padding-bottom: 5px;
          text-align: center;
          font-size: 16px;
          margin: 0 !important;
        }
      
        hr {
          page-break-after: always;
          border: 0;
        }
        .fa-file-pdf{
          color:red;
        }
        .fa-file-pdf:hover,.fa-copy:hover,.fa-pen:hover{
          font-size:117%;
        }
        .encabezado h6{

          background-color: #394049;
          color: #c6c6c6;
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
<body>
   <header>
      <h3><b>FISCALÍA GENERAL DEL ESTADO DE MICHOACÁN</b></h3>
   </header>

    <div class="header-img">
      <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/logo_fge_pdf.png" alt=""  width="100">
    </div>

   <main>
      <table>
         <caption style=""><b>INFORME DE SOLICITUDES</b></caption>
         <tr>
            <td><b>Región</b></td>
            <td>{{$fiscalia->nombre}}</td>
         </tr>
         <tr>
            <td><b>Fecha</b></td>
            <td>{{date('d-m-Y',strtotime($fecha))}}</td>
         </tr>
      </table>

      <br>
      <br>

      <table>
         <caption style="text-align:left;"><b>SOLICITUDES</b></caption>
         <tbody>
            <tr>
               <td width="80%"><b>Solicitudes recibidas</b></td>
               <td width="20%">{{$peticiones_recibidas->count()}}</td>
            </tr>
            <tr>
               <td><b>Solicitudes atendidas</b></td>
               <td>
                  {{$peticiones_recibidas->whereIn('estado',['atendida','entregada'])
                                          ->where('fecha_elaboracion',$fecha)
                                          ->count()}}
               </td>
            </tr>
            <tr>
               <td><b>Solicitudes atendidas en fecha posterior</b></td>
               <td>
                  {{$peticiones_recibidas->whereIn('estado',['atendida','entregada'])
                                          ->where('fecha_elaboracion','>',$fecha)
                                          ->count()}}
               </td>
            </tr>
            <tr>
               <td style="background-color:#c09f77; color:#394049 !important;"><b>Total de solicitudes atendidas</b></td>
               <td style="background-color:#394049; color:white !important;">
                  <b>
                  {{$peticiones_recibidas->whereIn('estado',['atendida','entregada'])
                                          ->where('fecha_peticion',$fecha)
                                          ->count()}}
                  </b>   
            </td>
         </tbody>
      </table>

      <br>

      <table>
         <caption style="text-align:left;"><b>DOCUMENTO EMITIDO</b></caption>
         <tbody>
            <tr>
               <td width="80%"><b>Dictamenes</b></td>
               <td width="20%">{{$peticiones_recibidas->where('documento_emitido','dictamen')/*->where('fecha_elaboracion',$fecha)*/->count()}}</td>
            </tr>
            <tr>
               <td><b>Informes</b></td>
               <td>{{$peticiones_recibidas->where('documento_emitido','informe')/*->where('fecha_elaboracion',$fecha)*/->count()}}</td>
            </tr>
            <tr>
               <td><b>Juzgados</b></td>
               <td>{{$peticiones_recibidas->where('documento_emitido','salida_juzgado')/*->where('fecha_elaboracion',$fecha)*/->count()}}</td>
            </tr>
            <tr>
               <td><b>Certificados</b></td>
               <td>{{$peticiones_recibidas->where('documento_emitido','certificado')/*->where('fecha_elaboracion',$fecha)*/->count()}}</td>
            </tr>
         </tbody>
      </table>
      <br>

<!--Necropsia-->
      <table>
         @php
             $array_necropsia_tipo = array(
                'suicidio' => 0,
                'dolosa' => 0,
                'hecho_transito' => 0,
                'patologia_otra' => 0
             );
         @endphp
         @foreach ($peticiones_recibidas as $peticion)
            @isset($peticion->necropsia_id)
                @php
                    $array_necropsia_tipo[$peticion->necropsia->necropsia_tipo] += 1;
                @endphp
            @endisset
         @endforeach
         <caption style="text-align:left;"><b>NECROPSIAS</b></caption>
         <tbody>
            <tr>
               <td width="80%"><b>Cantidad de necropsias</b></td>
               <td width="20%">{{$peticiones_recibidas->where('solicitud_id',61)->count()}}</td>
            </tr>
            <tr>
               <td style="padding-left:30px !important;">·Suicidio</td>
               <td>{{$array_necropsia_tipo['suicidio']}}</td>
            </tr>
            <tr>
               <td style="padding-left:30px !important;">·Doloso</td>
               <td>{{$array_necropsia_tipo['dolosa']}}</td>
            </tr>
            <tr>
               <td style="padding-left:30px !important;">·Hecho de tránsito</td>
               <td>{{$array_necropsia_tipo['hecho_transito']}}</td>
            </tr>
            <tr>
               <td style="padding-left:30px !important;">·Patología u otra</td>
               <td>{{$array_necropsia_tipo['patologia_otra']}}</td>
            </tr>
         </tbody>
      </table>

      <br>
<!--Rezago-->
      <table>
         <caption style="text-align:left;"><b>REZAGO<b></caption>
         <tbody>
         <tr>
            <td width="80%"><b>Rezago del día</b></td>
            <td width="20%">{{$peticiones_recibidas->where('estado','pendiente')->count()}}</td>
         </tr>
         <tr>
            <td><b>Rezago atendido</b></td>
            <td>{{$peticiones_rezago_atendido->count()}}</td>
         </tr>
         <tr>
            <td><b>Rezago acomuldo</b></td>
            <td>{{$peticiones_rezago->count()}}</td>
         </tr>
         </tbody>
      </table>
   </main>


         
</body>