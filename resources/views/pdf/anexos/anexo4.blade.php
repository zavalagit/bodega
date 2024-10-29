<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Anexo 4</title>

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
          <p style="font-size:11px">  <b> FORMATO DE ENTREGA-RECEPCIÓN DE INDICIOS </b> </p>
          <p style="font-size:11px">  <b> Y/O ELEMENTOS MATERIALES PROBATORIOS </b> </p>
          <p style="font-size:11px"> (ANEXO 4) </p>
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
          <td colspan="2" class="td-qr"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(15)->margin(0)->errorCorrection('H')->generate("http://201.116.252.147/codigoQR/$cadena->id")) !!} "></td>
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
              @isset($cadena->folio)
                <td width="20%">{{$cadena->folio}}</td>
              @endisset
              @empty ($cadena->folio)
                <td width="20%" style="padding:10px 0 10px 0"></td>
              @endempty
              <td></td>
              <td></td>
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
              @foreach ($cadena->indicios as $indicio)
                <tr>
                  <td width="20%">{{$indicio->identificador}}</td>
                  <td class="text-justify">{{$indicio->descripcion}}</td>
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
                <td style="text-align: left; padding-left:5px; font-size:11px">{{$cadena->embalaje}}</td>
                </tr>
             </tbody>
          </table>
        </div>
      </section>

      <section class="seccion-cuatro">
          <table class="">
             <tbody>
                <tr>
                <td style="border: 1px solid #737272; padding-top:30px;" width="40%"></td>
                   <td style="text-align: center; padding:0;"></td>
                   <td style="border: 1px solid #737272; padding-top:30px;" width="40%"></td>
                </tr>
                <tr>
                   <td style="border: 1px solid #737272; text-align: center; font-size:10px; padding:0; margin:0">{{$cadena->user->name}}</td>
                   <td style="padding:0; margin:0"></td>
                   <td style="border: 1px solid #737272; text-align: center; font-size:10px; padding:0;"></td>
                </tr>
                <tr>
                   <td style="border: 1px solid #737272; text-align: center; font-size:10px; padding:0;">{{$cadena->user->institucion->nombre}} {{$cadena->user->cargo->nombre}} {{$cadena->user->folio}}</td>
                   <td style="padding:0; margin:0"></td>
                   <td style="border: 1px solid #737272; text-align: center; font-size:10px; padding:0;"></td>
                </tr>
                <tr>
                   <td style="border: 1px solid #737272; text-align: center; font-size:10px; padding:0px;"> <b>Nombre completo, institución, cargo y firma</b> </td>
                   <td style="padding:0;"></td>
                   <td style="border: 1px solid #737272; text-align: center; font-size:10px; padding:0px;"> <b>Nombre completo, institución, cargo y firma</b> </td>
                </tr>
             </tbody>
          </table>
      </section>

    </main>




</body>
</html>
