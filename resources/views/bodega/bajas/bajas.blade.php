@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      .fa-search{
         color: #4db6ac;
      }
      .row{
         margin: 0 !important;
         padding: 0 !important;
      }
      .fa-file-pdf-o{
         color: #d50000;
      }
      thead{
         background-color:
      }
      .fa-check{
         color: #4caf50;
      }
      .fa:hover{
         font-size: 1.3em;
      }
      .icon-check:hover{
         font-size: 1.5em;
      }


     .td-descripcion, .th-descripcion{
      text-align: left !important;

     }

     td{
      vertical-align: top !important;
     }

     h5{
      padding: 0 !important;
      margin: 0 !important;
      color:#112046;
   }

   table{
       width: 180% !important;
   }
   .tabla{
      margin: 0 !important;
      padding: 0 !important;
   }
   td{
      vertical-align: top !important;
   }
   .center{
      text-align: center;
   }

   </style>
@endsection

@section('titulo')
   BAJAS
@endsection
@section('seccion', 'BAJAS')

@section('contenido')

{{--
   <div class="row">
      <form class="col s12">
         <div class="row">
            <div class="input-field col s4 offset-s8">
               <i class="fa fa-search prefix" aria-hidden="true"></i>
               @isset($buscar)
                  <input id="icon_prefix" type="text" name="buscar" value="{{$buscar}}">
               @endisset
               @empty($buscar)
                  <input id="icon_prefix" type="text" name="buscar">
               @endempty
               <label for="icon_prefix">Buscar...</label>
            </div>
         </div>
      </form>
   </div>
--}}


   <div class="tabla">
      <table class="responsive-table highlight  bordered">
         <thead>
            <tr>
               <th>FOLIO</th>
               <th class="center">EDITAR</th>
               <th class="center">PDF</th>
               <th>N.U.C.</th>
               <th class="center">NO. INDICIOS</th>
               <th class="center">HORA</th>
               <th class="center">FECHA</th>
               <th>DESCRIPCIÓN</th>
               <th>RESPONSABLE (ENTRAGA)</th>
               <th>RECIBE</th>
               <th>CADENA</th>
            </tr>
         </thead>

         <tbody>
            @isset($bajas)             
               @foreach($bajas as $key => $baja)
                  @if($baja->tipo == 'definitiva')
                  <tr class="red lighten-5">
                  @else
                  <tr class="lime lighten-5">
                  @endif
                     <td><b>{{$baja->cadena->folio_bodega}}</b></td>
                     <td class="center">
                        <a href="/bodega/baja-editar/{{$baja->id}}">
                           <i style="color:#2196f3" class="fas fa-pencil-alt"></i>      
                        </a>
                     </td>
                     <td class="center">
                        <a href="/bodega/baja-pdf/{{$baja->id}}" target="_blanck">
                           <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                        </a>
                     </td>
                     <td>{{$baja->cadena->nuc}}</td>
                     <td class="center">{{$baja->numero_indicios}}</td>
                     <td class="center">{{$baja->hora}}</td>
                     <td class="center">{{$baja->fecha}}</td>
                     <td style="width: 35%">
                        @foreach($baja->indicios as $key => $indicio)
                           <b>{{$indicio->identificador}}: </b>{{$indicio->descripcion}} <br>
                        @endforeach
                     </td>

                     <td>{{$baja->user->name}}</td>

                     @if($baja->quien_recibe != NULL)   
                     <td>{{$baja->quien_recibe}}</td>
                     @else
                     <td>{{$baja->perito}}</td>
                     @endif

                     @if($baja->estado_cadena == 'o')                  
                        <td>
                           No entregada   
                        </td>
                     @else
                        <td>
                           Entregada   
                        </td>
                     @endif                     
                  </tr>
               @endforeach   
            @endisset
            @empty($bajas)            
               <tr>
                  <td colspan="9">
                     <blockquote class="yellow lighten-2">No hay registros</blockquote>
                  </td>
               </tr>
            @endempty
         </tbody>
      </table>
   </div>
@endsection

@section('js')
   <script type="text/javascript">
      $('.li-cadenas').removeClass('active');
      $('.li-cedulas').addClass('active').css({'font-weight':'bold'});
   </script>
@endsection

