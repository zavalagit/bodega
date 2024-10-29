<section>
   <div class="row row-no-margin">
      @component('componentes.componente_seccion_titulo')
         @slot('mensaje','3. ENTREGA (RESPONSABLE DE BODEGA) ~ ')
         @slot('icono','fas fa-user')
      @endcomponent
   </div>
   @include('user.user_input_autocomplete2',[
      'input_text' => 'baja-responsable-bodega-entrega',
      'input_hidden' => 'baja_entrega',
      'user_tipo' => 'responsable_bodega'
   ])
</section>