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

  <div class="encabezado">
    <h5 class="amber center-align"><b>INVENTARIO DE INDICIOS</b></h5>
  </div>

  <section>
    <div class="row">
      <form class="col s12">
        <div class="row">
          <div class="input-field col s4">
            <select name="naturaleza">
              <option value="" disabled selected>Selecciona las naturalezas</option>
                <option value="0">TODO</option>
              @foreach ($naturalezas as $key => $naturaleza)
                <option value="{{$naturaleza->id}}">{{$naturaleza->nombre}}</option>
              @endforeach
            </select>
          </div>
          <div class="input-field col s2">
            <button class="btn waves-effect waves-light" type="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </section>

  @isset($nat)
    <section>
      <table>
        <thead>
          <tr>
            <th>FISCALIA</th>
            <th>{{$nat->nombre}}</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($fiscalias as $f => $fiscalia)
            @php
              $no_indicios=0;
            @endphp
            @foreach ($entradas as $e => $entrada)
                @if ( ($entrada->cadena->fiscalia_id == $fiscalia->id) && ($entrada->naturaleza->id === $nat->id) )
                @php
                  $no_indicios += $entrada->cadena->indicios->sum('numero_indicios');
                @endphp
              @endif
            @endforeach
            <tr>
              <td> <b>{{$fiscalia->nombre}}</b> </td>
              <td> <b>{{$no_indicios}}</b> </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </section>
  @endisset


@endsection

@section('js')

@endsection
