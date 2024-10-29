@extends('bodega.plantilla')

@section('contenido')

   <h4 class="center-align">BAJA</h4>
   <h5 class="center-align">Cadena con folio {{$cedula->folio}}</h5>
   <h5 class="center-align">N.U.C. {{$cedula->nuc}}</h5>

   <div class="row">
      <form class="col s12" id="form-prestamo">
         <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
         <input type="hidden" name="folio" value="{{$cedula->folio}}">
         <input type="hidden" name="entrega" value="{{Auth::user()->id}}">

         <p>Selcciona los a indicios a prestamo:</p>
<!--
         <p>
            <input type="checkbox" id="todos" name="todos"/>
            <label for="todos">Todos</label>
         </p>
-->
         @foreach ($cedula->indicios as $key => $indicio)
            <p>
               @if ($indicio->prestamo)
                  <input class="indicio" type="checkbox" id="{{$indicio->identificador}}" name="{{$indicio->identificador}}" disabled/>
                  <label for="{{$indicio->identificador}}">{{$indicio->identificador}} (En prestamo)</label>
                  <hr>
               @else
                  <input class="indicio" type="checkbox" id="{{$indicio->identificador}}" name="{{$indicio->identificador}}"/>
                  <label for="{{$indicio->identificador}}">{{$indicio->identificador}}</label>
                  <p>{{$indicio->descripcion}}</p>
                  <hr>
               @endif
            </p>
         @endforeach
         <hr>

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
            <div class="input-field col s6">

            </div>
            <div class="input-field col s6">

            </div>
         </div>
         <div class="row">
            <div class="input-field col s4">
               <input id="last_name" type="text" class="validate" name="recibe">
               <label for="last_name">Persona que recibe prestamo</label>
            </div>
            <div class="input-field col s4">
               <select name="cargo">
                <option disabled selected></option>
                @foreach ($cargos as $key => $cargo)
                     <option value={{$cargo->id}}>{{$cargo->nombre}}</option>
                @endforeach
               </select>
               <label>Cargo quien recibe prestamo</label>
            </div>
            <div class="input-field col s4">
               <input id="last_name" type="text" class="validate" name="gafete">
               <label for="last_name">No. Gafete persona recibe prestamo</label>
            </div>
         </div>
         <div class="row">
            <div class="input-field col s6">
               <input id="last_name" type="text" value="{{Auth::user()->name}}">
               <label for="last_name">Quien entrega</label>
            </div>
            <div class="input-field col s6">

            </div>
         </div>
         <div class="row">
        <div class="input-field col s12">
          <textarea id="textarea1" class="materialize-textarea"></textarea>
          <label for="textarea1">Observaciones</label>
        </div>
      </div>

         <button class="btn waves-effect waves-light" type="submit" id="btn-prestamo">
            Realizar prestamo
         </button>

      </form>


      <a disabled='disabled' href="/bodega/prestamo-pdf/1" id="btn-pdf-prestamo" target="_blank" class="waves-effect waves-light btn">Prestamo PDF</a>
   </div>

@endsection

@section('js')
   <script src="{{asset('js/prestamos.js')}}" charset="utf-8"></script>
@endsection
