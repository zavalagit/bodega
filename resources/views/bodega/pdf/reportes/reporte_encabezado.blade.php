<table class="table-encabezado">
   <tr>
      <th colspan="6" style="text-align:center;">REPORTE DE {{strtoupper($datos['reporte_tipo'])}}</th>
   </tr>
   
   <tr>
      <th>FECHA</th>
      <td>{{$datos['request']['hora1']}} {{ date('d-m-Y',strtotime($datos['request']['fecha1'])) }} ~ {{$datos['request']['hora2']}} {{ date('d-m-Y',strtotime($datos['request']['fecha2'])) }}</td>
      <th>RESPONSABLE BODEGA ENTREGA</th>
      <td>{{$datos['rb1']}}</td>
      <th>RESPONSABLE BODEGA RECIBE</th>
      <td>{{$datos['rb2']}}</td> 
   </tr>
</table>