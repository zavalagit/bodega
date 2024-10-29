@extends('cadenas.plantilla')


@section('contenido')
<a href="" class="waves-effect waves-light btn" id="btn-geo">button</a>

<div class="" id="map">

</div>

@endsection

@section('js')

  <script type="text/javascript">

    $('#btn-geo').click(function(e){
      e.preventDefault();
      if (navigator.geolocation) {
        $('#map').html('<p>Tu Navegador soporta geolocalización</p>');
      }else {
        $('#map').html('<p>Tu Navegador NO soporta geolocalización</p>');
      }


      function localizacion(posicion){
        var latitude = posicion.coords.latitude;
        var longitude = posicion.coords.longitude;

        $('#map').html('<p>Latitud: '+latitude+'<br>Longitud: '+longitude+'</p>');
      }
      function error(){
        $('#map').html('<p>No se pudo obtener tu ubicación</p>');
      }

      navigator.geolocation.getCurrentPosition(localizacion,error);
    });

  </script>
@endsection
