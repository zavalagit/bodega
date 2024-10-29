$(function(){

   $('.registro-eliminar').click(function(e){
      e.preventDefault();
      let url =  $(this).attr('href');
      console.log(url);
      // console.log( $('#meta-csrf-token').attr('content') );

      //jquery-confirm
      $.confirm({
         theme: 'my-theme',
         icon: 'fas fa-exclamation-triangle',
         closeIcon: true,
         boxWidth: '30%',
         useBootstrap: false,
         title: '&nbsp; <strong style="color: #c09f77;">Eliminar</strong>',
         content: '<strong>¿Quiere continuar?</strong> <br><br> ' +
                  'Presione la tecla <strong style="font-size: 20px; color: tomato;">S</strong> para proceder a eliminar.',
         buttons: {
               yes: {
                  isHidden: true, // hide the button
                  keys: ['s'],
                  action: function () {
                        // $.alert(url);
                        $.ajax({ 
                           type: "post",
                           url: url,
                           data: {_token: $('#meta-csrf-token').attr('content')},               
                           success: function (respuesta) {
                              console.log('Si');
                              console.log(respuesta);
                              if(respuesta.status){
                                 alertify.success("SE ELIMINO REGISTRO");

                                    setTimeout(function(){
                                       location.reload();
                                    },1000);

                                 // alertify.success("SE ELIMINO REGISTRO");
                              }else{
                                 alertify.error("ERROR");

                              }
                           },
                           error: function(respuesta){
                              console.log('ERROR');
                              console.log(respuesta);
                           }
                        });
                  }
               },
               no: {
                  keys: ['n'],
                  btnClass: 'btn-orange',
                  action: function () {
                        // $.alert('You clicked No.');
                  }
               },
         }
      });

   });


});