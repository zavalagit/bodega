<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Anexo 4</title>

  <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/plugins/materialize/css/materialize.css">
  <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/css/baja/baja_pdf.css">

  <style media="screen">
  </style>

</head>
<body>

   <header>
      <div class="header-folio">
         <p><b>{{$baja->cadena->folio_bodega}}</b></p>
      </div>

      <table border="0" style="width: 100%; margin-bottom: 0 !important;">
         <tr>
            <td style="width: 25%;">
               <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/fge_etiqueta_1.png" alt="" width="100"/>
            </td>
            <td style="width: 50%;">
               <p style="font-size:13px; text-align:center;"><b>FISCALÍA GENERAL DEL ESTADO DE MICHOACÁN</b></p>
               <p style="font-size:11px; text-align:center;"><b>FORMATO DE ENTREGA-RECEPCIÓN DE INDICIOS</b></p>
               <p style="font-size:11px; text-align:center;">  <b> Y/O ELEMENTOS MATERIALES PROBATORIOS </b> </p>
               <p style="font-size:11px; text-align:center;"> (BAJA) </p>
            </td>
            <td style="width: 25%; text-align: right;">
               <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/escudo_mich_4.png" alt="" height="100"/>
            </td>
         </tr>
      </table>

      <div class="header-nuc">
         <p class="nuc1">Nº REFERENCIA</p>
         <p class="nuc2"><b>{{$baja->cadena->nuc}}</b></p>
      </div>
   </header>

    <main>
      <section id="seccion-uno">
        <table class="tabla tabla-seccion-uno">
          <thead>
            <tr>
                <th>Folio o llamado</th>
                <th>Lugar de entrega-recepción</th>
                <th>Fecha y hora de entrega recepción</th>
            </tr>
          </thead>
          <tbody>
            <tr>
               <td width="20%">{{$baja->cadena->folio_bodega}}</td>
              <td width="50%">BODEGA DE EVIDENCIAS</td>
              <td width="30%">{{date('H:i:s',strtotime($baja->hora))}} {{date('d-m-Y',strtotime($baja->fecha))}}</td>
            </tr>
          </tbody>
        </table>
      </section>

      <section id="seccion-dos">
        <div class="">
          <p style="text-align: justify; font-size:11px;">
            <b>1. Inventario.</b> (Escriba el número, letra o combinación alfanumérica
              con la que se identifica a cada indicio o elemento marial probatorio que se
              entrega, así como su tipo o clase. Cancele los espacios sobrantes.)
          </p>
        </div>
        <div class="">
          <table class="tabla tabla-indicios">
            <thead>
              <tr>
                <th>Identificación</th>
                <th>Descripción</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($baja->indicios as $indicio)
                <tr>
                  <td width="20%">{{$indicio->identificador}}</td>
                  <td style="text-align: justify; padding: 0 6px 0 3px;">{{$indicio->pivot->baja_tipo == 'completa' ? $indicio->descripcion : $indicio->pivot->baja_descripcion}}</td>
                </tr>                 
              @endforeach
            </tbody>
          </table>
        </div>
      </section>

      <section class="seccion-tres">
        <div class="">
          <p style="text-align: justify; font-size:11px;">
            <b>2. Embalaje.</b> (Señale las condiciones en las que se encuentran los embalajes.
            Cuando alguno de ellos presente alteración, deterioro o cualquier otra anomalía,
            especifique dicha condición.)
          </p>
        </div>

        <div class="">
          <table class="tabla">
             <tbody>
                <tr>
                <td style="text-align: left; padding-left:5px; font-size:11px">{{$baja->embalaje}}</td>
                </tr>
             </tbody>
          </table>
        </div>
      </section>

      <section class="seccion-cuatro">
          <table class="">
             <tbody>
               <tr>
                  <td style="border: 1px solid #737272; text-align: center; font-size:10px; padding:0; margin:0; background-color: #c6c6c6;" width="40%"><b>ENTREGA</b></td>
                  <td style="padding:0; margin:0"></td>
                  <td style="border: 1px solid #737272; text-align: center; font-size:10px; padding:0; background-color: #c6c6c6;" width="40%"><b>RECIBE</b></td>
               </tr>
                <tr>
                  <td style="border: 1px solid #737272; padding-top:30px;"></td>
                   <td style="text-align: center; padding:0;"></td>
                   <td style="border: 1px solid #737272; padding-top:30px;"></td>
                </tr>
                <tr>
                   <td style="border: 1px solid #737272; text-align: center; font-size:10px; padding:0; margin:0;">{{$baja->user->name}}</td>
                   <td style="padding:0; margin:0"></td>
                  <td style="border: 1px solid #737272; text-align: center; font-size:10px; padding:0;">
                     @isset($baja->perito_id)
                        {{$baja->perito->nombre}}
                     @endisset
                     @isset($baja->quien_recibe)
                        {{$baja->quien_recibe}}
                     @endisset
                  </td>  
                </tr>
                <tr>
                   <td style="border: 1px solid #737272; text-align: center; font-size:10px; padding:0;">{{$baja->user->institucion->nombre}} {{$baja->user->cargo->nombre}} {{$baja->user->folio}}</td>
                   <td style="padding:0; margin:0"></td>
                   <td style="border: 1px solid #737272; text-align: center; font-size:10px; padding:0;">
                     @isset($baja->perito_id)
                        {{$baja->perito->institucion->nombre}} {{$baja->perito->cargo->nombre}} {{$baja->perito->folio}}
                     @endisset
                     @isset($baja->quien_recibe)
                        {{$baja->identificacion}}
                     @endisset
                  </td> 
                </tr>
                <tr>
                   <td style="border: 1px solid #737272; text-align: center; font-size:10px; padding:0px;"> <b>Nombre completo, institución, cargo y firma</b> </td>
                   <td style="padding:0;"></td>
                   <td style="border: 1px solid #737272; text-align: center; font-size:10px; padding:0px;">
                     <b>
                     @isset($baja->perito_id)
                        Nombre completo, institución, cargo y firma
                     @endisset
                     @isset($baja->quien_recibe)
                        Nombre, identificación y firma
                     @endisset
                     </b>
                  </td>
                </tr>
             </tbody>
          </table>
      </section>

    </main>




</body>
</html>
