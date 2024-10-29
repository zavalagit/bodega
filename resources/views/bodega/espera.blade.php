
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
      .fa-times{
         color: #d50000 !important;
      }

      .th-descripcion,.td-descripcion{
         text-align: left !important;
      }
   </style>
@endsection

@section('titulo')
   ESPERA
@endsection
@section('seccion', 'CADENAS DE CUSTODIA EN ESPERA')

@section('contenido')

<span id="span-csrf" data-csrf="{{csrf_token()}}"></span>

   <table class="highlight bordered centered">
      
      <thead class="blue lighten-5">
         <tr>

            <th>Validar</th>
            <th>Folio</th>   
            <th>N.U.C.</th>
            <th class="th-descripcion">Descripción</th>
            <th>Anexo 3</th>
            <th>Anexo 4</th>
            <th>Etiqueta</th>
         <!--   
            <th>Editar</th>
         -->   
         </tr>
      </thead>
      <tbody>
         @isset($cadenas)
            @if (count($cadenas))
               @foreach ($cadenas as $cadena)
                  <tr>                  
                     
                     <td width="80"><a href="/bodega/alta/{{$cadena->id}}" data-id="{{$cadena->id}}"><i class="fa fa-check icon-check" aria-hidden="true"></i></a></td>
                     <td width="150">{{$cadena->folio_bodega}}</td>                              
                     <td width="150">{{$cadena->nuc}}</td>
                     <td class="td-descripcion" width="450" align="left">
                        @foreach ($cadena->indicios as $key => $indicio)
                           <b>{{$indicio->identificador}}</b>: {{$indicio->descripcion}}<br>
                        @endforeach
                     </td>
                     <td width="80"><a href="/anexo-3/{{$cadena->id}}" target="_blank"><i class="fa fa-file-pdf-o icon-anexo3" aria-hidden="true"></i></a></td>
                     <td width="80"><a href="/anexo-4/{{$cadena->id}}" target="_blank"><i class="fa fa-file-pdf-o icon-anexo4" aria-hidden="true"></i></a></td>
                     <td width="80"><a href="/etiqueta/{{$cadena->id}}" target="_blank"><i class="fa fa-file-pdf-o etiqueta" aria-hidden="true"></i></a></td>

                  <!--   
                     <td width="80"><a href="/editar-cadena/{{$cadena->id}}"><i class="fas fa-pencil-alt"></i></a></td>
                  -->   
                  </tr>
               @endforeach
            @else
               <tr>
                  <td colspan="9">
                     <blockquote class="yellow lighten-2">
                        @isset($buscar)
                           No se encontraron coincidencias con "{{$buscar}}"
                        @endisset
                        @empty($buscar)
                           <b>NO HAY REGISTROS</b>
                        @endempty
                     </blockquote>
                  </td>
               </tr>
            @endif
         @endisset
      </tbody>
   </table>


@endsection

@section('js')
   <script type="text/javascript">
      $('.li-bodega').removeClass('active');
      $('#li-espera').addClass('active').css({'font-weight':'bold'});
   </script>
@endsection
