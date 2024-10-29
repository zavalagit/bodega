$(function(){

    /**
     * Ejemplo del btn (etiqueta "a") o activador del modal
        <a href="" class="btn-anexo" data-cadena-id="{{$cadena->id}}" data-folio="{{$cadena->folio_bodega}}" data-nuc="{{$cadena->nuc}}" data-anexo-tipo="anexo-3">
            <i class="fas fa-file-pdf fa-lg i-dorado"></i>
        </a>

     * Agregar
        <!--modal anexos-->
        @include('modal.modal_anexos')

     * JS
        <script type="text/javascript" src="{{asset('js/cadenas/anexos_pdf.js')}}" ></script>
     */

    $('body').on('click','.btn-anexo',function(e){
		e.preventDefault();
        //obteniendo atributos
        let id_cadena = $(this).attr('data-cadena-id');
        let folio = $(this).attr('data-folio');
        let nuc = $(this).attr('data-nuc');
        let anexo_tipo = $(this).attr('data-anexo-tipo');
        //haceindo y agregando url
        let url = '/'+anexo_tipo+'/'+id_cadena;
        $('#form-anexo').attr('action',url);
        //agregando titulos
        $('.modal-anexo-header .header-titulo').empty();
        $('.modal-anexo-header .header-titulo').append(anexo_tipo);
        $('.modal-anexo-header .header-folio').empty();
        if(folio != '')
            $('.modal-anexo-header .header-folio').append(folio + ' - '+ nuc);    
        else
            $('.modal-anexo-header .header-folio').append(nuc);    
        //abriendo modal
        $('#modal-anexo').modal('open');
	});
    
});

      