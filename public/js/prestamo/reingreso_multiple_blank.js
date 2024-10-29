$(function(){
   $('#reingreso-multiple').click(function(){
      if ( $(this).prop('checked') ){
         $('#btn-buscar').attr('formtarget','_blank');
      }
      else{
         $('#btn-buscar').removeAttr('formtarget');
      }
   });
});