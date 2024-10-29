<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Etiqueta</title>

<!--
   <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/plugins/materialize/css/materialize.min.css">
-->

   <style media="screen">
      @page{
         margin-top: 0.3cm;
         margin-bottom: 1.7cm;
      }
      body {
         font-size: 0.75em;
         margin: 5.5cm 0 1.5cm 0;
      }

      #header,
      #footer {
        position: fixed;
        left: 0;
        right: 0;
        font-size: 0.9em;
      }
      #footer {
        bottom: 0;
        border-top: 0.1pt solid #aaa;
      }

      .page-number {
        text-align: center;
      }

      .page-number:before {
        content: "Página " counter(page);
      }

      hr {
        page-break-after: always;
        border: 0;
      }
      .contenido{
         margin: 0 auto;
         width: 450px;
         padding: 8px;
         border: 0.5px solid #1a237e;
         border-radius: 20px;
      }
      table{
         width: 450px;

      }
      td{
         border: 1px solid #e0e0e0;
      }
      img{
         width: 80px !important;
      }
      .tdfecha{
         width: 50%;
      }
   </style>

</head>
<body>

   @php
      $descripciones = json_decode($data->descripcion);
      $servidores = json_decode($data->sp);
   @endphp

   <div class="contenido">
      <table cellspacing="0">
         <tr align="center" >
            <td><img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/imagenes/escudo-etiqueta.jpg" alt=""></td>
            <td><h2><b>FORMATO DE ETIQUETADO [FE]</b></h2></td>
         </tr>
         <tr align="center">
            <td colspan="2"><b>N.U.C(&nbsp;X&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;C.I.(&nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;P.P.(&nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;Otro(&nbsp;&nbsp;&nbsp;)</b></td>
         </tr>
         <tr>
            <td colspan="2"><b>NO.</b> {{$data->nuc}}</td>
         </tr>
         <tr>
            <td class="tdfecha"><b>FECHA: </b>{{$data->indicios[0]->fecha}}</td>
            <td><b>HORA: </b>
               @foreach ($data->indicios as $p => $v)
                  {{$v->hora}} ~
               @endforeach
            </td>
         </tr>
         <tr>
            <td colspan="2"><b>DESCRIPCIÓN GENERAL DEL INDICIO Y/O ELEMENTO MATERIAL PROBATORIO:</b></td>
         </tr>
         @foreach ($data->indicios as $p => $v)
            <tr>
               <td colspan="2">{{$v->identificador}}: {{$v->descripcion}}</td>
            </tr>
         @endforeach
         <tr>
            <td colspan="2"><b>RECOLECTADO DE:</b></td>
         </tr>
           @foreach ($data->indicios as $p => $v)
            <tr>
               <td colspan="2">{{$v->indicio_ubicacion_lugar}}</td>
            </tr>
         @endforeach
         <tr>
            <td colspan="2"><b>ESTADO DEL INDICIO Y/O ELEMENTO MATERIAL PROBATORIO:</b></td>
         </tr>
            @foreach ($data->indicios as $p => $v)
            <tr>
               <td colspan="2">{{$v->condicion}}</td>
            </tr>
         @endforeach
         <tr>
            <td colspan="2"><b>NO. DE INDICIO (s) Y/O ELEMENTO MATERIAL PROBATORIO: </b>
               @foreach ($data->indicios as $key => $indicio)
                  {{$indicio->identificador}}&nbsp;&nbsp;
               @endforeach
            </td>
         </tr>
         <tr>
            <td colspan="2"><b>OBSERVACIONES:</b></td>
         </tr>
         <tr>
            <td colspan="2">&nbsp;</td>
         </tr>
         <tr>
            <td colspan="2">&nbsp;</td>
         </tr>
         <tr>
            <td colspan="2"><b>NOMBRE Y FIRMA DE QUIEN RECOLECTA EL INDICIO Y/O ELEMENTO MATERIAL PROBATORIO:</b></td>
         </tr>
         <tr>
            <td colspan="2">{{$data->user->name}}</td>
         </tr>
         <tr align="center">
            <td><b>CARGO:</b></td>
            <td><b>IDENTIFICACIÓN:</b></td>
         </tr>
         <tr align="center">
            <td>{{$data->user->cargo->nombre}}</td>
            <td>{{$data->user->folio}}</td>
         </tr>
         <tr align="center" valign="bottom">
            <td colspan="2" rowspan="8"><b>FIRMA:________________________________________________________</td>
         </tr>
      </table>

      <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/codigoQr/codigoqr.png" alt="">
   </div>

</body>
