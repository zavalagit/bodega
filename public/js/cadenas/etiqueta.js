$(function(){

	$('body').on('click','.etiqueta-pdf',function(e){
		e.preventDefault();

		var id = $(this).attr('data-id');
		var _token = $('meta[name="csrf-token"]').attr('content');

		console.log(id);

		$('#form-etiqueta').empty();

		$.ajax({
			url: '/etiqueta-datos',
			type: 'POST',
			data: {_token:_token,id:id},
			success:function(data){				

				console.log();

				if (data.indicios.length > 1) {					
					var identificadores="";
					$.each(data.indicios, function(index,value){
						console.log(value.identificador)

						identificadores=identificadores+
						'<p>'+
	           				'<input type="checkbox" id="identificador-'+value.identificador+'" class="etiqueta-indicio" name="'+index+'"/>'+
	            			'<label for="identificador-'+value.identificador+'">'+value.identificador+'</label>'+
	         			'</p>';
					});
					
	     			var contenido="";
	     			contenido =
	     					
	     					'<input type="hidden" id="id_cadena" name="id_cadena" value="'+id+'">'+
							'<p>'+
								'<input type="checkbox" id="etiqueta-general" name="etiqueta_general"/>'+
								'<label for="etiqueta-general">ETIQUETA GENERAL (Indicios en una sola etiqueta)</label>'+
							'</p>'+
							'<p>'+
								'<input type="checkbox" id="etiqueta-identificador" name="etiqueta_identificador"/>'+
								'<label for="etiqueta-identificador">ETIQUETA POR IDENTIFICADOR</label>'+
							'</p>'+
							'<p>Elije  los identificadores para etiqueta</p>'+
							identificadores+
							'<h5>Tamaño de Etiqueta</h5>'+
							'<p>'+
	      						'<input name="etiqueta_tamano" type="radio" id="chica" value="chica" required />'+
	      						'<label for="chica">CHICA</label>'+
	    					'</p>'+
						    '<p>'+
						      '<input name="etiqueta_tamano" type="radio" id="mediana" value="mediana"/>'+
						      '<label for="mediana">MEDIANA</label>'+
						    '</p>'+
						    '<p>'+
						      '<input name="etiqueta_tamano" type="radio" id="grande" value="grande"/>'+
						      '<label for="grande">GRANDE</label>'+
						    '</p>'+
						    '<button class="btn waves-effect waves-light" type="submit">'+
	    						'CREAR ETIQUETA'+
	  						'</button>';
				}
				else{
					var contenido="";
	     			contenido =
	     					
	     					'<input type="hidden" id="id_cadena" name="id_cadena" value="'+id+'">'+
							'<p>'+
								'<input type="checkbox" id="etiqueta-general" name="etiqueta_general" checked required/>'+
								'<label for="etiqueta-general">ETIQUETA GENERAL (Indicios en una sola etiqueta)</label>'+
							'</p>'+							
							'<h5>Tamaño de Etiqueta</h5>'+
							'<p>'+
	      						'<input name="etiqueta_tamano" type="radio" id="chica" value="chica" required />'+
	      						'<label for="chica">CHICA</label>'+
	    					'</p>'+
						    '<p>'+
						      '<input name="etiqueta_tamano" type="radio" id="mediana" value="mediana"/>'+
						      '<label for="mediana">MEDIANA</label>'+
						    '</p>'+
						    '<p>'+
						      '<input name="etiqueta_tamano" type="radio" id="grande" value="grande"/>'+
						      '<label for="grande">GRANDE</label>'+
						    '</p>'+						    
						    '<button class="btn waves-effect waves-light" type="submit">'+
	    						'CREAR ETIQUETA</i>'+
	  						'</button>';	  						
				}

  				Materialize.updateTextFields();
				$('#form-etiqueta').append(contenido);
				Materialize.updateTextFields();


				$('#modal-etiqueta').modal('open');
			}

		});

	});


//	$('#btn-crear-etiqueta').click(function(e){
/*
		var form = new FormData($('#form-etiqueta')[0]);

		console.log(form);

		$.ajax({
         data: form,
         url: "/etiqueta-personalizada",
         type: "get",
         processData: false,
         contentType: false,
      	}).done(function(data){
	       
      		console.log(data);

		});


/*
		e.preventDefault();

		var form = new FormData($('#form-etiqueta')[0]);

		var id = $('#id_cadena').val();
		console.log('id form: '+id);

		console.log(form);

		$.ajax({
		//	data: {_token:_token,id:id},
         data: form,
         url: "/etiqueta-crear",
         type: "POST",
         processData: false,
         contentType: false,
      	}).done(function(data){
	       
      		console.log(data);


      		if (data.satisfactorio){      			
      			var ruta = 'etiqueta/'+data.etiqueta+'/'+id;
      			window.open(ruta);
      		}
      		else{
      			alertify.logPosition("top right");
	            alertify.error(data.error[0]);
      		}



/*
	        document.location.target='_blank';
	        document.location.href = 'etiqueta/'+data.etiqueta+'/'+id;





      	//	setTimeout(function(){
	               //window.location.href = 'anexos-pdf/'+data.id;
	    //    },2000);

      		/*
	        if(data.satisfactorio){
	         
	            alertify.logPosition("top right");
	            alertify.success("Registro con exito");
	            alertify.success("Espere un momento.");
	            setTimeout(function(){
	               window.location.href = 'consultar-cadena?buscar='+data.nuc;
	               //window.location.href = 'anexos-pdf/'+data.id;
	            },2000);
	         }
	         else {
	            alertify.logPosition("top right");
	            alertify.error(data.error[0]);
	            $('#btn-registrar-cadena').removeAttr('disabled');
	         }
         */
//		});
//	});


	$('body').on('change','#etiqueta-general',function(){
		if(this.checked){
			$('#etiqueta-identificador').attr('disabled','disabled');
			$('.etiqueta-indicio').attr('disabled','disabled');
		}
		else{
			$('#etiqueta-identificador').removeAttr('disabled');
			$('.etiqueta-indicio').removeAttr('disabled');
		}
	});

	$('body').on('change','#etiqueta-identificador',function(){
		if(this.checked){
			$('#etiqueta-general').attr('disabled','disabled');
			$('.etiqueta-indicio').attr('disabled','disabled');
		}
		else{
			$('#etiqueta-general').removeAttr('disabled');
			$('.etiqueta-indicio').removeAttr('disabled');
		}
	});

	$('body').on('change','.etiqueta-indicio',function(){

		var bandera = 0;

		$(".etiqueta-indicio").each(function(index) {
			if(this.checked){
				bandera = bandera + 1;
			}	

		});


		if(bandera){
			$('#etiqueta-general').attr('disabled','disabled');
			$('#etiqueta-identificador').attr('disabled','disabled');
		}
		else{
			$('#etiqueta-general').removeAttr('disabled');
			$('#etiqueta-identificador').removeAttr('disabled');
		}
	});


});

      