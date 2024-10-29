<table class="highlight bordered">
   <caption><b>COLECTIVOS</b></caption>
   <tbody>
      <!--recibidas-->
      <tr>
         <td>REGISTRADAS</td>
         <td>
            @if ( old('b_fecha_fin') )
               {{ $colectivos->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('created_at','<=',old('b_fecha_fin').' 23:59:59')->count() }}
            @elseif( old('b_fecha_inicio') )
               {{ $colectivos->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('created_at','<=',old('b_fecha_inicio').' 23:59:59')->count() }}
            @else
               {{ $colectivos->where('created_at','>=',$fecha_hoy.' 00:00:00')->where('created_at','<=',$fecha_hoy.' 23:59:59')->count() }}
            @endif
         </td>
      </tr>
      <!--atendidas-->
      <tr>
         <td>ATENDIDAS</td>
         <td>
            @if ( old('b_fecha_fin') )
               {{ $colectivos->where('colectivo_validacion_fecha','>=',old('b_fecha_inicio'))->where('colectivo_validacion_fecha','<=',old('b_fecha_fin'))->count() }}
            @elseif( old('b_fecha_inicio') )
               {{ $colectivos->where('colectivo_validacion_fecha',old('b_fecha_inicio'))->count() }}
            @else
               {{ $colectivos->where('colectivo_validacion_fecha',$fecha_hoy)->count() }}
            @endif
         </td>
      </tr>
      <!--pendientes-->
      <tr>
         <td>PENDIENTES</td>
         <td>
            @if ( old('b_fecha_fin') )
               {{
                  $colectivos->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')
                  ->where('created_at','<=',old('b_fecha_fin').' 23:59:59')
                  ->where('colectivo_validacion_fecha',null)->count() + 
                  $colectivos->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')
                  ->where('created_at','<=',old('b_fecha_fin').' 23:59:59')
                  ->where('colectivo_validacion_fecha','>',old('b_fecha_fin'))
                  ->count()
               }}
            @elseif( old('b_fecha_inicio') )
               {{ $colectivos->where('created_at','>=',old('b_fecha_inicio').' 00:00:00')->where('created_at','<=',old('b_fecha_inicio').' 23:59:59')->where('colectivo_validacion_fecha','<>',old('b_fecha_inicio'))->count() }}
            @else
               {{ $colectivos->where('created_at','>=',$fecha_hoy.' 00:00:00')->where('created_at','<=',$fecha_hoy.' 23:59:59')->where('colectivo_validacion_fecha','<>',$fecha_hoy)->count() }}
            @endif
         </td>
      </tr>
      <!--estudios-->
      <tr>
         <td>ESTUDIOS</td>
         <td>
            @if ( old('b_fecha_fin') )
               {{
                  $colectivos->where('colectivo_validacion_fecha','>=',old('b_fecha_inicio'))
                  ->where('colectivo_validacion_fecha','<=',old('b_fecha_fin'))
                  ->sum(function ($colectivo){ return $colectivo->pruebas->sum('pivot.prueba_estudios'); })
               }}
            @elseif( old('b_fecha_inicio') )
               {{ 
                  $colectivos->where('colectivo_validacion_fecha','>=',old('b_fecha_inicio'))
                  ->where('colectivo_validacion_fecha','<=',old('b_fecha_inicio'))
                  ->sum(function ($colectivo){ return $colectivo->pruebas->sum('pivot.prueba_estudios'); })
               }}
            @else
               {{ 
                  $colectivos->where('colectivo_validacion_fecha','>=',$fecha_hoy)
                  ->where('colectivo_validacion_fecha','<=',$fecha_hoy)
                  ->sum(function ($colectivo){ return $colectivo->pruebas->sum('pivot.prueba_estudios'); })
               }}
            @endif
         </td>
      </tr>
   </tbody>
</table>