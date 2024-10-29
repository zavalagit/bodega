<table>
   <caption><b>PETICIONES POR ESPECIALIDAD</b></caption>
   <thead>
       <tr>
           <th style="text-align:center;">Nº</th>
           <th style="text-align:center;">Especialidad</th>
           <th style="text-align:center;">Pendientes</th>
           <th style="text-align:center;">Atendidas</th>
           <th style="text-align:center;">Dictamen</th>
           <th style="text-align:center;">Certificado</th>
           <th style="text-align:center;">Informe</th>
           <th style="text-align:center;">Salida a Juzgado</th>
           <th style="text-align:center;">Archivo</th>
           <th style="text-align:center;">Estudios</th>
       </tr>
   </thead>
   <tbody>
       @php $n=1; @endphp
        @foreach ($especialidades->sortBy('nombre') as $especialidad)
            <tr>
                <td>{{$n++}}</td>
                <td style="text-align: left;">{{$especialidad->nombre}}</td>
                <td>{{$peticiones_recibidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('estado','pendiente')->count()}}</td>
                <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('estado',['atendida','entregada'])->count()}}</td>
                <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('estado',['atendida','entregada'])->where('documento_emitido','dictamen')->count()}}</td>
                <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('estado',['atendida','entregada'])->where('documento_emitido','certificado')->count()}}</td>
                <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('estado',['atendida','entregada'])->where('documento_emitido','informe')->count()}}</td>
                <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('estado',['atendida','entregada'])->where('documento_emitido','salida_juzgado')->count()}}</td>
                <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('estado',['atendida','entregada'])->where('documento_emitido','archivo')->count()}}</td>
                <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('estado',['atendida','entregada'])->sum('cantidad_estudios')}}</td>
            </tr>
        @endforeach
        <tr>
            <td>{{$n++}}</td>
            <td>TOTAL</td>
            <td>{{$peticiones_recibidas->where('estado','pendiente')->count()}}</td>
            <td>{{$atendidas->whereIn('estado',['atendida','entregada'])->count()}}</td>
            <td>{{$atendidas->whereIn('estado',['atendida','entregada'])->where('documento_emitido','dictamen')->count()}}</td>
            <td>{{$atendidas->whereIn('estado',['atendida','entregada'])->where('documento_emitido','certificado')->count()}}</td>
            <td>{{$atendidas->whereIn('estado',['atendida','entregada'])->where('documento_emitido','informe')->count()}}</td>
            <td>{{$atendidas->whereIn('estado',['atendida','entregada'])->where('documento_emitido','salida_juzgado')->count()}}</td>
            <td>{{$atendidas->whereIn('estado',['atendida','entregada'])->where('documento_emitido','archivo')->count()}}</td>
            <td>{{$atendidas->whereIn('estado',['atendida','entregada'])->sum('cantidad_estudios')}}</td>
        </tr>
   </tbody>
</table>