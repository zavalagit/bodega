@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      .div-ubicacion{
         margin-left: 10px;
         margin-right: 10px;
         margin-bottom: 20px;
         padding: 0 10px;
         border: 3px solid rgb(7, 231, 217);
         border-radius: 10px;
      }


      .th-asignar,.td-asignar{
         text-align: center !important;
      }
   </style>

@endsection


@section('contenido')


   <table>
      <caption class="amber"><b>LUGAR DE RESGUARDO</b></caption>
      <thead class="blue lighten-5">
         <tr>
            <th class="th-asignar">Asignar Lugar</th>
            <th>Descripción Indicio(s)</th>
            <th>Ubicación actual</th>
         </tr>
      </thead>

      <tbody>
         @if (count($cadena->indicios) > 1)
            <tr>
               <td class="td-asignar">
                  <a href="#modal-todos" id="indicios" class="indicio modal-trigger"
                     data-folio="{{$cadena->folio_bodega}}"><i style="color:red" class="fas fa-pencil-alt"></i>
                  </a>
               </td>
               <td colspan="2">
                  <b>Asignar todos los indicios a un lugar</b>
               </td>
            </tr>
         @endif
         @foreach ($cadena->indicios as $key => $indicio)
            <tr>
               <td class="td-asignar" width="150">
                  <a href="#modal-indicio" class="indicio modal-trigger"
                     data-id="{{$indicio->id}}"
                     data-identificador="{{$indicio->identificador}}"
                     data-descripcion="{{$indicio->descripcion}}">
                     <i class="fas fa-pencil-alt"></i>
                  </a>
               </td>
               <td width="500">
                  <b>{{$indicio->identificador}}.- </b>{{$indicio->descripcion}}
               </td>
               <td>
                  @isset($indicio->resguardo)
                     <span class="green-text text-darken-3"><b>{{$indicio->resguardo}}</b></span>
                  @endisset
                  @empty($indicio->resguardo)
                     <span class="red-text text-accent-4"><b>No Asignado</b></span>
                  @endempty
               </td>

            </tr>

         @endforeach
      </tbody>
   </table>


   <!-- Modal resguardo de indicio -->
   <div id="modal-indicio" class="modal">
      <div class="modal-content">
         <p id="info-indicio"></p>
         <div class="row">
            <form class="col s12" id="form-resguardar">
               <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
               <input type="hidden" id="id_indicio" name="id_indicio" value="">
               <div class="row">
                  <div class="input-field col s12">
                     <textarea id="textarea1" class="materialize-textarea" name="lugar"></textarea>
                     <label for="textarea1">Asignar Lugar</label>
                  </div>
               </div>
            </form>
         </div>
      </div><!--Modal Content-->
      <div class="modal-footer">
         <a href="" id="btn-resguardar" class="modal-action  waves-effect waves-green btn-flat"><i class="fa fa-check" aria-hidden="true"></i></a>
      </div>
   </div>

   <!-- Modal resguardo de todos los indicios -->
   <div id="modal-todos" class="modal">
      <div class="modal-content">
         <p>Lugar de Resguardo de todos los indicios</p>
         <div class="row">
            <form class="col s12" id="form-resguardar-todo">
               <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
               <input type="hidden" id="id_cadena" name="id_cadena" value="{{$cadena->id}}">
               <div class="row">
                  <div class="input-field col s12">
                     <textarea id="textarea-todo" class="materialize-textarea" name="lugar"></textarea>
                     <label for="textarea-todo">Asignar Lugar</label>
                  </div>
               </div>
            </form>
         </div>
      </div><!--Modal Content-->
      <div class="modal-footer">
         <a href="" id="btn-resguardar-todo" class="modal-action  waves-effect waves-green btn-flat"><i class="fa fa-check" aria-hidden="true"></i></a>
      </div>
   </div>

@endsection

@section('js')
   <script src="{{asset('js/resguardo.js')}}" charset="utf-8"></script>

   <script type="text/javascript">
      $('.modal').modal();

   $('.carousel.carousel-slider').carousel({fullWidth: true});
   </script>
@endsection
