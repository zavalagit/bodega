<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>FOLIO</th>
            <th>N.U.C.</th>
            <th>FECHA INGRESO</th>
            <th>DECRIPCIÓN</th>
        </tr>
    </thead>
    @php
        $no = 1;
    @endphp
    <tbody>
        @foreach ($cadenas as $cadena)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$cadena->folio_bodega}}</td>
                <td>{{$cadena->nuc}}</td>
                <td>{{$cadena->entrada->fecha}}</td>
                <td>
                    @foreach ($cadena->indicios->whereIn('estado',['activo','prestamo']) as $indicio)
                        <b>{{$indicio->identificador}}:</b> {{$indicio->descripcion}}
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>