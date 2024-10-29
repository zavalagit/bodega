
$(function(){

    Materialize.updateTextFields();

    $(".button-collapse").sideNav({
      menuWidth: 220,
    });

   $('.slider').slider({
      indicators: false,
      height: 200,
      transition: 500,
      interval: 1500,
   });

//   $('.carousel.carousel-slider').carousel({fullWidth: true});

    $('select').material_select();

    $('.pushpin-demo-nav').each(function() {
    let $this = $(this);
    let $target = $('#' + $(this).attr('data-target'));
    $this.pushpin({
      top: $target.offset().top,
      bottom: $target.offset().top + $target.outerHeight() - $this.height()
    });
  });


    $('.modal').modal();


    
      $('.carousel').carousel();
});
