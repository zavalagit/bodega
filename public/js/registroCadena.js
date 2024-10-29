$(function(){

   $('#btn-alta').click(function(e){
      e.preventDefault();
      console.log('entra');
      var form = new FormData($('#form-alta')[0]);

      $.ajax({
         data: form,
         url: "registro-cadena",
         type: "post",
         processData: false,
         contentType: false,
      }).done(function(data){
         console.log(data);
         if(data.satisfactorio == true){
            $('#btn-ver-pdf').removeClass('hide');
            $('#btn-ver-pdf').attr('data-folio',data.folio);
         }

      });
   });

   $('#nva-desc').click(function(e){
      e.preventDefault();
      var nvaDesc =
         '<div class="row">'+
            '<div class="input-field col s1">'+
               '<input type="text" name="">'+
            '</div>'+
            '<div class="input-field col s11">'+
               '<textarea id="descripcion" class="materialize-textarea" name="descripcion[]"></textarea>'+
               '<label for="descripcion">Descripcion</label>'+
            '</div>'+
         '</div>';

      $('#div-desc').append(nvaDesc);
   });

   $('#btn-ver-pdf').click(function(e)
   {
      e.preventDefault();
      var folio = $('#btn-ver-pdf').attr('data-folio');
   });



});
