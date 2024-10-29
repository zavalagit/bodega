{{-- ELIMINAR-ARCHIVO --}}
<td>{{$especialidad->solicitudes->count() + 1}}</td>
<td>TOTAL</td>
<!--recibidas-->
<td>{{$recibidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->count()}}</td>
<!--atendidas-->
<td>{{$tendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->count()}}</td>
<!--pendientes-->
<td>{{$pendientes->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->count()}}</td>
<!--dictamen-->
<td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','dictamen')->count()}}</td>
<!--certificado-->
<td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','dictamen')->count()}}</td>
<!--informe-->
<td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','dictamen')->count()}}</td>
<!--juzgado-->
<td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','dictamen')->count()}}</td>
<!--archivo-->
<td>{{$atendidas->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->where('documento_emitido','dictamen')->count()}}</td>
<!--estudios-->
<td>{{$peticiones->whereIn('solicitud_id',$especialidad->solicitudes->pluck('id'))->sum('cantidad_estudios')}}</td>