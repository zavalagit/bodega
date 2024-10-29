$(function(){

   
   $('#inventario-actualizar').click(function(e){
      e.preventDefault();

      $("#loading-section").css({visibility:"visible",opacity:'100'});

      console.log('entrassaa');
      
      $.ajax({
         url: "/inventario-general-actualizar",
         type: "get",
       }).done(function(data){
           //console.log(data);
   
         if(data.satisfactorio){
           //alertify.logPosition("top right");
           alertify.success("Datos actualizados :D");
           setTimeout(function(){
            $("#loading-section").css({visibility:"hidden",opacity:'0'});
            location.reload();
            },1000);
         }
         else {
           //alertify.logPosition("top right");
           alertify.error(data.mensaje);
         }
      })
      
   });

});