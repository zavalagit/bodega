<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Anexo 4</title>

  <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/plugins/materialize/css/materialize.css">
  <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/css/cadenas/anexos.css">
  <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/css/tablas.css">
  <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/css/tablas/tabla_vertical.css">

  <style media="screen">
      html{
         /* margin: 0 !important; */
         /* padding: 0 !important; */
      }
      #section-nuc, #section-nuc .div-encabezado-nuc{
         position: fixed;
         top: 20px;
         left: 65%;
      }
      #section-nuc .div-nuc{
         position: fixed;
         top: 55px;
         left: 65%;

         width: 28%;
         height: auto;

         background-color: #c6c6c6;
         border-left: 8px solid #C09f77;
      }
      body{
         margin: 0;
      }
      main{
         margin: 10% 1.2cm;
      }
      section{
         margin: 0;
      }
  </style>

</head>
<body>

 

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
      @foreach ($cadena->indicios->where('indicio_is_arma',true) as $indicio)
         @php $n = 1 @endphp
          <table class="tabla-vertical">
             <tr>
                <th width="25%">{{$n++}}.- IDENTIFICADOR INDICIO(S)</th>
                <td width="75%">{{$indicio->identificador}}</td>
             </tr>
             <tr>
                <th>{{$n++}}.- TIPO</th>
                <td>{{$indicio->arma->tipo}}</td>
             </tr>
             <tr>
                <th>{{$n++}}.- CLASIFICACIÓN</th>
                <td>{{$indicio->arma->clasificacion}}</td>
             </tr>
             <tr>
                <th>{{$n++}}.- FABRICANTE (MARCA)</th>
                <td>{{$indicio->arma->fabricante}}</td>
             </tr>            
             <tr>
                <th>{{$n++}}.- SERIE</th>
                <td>{{$indicio->arma->serie}}</td>
             </tr>           
             <tr>
                <th>{{$n++}}.- MODELO</th>
                <td>{{$indicio->arma->modelo}}</td>
             </tr>    
             <tr>
                <th>{{$n++}}.- CALIBRE</th>
                <td>{{$indicio->arma->calibre}}</td>
             </tr>
             <tr>
                <th>{{$n++}}.- CALIBRE</th>
                <td>{{$indicio->arma->calibre}}</td>
             </tr>
          </table>
          <br>
      @endforeach
    </main>




</body>
</html>
