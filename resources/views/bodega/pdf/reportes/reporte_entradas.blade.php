<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>REPORTE</title>

    <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/plugins/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/css/tablas/tabla_reporte.css">
    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/css/encabezados/reporte_encabezado.css">


   <style media="screen">

   @page{
      margin-top: 0.3cm;
      margin-bottom: 0cm;
   }
   body {
      font-size: 0.75em;
      margin: 0.5cm 0 1.5cm 0;

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



/* table thead{
   background-color: #aaa;
   font-size: 8px;
}
th{
   padding: 3px 3px 3px 3px !important;
   border: 0.8px solid #aaa;
}
td{
   background-color: #ffffff;
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
} */
   </style>

</head>

<body>

   @include('bodega.pdf.reportes.reporte_encabezado')

   <div>
      <table>
         <thead>
            <tr>
               <th>No</th>
               <th>Folio</th>
               <th>Carpeta</th>
               <th>No. Indicios</th>
               <th>Hora de entrada</th>
               <th>Fecha de entrada</th>
               <th>Naturaleza</th>
               <th>Responsable bodega</th>
            </tr>
         </thead>

         <tbody>
            @php
              $total_indicios=0;
              $n = 1; 
            @endphp
            @foreach ($entradas as $key => $entrada)
            <tr>               
                  <td>{{$n++}}</td>
                  <td>{{$entrada->cadena->folio_bodega}}</td>
                  <td>{{$entrada->cadena->nuc}}</td>
                  @php
                     $numero_indicios=0;
                  @endphp
                  @foreach ($entrada->cadena->indicios as $k => $indicio)
                     @php
                        $numero_indicios = $numero_indicios + $indicio->numero_indicios;
                        $total_indicios = $total_indicios + $indicio->numero_indicios
                     @endphp
                  @endforeach
                  <td>{{$numero_indicios}}</td>
                  <td>{{$entrada->hora}}</td>
                  <td>{{date('d-m-Y',strtotime($entrada->fecha))}}</td>
                  <td>{{$entrada->naturaleza->nombre}}</td>
                  <td>{{$entrada->user->name}}</td>
            </tr>
            @endforeach
            <tr>
              <td colspan="8"><b>Total ingresos = {{$total_indicios}}</b></td>
            </tr>
         </tbody>
      </table>
   </div>

   @include('bodega.pdf.reportes.reporte_firmas')
</body>
