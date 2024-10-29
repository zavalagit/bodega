@extends('bodega.plantilla')

@section('contenido')

   <h4 class="center-align">BAJA PARCIAL</h4>
   <h5 class="center-align">Cadena con folio {{$cedula->folio}}</h5>
   <h5 class="center-align">N.U.C. {{$cedula->nuc}}</h5>

   <div class="row">
      <form class="col s12" id="form-bparcial">
         <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
         <input type="hidden" name="folio" value="{{$cedula->folio}}">
         <input type="hidden" name="entrega" value="{{Auth::user()->id}}">

         <p>Selcciona los indicios para baja:</p>

         @foreach ($cedula->indicios as $key => $indicio)
            <p>
               @if ($indicio->estado == 'prestamo')
                  <input class="indicio" type="checkbox" id="{{$indicio->identificador}}" name="{{$indicio->identificador}}" disabled/>
                  <label for="{{$indicio->identificador}}">{{$indicio->identificador}} (En prestamo)</label>
                  <p>{{$indicio->descripcion}}</p>
                  <hr>
               @elseif ($indicio->estado == 'baja')
                  <input class="indicio" type="checkbox" id="{{$indicio->identificador}}" name="{{$indicio->identificador}}" disabled/>
                  <label for="{{$indicio->identificador}}">{{$indicio->identificador}} (BAJA)</label>
                  <p>{{$indicio->descripcion}}</p>
                  <hr>
               @else
                  <input class="indicio" type="checkbox" id="{{$indicio->identificador}}" name="{{$indicio->id}}"/>
                  <label for="{{$indicio->identificador}}">{{$indicio->identificador}}</label>
                  <p>{{$indicio->descripcion}}</p>
                  <hr>
               @endif
            </p>
         @endforeach
         <hr>

         <div class="row">
            <div class="input-field col s12">
               <input id="last_name" type="text" class="validate" name="concepto">
               <label for="last_name">Concepto de Baja</label>
            </div>
         </div>
         <div class="row">
            <div class="input-field col s4">
               <input type="text" id="numindicios" name="numindicios">
               <label for="numindicios">Num. Indicios</label>
            </div>
            <div class="input-field col s4">
               <input type="time" id="hora" name="hora">
               <label class="active" for="hora">Hora</label>
            </div>
            <div class="input-field col s4">
               <input type="date" id="fecha" name="fecha">
               <label class="active" for="hora">Fecha</label>
            </div>
         </div>
         <div class="row">
            <div class="input-field col s12">
               <textarea id="textarea1" class="materialize-textarea" name="observaciones"></textarea>
               <label for="textarea1">Observaciones</label>
            </div>
         </div>
         <div class="row">
            <div class="input-field col s12">
               <input id="last_name" type="text" class="validate" name="recibe">
               <label for="last_name">Quien recibe</label>
            </div>
         </div>

      <!--
         <button class="btn waves-effect waves-light" type="submit" id="btn-prestamo">
            Realizar baja parcial
         </button>
      -->
         <div class="fixed-action-btn">
            <a class="waves-effect waves-light btn" id="btn-bparcial">
               Reliazar baja
            </a>
         </div>

      </form>


      <a disabled='disabled' href="/bodega/prestamo-pdf/1" id="btn-pdf-prestamo" target="_blank" class="waves-effect waves-light btn">Prestamo PDF</a>
   </div>

@endsection

@section('js')
   <script src="{{asset('js/bparcial.js')}}" charset="utf-8"></script>
@endsection
