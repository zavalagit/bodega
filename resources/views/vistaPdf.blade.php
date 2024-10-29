<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Anexo 3</title>

   <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/plugins/materialize/css/materialize.css">


   <style media="screen">

   @page{
      margin-top: 0cm;
      margin-bottom: 1.7cm;
   }
   body {
      font-size: 0.65em;
      margin: 7.3cm 0 1.4cm 0;
   }

#header,
#footer {
  position: fixed;
  left: 0;
  right: 0;
  font-size: 0.6em;
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

table thead{
   background-color: #aaa;
}
th{
   padding: 3px 3px 3px 3px !important;
   border: 0.8px solid #aaa;
}
.tabla td{
   background-color: #ffffff;
   border: 0.8px solid #aaa;
   padding: 1px 1px 1px 1px;
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

.tr-sp td{
	height:35px !important;
}

   </style>

</head>

<body>


   <div id="header">
      <div class="right-align">
         <h1><b>{{$data->folio_bodega}}</b></h1>
      </div>
     <table class="centered">
       <tr bgcolor="#a0aca4">
         <td align="center">
            <img src="/var/www/html/bodega/public/imagenes/pdf1.png" alt="">
         </td>
         <td align="center">
            <h4><b>Formato de entrega-recepción de indicios y/o elementos materiales probatorios</b></h4>
            <h4>Registro de Cadena de Custodia</h4>
            <h4>(Anexo 3)</h4>
         </td>
         <td align="center">
            <img src="/var/www/html/bodega/public/imagenes/pdf2.png" alt="">
         </td>
       </tr>
     </table>
     <br>
     <div class="right grey div-nuc">
        <h5 class="grey lighten-2">
           <b>No. de referencia</b>
        </h5>
        <p class="p-nuc"><b>{{$data->nuc}}</b></p>
     </div>
  </div>

   <div id="footer">
      <div class="">
         <p>
            Periférico Independencia N° 5000, Col. Sentimientos de la Nación
            Morelia, Michoacán, México, C.P. 58170, Tel. 443 322 3600 Ext. 1021
            pgje.michoacan.gob.mx
         </p>
      </div>
     <div class="page-number"></div>
   </div>


      <div class="contenido">
         <div class="">
            <table class="tabla centered bordered">
                  <thead>
                     <tr>
                        <th>Institución o Unidad Administrativa</th>
                        <th>Folio o llamado</th>
                        <th>Lugar de intervención</th>
                        <th>Hora y fecha de intervención</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>{{$data->unidad->nombre}}</td>
                        <td>{{$data->folio}}</td>
                        <td>{{$data->intervencion_lugar}}</td>
                        <td>{{$data->intervencion_hora}} / {{date('d-m-Y', strtotime($data->intervencion_fecha))}}</td>
                     </tr>
                  </tbody>
            </table>
         </div>

         <br>

         <div class="">
            <p class="center-align">Inicio de la Cadena de custodia. (Marque con “X” el motivo por el cual comienza el registro).</p>
            <table class="tabla centered">
               <tr>
                  @if ($data->motivo == 'localizacion')
                     <td>Localización [ x ]</td>
                  @else
                     <td>Localización [&nbsp;&nbsp;&nbsp;&nbsp;]</td>
                  @endif

                  @if ($data->motivo == 'descubrimiento')
                     <td>Descubrimiento [ x ]</td>
                  @else
                     <td>Descubrimiento [&nbsp;&nbsp;&nbsp;&nbsp;]</td>
                  @endif

                  @if ($data->motivo == 'aportacion')
                     <td>Aportación [ x ]</td>
                  @else
                     <td>Aportación [&nbsp;&nbsp;&nbsp;&nbsp;]</td>
                  @endif

               </tr>
            </table>
         </div>

         <div class="">
            <p><b>1. Identidad.</b> (Número, letra o combinación alfanumérica asignada al indicio o elemento material probatorio, descripción general, incluyendo en su caso el estado o condición original en el momento de su recolección, ubicación en el lugar de intervención y hora de recolección. Relacione la identificación por secuencias cuando se trate de indicios o elementos materiales probatorios del mismo tipo o clase, en caso contrario, regístrese individualmente. Cancele los espacios sobrantes).</p>

            <table class="tabla">
               <thead>
                  <tr>
                     <th style="text-align: center">Identificación</th>
                     <th>Descripción</th>
                     <th style="text-align: center">Ubicación en el lugar</th>
                     <th style="text-align: center">Hora</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($data->indicios as $key => $indicio)
                     <tr>
                        <td style="text-align: center">{{$indicio->identificador}}</td>
                        <td>{{$indicio->descripcion}}</td>
                        <td style="text-align: center">{{$indicio->indicio_ubicacion_lugar}}</td>
                        <td style="text-align: center">{{date('d-m-Y', strtotime($indicio->fecha))}} {{$indicio->hora}}</td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>

         <br>

         <div class="">
            <p><b>2. Documentación.</b> (Coloque el número, letra o combinación de los indicios o elementos materiales de acuerdo al tipo de embalaje que sea).</p>
            <table class="tabla">
               <tr>
                  @if ($data->escrito == 'si')
                     <td>Escrito: Si[ x ] No[&nbsp;&nbsp;&nbsp;]</td>
                  @else
                     <td>Escrito: Si[&nbsp;&nbsp;&nbsp;] No[ x ]</td>
                  @endif

                  @if ($data->fotografico == 'si')
                     <td>Fotográfico: Si[ x ] No[&nbsp;&nbsp;&nbsp;]</td>
                  @else
                     <td>Fotogáfico: Si[&nbsp;&nbsp;&nbsp;] No[ x ]</td>
                  @endif

                  @if ($data->croquis == 'si')
                     <td>Croquis: Si[ x ] No[&nbsp;&nbsp;&nbsp;]</td>
                  @else
                     <td>Croquis: Si[&nbsp;&nbsp;&nbsp;] No[ x ]</td>
                  @endif
               </tr>
            </table>
            <table class="tabla">
               <tr>
                  @if ($data->otro == 'si')
                     <td>Otro: Si[ x ] No[&nbsp;&nbsp;&nbsp;]</td>
                  @else
                     <td>Otro: Si[&nbsp;&nbsp;&nbsp;] No[ x ]</td>
                  @endif

                  <td>Especifique:{{$data->especifique}}</td>
               </tr>
            </table>
         </div>
         <br>

         <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/codigoQr/codigoqr.png" alt="">

      </div><!--div contenido 1er página-->

      <hr/>

      <div class="contenido">

         <div class="">
            <p><b>3. Recolección.</b> (Coloque el número, letra o combinación de los indicios o elementos materiales probatorios de acuerdo a las condiciones de cómo fueron levantados según corresponda. Puede emplear intervalos).</p>
            <table class="tabla centered">
               <thead>
                  <tr>
                     <th>Manual</th>
                     <th>Instrumental</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>
                        @foreach ($data->indicios as $key => $indicio)
                           @if ($indicio->recoleccion === 'manual')
                              @if ($key != 0)
                                 ,
                              @endif
                              {{$indicio->identificador}}
                           @endif
                        @endforeach
                     </td>
                     <td>
                        @foreach ($data->indicios as $key => $indicio)
                           @if ($indicio->recoleccion === 'instrumental')
                              @if ($key != 0)
                                 ,
                              @endif
                              {{$indicio->identificador}}
                           @endif
                        @endforeach
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>

         <br>

         <div class="">
            <p><b>4. Empaque/embalaje.</b> (coloque el número, letra o combinación de los indicios o elementos materiales de acuerdo al tipo de embalaje que se empleó para su preservación o conservación, según corresponda. Puede emplear intervalos).</p>
            <table class="tabla centered">
               <thead>
                  <tr>
                     <th>Bolsa</th>
                     <th>Caja</th>
                     <th>Recipiente</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>
                        @foreach ($data->indicios as $key => $indicio)
                           @if ($indicio->embalaje === 'bolsa')
                              @if ($key != 0)
                                 ,
                              @endif
                              {{$indicio->identificador}}
                           @endif
                        @endforeach
                     </td>
                     <td>
                        @foreach ($data->indicios as $key => $indicio)
                           @if ($indicio->embalaje === 'caja')
                              @if ($key != 0)
                                 ,
                              @endif
                              {{$indicio->identificador}}
                           @endif
                        @endforeach
                     </td>
                     <td>
                        @foreach ($data->indicios as $key => $indicio)
                           @if ($indicio->embalaje === 'recipiente')
                              @if ($key != 0)
                                 ,
                              @endif
                              {{$indicio->identificador}}
                           @endif
                        @endforeach
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>

         <br>

         <div class="">
            <p><b>5. Servidores públicos.</b> (Todo servidor público que haya participado en el procesamiento de los indicios o elementos materiales probatorios deberá escribir su nombre completo, la institución a la que pertenece, su cargo, la etapa del procedimiento en la que intervino y su firma autógrafa. Se deberán cancelar los espacios sobrantes).</p>
            <table class="tabla centered">
               <thead>
                  <tr>
                     <th>Nombre</th>
                     <th>Institución</th>
                     <th>Cargo</th>
                     <th>Etapa</th>
                     <th>Firma</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($data->users as $s)
                     <tr class='tr-sp'>
                        <td>{{$s->name}}</td>
                        <td>PGJE</td>
                        <td>{{$s->cargo->nombre}}</td>
                        <td>{{$s->pivot->etapa}}</td>
                        <td></td>
                     </tr>
                  @endforeach                
               </tbody>
            </table>
         </div>

         <br>

         <p><b>6. Traslado.</b> (Marque con “X” la vía empleada. En caso de ser necesaria alguna condición o preservación de un inicio o elemento material probatorio en particular. El personal o policial con capacidades para el procesar, según sea el caso, deberá recomendarla). </p>
         @if ($data->traslado == 'terrestre')
            <p><b>a) Via:</b> Terrestre[ x ] Aerea[&nbsp;&nbsp;&nbsp;] Maritima[&nbsp;&nbsp;&nbsp;]</p>
         @endif
         @if ($data->traslado == 'aerea')
            <p><b>a) Via:</b> Terrestre[&nbsp;&nbsp;&nbsp;] Aerea[ x ] Maritima[&nbsp;&nbsp;&nbsp;]</p>
         @endif
         @if ($data->traslado == 'maritima')
            <p><b>a) Via:</b> Terrestre[&nbsp;&nbsp;&nbsp;] Aerea[&nbsp;&nbsp;&nbsp;] Maritima[ x ]</p>
         @endif

         @if ($data->trasladoCondiciones == 'si')
            <p><b>b) Se requieren condiciones especiales para su tralado:</b> Si[ x ] No[&nbsp;&nbsp;&nbsp;]</p>
            <p>Recomendaciones:</p>
            <table class="tabla">
               <tr>
                  <td>
                     {{$data->trasladoRecomendaciones}}
                  </td>
               </tr>
            </table>
         @endif
         @if ($data->trasladoCondiciones == 'no')
            <p><b>b) Se requieren condiciones especiales para su traslado:</b> Si[&nbsp;&nbsp;&nbsp;] No[ x ]</p>
            <p>Recomendaciones:</p>
            <table class="tabla">
               <tr>
                  <td>
                     ---
                  </td>
               </tr>
            </table>
         @endif

      </div>

      </div><!--div contenido 2da página-->

      <hr>

      <div class="contenido">
         <div class="">
            <p><b>7. Continuidad y trazabilidad.</b> (Fecha y hora de entrega-recepción, nombre completo de quien entrega y de quien recibe los indicios o elementos materiales probatorios en los cambios de custodia que realicen, institución a la que pertenecen, cargo o identificación dentro de la misma, propósito de la transferencia, firmas autógrafas y lugar de permanencia en la actividad respectiva. Anote las observaciones relacionadas con el embalaje, el indicio o elemento material probatorio o cualquier otra que considere necesario realizar. Agregue cuantas hojas sean necesarias. Cancele los espacios sobrantes después de que haya cumplido con el destino final del indicio o elemento material probatorio)</p>

            <table class="tabla-entrega centered">
               <thead>
                  <tr>
                     <th>Fecha y hora de entrega recepción</th>
                     <th>Nombre, institución y cargo o identificación de quien entrega</th>
                     <th>Actividad / Proposito</th>
                     <th>Firma</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td rowspan="2"></td>
                     <td>{{$data->user->name}}</td>
                     <td rowspan="2">Entrega</td>
                     <td rowspan="2"></td>
                  </tr>
                  <tr>
                     <td>PGJE {{$data->user->cargo->nombre}} {{$data->user->folio}}</td>
                  </tr>
               </tbody>
            </table>
            <table class="tabla-recibe centered">
               <thead>
                  <tr>
                     <th>Lugar de permanencia</th>
                     <th>Nombre, institución y cargo o identificación de quien recibe</th>
                     <th>Actividad / Proposito</th>
                     <th>Firma</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td rowspan="2"></td>
                     <td></td>
                     <td rowspan="2"></td>
                     <td rowspan="2"></td>
                  </tr>
                  <tr>
                     <td></td>
                  </tr>
               </tbody>
            </table>
            <table class="tabla-observaciones centered">
               <thead>
                  <tr>
                     <th>Observaciones</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td></td>
                  </tr>
                  <tr>
                     <td></td>
                  </tr>
               </tbody>
            </table>
            <table class="tabla-entrega centered">
               <thead>
                  <tr>
                     <th>Fecha y hora de entrega recepción</th>
                     <th>Nombre, institución y cargo o identificación de quien entrega</th>
                     <th>Actividad / Proposito</th>
                     <th>Firma</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td rowspan="2"></td>
                     <td></td>
                     <td rowspan="2"></td>
                     <td rowspan="2"></td>
                  </tr>
                  <tr>
                     <td></td>
                  </tr>
               </tbody>
            </table>
            <table class="tabla-recibe centered">
               <thead>
                  <tr>
                     <th>Lugar de permanencia</th>
                     <th>Nombre, institución y cargo o identificación de quien recibe</th>
                     <th>Actividad / Proposito</th>
                     <th>Firma</th>
                  </tr>
               </thead>
               <tbody>
                   <tr>
                     <td rowspan="2"></td>
                     <td></td>
                     <td rowspan="2"></td>
                     <td rowspan="2"></td>
                  </tr>
                  <tr>
                     <td></td>
                  </tr>
               </tbody>
            </table>
            <table class="tabla-observaciones centered">
               <thead>
                  <tr>
                     <th>Observaciones</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td></td>
                  </tr>
                  <tr>
                     <td></td>
                  </tr>
               </tbody>
            </table>
            <table class="tabla-entrega centered">
               <thead>
                  <tr>
                     <th>Fecha y hora de entrega recepción</th>
                     <th>Nombre, institución y cargo o identificación de quien entrega</th>
                     <th>Actividad / Proposito</th>
                     <th>Firma</th>
                  </tr>
               </thead>
               <tbody>
                                    <tr>
                     <td rowspan="2"></td>
                     <td></td>
                     <td rowspan="2"></td>
                     <td rowspan="2"></td>
                  </tr>
                  <tr>
                     <td></td>
                  </tr>
               </tbody>
            </table>
            <table class="tabla-recibe centered">
               <thead>
                  <tr>
                     <th>Lugar de permanencia</th>
                     <th>Nombre, institución y cargo o identificación de quien recibe</th>
                     <th>Actividad / Proposito</th>
                     <th>Firma</th>
                  </tr>
               </thead>
               <tbody>
                   <tr>
                     <td rowspan="2"></td>
                     <td></td>
                     <td rowspan="2"></td>
                     <td rowspan="2"></td>
                  </tr>
                  <tr>
                     <td></td>
                  </tr>
               </tbody>
            </table>
            <table class="tabla-observaciones centered">
               <thead>
                  <tr>
                     <th>Observaciones</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td></td>
                  </tr>
                  <tr>
                     <td></td>
                  </tr>
               </tbody>
            </table>

         </div>
      </div><!--div contenido 3ra página-->

</body>

</html>
