<section>
   <div class="row row-no-margin">
      @component('componentes.componente_seccion_titulo')
         @slot('mensaje','3. USUARIO (RESPONSABLE DEL REGISTRO) ~ ')
         @slot('icono','fas fa-user')
      @endcomponent
   </div>
   @include('user.user_input_autocomplete3',[
      'input_text' => 'depuracion-responsable-bodega-registra',
      'input_hidden' => 'user_id',
      'user_tipo' => 'responsable_bodega'
   ])
</section>