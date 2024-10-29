<table>
   <tr>
      <td colspan="9">RELACIÓN DE INDICIOS Y/O EVIDENCIAS</td>
   </tr>
   @foreach($data['nucs'] as $key => $nuc)
      <tr>
         <td colspan="9">{{$nuc}}</td>
      </tr>
   @endforeach
</table>


<table border="1">
  <thead>
    <tr>
      <th>NO.</th>
      @if ($data['folio'])
        <th>FOLIO</th>
      @endif
      <th>N.U.C.</th>
      <th>FECHA</th>
      @if ($data['sp_entrega'])  
        <th>SERVIDOR PÚBLICO INGRESA</th>
      @endif
      <th>FISCALÍA</th>
      <th>IDENTIFICADOR</th>
      <th>DESCRIPCIÓN</th>
      <th>RESGUARDO</th>
    </tr>
  </thead>
  <tbody>
      @php
        $no = 1;
      @endphp
      @foreach ($data['cadenas'] as $key => $cadena)
        @if($no%2 == 0)
        <tr>
        @else
        <tr class="grey lighten-2">
        @endif
              <td rowspan="{{$cadena->indicios->count()}}"><b>{{$no++}}</b></td>
              @if ($data['folio'])                      
                <td rowspan="{{$cadena->indicios->count()}}"><b>{{$cadena->folio_bodega}}</b></td>
              @endif
              <td rowspan="{{$cadena->indicios->count()}}"><b>{{$cadena->nuc}}</b></td>
              <td rowspan="{{$cadena->indicios->count()}}"><b>{{date('d-m-Y', strtotime($cadena->entrada->fecha))}}</b></td>
              @if ($data['sp_entrega'])
                <td rowspan="{{$cadena->indicios->count()}}"><b>{{$cadena->entrada->perito->nombre}}</b></td>  
              @endif
              <td rowspan="{{$cadena->indicios->count()}}"><b>{{$cadena->fiscalia->nombre}}</b></td>
           
                
                  @foreach ($cadena->indicios as $indicio)
                    @if ($loop->iteration > 1)
                     <tr>
                    @endif
                      <td>{{$indicio->identificador}}</td>
                      <td>{{$indicio->descripcion}}</td>
                      @if ($data['indicio_estado'])  
                        <td>{{$indicio->estado}}</td>
                     @endif
                     
                     @if ($data['indicio_resguardo'])
                        <td>
                        @if ($indicio->estado === 'activo')
                              BODEGA
                        @elseif($indicio->estado === 'prestamo')
                           {{$indicio->prestamos->where('estado','activo')->first()->perito1->nombre}}
                        @elseif($indicio->estado === 'baja')
                           @isset ($indicio->baja->perito_id)
                              {{$indicio->baja->perito->nombre}}
                           @endisset
                           @empty($indicio->baja->perito_id)
                              {{$indicio->baja->quien_recibe}} <br>
                              {{$indicio->baja->identificacion}}
                           @endempty
                        @endif
                        </td>
                     @endif
                     
                     </tr>
                    
                  @endforeach
                
              
        
      @endforeach
  </tbody>
</table>

{{--
<table border="0">
  <tbody>
    @php
        $nombre = Auth::user()->name;
        $iniciales=substr($nombre,0,1);

        for ($i=0; $i < strlen($nombre)-1; $i++) {
          if($nombre[$i] == ' ')
            $iniciales = "{$iniciales}{$nombre[$i+1]}";
        }
      @endphp
    <tr>
      <td colspan="4" class="right-align border-no"></td>
    </tr>
    <tr>
      <td colspan="4" class="right-align border-no">{{$iniciales}}</td>
    </tr>
  </tbody>
</table>
--}}