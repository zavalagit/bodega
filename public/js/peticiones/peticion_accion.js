$(function(){

	$('.modal').modal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      inDuration: 300, // Transition in duration
      outDuration: 200, // Transition out duration
      startingTop: '4%', // Starting top style attribute
      endingTop: '10%', // Ending top style attribute
			/*
      ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
        alert("Ready");
        console.log(modal, trigger);
      },
      complete: function() { alert('Closed'); } // Callback for Modal close
			*/
    }
  );


	$('.btn-modal').click(function(e){
      e.preventDefault();

      console.log('entrasss');
      

      let fecha_hoy = $(this).attr('data-fecha-hoy');
      let peticion = $(this).attr('data-peticion');
      peticion = peticion + '"}';
      peticion = JSON.parse(peticion);
      console.log(fecha_hoy);
      
      console.log(peticion);
      
      
      let enlaces = "";
      let enlace_cadena_editar = "";
      
         // var folio = $(this).attr('data-folio');
         // var id = $(this).attr('data-id');
         // var cadena_editar = $(this).attr('data-cadena-editar');

         @if ( date('Y-m-d', strtotime($peticion->created_at) ) == $fecha_hoy )
         <a href="/peticion-editar/{{$peticion->id}}">
            <i class="fas fa-pen"></i>
         </a>
      @else
         <i class="fas fa-lock"></i>
      @endif
      

   
      $('.modal-folio').html("<b>N.U.C.: "+peticion.nuc+"</b>");

      if( peticion.created_at == fecha_hoy ){
         enlaces =
            '<div class="modal-enlace center-align">'+
               '<a class="peticion-eliminar" data-id="'+peticion.id+'" href=""'>+
                 'ELIMINAR <i class="fas fa-times"></i>'+
               '</a>'+
            '</div>'+
            '<div class="modal-enlace center-align">'+
               '<a href="/peticion-editar/'+peticion.id+'"'>+
                  'EDITAR <i class="fas fa-times"></i>'+
               '</a>'+
            '</div>';
      }
      else{
         enlaces = 
            '<div class="modal-enlace center-align">'+
               'ELIMINAR <i class="fas fa-lock"></i>'+
            '</div>'+
            '<div class="modal-enlace center-align">'+
               'EDITAR <i class="fas fa-lock"></i>'+
            '</div>'+
      }



      /*
      enlaces = 
         '<div class="modal-enlace center-align">'+
            '<a href="/bodega/editar/'+id+'" target="_blank" style="font-size: 14px" class="link-editar-ingreso"><i class="fas fa-pen"></i> EDITAR INGRESO</a>'+
         '</div>'+
         '<div class="modal-enlace center-align">'+
            '<a href="/bodega/historial-cadena/'+folio+'" target="_blank" style="font-size: 14px" class="link-historial"><i class="fas fa-clock"></i> HISTORIAL</a>'+
         '</div>'+
         '<div class="modal-enlace center-align">'+
            '<a href="/bodega/prestamo/'+folio+'" target="_blank" style="font-size: 14px" class="link-prestamo"><i class="fas fa-arrow-circle-left"></i> PRESTAMO</a>'+
         '</div>'+
         '<div class="modal-enlace center-align">'+
            '<a href="/bodega/baja/'+folio+'" target="_blank" style="font-size: 14px" class="link-baja"><i class="fas fa-arrow-circle-down"></i> BAJA</a>'+
         '</div>';
*/
      $('.modal-seccion-enlaces').empty();
      $('.modal-seccion-enlaces').append(enlaces);
      $('.modal-seccion-enlaces').append(enlace_cadena_editar);
		$('#modal1').modal('open');

	});


	$('.btn-modal-cerrar').click(function(e){
		e.preventDefault();

		$('#modal1').modal('close');
   });
   


});
