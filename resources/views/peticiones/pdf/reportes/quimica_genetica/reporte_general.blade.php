@component('peticion.peticion_componentes.peticion_componente_reporte')
   @slot('fecha_formato',$fecha_formato)

   <table>
      <thead>
         <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2" style="background-color:#152f4a; color: #c09f77 !important;">ESPECIALIDAD</th>
            <th colspan="{{$fiscalias->count()+1}}" style="background-color:#152f4a; color: #c09f77 !important;">FISCALÍAS</th>  
         </tr>
         <tr>
            @foreach ($fiscalias->sortBy('nombre') as $fiscalia)
               <th style="background-color:#394049; color:#c09f77 !important;">{{$fiscalia->nombre}}</th>
            @endforeach
            <th style="background-color:#394049; color:#c09f77 !important;">TOTAL</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($especialidades->sortBy('nombre')->values() as $i => $especialidad)
            <tr>
               <td>{{$i+1}}</td>
               <td style="background-color: yellow;">{{$especialidad->nombre}}</td>
               @foreach ($fiscalias->sortBy('nombre') as $j => $fiscalia)
                  <td> {{$atendidas->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado'])->count()}} </td>
               @endforeach
               <td> {{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->whereIn('documento_emitido',['dictamen','certificado'])->count()}} </td>
            </tr>
         @endforeach
         <tr>
            <td>{{$i+2}}</td>
            <td style="background-color: orange;">Informes</td>
            @foreach ($fiscalias->sortBy('nombre') as $fiscallia)
               <td> {{$atendidas->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}} </td>
            @endforeach
            <td> {{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','informe')->count()}} </td>
         </tr>
         {{-- <tr>
            <td>{{$i+3}}</td>
            <td style="background-color: orange;">Archivo</td>
            @foreach ($fiscalias->sortBy('nombre') as $fiscallia)
               <td> {{$atendidas->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','archivo')->count()}} </td>
            @endforeach
            <td> {{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','archivo')->count()}} </td>
         </tr>
         <tr>
            <td>{{$i+4}}</td>
            <td style="background-color: orange;">Salida juzgado</td>
            @foreach ($fiscalias->sortBy('nombre') as $fiscallia)
               <td> {{$atendidas->where('fiscalia2_id',$fiscalia->id)->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','salida_juzgado')->count()}} </td>
            @endforeach
            <td> {{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','salida_juzgado')->count()}} </td>
         </tr> --}}
      </tbody>
   </table>

      <br>
      <br>


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