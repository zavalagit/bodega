<table>
   <thead>
      <tr>
         <th>NO.</th>
         <th>FOLIO</th>
         <th>N.U.C.</th>
         <th>FECHA</th>
         <th>SERVIDOR PÚBLICO INGRESA</th>
         <th>DESCRIPCIÓN</th>
      </tr>
   </thead>
   <tbody>
      @php
          $no = 1;
      @endphp
      @foreach($data as $cadena)
         <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $cadena->folio_bodega }}</td>
            <td>{{ $cadena->nuc }}</td>
            <td>{{ $cadena->entrada->fecha }}</td>
            <td>{{ $cadena->entrada->perito->nombre }}</td>
            <td>
               @foreach ($cadena->indicios as $indicio)
                  {{$indicio->identificador}}: {{$indicio->descripcion}} <br>
               @endforeach
            </td>
         </tr>
      @endforeach
   </tbody>
</table>