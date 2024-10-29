@extends('plantilla')

@section('css')
   <style media="screen">
      .carousel{
         height: 90.5vh;
      }
      .indicator-item{
         background-color: #aaa !important;
      }
      .indicators li.active{
         background-color: #0e0d0d !important;
      }
      textarea{
         padding: 0 !important;
      }
   </style>
@endsection

@section('contenido')

<div class="row">
   <form class="col s12 form-alta" id="form-alta">
      <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">


      <div class="carousel carousel-slider center" data-indicators="true">
       <div class="carousel-fixed-item center">
         <a class="btn waves-effect white grey-text darken-text-2" id="btn-alta">Registrar</a>
       </div>
       <!--1er Panel-->
       <div class="carousel-item black-text" href="#one!">
         <!--contenido 1er panel-->
            <!--1er fila-->
            <div class="row">
               <div class="input-field col s3">
                  <input id="folio" type="text" name="folio">
                  <label for="folio">Folio</label>
               </div>
               <div class="input-field col s3">
                  <input id="nuc" type="text" name="nuc">
                  <label for="nuc">NUC</label>
               </div>
               <div class="input-field col s3">
                  <input id="numIndicios" type="text" name="numIndicios">
                  <label for="numIndicios">No. Indicios</label>
               </div>
               <p class="col s1">
                  <input class="with-gap" name="tipo" type="radio" id="indicio" value="indicio" />
                  <label for="indicio">Indicio</label>
               </p>
               <p class="col s1">
                  <input class="with-gap" name="tipo" type="radio" id="evidencia" value="evidencia" />
                  <label for="evidencia">Evidencia</label>
               </p>
            </div>

            <!--2da Fila-->
            <div class="row">
               <!--Categoria-->
               <div class="input-field col s2">
                  <select id="categoria" name="categoria">
                     <option disabled selected></option>
                     @foreach ($categorias as $categoria)
                        <option value={{$categoria->id}}>{{$categoria->nombre}}</option>
                     @endforeach
                  </select>
                  <label>Categoria</label>
               </div>
               <!--Delegacion-->
               <div class="input-field col s2">
                  <select id="delegacion" name="delegacion">
                     <option disabled selected></option>
                     @foreach ($delegaciones as $delegacion)
                        <option value={{$delegacion->id}}>{{$delegacion->nombre}}</option>
                     @endforeach
                  </select>
                  <label>Delegacion</label>
               </div>
               <!--Entidad-->
               <div class="input-field col s2">
                  <select id="entidad" name="entidad">
                     <option disabled selected></option>
                     @foreach ($entidades as $entidad)
                        <option value={{$entidad->id}}>{{$entidad->nombre}}</option>
                     @endforeach
                  </select>
                  <label>Entidad</label>
               </div>
               <!--Fiscalia-->
               <div class="input-field col s2">
                  <select id="fiscalia" name="fiscalia">
                     <option disabled selected></option>
                     @foreach ($fiscalias as $fiscalia)
                        <option value={{$fiscalia->id}}>{{$fiscalia->nombre}}</option>
                     @endforeach
                  </select>
                  <label>Fiscalia</label>
               </div>
               <!--Unidad Admin-->
               <div class="input-field col s2">
                  <select id="unidad" name="unidad">
                     <option disabled selected></option>
                     @foreach ($unidades as $unidad)
                        <option value={{$unidad->id}}>{{$unidad->nombre}}</option>
                     @endforeach
                  </select>
                  <label>Unidad Administrativa</label>
               </div>
               <!--Embalaje-->
               <div class="input-field col s2">
                  <select id="embalaje" name="embalaje">
                  <option value="" disabled selected></option>
                  @foreach ($embalajes as $embalaje)
                     <option value={{$embalaje->id}}>{{$embalaje->nombre}}</option>
                  @endforeach
                  </select>
                  <label>Embalaje</label>
               </div>
            </div><!--2da fila-->

            <!--3ra fila-->
            <div class="row">
               <div class="input-field col s3">
                  <input  id="quienEntrega" type="text" name="quienEntrega">
                  <label for="quienEntrega">Quien Entrega</label>
               </div>
               <div class="input-field col s3">
                  <input  id="quienEntregaCargo" type="text" name="quienEntregaCargo">
                  <label for="quienEntregaCargo">Cargo quien entrega</label>
               </div>
               <div class="input-field col s1">
                  <input id="hora" type="time" name="hora">
                  <label class="active" for="hora">Hora</label>
               </div>
               <div class="input-field col s2">
                  <input id="fecha" type="date" name="fecha">
                  <label class="active" for="fecha">Fecha</label>
               </div>
               <div class="input-field col s3">
                  <select id="quienRecibe" name="quienRecibe">
                     <option value="" disabled selected></option>
                     @foreach ($usuarios as $usuario)
                        <option value={{$usuario->id}}>{{$usuario->name}}</option>
                     @endforeach
                  </select>
                  <label>Quien recibe</label>
               </div>
            </div><!--3ra fila-->

            <!--4ta fila-->
            <div class="row">

            </div>

            <!--5ta fila-->
            <div class="row">
               <div class="input-field col s12">
                  <textarea id="observacion" class="materialize-textarea" name="observacion"></textarea>
                  <label for="observacion">Observaciones</label>
               </div>
            </div>
       </div>

       <!--2do Panel-->
       <div class="carousel-item black-text" href="#two!" id="">
         <!--contenido 2do panel-->
         <!--Panel de descripciones-->
            <div class="row">
               <div class="col s2">
                  <button class="btn waves-effect waves-light" type="submit" name="action" id="nva-desc">
                     Nva. Desc.
                  </button>
               </div>
               <div class="col s2">
                  <button class="btn waves-effect waves-light hide" type="submit" name="action" id="btn-ver-pdf">
                     Ver PDF
                  </button>
               </div>
            </div>
            <div class="" id="div-desc">
               <div class="row">
                  <div class="input-field col s1">
                     <input type="text" name="" value="">
                  </div>
                  <div class="input-field col s11">
                     <textarea id="descripcion" class="materialize-textarea" name="descripcion[]"></textarea>
                     <label for="descripcion">Descripcion</label>
                  </div>
               </div>
            </div>
       </div>

     </div>


   </form>
</div>{{--row contenedor--}}

@endsection
