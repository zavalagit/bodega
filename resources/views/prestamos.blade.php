@extends('plantilla')


@section('contenido')
   <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s2"><h15>Folio</h15>
          <input placeholder="Folio" id="folio" type="text" class="validate">

        </div>
        <div class="input-field col s2"><h15>Nuc</h15>
          <input id="nuc" type="text" class="validate" placeholder="NUC">

        </div>
        <div class="input-field col s2"><h15>Indicios Prestados</h15>
          <input id="num_ind" type="text" class="validate" placeholder="No. Indicios">
                  </div>



      <div class="input-field col s2"><h15>Fecha de Salida</h15>
      <label for="fecha"></label>
          <input id="fecha" type="Date" class="validate" placeholder="Fecha">
          </div>


      <div class="input-field col s2"><h15>Hora de salida</h15>
          <input  id="hora" type="Time" class="validate">
          <label for="Hora"></label>
      </div>


<div class="input-field col s2"><h15>Indicios Devueltos</h15>
          <input id="num_ind" type="text" class="validate" placeholder="No. Indicios">

        </div>
     </div>


<div class="input-field col s12">

 <div class="input-field col s2"><h15>Fecha de Regreso</h15>
      <label for="fecha"></label>
          <input id="fecha" type="Date" class="validate" placeholder="Fecha">
          </div>


      <div class="input-field col s2"><h15>Hora de Regreso</h15>
          <input  id="hora" type="Time" class="validate">
          <label for="Hora"></label>
      </div>
    <div class="input-field col s2"><h15>Responsable de Prestamo</h15>
          <input  id="disabled" type="text" class="validate" placeholder="Quien se lo llevo">

      </div>


      <div class="input-field col s2"><h15>Quien Entrega</h15>
          <input  id="disabled" type="text" class="validate" placeholder="Quien Entrega">

      </div>


      <div class="input-field col s4"><h15>Quien Ordena</h15>
          <input  id="disabled" type="text" class="validate" placeholder="Quien Ordeno">

      </div>
  </div>



      <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s12"><h15>Quien Ordena</h15>
          <textarea id="descripcion" class="materialize-textarea" placeholder="Escribe la Descripcion"></textarea>
                  </div>
      </div>
    </form>
  </div>

      <center>
      <div class="input-field col s12">
        <button class="btn waves-effect waves-light btninter " type="submit" name="action"  >Guardar
        <i class="material-icons right">send</i>
        </button>
        </div>
        </center>
      </div>


    </form>
  </div>
@endsection
