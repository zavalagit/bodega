<!--recibidas-->
<td style="width:10%;">
   {{
      $peticiones->where('solicitud_id',$solicitud->id)
      ->where('created_at','>=',old('b_fecha_inicio'). ' 00:00:00')->where('created_at','<=',old('b_fecha_inicio'). ' 23:59:59')
      ->count()
   }}
</td>
<!--atendidas-->
<td>
   {{
      $peticiones->where('solicitud_id',$solicitud->id)
      ->where('fecha_sistema',old('b_fecha_inicio'))
      ->count()
   }}
</td>
<!--pendientes-->
<td>
   {{
      $peticiones->where('solicitud_id',$solicitud->id)
      ->where('fecha_sistema','<>',old('b_fecha_inicio'))
      ->count()
   }}
</td>
<!--dictamen-->
<td>
   {{
      $peticiones->where('solicitud_id',$solicitud->id)
      ->where('fecha_sistema',old('b_fecha_inicio'))
      ->where('documento_emitido','dictamen')
      ->count()
   }}
</td>
<!--certificado-->
<td>
   {{
      $peticiones->where('solicitud_id',$solicitud->id)
      ->where('fecha_sistema',old('b_fecha_inicio'))
      ->where('documento_emitido','certificado')
      ->count()
   }}
</td>
<!--informe-->
<td>
   {{
      $peticiones->where('solicitud_id',$solicitud->id)
      ->where('fecha_sistema',old('b_fecha_inicio'))
      ->where('documento_emitido','informe')
      ->count()
   }}
</td>
<!--juzgado-->
<td>
   {{
      $peticiones->where('solicitud_id',$solicitud->id)
      ->where('fecha_sistema',old('b_fecha_inicio'))
      ->where('documento_emitido','salida_juzgado')
      ->count()
   }}
</td>
<!--archivo-->
<td>
   {{
      $peticiones->where('solicitud_id',$solicitud->id)
      ->where('fecha_sistema',old('b_fecha_inicio'))
      ->where('documento_emitido','archivo')
      ->count()
   }}
</td>
<!--estudios-->
<td>
   {{
      $peticiones->where('solicitud_id',$solicitud->id)
      ->where('fecha_sistema',old('b_fecha_inicio'))
      ->sum('cantidad_estudios')
   }}
</td>