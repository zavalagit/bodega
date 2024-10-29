$(function(){

	$('#add-desc').click(function(){
		var indicio = '<div class="row">'+
          '<div class="input-field col s2">'+
            '<input id="identificador" type="text" class="center-align" value="" name="identificador[]">'+
            '<label for="identificador">IDENTIFICADOR</label>'+
          '</div>'+
          '<div class="input-field col s7">'+
            '<textarea id="descripcion" class="materialize-textarea" name="descripcion[]"></textarea>'+
            '<label for="descripcion">DESCRIPCIÓN</label>'+
          '</div>'+
          '<div class="input-field col s2">'+
            '<input id="identificador" type="text" class="center-align" value="" name="numero_indicios[]">'+
            '<label for="identificador">NO. INDICIOS</label>'+
          '</div>'+
          '<div class="input-field col s1 center-align">'+
            '<button type="button" name="button" id="x-desc">'+
                '<i class="fa fa-times" aria-hidden="true"></i>'+
            '</button>'+
          '</div>'+
        '</div>';


        $('#indicios').append(indicio);

	});

});