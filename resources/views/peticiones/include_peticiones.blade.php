{{--
   Variables:
      $fecha_inicio*
      $fecha_fin
      $pticiones_recibidas*
--}}

<table class="highlight bordered">
   <caption><b>SOLICITUDES</b></caption>
   <tbody>
       <tr>
           <td class="td-izq">Recibidas</td>
           <td class="td-der">{{ $peticiones_recibidas->count() }}</td>
       </tr>
       <tr>
            <td class="td-izq">Pendientes</td>
            <td class="td-der">
                {{$peticiones_recibidas->whereIn('estado','pendiente')->count()}}
            </td>
        </tr>
      
        <tr>
            <td class="td-izq">Atendidas</td>
            <td class="td-der">
                {{$atendidas->whereIn('estado',['atendida','entregada'])->count()}}
            </td>
        </tr>
              
          
   </tbody>
</table>