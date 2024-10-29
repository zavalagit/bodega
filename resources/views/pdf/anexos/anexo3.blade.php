<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>ANEXO 3</title>
 
  <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/plugins/materialize/css/materialize.css">
  <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/css/cadenas/anexos.css">

  <style media="screen">
  </style>

</head>
<body>

  <header>
    <table class="table-encabezado centered">
      <tr>
        <td class="td-fge">
          <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/fge_etiqueta_1.png" alt="" width="100"/>
        </td>
        <td class="td-encabezado">
          <p style="font-size:13px">  <b> FISCALÍA GENERAL DEL ESTADO DE MICHOACÁN </b> </p>
          <p style="font-size:11px">  <b> REGISTRO DE CADENA DE CUSTODIA </b> </p>
          <p style="font-size:11px"> (ANEXO 3) </p>
        </td>
        <td class="td-mich">
          <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/escudo_mich_4.png" alt="" height="100"/>
        </td>
      </tr>
    </table>
  </header>

    <footer id="footer">
      <table class="footer-table">
        <tr>
          <td colspan="2" class="td-qr"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(10)->margin(0)->errorCorrection('H')->generate("http://201.116.252.147/codigoQR/$cadena->id")) !!} "></td>
        </tr>
        <tr>
          <td class="table-td-izq">
            <h6>Periférico Independencia #5000 Col. Sentimientos de la Nación. Morelia, Michoacán. C.P. 58170 <b> /
              </b> (443) 322 3600 <b> / @FiscalíaMich </b> </h6>
          </td>
          <td class="table-td-der">
            <h6> <b> fiscaliamichoacan.gob.mx </b> </h6>
          </td>
        </tr>
      </table>
    </footer>

    <section id="section-nuc">
      <div class="div-encabezado-nuc">
        <p style="font-family: Arial, Helvetica, sans-serif; color: #002842;">
          <b> No. de referencia </b>
        </p>
      </div>

      <div class="div-nuc center-align">
        <h6 style="line-height:12px; color:#002842"> <b> {{$cadena->nuc}} </b> </h6>
      </div>
    </section>

    <main>
      <!--Seccion Cero-->
      <section class="seccion-cero">
          <table class="tabla tabla-seccion-cero">
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
                <td width="28%">{{$cadena->unidad->nombre}}</td>
                @isset($cadena->folio)
                <td width="15%" style="padding:10px 0 10px 0">{{$cadena->folio}}</td>
                @endisset
                @empty ($cadena->folio)
                <td width="15%">---</td>
                @endempty
                <td>{{$cadena->intervencion_lugar}}</td>
                <td width="22%">{{date('H:i:s',strtotime($cadena->intervencion_hora))}} /
                  {{date('d-m-Y', strtotime($cadena->intervencion_fecha))}}</td>
              </tr>
            </tbody>
          </table>
          <div class="">
            <p style="text-align: justify; font-size:11px;">
              Inicio de la Cadena de Custodia. (Marque con "X" el motivo por el cual comienza el registro)
            </p>
          </div>
          <div class="">
            <table class="tabla">
              <tbody>
                <tr>
                  @if ($cadena->motivo == 'localizacion')
                  <td>Localización [ <b>X</b> ]</td>
                  <td>Descubrimiento [&nbsp;&nbsp;&nbsp;&nbsp;]</td>
                  <td>Aportación [&nbsp;&nbsp;&nbsp;&nbsp;]</td>
                  @elseif ($cadena->motivo == 'descubrimiento')
                  <td>Localización [&nbsp;&nbsp;&nbsp;&nbsp;]</td>
                  <td>Descubrimiento [ <b>X</b> ]</td>
                  <td>Aportación [&nbsp;&nbsp;&nbsp;&nbsp;]</td>
                  @else
                  <td>Localización [&nbsp;&nbsp;&nbsp;&nbsp;]</td>
                  <td>Descubrimiento [&nbsp;&nbsp;&nbsp;&nbsp;]</td>
                  <td>Aportación [ <b>X</b> ]</td>
                  @endif
                </tr>
              </tbody>
            </table>
          </div>
        </section>
        <!-- 1.- Identidad -->
        <section class="seccion-identidad">
          <div class="">
            <p style="text-align: justify; font-size:11px;">
              <b>1. Identificación.</b> (Número, letra o combinación alfanumérica
              al indicio o elemento material probatorio, descripción general, ubicación en el lugar de intervención y hora de recolección. Relacione la identificaión por secuencias cuando se trate de indicios o elementos materiales probatorios del mismo tipo o clase, en caso contrario, registre individualmente. Cancele los espacion sobrantes.)
            </p>
          </div>
          <div class="">
            <table class="tabla tabla-indicios">
              <thead>
                <tr>
                  <th>Identificación</th>
                  <th>Descripción</th>
                  <th>Ubicación en el lugar</th>
                  <th>Hora</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cadena->indicios as $indicio)
                  <tr>
                    <td width="12%">{{$indicio->identificador}}</td>
                    <td width="48%" class="text-justify">{{$indicio->descripcion}}</td>
                    <td width="27%" class="text-justify">{{$indicio->indicio_ubicacion_lugar}}</td>
                    <td width="13%">{{date('H:i:s',strtotime($indicio->hora))}} <br> {{date('d-m-Y', strtotime($indicio->fecha))}}</td>
                  </tr>                 
                @endforeach
              </tbody>
            </table>
          </div>
        </section>
        <!-- 2.- Documentación -->
        <section class="seccion-documentacion">
          <div class="">
            <p style="text-align: justify; font-size:11px;">
              <b>2. Documentación.</b> (Marque con una "X" los métodos empleados o especifique cualquier otro en caso necesario.)
            </p>
          </div>
          <div class="">
            <table class="tabla tabla-documentacion">
              <tbody>
                <tr>
                  <td> <b>Escrito:</b> Si[ <b>{{ ($cadena->escrito == 'si') ? 'X' : "&nbsp;&nbsp;&nbsp;&nbsp;"}}</b> ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No[ <b>{{ ($cadena->escrito == 'no') ? 'X' : "&nbsp;&nbsp;&nbsp;&nbsp;"}}</b> ] </td>
                  <td> <b>Fotográfico:</b> Si[ <b>{{ ($cadena->fotografico == 'si') ? 'X' : "&nbsp;&nbsp;&nbsp;&nbsp;"}}</b> ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No[ <b>{{ ($cadena->fotografico == 'no') ? 'X' : "&nbsp;&nbsp;&nbsp;&nbsp;"}}</b> ] </td>
                  <td> <b>Croquis:</b> Si[ <b>{{ ($cadena->croquis == 'si') ? 'X' : "&nbsp;&nbsp;&nbsp;&nbsp;"}}</b> ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No[ <b>{{ ($cadena->croquis == 'no') ? 'X' : "&nbsp;&nbsp;&nbsp;&nbsp;"}}</b> ] </td>
                </tr>
                <tr>
                  <td> <b>Otro:</b> Si[ <b>{{ ($cadena->otro == 'si') ? 'X' : "&nbsp;&nbsp;&nbsp;&nbsp;"}}</b> ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No[ <b>{{ ($cadena->otro == 'no') ? 'X' : "&nbsp;&nbsp;&nbsp;&nbsp;"}}</b> ] </td>
                  <td colspan="2"> <b>Especifique: {{ ($cadena->especifique) ? "$cadena->especifique" : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------------------------------------------------------------------------------" }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>
        <!-- 3.- Rrecolección -->
        <section class="seccion-recoleccion">
          <div class="">
            <p style="text-align: justify; font-size:11px;">
              <b>3. Recolección.</b> (Coloque el número, letra o combinación de los
              indicios o elementos materiales probatorios de acuerdo a las condiciones
              de cómo fueron levantados según corresponda. Puede emplear intervalos).
            </p>
          </div>
          <div class="">
            <table class="tabla tabla-recoleccion">
              <thead>
                <tr>
                  <th>Manual</th>
                  <th>Instrumental</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td width="50%">
                    @foreach ($cadena->indicios as $key => $indicio)
                      @if ($indicio->recoleccion === 'manual')
                        @if ($key != 0)
                          ,
                        @endif
                        {{$indicio->identificador}}
                      @endif
                    @endforeach
                  </td>
                  <td width="50%">
                    @foreach ($cadena->indicios as $key => $indicio)
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
        </section>
        <!--4- empaque-embalaje-->
        <section class="seccion-empaque-embalaje">
          <div class="">
            <p style="text-align: justify; font-size:11px;">
              <b>4. Empaque/embalaje.</b> (coloque el número, letra o combinación de
              los indicios o elementos materiales de acuerdo al tipo de embalaje que
              se empleó para su preservación o conservación, según corresponda.
              Puede emplear intervalos).
            </p>
          </div>
          <div class="">
            <table class="tabla tabla-empaque-embalaje">
              <thead>
                <tr>
                  <th>Bolsa</th>
                  <th>Caja</th>
                  <th>Recipiente</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td width="34%">
                    @foreach ($cadena->indicios as $key => $indicio)
                      @if ($indicio->embalaje === 'bolsa')
                        @if ($key != 0)
                          ,
                        @endif
                        {{$indicio->identificador}}
                      @endif
                    @endforeach
                  </td>
                  <td width="33%">
                    @foreach ($cadena->indicios as $key => $indicio)
                      @if ($indicio->embalaje === 'caja')
                        @if ($key != 0)
                          ,
                        @endif
                        {{$indicio->identificador}}
                      @endif
                    @endforeach
                  </td>
                  <td width="34%">
                    @foreach ($cadena->indicios as $key => $indicio)
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
        </section>
        <!--5.- servidores públicos-->
        <section class="seccion-servidores-publicos">
          <div class="">
            <p style="text-align: justify; font-size:11px;">
              <b>5. Servidores públicos.</b> (Todo servidor público que haya participado
              en el procesamiento de los indicios o elementos materiales probatorios
              deberá escribir su nombre completo, la institución a la que pertenece,
              su cargo, la etapa del procedimiento en la que intervino y su firma autógrafa.
              Se deberán cancelar los espacios sobrantes).
            </p>
          </div>
          <div class="">
            <table class="tabla tabla-servidores-publicos">
              <thead>
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
                @foreach ($cadena->users as $user)
                <tr>
                  <td width="25%"
                    style="text-align: left;padding-left: 3px !important; height:60px !important;vertical-align:top;">
                    {{$user->name}}</td>
                  <td width="10%" style="height:60px !important;vertical-align:top;">FGE</td>
                  <td width="12%" style="height:60px !important;vertical-align:top;">{{$user->cargo->nombre}}</td>
                  <td width="25%"
                    style="text-align: left;padding-left: 3px !important; height:60px !important;vertical-align:top;">
                    {{$user->pivot->etapa}}</td>
                  <td width="28%"></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </section>
        <!--6.- traslado-->
        <section class="seccion-6">
          <div class="">
            <p style="text-align: justify; font-size:11px; margin-top:10px; margin-bottom:5px;">
              <b>6. Traslado.</b> (Marque con “X” la vía empleada. En caso de ser
              necesaria alguna condición o preservación de un inicio o elemento
              material probatorio en particular. El personal o policial con capacidades
              para el procesar, según sea el caso, deberá recomendarla).
            </p>
          </div>
          <div class="div-via">
            @if ($cadena->traslado == 'terrestre')
            <p style=""><b>a) Via:</b>&nbsp;&nbsp;&nbsp;Terrestre[ X
              ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aerea[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Maritima[&nbsp;&nbsp;&nbsp;&nbsp;]
            </p>
            @elseif ($cadena->traslado == 'aerea')
            <p><b>a)
                Via:</b>&nbsp;&nbsp;&nbsp;Terrestre[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aerea[
              X
              ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Maritima[&nbsp;&nbsp;&nbsp;&nbsp;]
            </p>
            @elseif ($cadena->traslado == 'maritima')
            <p><b>a)
                Via:</b>&nbsp;&nbsp;&nbsp;Terrestre[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aerea[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Maritima[
              X ]</p>
            @endif
          </div>
          <div class="div-recomendaciones">
            @if ($cadena->trasladoCondiciones == 'si')
            <p><b>b) Se requieren condiciones especiales para su tralado:</b> Si[ X
              ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No[&nbsp;&nbsp;&nbsp;]</p>
            <p>Recomendaciones:</p>
            <table class="tabla">
              <tr>
                <td>
                  {{$cadena->trasladoRecomendaciones}}
                </td>
              </tr>
            </table>
            @endif
            @if ($cadena->trasladoCondiciones == 'no')
            <p><b>b) Se requieren condiciones especiales para su traslado:</b>
              Si[&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No[ X ]</p>
            <p>Recomendaciones:</p>
            <table class="tabla">
              <tr>
                <td>
                  -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                </td>
              </tr>
            </table>
            @endif
          </div>
        </section>
  
        <!--Salto de linea
          <hr>
        -->
  
        <!--7.- trazabilidad-->
        <section class="trazabilidad">
          <div class="">
            <p style="text-align: justify; font-size:11px;">
              <b>7. Continuidad y trazabilidad.</b> (Todo servidor público que haya
              participado en el procesamiento de los indicios o elementos materiales
              probatorios deberá escribir su nombre completo, la institución a la que
              pertenece, su cargo, la etapa del procedimiento en la que intervino y su
              firma autógrafa. Se deberán cancelar los espacios sobrantes).
            </p>
          </div>
  
          <div>
            <table class="tabla tabla-trazabilidad">
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
                  <td rowspan="2" width="25%" style="height:30px;"></td>
                <td width="40%">{{$cadena->user->name}}</td>
                  <td rowspan="2" width="15%" style="height:30px;">Entrega</td>
                  <td rowspan="2" width="20%" style="height:30px;"></td>
                </tr>
                <tr>
                  <td width="20%">FGE {{$cadena->user->cargo->nombre}} {{$cadena->user->folio}}</td>
                </tr>
              </tbody>
            </table>
            <table class="tabla tabla-trazabilidad" style="margin:0 !important;">
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
                  <td rowspan="2" width="25%" style="height:30px;"></td>
                  <td width="40%"></td>
                  <td rowspan="2" width="15%" style="height:30px;"></td>
                  <td rowspan="2" width="20%" style="height:30px;"></td>
                </tr>
                <tr>
                  <td></td>
                </tr>
              </tbody>
            </table>
            <table class="tabla tabla-trazabilidad">
              <thead>
                <tr>
                  <th colspan="4">Observaciones</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="4" style="height:20px;"></td>
                </tr>
                <tr>
                  <td colspan="4" style="height:20px;"></td>
                </tr>
              </tbody>
            </table>
            <table class="tabla tabla-trazabilidad">
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
                  <td rowspan="2" width="25%" style="height:30px;"></td>
                  <td width="40%"></td>
                  <td rowspan="2" width="15%" style="height:30px;"></td>
                  <td rowspan="2" width="20%" style="height:30px;"></td>
                </tr>
                <tr>
                  <td width="20%"> <br> </td>
                </tr>
              </tbody>
            </table>
            <table class="tabla tabla-trazabilidad" style="margin:0 !important;">
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
                  <td rowspan="2" width="25%" style="height:30px;"></td>
                  <td width="40%"></td>
                  <td rowspan="2" width="15%" style="height:30px;"></td>
                  <td rowspan="2" width="20%" style="height:30px;"></td>
                </tr>
                <tr>
                  <td></td>
                </tr>
              </tbody>
            </table>
            <table class="tabla tabla-trazabilidad">
              <thead>
                <tr>
                  <th colspan="4">Observaciones</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="4" style="height:20px;"></td>
                </tr>
                <tr>
                  <td colspan="4" style="height:20px;"></td>
                </tr>
              </tbody>
            </table>
            <table class="tabla tabla-trazabilidad">
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
                  <td rowspan="2" width="25%" style="height:30px;"></td>
                  <td width="40%"></td>
                  <td rowspan="2" width="15%" style="height:30px;"></td>
                  <td rowspan="2" width="20%" style="height:30px;"></td>
                </tr>
                <tr>
                  <td width="20%"></td>
                </tr>
              </tbody>
            </table>
            
            <table class="tabla tabla-trazabilidad" style="margin:0 !important;">
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
                  <td rowspan="2" width="25%" style="height:30px;"> <br> </td>
                  <td width="40%"><br> </td>
                  <td rowspan="2" width="15%" style="height:30px;"> <br> </td>
                  <td rowspan="2" width="20%" style="height:30px;"> <br> </td>
                </tr>
                <tr>
                  <td> <br> </td>
                </tr>
              </tbody>
            </table>
            <table class="tabla tabla-trazabilidad">
              <thead>
                <tr>
                  <th colspan="4">Observaciones</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="4" style="height:20px;"></td>
                </tr>
                <tr>
                  <td colspan="4" style="height:20px;"></td>
                </tr>
              </tbody>
            </table>
            
          </div>
        </section>
    </main>




</body>
</html>
