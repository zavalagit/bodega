<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Anexo 4</title>

   <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/plugins/materialize/css/materialize.min.css">


   <style media="screen">

  @page{
      margin-top: 0cm;
      margin-bottom: 1.7cm;
   }
   body {
      font-size: 0.65em;
      margin: 7cm 0 1.4cm 0;
   }

#header,
#footer {
  position: fixed;
  left: 0;
  right: 0;
  font-size: 0.6em;
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

table thead{
   background-color: #aaa;
}
th{
   padding: 3px 3px 3px 3px !important;
   border: 0.8px solid #aaa;
}
.tabla td{
   background-color: #ffffff;
   border: 0.8px solid #aaa;
   padding: 1px 1px 1px 1px;
}
#header td{
   background-color: #ffffff;
   border: none;
}
.titulo-nuc{
   background-color: #aaa;
   padding: 5px !important;
   margin: 0 !important;
}
.dato-nuc{
   display: block;
   background-color: #e0e0e0;
   margin: 0 !important;
   padding: 0 !important;
}
.tabla-entrega td, .tabla-recibe td, .tabla-observaciones td{
   padding: 7px !important;
   border: 0.7px solid #aaa !important;
}
.div-nuc{
   padding: 3px !important;
}
.div-nuc h5{
   margin-top: 0 !important;
   font-size: 13px;
}
.p-nuc{
   font-size: 13px;
   margin-bottom: 0 !important;
}
.tdfirma{
  height: 35px !important;
}
.th-descripcion{
  text-align: left !important;
}

   </style>

</head>

<body>

   <div id="header">
     <div class="right-align">
         <h1><b>{{$data->folio_bodega}}</b></h1>
      </div>
     <table class="centered">
       <tr bgcolor="#a0aca4">
         <td align="center">
            <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/imagenes/pdf1.png">
         </td>
         <td align="center">
            <h4><b>Formato de entrega-recepción de indicios y/o elementos materiales probatorios</b></h4>
            <h4>(Anexo 4)</h4>
         </td>
         <td align="center">
            <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/imagenes/pdf2.png">
         </td>
       </tr>
     </table>
     <br>
     <div class="right grey div-nuc">
        <h5 class="grey lighten-2">
           <b>No. de referencia</b>
        </h5>
        <p class="p-nuc"><b>{{$data->nuc}}</b></p>
     </div>
  </div>

   <div id="footer">
      <div class="">
         <p>
            Periférico Independencia N° 5000, Col. Sentimientos de la Nación
            Morelia, Michoacán, México, C.P. 58170, Tel. 443 322 3600 Ext. 1021
            pgje.michoacan.gob.mx
         </p>
      </div>
     <div class="page-number"></div>
   </div>

   <div class="contenido">
      <table class="tabla centered">
         <thead>
            <tr>
               <th>Folio o llamado</th>
               <th>Lugar de entrega-recepcion</th>
               <th>Fecha y hora de entrega de recepcion</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>{{$data->folio}}</td>
               <td></td>
               <td>&nbsp;</td>
            </tr>
         </tbody>
      </table>

      <p><b>1. Inventario.</b> (Escriba el número, letra o combinación alfanumérica
          con la que se identifica a cada indicio o elemento marial probatorio que se
          entrega, así como su tipo o clase. Cancele los espacios sobrantes.)
      </p>
      <table class="tabla centered">

         <thead>
            <tr>
               <th>Identificación</th>
               <th class="th-descripcion">Descripción</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($data->indicios as $key => $indicio)
               <tr>
                  <td>{{$indicio->identificador}}</td>
                  <td style="text-align: left">{{$indicio->descripcion}}</td>
               </tr>
            @endforeach
         </tbody>
      </table>

      <p><b>1. Embalaje.</b> (Señale las condiciones en las que se encuentran los embalajes.
          Cuando alguno de ellos presente alteración, deterioro o cualquier otra anomalía,
          especifique dicha condición.)
      </p>

      <table class="tabla">
         <tbody>
            <tr>
               <td>{{$data->embalaje}}</td>
            </tr>
         </tbody>
      </table>
      <br>
      <br>
      <br>

      @php
         $servidores = json_decode($data->sp);
      @endphp

      <table class="tabla centered">
         <thead>
            <tr>
               <th>Persona que entrega</th>
               <th>Persona que recibe</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td class="tdfirma"></td>
               <td class="tdfirma"></td>
            </tr>
            <tr>
               <td class="tddatos">{{$data->user->name}}</td>
               <td class="tddatos"></td>
            </tr>
            <tr>
               <td class="tddatos">PGJE {{$data->user->cargo->nombre}} {{$data->user->folio}}</td>
               <td class="tddatos"></td>
            </tr>
            <tr>
               <td>Nombre completo, institución, cargo y firma</td>
               <td>Nombre completo, institución, cargo y firma</td>
            </tr>
         </tbody>
      </table>
      <br>
      <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/codigoQr/codigoqr.png" alt="">
   </div>

</body>
