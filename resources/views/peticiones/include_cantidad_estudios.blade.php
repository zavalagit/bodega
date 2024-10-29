<ul class="collapsible" data-collapsible="expandable">
    <li>
        <div class="collapsible-header collapsible-titulo">
            <div>DESGLOSE POR SOLICITUD</div>
        </div>
    </li>
    @foreach ($especialidades->sortBy('nombre') as $key => $especialidad)
       <li>
          <div class="row collapsible-header hola">
             <div class="col s10"><b>· {{$especialidad->nombre}}</b></div>
             <div class="col s2"><i class="fas fa-angle-down"></i></div>
          </div>
          <div class="collapsible-body">
             <table class="highlight bordered">
                <thead>
                   <th style="text-align: center;">Nº</th>
                   <th style="text-align: center;">Solicitud</th>
                   <th style="text-align: center;">Dictamen</th>
                   <th style="text-align: center;">Certificado</th>
                   <th style="text-align: center;">Informe</th>
                   <th style="text-align: center;">Salida juzgado</th>
                   <th style="text-align: center;">Archivo</th>
                   <th style="text-align: center;">Estudios</th>
                </thead>
                <tbody>
                   @php $n=1; @endphp
                   @foreach ($especialidad->solicitudes->sortBy('nombre') as $solicitud)
                      <tr>
                        <td style="width:5%;">{{$n++}}</td> 
                        <td style="width:45%; text-align: left;">{{$solicitud->nombre}}</td>
                        <td style="width:10%;">{{$atendidas->where('solicitud_id',$solicitud->id)->whereIn('estado',['atendida','entregada'])->where('documento_emitido','dictamen')->count()}}</td>
                        <td style="width:10%;">{{$atendidas->where('solicitud_id',$solicitud->id)->whereIn('estado',['atendida','entregada'])->where('documento_emitido','certificado')->count()}}</td>
                        <td style="width:10%;">{{$atendidas->where('solicitud_id',$solicitud->id)->whereIn('estado',['atendida','entregada'])->where('documento_emitido','informe')->count()}}</td>
                        <td style="width:10%;">{{$atendidas->where('solicitud_id',$solicitud->id)->whereIn('estado',['atendida','entregada'])->where('documento_emitido','salida_juzgado')->count()}}</td>
                        <td style="width:10%;">{{$atendidas->where('solicitud_id',$solicitud->id)->whereIn('estado',['atendida','entregada'])->where('documento_emitido','archivo')->count()}}</td>
                        <td style="width:10%;">{{$atendidas->where('solicitud_id',$solicitud->id)->whereIn('estado',['atendida','entregada'])->sum('cantidad_estudios')}}</td>
                      </tr>
                   @endforeach
                   <tr>
                     <td style="width:5%;">{{$n++}}</td>
                     <td style="width:25%; text-align: left;">TOTAL</td>
                     <td style="width:10%;">{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('estado',['atendida','entregada'])->where('documento_emitido','dictamen')->count()}}</td>
                     <td style="width:10%;">{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('estado',['atendida','entregada'])->where('documento_emitido','certificado')->count()}}</td>
                     <td style="width:10%;">{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('estado',['atendida','entregada'])->where('documento_emitido','informe')->count()}}</td>
                     <td style="width:10%;">{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('estado',['atendida','entregada'])->where('documento_emitido','salida_juzgado')->count()}}</td>
                     <td style="width:10%;">{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('estado',['atendida','entregada'])->where('documento_emitido','archivo')->count()}}</td>
                     <td style="width:10%;">{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('estado',['atendida','entregada'])->sum('cantidad_estudios')}}</td>
                   </tr>
                </tbody>
             </table>
          </div>
       </li>
    @endforeach
 </ul>

