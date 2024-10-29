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
          margin-top: 1%;
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
          top: -8%;
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
        #titulo h3 {
            background-color: #c09f77;
          color: #152F4A;
          padding-top: 5px;
          padding-bottom: 5px;
          text-align: center;
          font-size: 16px;
          margin:0 !important;

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
            border: 1px solid #394049 !important;
            font-size: 10px !important;
        }
        table td{
            padding-left: 8px !important;
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
      <h3><b>FISCALÍA GENERAL DEL ESTADO DE MICHOACÁN</b></h3>
    </header>
    <div class="header-img">
      <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/logo_fge_pdf.png" alt=""  width="100">
    </div>

    <main>
        <div id="titulo">
            <h3><b>FISCALÍA {{Auth::user()->fiscalia->nombre}}</b></h3>
            @if (Auth::user()->tipo === 'director_unidad')
            <h3><b>FISCALÍA {{Auth::user()->unidad->nombre}}</b></h3>
            @endif
        </div>

        
        <table class="highlight bordered centered">
         <thead>
           <tr>
             <th>No.</th>
             <th>ESTADO</th>
             <th style="text-align:left;">PERITO</th>
             <th>UNIDAD</th>  
             <th style="text-align:left;">N.U.C.</th>
             <th>FECHA PETICIÓN</th>
             <th>NÚMERO OFICIO</th>
             <th>FECHA ELABORACIÓN</th>
             <th>DOCUMENTO EMITIDO</th>
             <th>ESPECIALIDAD</th>
             <th style="text-align:left;">SOLICITUD</th>
             <th>FECHA DE ENTREGA</th>
           </tr>
         </thead>
         <tbody>
                @php
                $no_consecutivo = 1;
                @endphp
                @foreach ($peticiones as $peticion)
                   <tr>
                      <td class="td-no" style="width:3%;">{{$no_consecutivo++}}</td>
                      <td class="td-no" style="width:3%;">{{$peticion->estado}}</td>
                      <td style="text-align:left;width:15%;">{{$peticion->user->name}}</td>
                      <td>{{$peticion->unidad->nombre}}</td>  
                      <td style="text-align:left;">{{$peticion->nuc}}</td>
                      <td style="width:6%;">{{$peticion->fecha_peticion}}</td>
                      <td style="width:8%;">{{$peticion->oficio_numero}}</td>
                      <!--2da etapa-->
                      <td style="width:6%;">
                         @isset($peticion->fecha_elaboracion)
                            {{$peticion->fecha_elaboracion}}  
                         @endisset
                         @empty($peticion->fecha_elaboracion)
                               ---
                         @endempty
                      </td>
                      <td style="width:8%;">
                         @isset($peticion->documento_emitido)
                            {{strtoupper($peticion->documento_emitido)}} 
                         @endisset
                         @empty($peticion->documento_emitido)
                               ---
                         @endempty
                      </td>
                      <td style="width:8%;">
                        @isset($peticion->solicitud_id)
                           {{$peticion->solicitud->especialidad->nombre}} 
                        @endisset
                        @empty($peticion->solicitud_id)
                              ---
                        @endempty
                     </td>
                      <td style="text-align:left;width:10%;">
                         @isset($peticion->solicitud_id)
                            {{$peticion->solicitud->nombre}} 
                         @endisset
                         @empty($peticion->solicitud_id)
                               ---
                         @endempty
                      </td>
                     
                      <!--3ra etapa-->
                      <td style="width:6%;">
                         @isset($peticion->fecha_entrega)
                           {{$peticion->fecha_entrega}}
                         @endisset
                         @empty($peticion->fecha_entrega)
                               ---
                         @endempty
                      </td>
                      
                      
                      
                      
                      

                   </tr>
                @endforeach
         </tbody>
       </table>
            
        
    </main>

</body>
</html>
