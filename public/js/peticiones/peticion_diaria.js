$(function(){

    $('.modal-ver-peticion-diaria').click(function(e){
        e.preventDefault();

        let id = $(this).attr('data-id');
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
			url: '/peticion-get-registro',
			type: 'POST',
			data: {_token:_token,id:id},
			success:function(data){				

				console.log(data);
				

                let table = 
                    '<table>'+
                        '<thead>'+
                            '<tr>'+
                                '<th>N.U.C.</th>'+
                                '<th>Número Oficio</th>'+
                                '<th>Feha petición</th>'+
                                '<th>Servidor públic solicita</th>'+
                                '<th>Fecha elaboración</th>'+
                                '<th>Especialidad</th>'+
								'<th>Solicitud</th>'+
								'<th>Fecha entrega</th>'+
                                '<th>Servidor públic recibe</th>'+
                                '<th>Estudios</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                            '<tr>'+
                                '<td>'+data.registro.nuc+'</td>'+
                                '<td>'+data.registro.oficio_numero+'</td>'+
                                '<td>'+data.registro.fecha_peticion+'</td>'+
                                '<td>'+data.registro.sp_solicita+'</td>'+
                                '<td>'+data.registro.fecha_elaboracion+'</td>'+
                                '<td>'+data.registro.solicitud.especialidad.nombre+'</td>'+
                                '<td>'+data.registro.solicitud.nombre+'</td>'+
                                '<td>'+data.registro.fecha_entrega+'</td>'+
                                '<td>'+data.registro.sp_recibe+'</td>'+
                                '<td>'+data.registro.cantidad_estudios+'</td>'+
                            '</tr>'+
                        '</tbody>'+
                    '</table>';


        $('.modal-content').empty();
        $('.modal-content').append(table);
        $('#modal-registro').modal('open');


				

  				//Materialize.updateTextFields();
				//$('#form-etiqueta').append(contenido);
				//Materialize.updateTextFields();


				
			}

		});

        let table = 
            '<table>'+
                '<thead>'+
                    '<tr>'+
                        '<th>Name</th>'+
                        '<th>Item Name</th>'+
                        '<th>Item Price</th>'+
                    '</tr>'+
                '</thead>'+
                '<tbody>'+
                    '<tr>'+
                        '<td>Alvin</td>'+
                        '<td>Eclair</td>'+
                        '<td>$0.87</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Alan</td>'+
                        '<td>Jellybean</td>'+
                        '<td>$3.76</td>'+
                    '</tr>'+
                '</tbody>'+
            '</table>';


        $('.modal-content').empty();
        $('.modal-content').append(table);

        $('#modal-registro').modal('open');
    });

});