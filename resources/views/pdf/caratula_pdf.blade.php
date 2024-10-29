<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>CARATULA</title>

    <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/plugins/materialize/css/materialize.min.css">


   <style media="screen">

   @page{
      margin-top: 0cm;
      margin-bottom: 0cm;
      margin-right: 4cm;
      margin-left: 4cm;
   }
   body {
      font-size: 0.75em;
      margin: 0cm 0 0cm;
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

table{
  font-size: 15px !important;
}

table thead{
   background-color: #aaa;
}
th{
   padding: 3px 3px 3px 3px !important;
   border: 0.8px solid #aaa;
}
.tabla td{
   border: 0.8px solid #aaa;
   padding: 3px 3px 3px 3px;
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
.tdfirma{
   padding-top: 70px !important;
}
.tddatos{
   padding-top: 0px !important;
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

h3{
  margin: 0 !important;
  padding: 0 !important;
  font-size: 35px;
}
   </style>

</head>

<body>


   <div class="tabla">
      <table class="">
         <caption class="amber"><h3><b>{{$fecha}}</b></h3></caption>
         <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($entradas as $key => $entrada)
               @if($no%2 == 0)
                  <tr>
               @else
                  <tr class="grey lighten-2">
               @endif
                     <td width="30%"><b>{{$entrada->cadena->folio_bodega}}</b></td>
                     <td width="40%"><b>{{$entrada->cadena->nuc}}</b></td>                  
                     <td width="30%"><b>{{date('H:i:s',strtotime($entrada->hora))}}</b></td>
                  </tr>
               @php
                   ++$no;
               @endphp
            @endforeach
         </tbody>
      </table>
   </div>

  

</body>
