
@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      textarea{
         padding: 0 !important;
         padding-top: 0px !important;
      }

      blockquote{
         padding: 1px 0 !important;
         color: #fff !important;
         background-color: #112046 !important;
         font-size: 13px !important;
         text-align: center;
         margin: 0 !important; 
      }

      hr{
         border-color: #2196f3;
      }

      h5{
         padding: 0 !important;
         margin: 0 !important;
         color:#112046;
      }
      th,td{
         margin: 0 !important;
         padding: 2px 3px !important;
      }
      .tr-encabezado{
         background-color: #112046 !important;
         color: #fff;
         font-size: 13px;
      }
      table{
      width: 100% !important;
      margin: 0 !important;
      }

      .row{
        margin: 0 !important;
        padding: 0 !important;
      }
      #div-icon-add{
        margin-top: 5px !important;
        margin-bottom: 15px !important;
      }
   </style>
@endsection

@section('contenido')

  <table>
    <thead>      
      <tr>
        <th>No.</th>
        <th>PERITO</th>
        <th>CADENAS</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $key => $user)
      @if($key%2)
      <tr class="blue">
      @else
      <tr>
      @endif
        <td>{{$key+1}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->cadenas->count()}}</td>
      </tr>
      @endforeach
    </tbody>

  </table>

@endsection

@section('js')
  <script src="{{asset('js/perito_entrega.js')}}"></script>
  <script src="{{asset('js/rb_cambiar.js')}}"></script>
  <script type="text/javascript">
      $('.li-bodega').removeClass('active');
      $('#li-capturar').addClass('active').css({'font-weight':'bold'});
   </script>

  <script src="{{asset('js/indicios_agregar.js')}}"></script>

@endsection