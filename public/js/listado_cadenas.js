$(function(){

  if($('input:radio[name=listado_tipo]:checked').val() == 'listado_oficio'){
    $('.listado-indicio-estado').prop('disabled', true);
    $('.listado-indicio-estado').prop('checked', false);
    $('.listado-campo').prop('disabled', true);
    $('.listado-archivo').prop('checked', false);
    $('.listado-archivo').prop('disabled', true);
  }


  $('#add-buscar-texto').click(function(e){
    e.preventDefault();

      let texto;

      texto = 
        '<div class="input-field col s12">'+
          '<a href="" class="texto-x"><i class="fas fa-times i-x"></i></a>'+
          '<input type="text" class="buscar-texto" placeholder="Escriba algún texto" name="buscar_texto[]">'+
        '</div>';


      $('#div-row-textos').append(texto);
        
  });

  //Elimina texto
  $('body').on('click',".texto-x",function(e){
    e.preventDefault();
    console.log('entra');
    var hijos = $('#div-row-textos').children('div');
    if(hijos.length > 1){
      $(this).parent().remove();
      
    }
  });

  $('#add-nuc').click(function(e){
    e.preventDefault();

      var nuc;

      nuc = 
        '<div class="input-field col s3">'+
          '<a href="" class="nuc-x"><i class="fas fa-times i-x"></i></a>'+
          '<input id="nuc" type="text" placeholder="N.U.C" class="validate" name="nucs[]">'+
        '</div>';


      $('#div-row-nucs').append(nuc);
        
  });

  //Elimina NUC
  $('body').on('click',".nuc-x",function(e){
    e.preventDefault();
    console.log('entra');
    var hijos = $('#div-row-nucs').children('div');
    if(hijos.length > 1)
      $(this).parent().remove();
  });


  
  $('#select-fiscalia').change(function(){
    console.log($(this).val());
    console.log('longitud: '+ $(this).val().length);
    
    if( $(this).val().length === 0 ){
      $('.option-fiscalia').removeAttr('disabled');
      $('select').material_select();
    }

    if( $(this).val()[0] === "0" ){
      $('.option-fiscalia').attr('disabled','on');
      $('select').material_select();
    }
    
    $(this).val().forEach(element => {
      console.log(element);
      
    });
    
  });

  $('#select-naturaleza').change(function(){
    console.log($(this).val());
    console.log('longitud: '+ $(this).val().length);
    
    if( $(this).val().length === 0 ){
      $('.option-naturaleza').removeAttr('disabled');
      $('select').material_select();
    }

    if( $(this).val()[0] === "0" ){
      $('.option-naturaleza').attr('disabled','on');
      $('select').material_select();
    }
    
    $(this).val().forEach(element => {
      console.log(element);
      
    });
    
  });

  $('#buscar-texto').keyup(
    function(){
      console.log('entrasdasd');

      var texto = $("#buscar-texto").val().length;

      console.log(texto);

      if (texto) {
        $('#listado-indicio').removeAttr('disabled');
      }
      else{
        $('#listado-indicio').attr('disabled','disabled');

        if($('input:radio[name=listado_tipo]:checked').val() == 'listado_indicio'){
          console.log('holasdddaasjjj');
          $('input[name="listado_tipo"]').prop('checked', false);
          $("#listado-cadena").prop("checked", true);
          
        }
      }
      // console.log($('input:radio[name=listado_tipo]:checked').val());
    }
  );


  $('input:radio[name=listado_tipo]').click(function(){
    if($('input:radio[name=listado_tipo]:checked').val() == 'listado_oficio'){
      $('.listado-indicio-estado').prop('disabled', true);
      $('.listado-indicio-estado').prop('checked', false);
      $('.listado-campo').prop('checked', false);
      $('.listado-campo').prop('disabled', true);
      $('.listado-archivo').prop('checked', false);
      $('.listado-archivo').prop('disabled', true); 
    }
    else if($('input:radio[name=listado_tipo]:checked').val() == 'listado_general'){
      $('.listado-indicio-estado').prop('disabled', false);
      $("#indicio-activo").prop("checked", true);
      $('.listado-campo').prop('disabled', false);
      $('.listado-archivo').prop('disabled', false);
      $("#listado-pdf").prop("checked", true);
    }
    else if($('input:radio[name=listado_tipo]:checked').val() == 'listado_folio'){
      $("#listado-excel").prop("checked", false);
      $("#listado-excel").prop("disabled", true);
      $("#listado-pdf").prop("checked", true);
    }
  });

  
  $('.listado-indicio-estado').click(function(e){
    // e.preventDefault();
    console.log('asdsasd');
    let array_estado = $('[name="indicio_estado[]"]:checked').map(function(){
      return this.value;
    }).get();
    
    if(array_estado.length == 0){
      $(this).prop("checked", true);
    }

  });

});
