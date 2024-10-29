<table>
   <tr>
      <td colspan="12">{{ $data['fecha_encabezado'] }}</td>
   </tr>
</table>

<table>
   <thead>
      <tr>
         <th>No.</th>
         <th>N.U.C.</th>
         <th>PERITO</th>
         <th>ESPECIALIDAD</th>
         <th>SOLICITUD</th>
         <th>FECHA RECEPCIÓN</th>
         <th>FECHA ELABORACIÓN</th>
         <th>DOCUMENTO EMITIDO</th>
         <th>ESTUDIOS</th>
         <th>NÚMERO OFICIO</th>
         <th>FOLIO INTERNO</th>
         <th>ESTADO</th>
      </tr>
   </thead>
   <tbody>
      @php
      $no_consecutivo = 1;
      @endphp
      @foreach ($data['peticiones'] as $peticion)
         <tr>
            <td>{{$no_consecutivo++}}</td>
            <td>{{$peticion->nuc}}</td>
            <td>{{$peticion->user->name}}</td>
            <td>{{$peticion->solicitud->especialidad->nombre}}</td>
            <td>{{$peticion->solicitud->nombre}}</td>
            <td>{{$peticion->fecha_recepcion}}</td>   
            <td>{{$peticion->fecha_elaboracion}}</td>
            <td>{{$peticion->documento_emitido}}</td>
            <td>{{$peticion->cantidad_estudios}}</td>
            <td>{{$peticion->oficio_numero}}</td>
            <td>{{$peticion->oficio_numero}}</td>
            <td>{{ strtoupper($peticion->estado) }}</td>
         </tr>  
      @endforeach
   </tbody>
</table>