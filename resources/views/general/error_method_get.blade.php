@if ($errors->any())
   <script type="text/javascript">
      const error = @json($errors->first());
      alertify.error(error);
   </script>
@endif