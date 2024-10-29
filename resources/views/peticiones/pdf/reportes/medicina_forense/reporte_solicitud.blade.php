@component('peticion.peticion_componentes.peticion_componente_reporte')
   @slot('fecha_formato',$fecha_formato)
   @foreach ($especialidades->sortBy('nombre') as $especialidad)
   <table>
      <caption><b>{{mb_strtoupper($especialidad->nombre)}}</b></caption>
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
                  <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->where('solicitud_id',$solicitud->id)->whereIn('documento_emitido',['dictamen','certificado','salida_juzgado'])->count()}}</td>
               @endforeach
               <td>{{$peticiones->where('solicitud_id',$solicitud->id)->whereIn('documento_emitido',['dictamen','certificado','salida_juzgado'])->count()}}</td>
            </tr>
         @endforeach
         

         <tr>
            <td>{{$n++}}</td>
            <td>INFORMES</td>
               @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
                   <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}}</td>
               @endforeach
            <td>{{$peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}}</td>
         </tr>


         <tr>
            <td>{{$n++}}</td>
            <td>TOTAL</td>
            @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
               <td>{{$peticiones->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado','informe','salida_juzgado'])->count()}}</td>
            @endforeach
            <td>{{ number_format($peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado','informe','salida_juzgado'])->count() ) }}</td>
         </tr>
      </tbody>   
   </table>
   
   <br>
  @endforeach
  
            
  

<table style="border: 0px !important;">
<tr>
<td style="border: 0px !important; text-align: center;">COORDINADOR GENERAL DE SERVICIOS PERICIALES <br> DR. EN D. PEDRO GUTIERREZ GUTIERREZ</td>
<td style="border: 0px !important; text-align: center;">TITULAR DE LA {{Auth::user()->unidad->nombre}}<br> {{Auth::user()->name}}</td>
</tr>
<br>
<!--
<tr>
<td style="border: 0 0 1px 0 solid #000 !important; text-align: center;"><br></td>
<td style="border: 0 0 1px 0 solid #000 !important; text-align: center;"><br></td>
</tr>
-->
</table>
@endcomponent