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
  font-size: 6px !important;
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
    <caption class="amber">
      <h5><b>RELACIÓN BAJAS ARMAS {{date('d-m-Y',strtotime($fecha_inicio))}}/{{date('d-m-Y',strtotime($fecha_fin))}}</b></h5>
    </caption>
    <thead>
        <tr>
            <th>No</th>
            <th>FOLIO</th>
            <th>N.U.C.</th>
            <th>FECHA BAJA</th>
			<th>MOTIVO</th>
			<th>lUGAR A DONSE DE VA</th>
            <th>DESCRIPCIÓN</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($bajas->values() as $i => $baja)
		@if($i%2 == 0)
		<tr>
        @else
		<tr class="grey lighten-2">
        @endif
        <td width="10%"><b>{{$i+1}}</b></td>
        <td width="10%"><b>{{$baja->cadena->folio_bodega}}</b></td>
        <td width="10%"><b>{{$baja->cadena->nuc}}</b></td>
        <td width="5%"><b>{{$baja->fecha}}</b></td>
		<td width="5%"><b>{{$baja->motivo ?? '---'}}</b></td>
		<td width="5%"><b>{{$baja->institucion->nombre ?? '---'}}</b></td>
        <td width="70%">
          @foreach($baja->cadena->indicios as $j => $indicio)
            <b>{{$indicio->identificador}}</b>:{{$indicio->descripcion}} ~ {{$indicio->estado}}<br>
          @endforeach
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{--
<div class="tabla">
  <table class="">
    
    <thead>
        <tr>
            <th>No</th>
            <th>Región</th>
            <th>Lugar</th>
            <th># Bajas</th>
			<th>MOTIVO</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($regiones->sortBy('nombre')->values() as $i => $region)
		@if($i%2 == 0)
		<tr>
        @else
		<tr class="grey lighten-2">
        @endif
		
		<td rowspan="{{$instituciones->count()}}" width="10%"><b>{{$i+1}}</b></td>
		<td rowspan="{{$instituciones->count()}}" width="10%"><b>{{$region->nombre}}</b></td>
		
		@foreach($instituciones->sortBy(nombre)->values() as $j => $institucion )
			
			<td width="10%"><b>{{$institucion->nombre}}</b></td>
			<td width="10%"><b>{{$bajas->where()}}</b></td>
			<td width="5%"><b>{{$baja->fecha}}</b></td>
			<td width="5%"><b>{{$baja->motivo ?? '---'}}</b></td>
			<td width="5%"><b>{{$baja->institucion->nombre ?? '---'}}</b></td>
			<td width="70%">
			
			</tr>
		@endforeach
      @endforeach
    </tbody>
  </table>
</div>
--}}
</body>
