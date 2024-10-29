@component('peticion.peticion_componentes.peticion_componente_reporte')
   @slot('fecha_formato',$fecha_formato)

   @foreach ($especialidades->sortBy('nombre') as $especialidad)
      <table style="page-break-after:always;">
         <caption style="background-color:#152f4a; color: #c09f77 !important;"><b>{{mb_strtoupper($especialidad->nombre)}}</b></caption>
         <thead>
            <tr>
               <th rowspan="2">No.</th>
               <th rowspan="2">SOLICITUD</th>   
               <th colspan="{{$fiscalias->count()+1}}">FISCALÍAS</th>   
            </tr>
            <tr>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                     <th>{{$fiscalia->nombre}}</th>
               @endforeach
               <th>TOTAL</th>
            </tr>
         </thead>
         <tbody>
            @php $n = 1; @endphp
            @foreach ($especialidad->solicitudes->sortBy('nombre') as $solicitud)
               <tr>
                  <td>{{$n++}}</td>
                  <td style="text-align: justify; padding-right:5px !important;">{{$solicitud->nombre}}</td>
                  @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                     <td>{{$atendidas->where('fiscalia2_id',$fiscalia->id)->where('solicitud_id',$solicitud->id)->whereIn('documento_emitido',['dictamen','certificado'])->count()}}</td>
                  @endforeach
                  <td>{{$atendidas->where('solicitud_id',$solicitud->id)->whereIn('documento_emitido',['dictamen','certificado'])->count()}}</td>
               </tr>
            @endforeach
            

            <tr>
               <td>{{$n++}}</td>
               <td>INFORMES</td>
                  @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                        <td>{{$atendidas->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}}</td>
                  @endforeach
               <td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}}</td>
            </tr>


            <tr>
               <td>{{$n++}}</td>
               <td>TOTAL</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                  <td>{{$atendidas->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado','informe'])->count()}}</td>
               @endforeach
               <td>{{ number_format($atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado','informe'])->count() ) }}</td>
            </tr>
         </tbody>   
      </table>
   @endforeach
@endcomponent