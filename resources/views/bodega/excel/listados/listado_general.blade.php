<!DOCTYPE html>

<html>

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>LISTADO</title>
   <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/plugins/materialize/css/materialize.min.css">
   <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/css/listado_encabezado.css">
   <style media="screen">

   
   </style>
</head>

<body>
   <table class="">
      <thead>
         <tr>
            <th>Nº</th>
            @if ($data['datos']['campo_folio'])
               <th>FOLIO</th>
            @endif
            
            <th>N.U.C.</th>
            <th>FECHA</th>
            @if ($data['datos']['campo_sp_entrega'])  
            <th>SERVIDOR PÚBLICO INGRESA</th>
            @endif
            <th>REGIÓN</th>
			<th>
				naturaleza
			</th>
			<th>
				embalaje
			</th>
			<th>Indicio_id</th>
            <th>IDENTIFICADOR</th>
            <th>DESCRIPCIÓN</th>
            @if ($data['datos']['campo_indicio_estado'])
            <th>ESTADO</th>
            @endif
            <th>CANTIDAD I/E</th>
            @if ($data['datos']['campo_indicio_resguardo'])
            <th>RESGUARDO</th>  
            @endif
			
			
         </tr>
         </thead>
         <tbody>
          @php $no = 1; @endphp
          @foreach ($data['cadenas'] as $key => $cadena)
            @php
                if($data['datos']['request']['buscar_texto'][0] != null){
                  /*
                    Filter es para filtrar solo los registros que pasas dicha prueba
                    strripo es para encontrar alguna coincidencia en algun texto
                    En este caso solo queremos los indicios que en su descripcion haya un match con el texto que mandamos 
                  */
                  $indicios = $cadena->indicios->filter(function ($indicio, $key) use($data){
                        $buscar = false;
                      foreach ($data['datos']['request']['buscar_texto'] as $texto) {
                        $buscar = strripos($indicio->descripcion, $texto);

                        if( $buscar ){
                            return $indicio;
                        }
                      }   
                  })
                  #Estamos filtrando los indicios que estan en alguno de estos estados que mandamos ['activo','prestamo','baja']
                  ->WhereIn('estado',$data['datos']['request']['indicio_estado']);
                }
                else{
                  $indicios = $cadena->indicios->whereIn('estado',$data['datos']['request']['indicio_estado']);
                }
            @endphp

            <!-- Si la cantidad de indicios es cero, rompemos la iteracion-->
            @if ($indicios->count() == 0)
              @continue;
            @endif

            <tr>
               <td rowspan="{{$indicios->count()}}" {{--style="background-color: #C6C6C6; color: #ffffff;"--}}><b>{{$no++}}</b></td>
               @if ($data['datos']['campo_folio'])                      
                  <td rowspan="{{$indicios->count()}}"><b>{{$cadena->folio_bodega}}</b></td>
               @endif
               <td rowspan="{{$indicios->count()}}"><b>{{$cadena->nuc}}</b></td>
               <td rowspan="{{$indicios->count()}}"><b>{{date('d-m-Y', strtotime($cadena->entrada->fecha))}}</b></td> 
               @if ($data['datos']['campo_sp_entrega'])
                  <td rowspan="{{$indicios->count()}}"><b>{{$cadena->entrada->perito->nombre}}</b></td>  
               @endif
               <td rowspan="{{$indicios->count()}}"><b>{{$cadena->fiscalia->nombre}}</b></td>
			   <td rowspan="{{$indicios->count()}}"><b>{{$cadena->entrada->naturaleza->nombre}}</b></td>
			   <td rowspan="{{$indicios->count()}}"><b>{{$cadena->entrada->embalaje}}</b></td>
               @foreach ($indicios as $indicio)
                  @if ($loop->iteration > 1)
                     <tr>
                  @endif
				  <td>{{$indicio->id}}</td>
                  <td>{{$indicio->identificador}}</td>
                  <td>{{$indicio->descripcion}}</td>
                  @if ($data['datos']['campo_indicio_estado'])  
                     <td>{{strtoupper ($indicio->estado)}}</td>
                  @endif 
                  
                  <td>{{$indicio->numero_indicios}}</td>
                  
                  @if ($data['datos']['campo_indicio_resguardo'])    
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

      {{-- <table border="0">
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
      </table> --}}
   



</body>
