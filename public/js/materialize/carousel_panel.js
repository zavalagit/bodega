$(function(){
   $('.carousel').carousel({
      noWrap: true,
   });
   $('.carousel.carousel-slider').carousel({fullWidth: true});

   $('.adelante').click(function(e){
      e.preventDefault();
      $('.carousel').carousel('next');
   })
   $('.atras').click(function(e){
      e.preventDefault();
      $('.carousel').carousel('prev');
   })
});