$(function(){
   $('.cadena-estado-bloqueada').tooltip(
      {
         enterDelay: 50,
         html: 'Estoy bloqueada.',
         position: 'bottom'
      }
   );
   $('.cadena-estado-revision').tooltip(
      {
         enterDelay: 50,
         html: 'Estoy en revisión.',
         position: 'bottom'
      }
   );
   $('.cadena-estado-rechazada').tooltip(
      {
         enterDelay: 50,
         html: 'Estoy rechazada.',
         position: 'bottom'
      }
   );
   $('.cadena-estado-espera').tooltip(
      {
         enterDelay: 50,
         html: 'Estoy en espera.',
         position: 'bottom'
      }
   );
   $('.cadena-estado-editar').tooltip(
      {
         enterDelay: 50,
         html: 'Estoy habilidata para edición.',
         position: 'bottom'
      }
   );
   //cadena baja
   $('.cadena-estado-baja').tooltip(
      {
         enterDelay: 50,
         html: 'Estoy dado de baja',
         position: 'bottom'
      }
   );
   //cadena prestamo
   $('.cadena-estado-prestamo').tooltip(
      {
         enterDelay: 50,
         html: 'Estoy en prestamo',
         position: 'bottom'
      }
   );
   //cadena prestamo parcial
   $('.cadena-estado-prestamo-parcial').tooltip(
      {
         enterDelay: 50,
         html: 'Tengo un prestamo parcial',
         position: 'bottom'
      }
   );
   //cadena observación
   $('.cadena-estado-observacion').tooltip(
      {
         enterDelay: 50,
         html: "Tengo una nota u observación.",
         position: 'bottom',
      }
   );
});

