<html>
   <head>
      <link rel="stylesheet" href="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/css/prestamo/prestamo_pdf.css">
   </head>
   <body>
      <header>
         <div class="header-folio">
            <p>{{date('d-m-Y',strtotime($prestamo->cadena->entrada->fecha))}}/<b>{{$prestamo->cadena->folio_bodega}}</b></p>
         </div>

         <table border="0" style="width: 100%;">
            <tr>
            <td style="width: 25%;">
               <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/fge_etiqueta_1.png" alt="" width="100"/>
            </td>
            <td style="width: 50%;">
               <p style="font-size:13px; text-align:center;"><b>FISCALÍA GENERAL DEL ESTADO DE MICHOACÁN</b></p>
               <p style="font-size:11px; text-align:center;"><b>PRESTAMOS E INGRESOS DE INDICIOS O EVIDENCIAS DEL ALMACÉN</b></p>
               {{-- <p style="font-size:11px">  <b> Y/O ELEMENTOS MATERIALES PROBATORIOS </b> </p> --}}
               <p style="font-size:11px; text-align:center;"> (FORMATO INTERNO DE PRESTAMO) </p>
            </td>
            <td style="width: 25%; text-align: right;">
               <img src="<?php echo $_SERVER["DOCUMENT_ROOT"]; ?>/logos/escudo_mich_4.png" alt="" height="100"/>
            </td>
            </tr>
         </table>

         <div class="header-nuc">
            <p class="nuc1">Nº REFERENCIA</p>
            <p class="nuc2"><b>{{$prestamo->cadena->nuc}}</b></p>
         </div>
      </header>

      <main>
         <table class="tabla-prestamo tabla1">
            <tr>
               <th>Fecha prestamo</th>
               <th>Hora prestamo</th>
               <th>Periodo de prestamo</th>
               <th>Unidad administrativa</th>
               <th>Cadena</th>
            </tr>
            <tr>
               <td style="width: 20%;">{{date('d-m-Y',strtotime($prestamo->prestamo_fecha))}}</td>
               <td style="width: 20%;">{{date('H:i:s',strtotime($prestamo->prestamo_hora))}}</td>
               <td style="width: 20%;">24 hrs.</td>
               <td style="width: 25%; padding: 0; text-align: center;">{{$prestamo->perito1->unidad->nombre}}</td>
               <td style="width: 15%; padding: 0 3px; text-align: center;">Si &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No</td>
            </tr>
         </table>

         <table class="tabla-prestamo tabla2">
            <tbody>
               <tr>
                  <th class="th-border"><b>Persona entrega</b></th>
                  <th style="background-color: #fff"></th>
                  <th class="th-border"><b>Persona recibe</b></th>
               </tr>
               <tr>
                  <td class="td-border" style="width:40%; padding-top:45px;"></td>
                  <td style=""></td>
                  <td class="td-border" style="width:40%; padding-top:45px;"></td>
               </tr>
               <tr>
                  <td class="td-border">{{$prestamo->user1->name}}</td>
                  <td></td>
                  <td class="td-border">{{$prestamo->perito1->nombre}}</td>
               </tr>
               <tr>
                  <td class="td-border">{{$prestamo->user1->institucion->nombre}} {{$prestamo->user1->cargo->nombre}} {{$prestamo->user1->folio}}</td>
                  <td></td>
                  <td class="td-border">{{$prestamo->perito1->institucion->nombre}} {{$prestamo->perito1->cargo->nombre}} {{$prestamo->perito1->folio}}</td>
               </tr>
               <tr>
                  <td class="td-border"> <b>Nombre completo, institución, cargo y firma</b> </td>
                  <td></td>
                  <td class="td-border"> <b>Nombre completo, institución, cargo y firma</b> </td>
               </tr>
            </tbody>
         </table>

         <table class="tabla-prestamo tabla-indicios" style="page-break-inside:auto;">
            <thead>
               <tr>
                  <th>Folio</th>
                  <th>Identificador</th>
                  <th style="padding-left:3px; text-align: lef;">Descripción</th>
                  <th>Cantidad i/e</th>
                  <th>Observaciones</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($prestamo->indicios as $indicio)
                  <tr>
                     @if ($loop->first)
                        <td rowspan="{{$prestamo->indicios->count()}}" style="width: 10%;">{{$prestamo->cadena->folio_bodega}}</td>
                     @endif
                     <td style="width: 10%;">{{$indicio->identificador}}</td>  
                     <td style="padding: 2px 3px; text-align: justify;">{{ $indicio->pivot->prestamo_descripcion ?? $indicio->descripcion}}</td>  
                     <td style="width: 10%;">{{$indicio->pivot->prestamo_cantidad_indicios}}</td>
                     @if ($loop->first)
                        <td rowspan="{{$prestamo->indicios->count()}}" style="width: 10%;">Estudio</td>
                     @endif  
                  </tr>                
               @endforeach
            </tbody>
         </table>

         <table class="tabla-prestamo tabla1">
            <thead>
               <tr>
                  <th>Fecha reingreso</th>
                  <th>Hora reingreso</th>
                  <th>Cadena</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td style="width: 42%;"></td>
                  <td style="width: 42%;"></td>
                  <td style="width: 16%; padding: 0 3px; text-align: center;">Si &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No</td>
               </tr>
            </tbody>
         </table>

         <table class="tabla-prestamo tabla2">
            <thead>
               <tr>
                  <th class="th-border"><b>Persona entrega</b></th>
                  <th style="background-color: #fff"></th>
                  <th class="th-border"><b>Persona recibe</b></th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="td-border" style="width:40%; padding-top:45px;"></td>
                  <td style=""></td>
                  <td class="td-border" style="width:40%; padding-top:45px;"></td>
               </tr>
               <tr>
                  <td class="td-border">&nbsp;</td>
                  <td></td>
                  <td class="td-border">&nbsp;</td>
               </tr>
               <tr>
                  <td class="td-border">&nbsp;</td>
                  <td></td>
                  <td class="td-border">&nbsp;</td>
               </tr>
               <tr>
                  <td class="td-border"> <b>Nombre completo, institución, cargo y firma</b> </td>
                  <td></td>
                  <td class="td-border"> <b>Nombre completo, institución, cargo y firma</b> </td>
               </tr>
            </tbody>
         </table>
      </main>

      {{-- <footer>
         <h1>www.styde.net</h1>
      </footer> --}}
   </body>
</html>