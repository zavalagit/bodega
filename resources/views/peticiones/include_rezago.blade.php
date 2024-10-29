{{--
   Variables:
      $peticiones_recibidas*
      $peticiones_rezago_atendido*
      $rezago_total*
--}}


<table class="highlight bordered">
   <caption><b>REZAGO</b></caption>
   <tbody>
        @isset($fecha_fin)
            @if ($es_mes)
                <tr>
                    <td class="td-izq">Rezago atendido en el mes</td>
                    <td class="td-der">{{$peticiones_rezago_atendido->count()}}</td>
                </tr>
            @else
                <tr>
                    <td class="td-izq">Rezago atendido en el intervalo de fechas solicitado</td>
                    <td class="td-der">{{$peticiones_rezago_atendido->count()}}</td>
                </tr>
            @endif
        @endisset

        @empty($fecha_fin)
            <tr>
                <td class="td-izq">Rezago atendido en el día</td>
                <td class="td-der">{{$peticiones_rezago_atendido->count()}}</td>
            </tr>
        @endempty

        <tr>
            <td class="td-izq">Rezago general</td>
            <td class="td-der">{{$rezago_total->count()}}</td>
        </tr>
   </tbody>
</table>