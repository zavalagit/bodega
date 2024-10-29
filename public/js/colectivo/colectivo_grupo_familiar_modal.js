$(function(){

   $('.btn-grupo-familiar').click(function(e){
      e.preventDefault();
      let colectivo_id = $(this).attr('data-colectivo-id');
      let _token = $('#meta-csrf-token').attr('content');

      $.ajax({
         type: "post",
         url: "/colectivo-modal-grupo-familiar/" + colectivo_id,
         data: {'_token': _token},
         // dataType: "dataType",
         success: function (vista) {
            console.log(vista);
            $('section#modal-asd').empty();
            $('section#modal-asd').append(vista);
            $('.modal').modal();
            $('#modal-grupo-familiar').modal('open');
            $('#colectivo-grupo-familiar').focus();

         }
      });
   });

});