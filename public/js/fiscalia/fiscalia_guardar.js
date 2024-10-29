$(function(){
   //Boton Registrar Cadena Custodia
   $('#btn-fiscalia-guardar').click(function(e){
     console.log('entrasdasd');
     e.preventDefault();
     var form = new FormData($('#form-fiscalia')[0]);
     $(this).attr('disabled','on');

      url = '/administrador/fiscalia-guardar/'+$('#id-fiscalia').val();

     console.log(url);

     $.ajax({
       data: form,
       url: url,
       type: "post",
       processData: false,
       contentType: false,
     }).done(function(data){
         console.log(data);
 
 
       if(data.satisfactorio){

         alertify.success("¡REGISTRO CON EXITO!");
         
         setTimeout(function(){
            let url_back =  document.referrer;
            window.location.href = url_back;;
         },2000);
       }
       else {
         //alertify.logPosition("top right");
         alertify.error(data.error[0]);
         $('#btn-fiscalia-guardar').removeAttr('disabled');
       }
 
     });//ajax
   });
 
 });
 