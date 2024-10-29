<!DOCTYPE html>
<html lang="es">
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
          margin-top: 9%;
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
          top: -7%;
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
        #titulo h4 {
            background-color: #c09f77;
          color: #152F4A;
          /*padding-top: 5px;
          padding-bottom: 5px;*/
          text-align: center;
          font-size: 16px;
          margin:0 !important;*/

        }
        .encabezado h6{
          background-color: #394049;
          color: #c6c6c6;
          padding-top: 5px;
          padding-bottom: 5px;
          text-align: center;
          font-size: 16px;

        }
        .encabezadofinal h6{
          background-color: #394049;
          color: #c09f77;
          padding-top: 5px;
          padding-bottom: 5px;
          text-align: center;
          font-size: 16px;

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
        caption{
            border: 1px solid #394049 !important;
  background-color: #c09f77 !important;
  color: #c09f77;
}

.vertical{
   writing-mode: vertical-lr;
transform: rotate(90deg);
-webkit-transform: rotate(-90deg);
-moz-transform: rotate(-90deg);
}

    </style>

  </head>

<body >

   
   <header>
      <h3 style="margin:0px !important;"><b>FISCALÍA GENERAL DEL ESTADO DE MICHOACÁN</b></h3>
      @if (Auth::user()->tipo === 'director_fiscalia')
      <h3><b>FISCALÍA {{Auth::user()->fiscalia->nombre}}</b></h3>
      @endif
      @if (Auth::user()->tipo === 'director_unidad')
      <h3 style="margin:0px !important; "><b>{{Auth::user()->unidad->nombre}}</b></h3>
      @endif
      <h3 style="margin:0px !important;"><b>{{$fecha_encabezado}}</b></h3>
   </header>

    <div class="header-img">
      <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/logo_fge_pdf.png" alt=""  width="100">
    </div>

    <main>
        
      {{--
      <div id="titulo">
         <h4><b>FISCALÍA {{Auth::user()->fiscalia->nombre}}</b></h4>
         @if (Auth::user()->tipo === 'director_unidad')
         <h4><b>FISCALÍA {{Auth::user()->unidad->nombre}}</b></h4>
         @endif
     </div>
     --}}

        @foreach ($especialidades->sortBy('nombre') as $especialidad)
         <table>
            <caption><b>{{mb_strtoupper($especialidad->nombre)}}</b></caption>
            <thead>
               <tr>
                  <th rowspan="2">No.</th>
                  <th rowspan="2">SOLICITUD</th>   
                  <th colspan="{{$fiscalias->count()+1}}">FISCALÍAS</th>   
               </tr>
               <tr>
                  @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                      <th>{{$fiscalia->nombre}}</th>
                  @endforeach
                  <th>TOTAL</th>
               </tr>
            </thead>
            <tbody>
               @php $n = 1; @endphp
               @foreach ($especialidad->solicitudes->sortBy('nombre') as $solicitud)
                  <tr>
                     <td>{{$n++}}</td>
                     <td style="text-align: justify; padding-right:5px !important;">{{$solicitud->nombre}}</td>
                     @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                        <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->where('solicitud_id',$solicitud->id)->where('documento_emitido','dictamen')->count()}}</td>
                     @endforeach
                     <td>{{$peticiones->where('solicitud_id',$solicitud->id)->where('documento_emitido','dictamen')->count()}}</td>
                  </tr>
               @endforeach
               

               <tr>
                  <td>{{$n++}}</td>
                  <td>INFORMES</td>
                     @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                         <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}}</td>
                     @endforeach
                  <td>{{$peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}}</td>
               </tr>
			   <tr>
                  <td>{{$n++}}</td>
                  <td>CERTIFICADOS</td>
                     @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                         <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','certificado')->count()}}</td>
                     @endforeach
                  <td>{{$peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','certificado')->count()}}</td>
               </tr>
               <tr>
                  <td>{{$n++}}</td>
                  <td>TOTAL</td>
                  @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                     <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado','informe'])->count()}}</td>
                  @endforeach
                     <td>{{ number_format($peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado','informe'])->count() ) }}</td>
               </tr>
            </tbody>   
         </table>
         
         <br>
        @endforeach
        
                  
        

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
