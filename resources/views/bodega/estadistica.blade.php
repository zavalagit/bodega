@extends('bodega.plantilla')

@section('css')
  <style media="screen">
    .encabezado h5{
      margin: 0 !important;
      padding: 0 !important;
    }
    body{
      background-color: #e3f2fd;
    }
  </style>
@endsection

@section('contenido')

  <section>
    <div class="encabezado">
       <h5 class="amber center-align"><b>{{$mes}} {{$year}} </b></h5>
    </div>

    <table class="highlight">
        <thead style="background-color:#142c67; color:rgb(255, 255, 255); ">
          <tr>
              <th>FISCALIA</th>
              <th class="center-align">indicios</th>
              <th class="center-align">evidencias</th>
              <th class="center-align">PRESTAMOS</th>
              <th class="center-align">BAJAS</th>
          </tr>
        </thead>

        @php
          $total_indicios = 0;
          $total_evidencias=0;
          $total_prestamos=0;
          $total_bajas=0;
        @endphp
        <tbody class="blue lighten-5">
          @foreach ($fiscalias as $i => $fiscalia)
            @php
              $no_indicios=0;
              $no_evidencias=0;
              $no_prestamos=0;
              $no_bajas=0;
            @endphp
            @foreach ($entradas as $j => $entrada)
              @if ($entrada->cadena->fiscalia_id == $fiscalia->id)
                @php
                  if ($entrada->tipo == 'indicio') {
                    $no_indicios = $no_indicios + $entrada->cadena->indicios->sum('numero_indicios');
                  }else {
                    $no_evidencias = $no_evidencias + $entrada->cadena->indicios->sum('numero_indicios');
                  }
                @endphp
              @endif
            @endforeach
            @foreach ($prestamos as $j => $prestamo)
              @if ($prestamo->cadena->fiscalia_id == $fiscalia->id)
                @php
                  $no_prestamos = $no_prestamos + $prestamo->indicios->sum('numero_indicios');
                @endphp
              @endif
            @endforeach
            @foreach ($bajas as $j => $baja)
              @if ($baja->cadena->fiscalia_id == $fiscalia->id)
                @php
                  $no_bajas = $no_bajas + $baja->indicios->sum('numero_indicios');
                @endphp
              @endif
            @endforeach
            <tr>
              <td><b>{{$fiscalia->nombre}}</b></td>
              <td class="center-align">{{$no_indicios}}</td>
              <td class="center-align">{{$no_evidencias}}</td>
              <td class="center-align">{{$no_prestamos}}</td>
              <td class="center-align">{{$no_bajas}}</td>
            </tr>

            @php
              $total_indicios = $total_indicios + $no_indicios;
              $total_evidencias = $total_evidencias + $no_evidencias;
              $total_prestamos = $total_prestamos + $no_prestamos;
              $total_bajas = $total_bajas + $no_bajas;
            @endphp
          @endforeach
            <tr class="red lighten-4">
              <td><b>TOTAL</b></td>
              <td class="center-align"><b>{{$total_indicios}}</b></td>
              <td class="center-align"><b>{{$total_evidencias}}</b></td>
              <td class="center-align"><b>{{$total_prestamos}}</b></td>
              <td class="center-align"><b>{{$total_bajas}}</b></td>
            </tr>
        </tbody>
      </table>
  </section>

  <div class="row">
    <form class="col s12 blue lighten-3">
      <div class="row">
        <div class="input-field col offset-s8 s2">
          <input type="month" name="fecha">
        </div>
        <div class="input-field col s2">
          <button class="btn waves-effect waves-light" type="submit">consultar</button>
        </div>
      </div>
    </form>
  </div>

@endsection

@section('js')
   <script type="text/javascript">
      $('.li-bodega').removeClass('active');
      $('#li-prestamos').addClass('active').css({'font-weight':'bold'});
   </script>
@endsection
