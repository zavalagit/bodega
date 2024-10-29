$(function(){

   $('#btn-capturar').click(function(e){
      e.preventDefault();
      var form = new FormData($('#form-foranea')[0]);

      console.log('entra aquí asd');


      $.ajax({
         data: form,
         url: "/bodega/guardar-foranea",
         type: "post",
         processData: false,
         contentType: false,
      }).done(function(data){
         console.log(data);

        if(data.satisfactorio){
            //alertify.logPosition("top right");
            alertify.success("Registro con exito");
            alertify.success("Espere un momento.");
            setTimeout(function(){
               location.reload();
            },2000);
         }
         else {
            //alertify.logPosition("top right");
            alertify.error(data.error[0]);
         }

      });
   });


    //Agrega nueva descripcion
      $('#add-desc').click(function(e)
      {
         e.preventDefault();
         var desc =
         '<div class="row">'+
            '<hr>'+
               '<div class="input-field col s2">'+
                  '<input id="identificador" type="text" class="center-align" name="identificador[]">'+
                  '<label for="identificador">Identificador</label>'+
               '</div>'+
               '<div class="input-field col s7">'+
                  '<textarea id="descripcion" class="materialize-textarea" name="descripcion[]"></textarea>'+
                  '<label for="descripcion">Descripcion</label>'+
               '</div>'+
               '<div class="input-field col s2">'+
                  '<input id="identificador" type="text" class="center-align" name="numero_indicios[]">'+
                  '<label for="identificador">No. Indicios</label>'+
               '</div>'+
               '<div class="input-field col s1 center-align">'+
                  '<button type="button" name="button" id="x-desc">'+
                     '<i class="fa fa-times" aria-hidden="true"></i>'+
                  '</button>'+
               '</div>'+
            '</div>';

         $('#identidad').append(desc);

      });
      //Elimina una descripcion
      $('body').on('click',"#x-desc",function(e){
         $(this).parent().parent().remove();
      });



});
