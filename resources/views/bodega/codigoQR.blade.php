@extends('bodega.plantilla')

@section('titulo')
   CADENA
@endsection

@section('css')
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
   <style type="text/css">
      body{
         margin: 0 !important;
         padding: 0 !important;
      }
      table{
         width: 230% !important;
      }
      td{
         vertical-align: top !important;
      }
      h5{
       margin: 0 !important;
         padding: 0 !important;  
      }
      blockquote{
         padding: 1px 0 !important;
         color: #fff !important;
         background-color: #112046 !important;
         font-size: 13px !important;
         text-align: center;
         margin: 0 !important; 
      }
      .blockquote-aviso{
         color: #000 !important;
         text-align: left;
         padding-left: 10px !important;
      }
   </style>
@endsection


@section('contenido')
   <div class="amber"> 
      <h5 class="center-align">
         <b>HISTORIAL - CADENA {{$cadena->folio_bodega}}</b>
      </h5>
   </div>

   <blockquote>
      <b>P R E S T A M O S</b>
   </blockquote>

   <div class="tabla">
      <table>
         <thead>
            <tr class="blue lighten-5">
               <th>EDITAR</th>
               <th>ELIMINAR</th>
               <th>FOLIO</th>
               <th>N.U.C.</th>
               <th>NO. INDICIOS</th>
               <th>HORA SALIDA</th>
               <th>FECHA SALIDA</th>
               <th>INDICIOS DEVUELTOS</th>
               <th>HORA REINGRESO</th>
               <th>FECHA REINGRESO</th>
               <th>RB PRESTA</th>
               <th>QUIEN SE LO LLEVA</th>
               <th>QUIEN ENTREGA</th>
               <th>RB RECIBE</th>
               <th>QUIEN AUTORIZA</th>                  
               <th>DESCRIPCIÓN</th>
               <th>PDF</th>
            </tr>
         </thead>
         <tbody>
            @if( count($cadena->prestamos) )
               @foreach($cadena->prestamos as $key => $prestamo)         
                  <tr>
                     <td><a href="/bodega/editar-prestamo/{{$prestamo->id}}" target="blank"><i class="fas fa-pencil-alt"></i></a></td>
                     <td><a href="" class="btn-eliminar-prestamo" data-id="{{$prestamo->id}}"><i style="color:#b71c1c" class="fa fa-trash" aria-hidden="true"></i></a></td>
                     <td>{{$cadena->folio_bodega}}</td>
                     <td>{{$cadena->nuc}}</td>               
                     <td>{{$prestamo->prestamo_numindicios}}</td>
                     <td>{{$prestamo->prestamo_hora}}</td>
                     <td>{{$prestamo->prestamo_fecha}}</td>
                     @if($prestamo->estado == 'concluso')
                        <td>{{$prestamo->reingreso_numindicios}}</td>
                        <td>{{$prestamo->reingreso_hora}}</td>
                        <td>{{$prestamo->reingreso_fecha}}</td>
                     @else
                        <td>***</td>
                        <td>***</td>
                        <td>***</td>                  
                     @endif
                     <td>{{$prestamo->user1->name}}</td>
                     <td>{{$prestamo->perito1->nombre}}</td>
                     @if($prestamo->estado == 'concluso')
                        <td>{{$prestamo->user2->name}}</td>
                        <td>{{$prestamo->perito2->nombre}}</td>
                     @else
                        <td>***</td>
                        <td>***</td>                  
                     @endif
                     <td>{{$prestamo->prestamo_ordena}}</td>
                     <td style="width: 20%">                  
                        @foreach($prestamo->indicios as $key => $indicio)
                           <b>{{$indicio->identificador}} :</b>{{$indicio->descripcion}}<br>
                        @endforeach
                     </td>
                     <td>
                     <a href="/bodega/prestamo-pdf/{{$prestamo->id}}" target="blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                     </td>
                  </tr>
               @endforeach
            @else
               <tr>
                  <td colspan="17">                     
                     <blockquote class="blockquote-aviso yellow lighten-2"><b>NO HAY REGISTROS</b></blockquote>
                  </td>
               </tr>
            @endif
         </tbody>
      </table>   
   </div>

   <blockquote><b>B A J A S</b></blockquote>
   <div class="tabla">
      <table>
         <thead>
            <tr class="blue lighten-5">
               <th>EDITAR</th>
               <th>ELIMINAR</th>
               <th>FOLIO</th>
               <th>N.U.C.</th>
               <th>NO. INDICIOS</th>
               <th>HORA SALIDA</th>
               <th>FECHA SALIDA</th>               
               <th>DESCRIPCIÓN</th>
               <th>RB ENTREGA</th>               
               <th>RECIBE</th>
               <th>IDENTIFICACIÓN</th>
               <th>CARGO</th>
               <th>OBSERVACIONES</th>
               <th>TIPO BAJA</th>
               <th>PDF</th>
            </tr>
         </thead>
         <tbody>
            @if( count($cadena->bajas) )
               @foreach($cadena->bajas as $key => $baja)         
                  <tr>
                     <td><a href="/bodega/baja-editar/{{$baja->id}}" target="blank"><i class="fas fa-pencil-alt"></i></a></td>
                     <td><a href="" class="btn-eliminar-baja" data-id="{{$baja->id}}"><i style="color:#b71c1c" class="fa fa-trash" aria-hidden="true"></i></a></td>
                     <td>{{$cadena->folio_bodega}}</td>
                     <td>{{$cadena->nuc}}</td>               
                     <td>{{$baja->numero_indicios}}</td>
                     <td>{{$baja->hora}}</td>
                     <td>{{$baja->fecha}}</td>                                 
                     <td style="width: 20%">                  
                        @foreach($baja->indicios as $key => $indicio)
                           <b>{{$indicio->identificador}} :</b>{{$indicio->descripcion}}<br>
                        @endforeach
                     </td>
                     <td>{{$baja->user->name}}</td>
                     @isset($baja->quien_recibe)
                        <td>{{$baja->quien_recibe}}</td>
                        <td>{{$baja->identificacion}}</td>
                        <td>***</td>
                     @endisset
                     @empty($baja->quien_recibe)
                        <td>{{$baja->perito->nombre}}</td>
                        <td>{{$baja->perito->folio}}</td>
                        <td>{{$baja->perito->cargo}}</td>
                     @endempty                 
                     <td>{{$baja->observaciones}}</td>
                     <td>{{strtoupper($baja->tipo)}}</td>
                     <td>
                        <a href="/bodega/baja-pdf/{{$baja->id}}" target="blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                     </td>
                  </tr>
               @endforeach
            @else
               <tr>
                  <td colspan="16">                     
                     <blockquote class="blockquote-aviso yellow lighten-2"><b>NO HAY REGISTROS</b></blockquote>
                  </td>
               </tr>
            @endif
         </tbody>
      </table>
   </div>
@endsection

@section('js')

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
   <script src="{{asset('js/prestamo_eliminar.js')}}" type="text/javascript"></script>
   <script src="{{asset('js/baja_eliminar.js')}}" type="text/javascript"></script>
@endsection
