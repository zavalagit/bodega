<div class="carousel carousel-slider center">
   {{ $slot }}
</div>

{{-- 
   css:
      <link rel="stylesheet" href="{{asset('/css/materialize/carousel_panel.css')}}">   

   html:
      @component('componentes.componente_carousel')
         <!--panel-1-->
         @component('componentes.componente_carousel_panel',['previo' => false, 'siguiente' => true])
            @include('prestamo.prestamo_multiple_panel_1')
         @endcomponent
         <!--panel-2-->
         @component('componentes.componente_carousel_panel',['previo' => true, 'siguiente' => false])
            @include('prestamo.prestamo_multiple_panel_2')
         @endcomponent
      @endcomponent

--}}
