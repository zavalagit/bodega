$(function(){

   $('.carousel.carousel-slider').carousel({
      fullWidth: true,
      indicators: false,
      noWrap: true,
   });

   $('.carousel-item-next').click(function(e){
      e.preventDefault();
      $('.carousel').carousel('next');
   });
   $('.carousel-item-prev').click(function(e){
      e.preventDefault();
      $('.carousel').carousel('prev');
   });
   


});