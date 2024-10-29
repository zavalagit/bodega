<table class="highlight bordered">
   <caption><b>PETICIONES</b></caption>
   <tbody>
      <!--recibidas-->
      <tr>
         <td>RECIBIDAS</td>
         <td>{{$recibidas->count()}}</td>
      </tr>
      <!--atendidas-->
      <tr>
         <td>ATENDIDAS</td>
         <td>{{$atendidas->count()}}</td>
      </tr>
      <!--pendientes-->
      <tr>
         <td>PENDIENTES</td>
         <td>{{$pendientes->count()}}</td>
      </tr>
      <!--rezago-->
      <tr>
         <td>REZAGO</td>
         <td>{{$recibidas->where('estado','pendiente')->count()}}</td>
      </tr>
      <!--estudios-->
      {{-- <tr>
         <td>ESTUDIOS</td>
         <td>{{$atendidas->sum('cantidad_estudios')}}</td>
      </tr> --}}
   </tbody>
</table>