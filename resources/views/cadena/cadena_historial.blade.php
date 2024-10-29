@extends('plantilla.template_sin_menu')

@section('titulo')
   HISTORIAL
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<link rel="stylesheet" href="{{asset('plugins/viewer_js/css/viewer.css')}}">
<link rel="stylesheet" href="{{asset('css/jconfirm/jconfirm_theme.css')}}">
   {{-- <link rel="stylesheet" href="{{asset('/css/tablas')}}"> --}}
   {{-- <link rel="stylesheet" href="{{asset('css/modal/modal.css')}}"> --}}
   <style type="text/css">
      body{
         margin: 0 !important;
         padding: 0 !important;
      }
      .table-width{
         width: 230% !important;
      }
      /* table{
         width: 100% !important;
      } */
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

      .fa-file-pdf-o{
         color: red;
         font-size: 20px;
      }

      table{
         border-spacing: 0 !important;
         border-collapse: separate !important;
         border: 0.1pt solid #c09f77;
      }
      table thead{
         background-color: #152f4a;
         color: #c09f77;
      }
      table tbody{
         background-color: #c6c6c6;
         font-weight: bold;
         border-radius: 0 !important;
      }
      table td, table th{
         border-radius: 0 !important;
         border: 0.1pt solid #fff;
      }
      table thead tr th.th-contador{
         background-color: #152f4a;
         color: #c09f77;
      }

      /* table{
         max-width: 100%;
  overflow-x: scroll;
      } */
   </style>
@endsection

@section('contenido')
   <div class="">
      <!--anexos-->
      @include('cadena.historial.historial_anexos')
      <!--entrada-->
      @include('cadena.historial.historial_entradas')      
      <!--prestamos-->
      @include('cadena.historial.historial_prestamos')            
      <!--bajas-->
      @include('cadena.historial.historial_bajas')                 
   </div>


<!-- Modal Anexos -->
@include('modal.modal_anexos')

<!--modal etiqueta-->
@include('modal.modal_etiqueta')


<!--foto-modal-bottom-->
<div id="modal-foto-form" class="modal bottom-sheet" style="background-color: rgba(192,159,119,0.4) !important">
   <div class="modal-content">
      asdasdasdasdadasdsd
   </div>      
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
   <script src="{{asset('js/prestamo_eliminar.js')}}" type="text/javascript"></script>
   <script src="{{asset('js/baja_eliminar.js')}}" type="text/javascript"></script>
   <!--ANEXOS-->
   {{-- <script type="text/javascript" src="{{asset('js/cadenas/anexo3_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/anexo4_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/etiqueta.js')}}" ></script> --}}

   <script src="{{asset('js/modal/modal.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/cadenas/anexos_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/etiqueta_pdf.js')}}" ></script>
   <script type="text/javascript" src="{{asset('js/cadenas/etiqueta.js')}}" ></script>

   <script src="{{asset('plugins/viewer_js/js/viewer.js')}}"></script>
   <script src="{{asset('plugins/viewer_js/js/jquery-viewer.js')}}"></script>
   <script>
      $(function(){

         $(document).on('click','.btn-fotos',function(e){
            e.preventDefault();
            console.log('entrasd');
            let modelo = $(this).attr('data-modelo');
            let modelo_id = $(this).attr('data-modelo-id');
            $('#fotos-'+modelo+'-'+modelo_id).viewer('show');
         });
      });

   </script>

   <script src="{{asset('js/foto/foto_form.js')}}"></script>
   <script src="{{asset('js/general/registro_eliminar.js')}}"></script>
@endsection
