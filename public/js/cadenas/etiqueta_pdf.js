$(function(){

   /**
    * HTML
    *    <a href="" class="btn-etiqueta" data-cadena-id="{{$cadena->id}}">
            <i class="fas fa-file-pdf fa-lg i-dorado"></i>
         </a>

         <!--modal etiqueta-->
         @include('modal.modal_etiqueta')
    *
    *
    */

   $('body').on('click','.btn-etiqueta',function(e){
      e.preventDefault();
      // let _token = $('#meta-csrf-token').attr('content');
		let _token = $('meta[name="csrf-token"]').attr('content');
      // console.log(_token);
      let id_cadena = $(this).attr('data-cadena-id');
      
      $('#form-etiqueta').attr('action','/etiqueta-pdf/'+id_cadena);

      $.ajax({
         url: '/etiqueta-get-indicios/'+id_cadena,
         type: 'post',
         data: {_token:_token},
         // processData: false,
         // contentType: false,
         success: function(respuesta){
            // console.log(respuesta);
            $('#form-etiqueta').empty();
            /**
             * se agrega la vista modal.formulario_para_modal_etiqueta
             * es los que envia el controlador
             */
            $('#form-etiqueta').append(respuesta);
            $('#modal-etiqueta').modal('open');
         },
         error: function(respuesta){
            console.log('algo anda mal');
            console.log(respuesta);
         }
      });

   });

   /**
    * Click en etiqueta general
    */
   $('body').on('click','#etiqueta-general',function(){
      console.log($(this).prop('checked'));

      if($(this).prop('checked')){
         $('#etiqueta-identificador').prop('checked',false);
         $('#etiqueta-identificador').prop('disabled',true);
         $('.etiqueta-indicio').prop('checked',false);
         $('.etiqueta-indicio').prop('disabled',true);
      }
      else{
         $('#etiqueta-identificador').prop('disabled',false);
         $('.etiqueta-indicio').prop('disabled',false);
      }
   });
   /**
    * click en etiqueta por identificador
    */
   $('body').on('click','#etiqueta-identificador',function(){
      console.log($(this).prop('checked'));

      if($(this).prop('checked')){
         $('#etiqueta-general').prop('checked',false);
         $('#etiqueta-general').prop('disabled',true);
         $('.etiqueta-indicio').prop('checked',false);
         $('.etiqueta-indicio').prop('disabled',true);
      }
      else{
         $('#etiqueta-general').prop('disabled',false);
         $('.etiqueta-indicio').prop('disabled',false);
      }
   });
   /**
    * click en etiqueta personalizada
    */
   $('body').on('click','.etiqueta-indicio',function(){
      if( $(".etiqueta-indicio:checkbox:checked").length == 1 ){
         $('#etiqueta-general').prop('checked',false);
         $('#etiqueta-general').prop('disabled',true);
         $('#etiqueta-identificador').prop('checked',false);
         $('#etiqueta-identificador').prop('disabled',true);
      }
      else if( $(".etiqueta-indicio:checkbox:checked").length == 0){
         $('#etiqueta-general').prop('disabled',false);
         $('#etiqueta-identificador').prop('disabled',false);
      }
   });

   

});