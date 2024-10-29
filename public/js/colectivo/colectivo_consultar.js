$(function(){

   $('#b-fecha-inicio').change(function(){
      console.log('holas');
      console.log($(this).val());

      if ($(this).val())
         $('#b-fecha-fin').prop('disabled',false);
      else{
         $('#b-fecha-fin').val('');
         $('#b-fecha-fin').prop('disabled',true);
      }
   });

});