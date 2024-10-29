<div class="row">
   @component('componentes.componente_seccion_titulo')
      @slot('mensaje','1. ANEXOS ~ ')
      @slot('icono','fas fa-file-pdf')
   @endcomponent

   <div class="col s12">
      <table>
         <thead>
            <tr>
               <th>ANEXO 3</th>
               <th>ANEXO 4</th>
               <th>ETIQUETA</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               @if($cadena->user_id != NULL)
                  <td>
                     <a href="" class="btn-anexo" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-3">
                        <i style="color: #c09f77;" class="fas fa-file-pdf fa-lg"></i>
                     </a>
                  </td>
                  <td>
                     <a href="" class="btn-anexo" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-4">
                        <i style="color: #c09f77;" class="fas fa-file-pdf fa-lg"></i>
                     </a>
                  </td>
                  <td>
                     <a href="" class="btn-etiqueta" data-cadena-id="{{$cadena->id}}">
                        <i class="fas fa-file-pdf fa-lg i-dorado"></i>
                     </a>
                  </td>
               @else
                  <td colspan="3">
                     <blockquote class="blockquote-aviso yellow lighten-2"><b>NO ES CADENA DE SISTEMA</b></blockquote>
                  </td>
               @endif
            </tr>
         </tbody>
      </table>
   </div>
   <div class="col s12"><hr class="hr-1"></div>
</div>