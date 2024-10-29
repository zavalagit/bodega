$(function(){

	$('.select-etiqueta').change(function(){
		var opcion = $(this).val();
		window.open(opcion,'_blank');
	});

});