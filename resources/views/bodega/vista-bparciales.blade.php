@extends('bodega.plantilla')

@section('css')
@endsection

@section('titulo')
   ENTRADAS
@endsection

@section('contenido')
   <div class="row">
      <form class="col s12">
         <div class="row">
            <div class="input-field col s4 offset-s8">
               <i class="fa fa-search prefix" aria-hidden="true"></i>
               @isset($buscar)
                  <input id="icon_prefix" type="text" name="buscar" value="{{$buscar}}">
               @endisset
               @empty($buscar)
                  <input id="icon_prefix" type="text" name="buscar">
               @endempty
               <label for="icon_prefix">Buscar...</label>
            </div>
         </div>
      </form>
   </div>

   <div class="tabla">
      <table class="responsive-table highlight centered bordered">
         <caption class="amber"><b>BAJAS PARCIALES</b></caption>
         <thead class="blue lighten-5">
            <tr>
               <th>Folio</th>
               <th>N.U.C.</th>
               <th>Indicios</th>
               <th>Fecha</th>
               <th>Hora</th>
               <th>Descripción</th>
               <th>Observaciones</th>
               <th>Recibió</th>
               <th>PDF</th>
            </tr>
         </thead>

         <tbody>
            @isset($bparciales)
               @foreach ($bparciales as $key => $bparcial)
                  <tr>
                     <td width="100">{{$bparcial->indicios[0]->cedula_folio}}</td>
                     <td width="100">{{$bparcial->indicios[0]->cedula->nuc}}</td>
                     <td width="100">{{$bparcial->numindicios}}</td>
                     <td width="100">{{$bparcial->fecha}}</td>
                     <td width="100">{{$bparcial->hora}}</td>
                     <td width="1000">
                        @foreach ($bparcial->indicios as $key => $indicio)
                           <b>{{$indicio->identificador}}:</b>{{$indicio->descripcion}}<br>
                        @endforeach
                     </td>
                     <td width="1000">{{$bparcial->observaciones}}</td>
                     <td width="150">{{$bparcial->recibe}}</td>
                  </tr>
               @endforeach
            @endisset
            @empty($bparciales)
               <tr>
                  <td colspan="5">
                     <blockquote class="yellow lighten-2">No hay registros</blockquote>
                  </td>
               </tr>
            @endempty
         </tbody>
      </table>
   </div>
{{--}}   {{ $prestamos->links() }}
--}}
@endsection

@section('js')
@endsection
