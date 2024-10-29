<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title></title>
    
      <style>
         @page{
            /* margin: 2.5cm 1cm; */
            margin-top: 2.5cm;
            margin-left: 1cm;
            margin-bottom: 1cm;
            margin-right: 1cm;
         }
         header{
            position: fixed;
            top: -2.2cm;
            left: 0px;
            right: 0px;

            background-color: #152f4a;
            height: 2.2cm;
         }
         header table,
         header table tr,
         header table tr td{
            border: hidden !important;
         }
         header table tr td{
            color: #c09f77;
         }
         main{
            margin-top: 2%;
         }
        table{
           width: 100%;
        }
        table th,table td{
           background-color #fff;
           color:#394049;
            border: 1px solid #394049 !important;
            font-size: 10px !important;
        }
        table td{
            padding-left: 8px !important;
        }
        th{
            background-color: #fff;
            color:#394049;
        }
        

/* .vertical{
   writing-mode: vertical-lr;
transform: rotate(90deg);
-webkit-transform: rotate(-90deg);
-moz-transform: rotate(-90deg);
} */

    </style>

  </head>

<body >

   
   <header>
      <table>
         <tr>
            <td rowspan="3" width="20%" style="text-align:center; vertical-align:middle !important;">
               <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/logo_fge_pdf.png" alt=""  width="61">
            </td>
            <td width="80%">
               <h3 style="margin:0px !important; padding-right: 2%;text-align: right;"><b>FISCALÍA GENERAL DEL ESTADO DE MICHOACÁN</b></h3>
            </td>
         </tr>
         <tr>
            <td>
               <h3 style="margin:0px !important; padding-right: 2%;text-align: right;"><b>{{Auth::user()->unidad->nombre}}</b></h3>
            </td>
         </tr>
         <tr>
            <td>
               <h3 style="margin:0px !important; padding-right: 2%;text-align: right;"><b>Fecha: {{$fecha_formato}}</b></h3>
            </td>
         </tr>
      </table>
   </header>

    

   <main>        
      @if ( Auth::user()->unidad_id == 1 )
         @include('peticion.reportes.quimica_genetica.'.$reporte_tipo)
      @elseif ( Auth::user()->unidad_id == 2 )
         @include('peticion.reportes.medicina_forense.'.$reporte_tipo)
      @elseif ( Auth::user()->unidad_id == 3 )
         @include('peticion.reportes.criminalistica.'.$reporte_tipo)
      @endif
      
      <br>
      <br>
      <br>
      
      <table style="border: 0px !important;">
         <tr>
           <td style="border: 0px !important; text-align: center;">COORDINADOR GENERAL DE SERVICIOS PERICIALES <br> DR. EN D. PEDRO GUTIERREZ GUTIERREZ</td>
           <td style="border: 0px !important; text-align: center;">TITULAR DE LA {{Auth::user()->unidad->nombre}}<br> {{Auth::user()->name}}</td>
         </tr>
         <br>
         <!--
         <tr>
            <td style="border: 0 0 1px 0 solid #000 !important; text-align: center;"><br></td>
            <td style="border: 0 0 1px 0 solid #000 !important; text-align: center;"><br></td>
         </tr>
      -->
       </table>
   </main>

</body>
</html>
