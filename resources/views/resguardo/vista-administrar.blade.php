@extends('bodega.plantilla')

@section('css')
   <style media="screen">
   fieldset
{
   border:2px solid green;
       -moz-border-radius:8px;
       -webkit-border-radius:8px;
       border-radius:8px;
       margin: 10px 10px;
}
   </style>
@endsection

@section('titulo')
   Adm. Bodega
@endsection

@section('contenido')

   <form class="col s12" id="form-lugar">
      <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

      <div class="row">
         <fieldset>
            <legend>Lugar</legend>
            <div class="input-field col s9">
               <input id="lugar" type="text" placeholder="nombre" name="lugar">
               <label for="lugar">Lugar</label>
            </div>
            <div class="input-field col s2">
               <button id="btn-lugar" class="btn waves-effect waves-light" type="submit">
                  Agregar
               </button>
            </div>
         </fieldset>
      </div>
   </form>


   <form class="col s12" id="form-charola">
      <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

      <div class="row">
         <fieldset>
            <legend>Charola</legend>
            <div class="input-field col s9">
               <input id="charola" type="text" placeholder="nombre" name="charola">
               <label for="charola">Charola</label>
            </div>
            <div class="input-field col s9">
               <select name="lugar_charola">
                  <option value="" disabled selected></option>
                  @foreach ($lugares as $key => $lugar)
                     <option value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                  @endforeach
               </select>
               <label>Lugar al que va a pertenecer</label>
            </div>
            <div class="input-field col s2">
               <button id="btn-charola" class="btn waves-effect waves-light" type="submit">
                  Agregar
               </button>
            </div>
         </fieldset>
      </div>
   </form>

   <form class="col s12" id="form-caja">
      <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

      <div class="row">
         <fieldset>
            <legend>Caja</legend>
            <div class="input-field col s9">
               <input id="caja" type="text" placeholder="nombre" name="caja">
               <label for="caja">Caja</label>
            </div>
            <div class="input-field col s9">
               <select name="lugar_caja">
                  <option value="" disabled selected></option>
                  @foreach ($lugares as $key => $lugar)
                     <option value="{{$lugar->id}}">{{$lugar->nombre}}</option>
                  @endforeach
               </select>
               <label>Lugar al que va a pertenecer</label>
            </div>
            <div class="input-field col s2">
               <button id='btn-caja' class="btn waves-effect waves-light" type="submit" name="action">
                  Agregar
               </button>
            </div>
         </fieldset>
      </div>
   </form>

@endsection

@section('js')
   <script src="{{asset('js/resguardo.js')}}" charset="utf-8"></script>
@endsection
