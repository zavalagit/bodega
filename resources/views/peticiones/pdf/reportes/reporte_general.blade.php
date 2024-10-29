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
      
      {{-- <h3 style="margin:0px !important; "><b>{{Auth::user()->unidad->nombre}}</b></h3> --}}
      
      <h3 style="margin:0px !important;"><b>{{$fecha_formato}}</b></h3>
   </header>

    <div class="header-img">
      <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/logo_fge_pdf.png" alt=""  width="100">
    </div>

   <main>

      <table>
         <thead>
            <tr>
               <th rowspan="2">No.</th>
               <th rowspan="2" style="background-color:#152f4a; color: #c09f77 !important;">ESPECIALIDAD</th>
               <th colspan="{{$fiscalias->count()+1}}" style="background-color:#152f4a; color: #c09f77 !important;">FISCALÍAS</th>  
            </tr>
            <tr>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                  <th style="background-color:#394049; color:#c09f77 !important;">{{$fiscalia->nombre}}</th>
               @endforeach
               <th style="background-color:#394049; color:#c09f77 !important;">TOTAL</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($especialidades->sortBy('nombre')->values() as $i => $especialidad)
               <tr>
                  <td>{{$i+1}}</td>
                  <td style="background-color: yellow;">{{$especialidad->nombre}}</td>
                  @foreach ($fiscalias->sortBy('nombre') as $j => $fiscalia)
                     <td> {{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado'])->count()}} </td>
                  @endforeach
                  <td> {{$peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado'])->count()}} </td>
               </tr>
            @endforeach
            <tr>
               <td>{{$i+2}}</td>
               <td style="background-color: orange;">Informes</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscallia)
                  <td> {{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}} </td>
               @endforeach
               <td> {{$peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}} </td>
            </tr>
            {{-- <tr>
               <td>{{$i+3}}</td>
               <td style="background-color: orange;">Archivo</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscallia)
                  <td> {{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','archivo')->count()}} </td>
               @endforeach
               <td> {{$peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','archivo')->count()}} </td>
            </tr>
            <tr>
               <td>{{$i+4}}</td>
               <td style="background-color: orange;">Salida juzgado</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscallia)
                  <td> {{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','salida_juzgado')->count()}} </td>
               @endforeach
               <td> {{$peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','salida_juzgado')->count()}} </td>
            </tr> --}}
         </tbody>
      </table>
      <br>
      <table>
         <thead>
            <tr>
               <th rowspan="2">No.</th>
               <th rowspan="2" style="background-color:#152f4a; color: #c09f77 !important;">NECROPSIA</th>
               <th colspan="{{$fiscalias->count()+1}}" style="background-color:#152f4a; color: #c09f77 !important;">FISCALÍAS</th>  
            </tr>
            <tr>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                  <th style="background-color:#394049; color:#c09f77 !important;">{{$fiscalia->nombre}}</th>
               @endforeach
               <th style="background-color:#394049; color:#c09f77 !important;">TOTAL</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>1</td>
               <td>Medicina</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                  <td>{{$necro_peticiones->where('fiscalia2_id',$fiscalia->id)->where('unidad3_id',null)->count()}}</td>
               @endforeach
               <td>{{$necro_peticiones->where('unidad3_id',null)->count()}}</td>
            </tr>
            <tr>
               <td>2</td>
               <td>USPEC</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                  <td>{{$necro_peticiones->where('fiscalia2_id',$fiscalia->id)->where('unidad3_id',110)->count()}}</td>
               @endforeach
               <td>{{$necro_peticiones->where('unidad3_id',110)->count()}}</td>
            </tr>
            <tr>
               <td>3</td>
               <td>UECS</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                  <td>{{$necro_peticiones->where('fiscalia2_id',$fiscalia->id)->where('unidad3_id',66)->count()}}</td>
               @endforeach
               <td>{{$necro_peticiones->where('unidad3_id',66)->count()}}</td>
            </tr>
         </tbody>
      </table>


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
