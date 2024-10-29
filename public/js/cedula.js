$(function(){

   $('#btn-guardar-cedula').click(function(e){
      e.preventDefault();
      console.log('hola cedula');
      var form = new FormData($('#form-alta')[0]);

      $.ajax({
         data: form,
         url: '/bodega/save_alta',
         type: 'post',
         processData: false,
         contentType: false,
      }).done(function(data){
         console.log(data);

         if(data.satisfactorio){
//             alertify.logPosition("top right");
             alertify.success("Se dio Cadena de alta con el folio: "+data.folio);

             setTimeout(function(){
                window.location.href = '/bodega/revisar';
             },1500);

          }
          else {
//             alertify.logPosition("top right");
             alertify.error(data.error[0]);
             //window.location.href = 'editar-cadena-perito/11';
          }

      });
   });


   //Determinando fecha de entrega por default
   var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;
    $("#fecha").attr("value", today);

});
