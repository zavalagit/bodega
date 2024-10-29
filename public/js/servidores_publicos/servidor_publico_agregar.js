$(function(){

	$('.btn-modal-sp').click(function(e){
		e.preventDefault();

		let sp = $(this).attr('data-sp');
		let input = '<input id="input-sp" data-sp="'+sp+'" type="text" name="servidor_publico" placeholder="Agregar Servidor Público"></input>';
		let ul = '<ul id="lista-sp"></ul>';

		console.log(sp);
		

		$('.modal-contenido-sp').empty();
		$('.modal-contenido-sp').append(input);
		$('.modal-contenido-sp').append(ul);
		$('#modal-sp').modal('open');
	});

   $('body').on('keyup','#input-sp',function(){
	
		let sp = $(this).attr('data-sp');
		

		let buscar = $(this).val();
      let _token = $('#_token').val();
      //console.log(_token);
      //console.log(sp);
   
      if (buscar.length > 0) {
         $.ajax({
            url: '/users-lista',
            type: 'POST',
            data: {_token:_token,buscar:buscar},
            success:function(data){
					console.log('entrasssss');
					
               $('#lista-sp').empty();
               $.each(data.usuarios, function(i,usuario){
                  //console.log(usuario);
                  $('#lista-sp').append('<li><a href="" class="servidor"  data-sp="'+sp+'" data-id="'+usuario.id+'" data-folio="'+usuario.folio+'" data-name="'+usuario.name+'"><b>'+usuario.folio+'</b>: '+usuario.name+'</a></li>');
               });
            }
         });
      }
      else{
         $('.lista-sp').empty();
      }
   
   });


	$('body').on('click','.servidor',function(e){
		e.preventDefault();
		Materialize.updateTextFields();

		let sp = $(this).attr('data-sp');
		let sp_id = $(this).attr('data-id');
		let folio = $(this).attr('data-folio');
		let name = $(this).attr('data-name');

      /*
		let servidor = 
			'<div class="input-field col s11 m11 l5" class="'+sp+'-servidor">'+
				'<input type="hidden" id="" name="id_sp" value="'+sp_id+'">'+
				'<input type="text" id="" name="id_sp" value="'+data.perito.id+'">'+
			'</div>';
      */

      $('#servidor-'+sp).empty()
      let servidor = 
            '<input type="hidden" id="" name="id_sp" value="'+sp_id+'">'+
            '<input type="text" id="" value="'+name+'" readonly>';

      $('#servidor-'+sp).append(servidor);

		$('#modal-sp').modal('close');
	});


   $('body').on('click','.perito',function(e){
		e.preventDefault();

		$(document).ready(function() {
    		Materialize.updateTextFields();
  		});


  		$('.input-sp').val('');
  		$('.lista-'+sp).empty();

		let _token = $('#_token').val();
		let id = $(this).attr('data-id');

		$.ajax({
			url: "/get-perito",
			type: "post",
			data: {_token:_token,id:id},
		}).done(function(data){

				let servidor_publico =
				'<div class="row">'+
               '<input type="hidden" id="" name="id_sp" value="'+data.perito.id+'">'+
				   '<div class="input-field col s12 m3 l2">'+
				      '<input id="folio" type="text" readonly value="'+data.perito.folio+'">'+
				      '<label for="folio">FOLIO</label>'+
				   '</div>'+
				   '<div class="input-field col s12 m9 l6">'+
				      '<input id="nombre" type="text" readonly value="'+data.perito.nombre+'">'+
				      '<label for="nombre">NOMBRE</label>'+
				   '</div>'+
				   '<div class="input-field col s12 m6 l3">'+
				      '<input id="cargo" type="text" readonly value="'+data.cargo+'">'+
				      '<label for="cargo">CARGO</label>'+
				   '</div>'+
				   '<div class="input-field col s12 m1 l1 center-align">'+
				      '<a href="" class="x-sp" data-sp="'+sp+'">'+
				         '<i class="fas fa-times" style="color:red"></i>'+
				      '</a>'+
				   '</div>'+
				'</div>';

         $('#div-input-sp').hide();
        	$('#section-sp').append(servidor_publico);

			$(document).ready(function() {
				Materialize.updateTextFields();
			});
    	});//done
   });
   
   //Elimina un servidor publico
	$('body').on('click',".x-sp",function(e){
		e.preventDefault();
      $(this).parent().parent().remove();
      $('#div-input-sp').show();
	});
});


