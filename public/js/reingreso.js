// $(function(){
//    $('#btn-reingreso').click(function(e){
//       e.preventDefault();

//       var form = new FormData($('#form-reingreso')[0]);

//       $.ajax({
//          url: '/bodega/reingreso-save',
//          type: 'post',
//          data: form,
//          processData: false,
//          contentType: false,
//          success: function(respuesta){
//             if (respuesta.satisfactorio) {
//                $('#btn-reingreso').attr('disabled','disabled');
//                alertify.success("REINGRESO CON EXITO");
//                setTimeout(function(){
//                   window.location.href = '/bodega/prestamos';
//                   //window.location.href = 'anexos-pdf/'+data.id;
//                },800);
//             }
//             else{
//                console.log('Todo mal');
//             }
//          },
//          error: function(respuesta){
//             console.log('Todo mal');
//             console.log(respuesta);
//          }
//       });
//    });
// });
