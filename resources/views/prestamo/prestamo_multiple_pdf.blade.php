@extends('plantillas.plantilla_sin_menu')

@section('css')
<link rel="stylesheet" href="{{asset('/css/tablas.css')}}">
<style>
   th{
      border-left: 1px solid #c09f77; 
      border-top: 1px solid #c09f77; 
   }
   td{
      border-left: 1px solid #c6c6c6; 
   }
</style>
@endsection

@section('seccion')
    PRESTAMO MÚLTIPLE
@endsection

@section('contenido')

<div class="row">
   <div class="col s12">
      <table>
         <thead>
            <tr>
               <th>N°</th>
               <th>Folio</th>
               <th>N.U.C.</th>
               <th>Prestamo PDF</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($prestamos->values() as $i => $prestamo)
            <tr>
               <td>{{$i+1}}</td>
               <td>{{$prestamo->cadena->folio_bodega}}</td>
               <td>{{$prestamo->cadena->nuc}}</td>
               <td>
                  <a href="/bodega/prestamo-pdf/{{$prestamo->id}}" target="_blank">
                     <i class="fas fa-file-pdf fa-lg i-dorado"></i>
                  </a>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>

@endsection

@section('js')

@endsection
