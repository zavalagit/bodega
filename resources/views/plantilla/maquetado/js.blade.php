<!--JS-->

<!--jQuey-->
<script src="{{asset('plugins/jQuery/jquery.min.js')}}"></script>
<!--materialize-->
{{-- <script src="{{asset('plugins/materialize/js/materialize.js')}}"></script> --}}
<script src="{{asset('plugins/materialize-v1.0.0/js/materialize.js')}}"></script>
<script src="{{asset('js/materialize/materialize_inicializar_componentes.js')}}"></script>
<!--js del template-->
<script src="{{asset('js/template/template_slider.js')}}"></script>
<!--js readonly-->
<script src="{{asset('plugins/readonly_js/readonly.js')}}"></script>
{{-- <script src="{{asset('plugins/readonly_js/test.js')}}"></script> --}}
<!--alertify-->
<script src="{{asset('plugins/alertify/js/alertify.min.js')}}"></script>
<!--funciones jQuery de materialize-->
{{-- <script src="{{asset('js/sesion_rbi/materialize.js')}}"></script> --}}
<!--JS Maker-->
<script src="{{asset('plugins/js_maker/jquery.mark.min.js')}}" charset="UTF-8"></script>
<!--plantilla-->
<script src="{{asset('js/plantilla/plantilla_item_selected.js')}}"></script>
<!--js para las vistas-->
@yield('js')