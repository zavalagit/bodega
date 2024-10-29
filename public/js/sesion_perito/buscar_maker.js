$(function(){

    var texto = $('#buscar-input').val();
    if(texto != ''){
      console.log('entro');
      $('td').mark(texto,{
        "separateWordSearch": false,
      });
    }


/*

    var remarcar = $('#buscar-texto').val();
    console.log(remarcar);
    if(remarcar != ''){
      $('td').mark(remarcar,{
        "separateWordSearch": false,
      });
    }
*/

});