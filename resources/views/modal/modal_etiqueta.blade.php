<!--Modal anexos-->
   {{--
     * Ejemplo del btn (etiqueta "a") o activador del modal
        <a href="" class="btn-anexo" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-3">
            <i class="fas fa-file-pdf fa-lg i-dorado"></i>
        </a>

     * Agregar
        <!--modal anexos-->
        @include('modal.modal_anexos')

     * JS
        <script type="text/javascript" src="{{asset('js/cadenas/anexos_pdf.js')}}" ></script>
   --}}
   <div id="modal-etiqueta" class="modal">
      <div class="modal-cerrar right-align">
         <a href="#" class="btn-modal-cerrar"><i class="fas fa-window-close fa-lg" style="color:#d50000"></i></a>
      </div>
      <div class="row">
         <div id="modal-header" class="col s12 modal-etiqueta-header">
            <p class="header-titulo" style="text-transform:uppercase;">Etiqueta de indicios</p>
            <p class="header-titulo header-folio"><!--nuc y/o folio--></p>
         </div>
      </div>
      <div id="modal-body" class="row modal-etiqueta-body">
         <div style="width: 98%;" class="right-align">
            <i style="color: #394049;" class="fas fa-sticky-note fa-2x"></i>
         </div>
         <div id="modal-contenido" class="row" style="margin-bottom:10px !important;">
            <form id="form-etiqueta" action="" target="_blank">
               
            </form>
         </div>
      </div>
      <div id="modal-footer" class="modal-etiqueta-footer">
         {{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a> --}}
      </div>
   </div>