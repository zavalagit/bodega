<html>
  <head>
    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/plugins/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/css/encabezados/listado_encabezado.css">
    <style>
      @page {
        margin: 0cm 0cm;
        font-family: Arial;
      }
      body {
        margin: 4cm 0.5cm 0.7cm 0.5cm;
      }
      header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 4cm;
        margin-left: 0.5cm;
        /* background-color: #2a0927; */
        /* color: white; */
        /* text-align: center; */
        /* line-height: 30px; */
      }
      footer {
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
        height: 0.7cm;
        /* background-color: #2a0927; */
        /* color: #bd; */
        /* text-align: center;
        line-height: 35px; */
        margin: 0 0.5cm;
        border-top: 1px solid #bdbdbd;
      }
      table.tabla-indicios{
        font-size: 6.5px !important;
      }
      table.tabla-indicios th{
        padding: 3px 3px 3px 3px !important;
        border: 0.8px solid #aaa;
        background-color: #bdbdbd
      }
      table.tabla-indicios td{
        border: 0.8px solid #aaa;
        padding: 3px 3px 3px 3px;
      }
      .page-number {
        text-align: center;
      }
      .page-number:before {
        font-size: 8px;
        content: "Página " counter(page);
      }
    </style>
  </head>
  <body>
    <header>
      @include('bodega.pdf.listados.listado_encabezado')
    </header>
    <footer>
      <div class="page-number"></div>
    </footer>

    <main>
      <table class="tabla-indicios">
        <thead>
          <tr>
            <th>NO.</th>
            @if ($datos['campo_folio'])
              <th>FOLIO</th>
            @endif
            <th>N.U.C.</th>
            <th>FECHA</th>
            @if ($datos['campo_sp_entrega'])  
              <th>SERVIDOR PÚBLICO INGRESA</th>
            @endif
            <th>REGIÓN</th>
            {{-- <th>IDENTIFICADOR</th> --}}
            <th>DESCRIPCIÓN</th>
            {{-- @if ($datos['campo_indicio_estado'])
              <th>ESTADO</th>
            @endif
            @if ($datos['campo_indicio_resguardo'])
              <th>RESGUARDO</th>  
            @endif --}}
          </tr>
        </thead>
        <tbody>
          @php $no = 1; @endphp
          @foreach ($cadenas as $key => $cadena)
            @php
                $indicios = $cadena->indicios()
                                    ->where(function($q) use($datos){
                                      foreach ($datos['request']['indicio_estado'] as $key => $estado) {
                                        $q->orwhere('estado', 'like',  '%' . $estado .'%');
                                      }
                                    })->get();

                if($datos['request']['buscar_texto'][0] != null){
                  $indicios = $indicios->filter(function ($indicio, $key) use($datos){
                        $buscar = false;
                      foreach ($datos['request']['buscar_texto'] as $texto) {
                        // dd($indicio->descripcion);
                        // dd($texto);
                        $buscar = stripos($indicio->descripcion,$texto);

                        if( $buscar !== false ){
                            return $indicio;
                        }
                      }   
                  });
                }
                
            @endphp

            @php
                // if($datos['request']['buscar_texto'][0] != null){
                //   /*
                //     Filter es para filtrar solo los registros que pasas dicha prueba
                //     strripo es para encontrar alguna coincidencia en algun texto
                //     En este caso solo queremos los indicios que en su descripcion haya un match con el texto que mandamos 
                //   */
                //   $indicios = $cadena->indicios->filter(function ($indicio, $key) use($datos){
                //         $buscar = false;
                //       foreach ($datos['request']['buscar_texto'] as $texto) {
                //         $buscar = strripos($indicio->descripcion, $texto);

                //         if( $buscar ){
                //             return $indicio;
                //         }
                //       }   
                //   })
                //   #Estamos filtrando los indicios que estan en alguno de estos estados que mandamos ['activo','prestamo','baja']
                //   // ->WhereIn('estado',$datos['request']['indicio_estado']);
                //   ->where(function($q) use($datos){
                //     foreach ($datos['request']['indicio_estado'] as $key => $estado) {
                //       $q->orwhere('estado', 'like',  '%' . $estado .'%');
                //     }
                //   });
                // }
                // else{
                //   // $indicios = $cadena->indicios->whereIn('estado',$datos['request']['indicio_estado']);
                //   $indicios = $cadena->indicios()
                //                 ->where(function($q) use($datos){
                //                   foreach ($datos['request']['indicio_estado'] as $key => $estado) {
                //                     $q->orwhere('estado', 'like',  '%' . $estado .'%');
                //                   }
                //                 })->get();
                // }
            @endphp

            <!-- Si la cantidad de indicios es cero, rompemos la iteracion-->
            @if ($indicios->count() == 0)
              @continue;
            @endif

            {{-- @if ( ($cadena->folio_bodega == '20-8994') || ($cadena->folio_bodega == '20-8995') || ($cadena->folio_bodega == '20-9000') || ($cadena->folio_bodega == '20-8997'))
                @continue;
            @endif --}}

            <tr style="page-break-before: avoid !important;" class="{{ ($no%2 == 0) ? 'grey lighten-4' : '' }}">
              <td {{--rowspan="{{$indicios->count()}}"--}} width="3%"><b>{{$no++}}</b></td>
              @if ($datos['campo_folio'])                      
                <td {{--rowspan="{{$indicios->count()}}"--}} width="6%"><b>{{$cadena->folio_bodega}}</b></td>
              @endif
              <td {{--rowspan="{{$indicios->count()}}"--}} width="10%"><b>{{$cadena->nuc}}</b></td>
              <td {{--rowspan="{{$indicios->count()}}"--}} width="7%"><b>{{date('d-m-Y', strtotime($cadena->entrada->fecha))}}</b></td>
              @if ($datos['campo_sp_entrega'])
                <td {{--rowspan="{{$indicios->count()}}"--}} width="10%"><b>{{$cadena->entrada->perito->nombre}}</b></td>  
              @endif
              <td {{--rowspan="{{$indicios->count()}}"--}} width="8%"><b>{{$cadena->fiscalia->nombre}}</b></td>

              <td>
                <table>
                  @foreach ($indicios as $indicio)
                      <tr style="page-break-inside: avoid !important;">
                        <td width="5%">{{$indicio->identificador}}</td>
                        <td>{{$indicio->descripcion}}</td>
                        @if ($datos['campo_indicio_estado'])  
                          <td width="7%">{{$indicio->estado ?? '---'}}</td>
                        @endif
                        @if ($datos['campo_indicio_resguardo'])  
                          <td width="13%" style="height: auto;">
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
                </table>
              </td>
              
              {{-- @foreach ($indicios as $indicio)
                @if ($loop->iteration > 1)
                  <tr style="page-break-before: avoid !important;" class="{{ ($no%2 == 0) ? '' : 'grey lighten-4' }}">
                @endif
                <td style="height: auto;" width="8%">{{$indicio->identificador}}</td>
                <td style="height: auto;">{{$indicio->descripcion}}</td>
                @if ($datos['campo_indicio_estado'])  
                  <td style="height: auto;" width="6%">{{strtoupper ($indicio->estado)}}</td>
                @endif        
                @if ($datos['campo_indicio_resguardo'])  
                  <td style="height: auto;" width="10%">
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
              @endforeach       --}}
            </tr>
          @endforeach
        </tbody>
      </table>
    </main>

    {{-- <script type="text/php">
      if ( isset($pdf) ) {
          $pdf->page_script('
              $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
              $pdf->text(1000, 100, "Pagina $PAGE_NUM de $PAGE_COUNT", $font, 10);
          ');
      }
  </script> --}}

  </body>
</html>