$(function(){

   console.log($.browser);
   console.log(navigator.appCodeName);
   console.log(navigator.userAgent);
   
   

   if (navigator.userAgent.indexOf("Edge") > -1) {
      alertify.alert('Hay funciones no compatibles con "Internet Explorer". Use el navegador "Google Chrome"');
   }

});