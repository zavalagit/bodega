<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>LISTADO</title>

    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/plugins/materialize/css/materialize.min.css">


   <style media="screen">

   @page{
      margin-top: 0cm;
      margin-bottom: 0cm;
      margin-right: 1cm;
      margin-left: 1cm;
   }
   body {
      font-size: 0.0em;
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
  font-size: 6px !important;
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

h5{
  margin: 0 !important;
  padding: 10px !important;
  font-size: 18px;
}
.border-no{
  border: 0px !important;
}
   </style>

</head>

<body>

   <div class="tabla">
      <table>
         <tr>
            <th>Periodo</th>
            <td>{{$buscar_fecha_inicio}} - {{$buscar_fecha_fin}}</td>
         </tr>
      </table>
   </div>

   <div class="tabla">
      <table>
         <thead>
            <tr>
               <th>Región</th>
               <th>Indicios</th>
               <th>Evidencias</th>
               <th>I/E Prestamos</th>
               <th>I/E Bajas</th>
            </tr>
         </thead>
         <tbody>
            @isset($array_estadistica)
               
                @foreach ($array_estadistica as $key => $fiscalia)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$fiscalia['indicios']}}</td>
                        <td>{{$fiscalia['evidencias']}}</td>
                        <td>{{$fiscalia['prestamos']}}</td>
                        <td>{{$fiscalia['bajas']}}</td>
                    </tr>
                @endforeach
                <tr style="background-color:#c09f77">
                    <td> <b>TOTAL</b> </td>
                    <td><b>{{number_format( array_sum(array_column($array_estadistica,'indicios')) )}}</b></td>
                    <td><b>{{number_format( array_sum(array_column($array_estadistica,'evidencias')) )}}</b></td>
                    <td><b>{{number_format( array_sum(array_column($array_estadistica,'prestamos')) )}}</b></td>
                    <td><b>{{number_format( array_sum(array_column($array_estadistica,'bajas')) )}}</b></td>
                </tr>
            @endisset
            @empty($array_estadistica)
                <tr>
                    <td colspan="5">no hay</td>
                </tr>
            @endempty
         </tbody>
      </table>
   </div>

</body>
