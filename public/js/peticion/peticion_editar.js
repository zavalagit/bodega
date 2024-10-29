$(function(){

   // $('input.readonly').readonly(true);
   $('input[type="text"].readonly').prop('readonly',true);
   $('input[type="date"].readonly').prop('readonly',true);
   $('input[type="number"].readonly').prop('readonly',true);
   $('.readonly:radio:not(:checked)').attr('disabled', true);
   $('select.readonly option:not(:selected)').attr('disabled',true);
   $('select').formSelect();

});