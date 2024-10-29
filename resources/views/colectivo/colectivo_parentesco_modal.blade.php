<table>
   <caption class="" style="background-color:#c09f77 !important;color:#152f4a;"> <b>FOLIO</b> </caption>

   <thead>
      <tr>
         <th style="background-color: #c09f77; color: #152f4a;">N°</th>
         <th style="background-color: #c09f77; color: #152f4a;">Nombre</th>
         <th style="background-color: #c09f77; color: #152f4a;">Parentesco</th>
         @if ( $colectivo->parentescos->contains('id',10) ) <th style="background-color: #c09f77; color: #152f4a;">Otro parentesco</th> @endif
         <th style="background-color: #c09f77; color: #152f4a;">Fecha de desaparición</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($colectivo->parentescos as $i => $parentesco)
         <tr>
            <td style="background-color: #c6c6c6; color: #000;">{{$i+1}}</td>
            <td style="background-color: #c6c6c6; color: #000;">{{$parentesco->pivot->ausente_nombre}}</td>
            <td style="background-color: #c6c6c6; color: #000;">{{$parentesco->nombre}}</td>
            @if ( $colectivo->parentescos->contains('id',10) ) <td style="background-color: #c6c6c6; color: #000;">{{ $parentesco->pivot->parentesco_otro ?: '---' }}</td> @endif
            <td style="background-color: #c6c6c6; color: #000;">{{$parentesco->pivot->fecha_desaparecido_fecha ?? '---'}}</td>
         </tr>
      @endforeach
   </tbody>
</table>
