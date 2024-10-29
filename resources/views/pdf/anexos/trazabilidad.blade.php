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
          <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/fge.png" alt="" width="100"/>
        </td>
        <td class="td-encabezado">
          <p style="font-size:13px">  <b> FISCALÍA GENERAL DEL ESTADO DE MICHOACÁN </b> </p>
          <p style="font-size:11px">  <b> REGISTRO DE CADENA DE CUSTODIA </b> </p>
          <p style="font-size:11px"> (ANEXO 3) </p>
        </td>
        <td class="td-mich">
          <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/escudo_mich.png" alt="" height="100"/>
        </td>
      </tr>
    </table>
  </header>

    <footer id="footer-anexo3">
      <table class="footer-table">
        <tr>
          <td colspan="2" class="table-td-qr">
            <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/codigoQr/codigoqr.png" width="450%"></td>
          </td>
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

        
        
        
        
  
        <!--7.- trazabilidad-->
        <section class="trazabilidad">
  
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
