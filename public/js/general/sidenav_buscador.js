$(function(){
   $('#sidenav-buscador').sidenav({
      // menuWidth: 600, // Default is 300
      edge: 'right',
      draggable: true,
   });
   $('.btn-sidenav-buscador-open').click(function(e){
      e.preventDefault();
      $('#sidenav-buscador').sidenav('open');
   });
});