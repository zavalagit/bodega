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



      <div class="tabla">
      <table>
         <thead>
            <tr>
               <th>No</th>
               <th>Folio</th>
               <th>Carpeta</th>
               <th>No. Indicios</th>
               <th>Fecha Salida</th>
               <th>Hora Salida</th>
               <th>Indicios Reingreso</th>
               <th>Fecha Reingreso</th>
               <th>Hora Reingreso</th>
               <th>Naturaleza</th>
               <th>Prestó\Recibió</th>
            </tr>
         </thead>

         <tbody>
            @php
              $indicios_prestamo = 0; 
              $indicios_reingreso = 0;
              $n = 1; 
            @endphp

            @foreach ($reingresos as $key => $reingreso)
              
              {{-- @php
               if ( ($prestamo->prestamo_fecha == $fecha1) || ($prestamo->prestamo_fecha == $fecha2) )
               $indicios_prestamo = $indicios_prestamo + $prestamo->prestamo_numindicios; 


               $indicios_reingreso = $indicios_reingreso + $prestamo->reingreso_numindicios; 
              @endphp --}}


            <tr>               
                  <td>{{$n++}}</td>
                  <td>{{$reingreso->cadena->folio_bodega}}</td>
                  <td>{{$reingreso->cadena->nuc}}</td>                                    
                  @if( ($reingreso->prestamo_fecha == $datos['request']['fecha1']) || ($reingreso->prestamo_fecha == $datos['request']['fecha2']))
                  <td>{{$reingreso->prestamo_numindicios}}</td>
                  @else
                  <td>***</td>
                  @endif
                  <td>{{date('d-m-Y',strtotime($reingreso->prestamo_fecha))}}</td>
                  @if( ($reingreso->prestamo_fecha == $datos['request']['fecha1']) || ($reingreso->prestamo_fecha == $datos['request']['fecha2']))
                  <td>{{$reingreso->prestamo_hora}}</td>
                  @else
                  <td>***</td>
                  @endif
                  
                  <td>{{$reingreso->reingreso_numindicios}}</td>
                  
                  

                  
                    <td>{{date('d-m-Y',strtotime($reingreso->reingreso_fecha))}}</td>
                  

                  
                    <td>{{$reingreso->reingreso_hora}}</td>
                  

                  @isset($reingreso->cadena->entrada->naturaleza_id)
                  <td>{{$reingreso->cadena->entrada->naturaleza->nombre}}</td>
                  @endisset
                  @empty($reingreso->cadena->entrada->naturaleza_id)
                      ---
                  @endempty

                  @isset($reingreso->user2_id)
                    @php
                      $user1 = explode(" ",$reingreso->user1->name);
                      $user1 = $user1[0];
                        $user2 = explode(" ",$reingreso->user2->name);
                        $user2 = $user2[0];
                    @endphp
                    <td>{{$user1}}\{{$user2}}</td>
                  @endisset
                  @empty($reingreso->user2_id)
                    @php
                      $user1 = explode(" ",$reingreso->user1->name);
                      $user1 = $user1[0];
                    @endphp
                    <td>{{$user1}}</td>
                  @endempty
            </tr>
            @endforeach

            {{-- <tr>
              <td colspan="5">Total No. Indicios Prestamo: <b>{{$indicios_prestamo}}</b></td>
              <td colspan="5">Total No. Indicios Reingreso: <b>{{$indicios_reingreso}}</b></td>
            </tr> --}}


         </tbody>
      </table>

     
   </div>
 

</body>
