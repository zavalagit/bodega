<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>LISTADO</title>

    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/plugins/materialize/css/materialize.min.css">


   <style media="screen">

   @page{
      margin-top: 0cm;
      margin-bottom: 0cm;
      margin-right: 1cm;
      margin-left: 1cm;
   }
   body {
      font-size: 0.0em;
      margin: 0cm 0 0cm;
   }

#header,
#footer {
  position: fixed;
  left: 0;
  right: 0;
  font-size: 0.9em;
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

table{
  font-size: 10px !important;
}

table thead{
   background-color: #aaa;
}
th{
   padding: 3px 3px 3px 3px !important;
   border: 0.8px solid #aaa;
}
.tabla td{
   border: 0.8px solid #aaa;
   padding: 3px 3px 3px 3px;
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
.tdfirma{
   padding-top: 70px !important;
}
.tddatos{
   padding-top: 0px !important;
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

h5{
  margin: 0 !important;
  padding: 10px !important;
  font-size: 18px;
}
.border-no{
  border: 0px !important;
}
   </style>

</head>

<body>

   <div class="tabla">
      <table class="">
         <caption class="amber"><h5></h5></caption>

        <thead>
          <tr>
            <th>NO.</th>
            @if ($folio)
              <th>FOLIO</th>
            @endif
            <th>N.U.C.</th>
            <th>FECHA</th>
            @if ($sp_entrega)  
              <th>SERVIDOR PÚBLICO INGRESA</th>
            @endif
            <th>FISCALÍA</th>
            <th>DESCRIPCIÓN</th>
          </tr>
        </thead>
        <tbody>
            @php
              $no = 1;
            @endphp
            @foreach ($cadenas as $key => $cadena)
              @if($no%2 == 0)
              <tr>
              @else
              <tr class="grey lighten-2">
              @endif
                    <td width="5%"><b>{{$no++}}</b></td>
                    @if ($folio)                      
                      <td width="10%"><b>{{$cadena->folio_bodega}}</b></td>
                    @endif
                    <td width="10%"><b>{{$cadena->nuc}}</b></td>
                    <td width="10%"><b>{{date('d-m-Y', strtotime($cadena->entrada->fecha))}}</b></td>
                    @if ($sp_entrega)
                      <td width="10%"><b>{{$cadena->entrada->perito->nombre}}</b></td>  
                    @endif
                    <td width="10%"><b>{{$cadena->fiscalia->nombre}}</b></td>
                    <td width="">
                      <table>
                        @foreach ($cadena->indicios as $indicio)
                          <tr>
                            <td width="10%">{{$indicio->identificador}}</td>
                            <td>{{$indicio->descripcion}}</td>
                            @if ($indicio_estado)  
                              <td width="6%">{{$indicio->estado}}</td>
                            @endif
                          </tr>
                        @endforeach
                      </table>
                    </td>
              </tr>
            @endforeach
        </tbody>
      </table>

      <table border="0">
        <tbody>
          @php
              $nombre = Auth::user()->name;
              $iniciales=substr($nombre,0,1);

              for ($i=0; $i < strlen($nombre)-1; $i++) {
                if($nombre[$i] == ' ')
                  $iniciales = "{$iniciales}{$nombre[$i+1]}";
              }
            @endphp
          <tr>
            <td colspan="4" class="right-align border-no"></td>
          </tr>
          <tr>
            <td colspan="4" class="right-align border-no">{{$iniciales}}</td>
          </tr>
        </tbody>
      </table>
   </div>



</body>
