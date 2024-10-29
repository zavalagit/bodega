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




   </style>

</head>

<body>

   @include('bodega.pdf.reportes.reporte_encabezado')

   <div>
      <table>
         <thead>
            <tr>
               <th>Folio</th>
               <th>Carpeta</th>
               <th>No. Indicios</th>
               <th>Fecha</th>
               <th>Hora</th>
               <th>Naturaleza</th>
               <th>Tipo de baja</th>
               <th>Responsable bodega</th>
            </tr>
         </thead>

         <tbody>
            @foreach ($bajas as $key => $baja)
               <tr>                                 
                  <td>{{$baja->cadena->folio_bodega}}</td>
                  <td>{{$baja->cadena->nuc}}</td>
                  <td>{{$baja->numero_indicios}}</td>
                  <td>{{$baja->fecha}}</td>
                  <td>{{$baja->hora}}</td>
                  <td>{{$baja->cadena->entrada->naturaleza->nombre}}</td>
                  <td>{{strtoupper($baja->tipo)}}</td>
                  <td>{{$baja->user->name}}</td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>

   @include('bodega.pdf.reportes.reporte_firmas')
   
  
 

</body>
