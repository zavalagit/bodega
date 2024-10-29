
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
   RECHAZADAS
@endsection
@section('seccion', 'CADENAS DE CUSTODIA RECHAZADAS')

@section('contenido')

<span id="span-csrf" data-csrf="{{csrf_token()}}"></span>

   <table class="highlight bordered centered">
      
      <thead class="blue lighten-5">
         <tr>         
            <th>N.U.C.</th>
            <th class="th-descripcion">Descripción</th>
            <th>Anexo 3</th>
            <th>Anexo 4</th>
            <th>Etiqueta</th>  
         </tr>
      </thead>
      <tbody>
         @isset($cadenas)
            @if (count($cadenas))
               @foreach ($cadenas as $cadena)
                  <tr>                               
                     <td width="150">{{$cadena->nuc}}</td>
                     <td class="td-descripcion" width="450" align="left">
                        @foreach ($cadena->indicios as $key => $indicio)
                           <b>{{$indicio->identificador}}</b>: {{$indicio->descripcion}}<br>
                        @endforeach
                     </td>
                     <td width="80"><a href="/anexo-3/{{$cadena->id}}" target="_blank"><i class="fa fa-file-pdf-o icon-anexo3" aria-hidden="true"></i></a></td>
                     <td width="80"><a href="/anexo-4/{{$cadena->id}}" target="_blank"><i class="fa fa-file-pdf-o icon-anexo4" aria-hidden="true"></i></a></td>
                     <td width="80"><a href="/etiqueta/{{$cadena->id}}" target="_blank"><i class="fa fa-file-pdf-o etiqueta" aria-hidden="true"></i></a></td>
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



   <!--Modal Rechazo-->
   <div id="nota" class="modal">
      <div class="modal-content">
         <h5>Nota</h5>
         <div class="row">
            <form class="col s12" id="form-nota">
               <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
               <input type="hidden" id="id_cadena_modal" name="id_cadena" value="">
               <div class="row">
                 <div class="input-field col s12">
                   <textarea id="nota-mensaje" name="nota" class="materialize-textarea"></textarea>
                   <label for="textarea1"></label>
                 </div>
               </div>
               <div class="row">
                  <div class="col s1 offset-s11">                     
                     <a class="right-align" id="btn-nota" href=""><i class="fa fa-paper-plane" aria-hidden="true"></i></a> 
                  </div>                  
               </div>
            </form>
         </div>
      </div>
      <!--
      <div class="modal-footer">
         <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
      </div>
      -->
   </div>


   <!--Modal Validar-->
   <div id="modal-validar" class="modal">
      <div class="modal-content">
         <h5>Validar cadena</h5>
         <div class="row">
            <form class="col s12" id="form-nota">
               <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
               <input type="hidden" id="id_modal_validar" name="id_cadena" value="">
               <div class="row">
                 <div class="input-field col s12">
                   <input id="bodega" type="text" class="validate">
                  <label for="first_name">Folio Interno Bodega</label>
                 </div>
               </div>
               <div class="row">
                  <div class="col s1 offset-s11">                     
                     <a class="right-align" id="btn-nota" href=""><i class="fa fa-check icon-check" aria-hidden="true"></i></a> 
                  </div>                  
               </div>
            </form>
         </div>
      </div>
      <!--
      <div class="modal-footer">
         <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
      </div>
      -->
   </div>

@endsection

@section('js')
   <script type="text/javascript">
      $('.li-bodega').removeClass('active');
      $('#li-rechazadas').addClass('active').css({'font-weight':'bold'});
   </script>
@endsection
