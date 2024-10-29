<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <title>E-G-I</title>

<!--
   <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/plugins/materialize/css/materialize.min.css">
-->

   <style media="screen">
     @page{
         margin-top: 0.3cm;
         margin-bottom: 0.3cm;
      }
      body {
         font-size: 0.80em !important;
         margin: 0 0 0 0;
      }
     
      hr {
        page-break-after: always;
        border: 0;
      }
      .contenido{
         margin: 0;
         width: 700px;
         height: auto;
         padding: 8px;
         border: 0.5px solid #1a237e;
         border-radius: 20px;
      }
      table{
         width: 700px;
         height: auto;
      }
      td{
         border: 0.5px solid #e0e0e0;
      }
      img{
         width: 60px !important;
      }
      .tdfecha{
         
      }
   </style>

</head>
<body>


   @foreach($cadena->indicios as $key => $indicio)
      @if($key != 0)
       <hr>
      @endif
      <div class="contenido" style="font-size:7px">
         {{--
            <div align="right" style="font-size:20px">
               <b>{{$cadena->folio_bodega}}</b>
            </div>
         --}}
            
         <table cellspacing="0">
            <tr align="center" >
               <td><img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/fge_etiqueta.png" alt=""></td>
               <td style="font-size:6px"><h2><b>FORMATO DE ETIQUETADO [FE]</b></h2></td>
            </tr>
            <tr align="center">
               <td colspan="2"><b>N.U.C(&nbsp;X&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;C.I.(&nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;P.P.(&nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;Otro(&nbsp;&nbsp;&nbsp;)</b></td>
            </tr>
            <tr>            
               <td colspan="2"><b> NO.</b> {{$cadena->nuc}} </td>         
            </tr>
            <tr>
               <td><b>FECHA: </b>{{date('d-m-Y',strtotime($indicio->fecha))}}</td>
               <td><b>HORA: </b>                  
                     {{date('H:i:s',strtotime($indicio->hora))}}
               </td>
            </tr>
            <tr>
               <td colspan="2"> <b>DESCRIPCIÓN GENERAL DEL INDICIO Y/O ELEMENTO MATERIAL PROBATORIO: </b></td>
            </tr>
            <tr>
               <td colspan="2">{{$indicio->identificador}}: {{$indicio->descripcion}}</td>
            </tr>
            <tr>
               <td colspan="2"><b>RECOLECTADO DE: </b></td>
            </tr>         
            <tr>               
               @if($indicio->recolectado_de != '')               
                  <td colspan="2">{{$indicio->recolectado_de}}</td>
               @else
                  <td colspan="2">{{$indicio->indicio_ubicacion_lugar}}</td>
               @endif
            </tr>         
            <tr>
               <td colspan="2"><b>ESTADO DEL INDICIO Y/O ELEMENTO MATERIAL PROBATORIO:</b></td>
            </tr>
            @if($indicio->condicion)                                   
               <tr>
                  <td colspan="2">{{$indicio->condicion}}</td>
               </tr>
            @endif                                    
            <tr>               
               <td colspan="2"><b>NO. DE INDICIO (s) Y/O ELEMENTO MATERIAL PROBATORIO: </b>
            </tr>
            <tr>
               <td colspan="2">                                 
                  {{$indicio->identificador}}
               </td>               
            </tr>
               </td>
            </tr>
            <tr>
               <td colspan="2"><b>OBSERVACIONES:</b></td>         
            </tr>
            @if($indicio->observacion != NULL)
            <tr>            
               <td colspan="2">{{$indicio->observacion}}</td>
            </tr>
            @endif
            <tr>
               <td colspan="2"><b>NOMBRE Y FIRMA DE QUIEN RECOLECTA EL INDICIO Y/O ELEMENTO MATERIAL PROBATORIO:</b></td>
            </tr>
            <tr>
               <td colspan="2">{{$cadena->user->name}}</td>
            </tr>
            <tr >
               <td class="tdfecha"><b>CARGO:</b></td>
               <td colspan="1"><b>IDENTIFICACIÓN:</b></td>
            </tr>
            <tr align="center">
               <td>{{$cadena->user->cargo->nombre}}</td>
               <td>{{$cadena->user->folio}}</td>
            </tr>
            <tr align="center" >
               <td aling="center" colspan="2" rowspan="1"><b>FIRMA: ____________________________________</td>
            </tr>
            <tr>
               <td colspan="2" class="td-qr"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(10)->margin(0)->errorCorrection('H')->generate("http://201.116.252.147/codigoQR/$cadena->id")) !!} "></td>          
            </tr>
         </table>
      </div>
   @endforeach  

</body>
