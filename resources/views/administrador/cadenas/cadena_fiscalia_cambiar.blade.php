@extends('bodega.plantilla')

@section('css')
   <link rel="stylesheet" href="{{asset('css/colores.css')}}">
   <link rel="stylesheet" href="{{asset('css/tablas.css')}}">

   <style media="screen">
      
      .row{
         margin: 0 !important;
         padding: 0 !important;
      }
      
      
      .fa:hover{
         font-size: 1.3em;
      }
      .icon-check:hover{
         font-size: 1.5em;
      }

      body {
         overflow-x: scroll; /*horizontal scroll*/
          overflow-y: scroll; /*vertical scroll*/
}
   #tabla-entradas{
       width: 180% !important;
   }

   .th-center,.td-center{
      text-align: center;
   }

   a.accion{
      border-radius: 0 !important;
      background-color: rgba(255, 255, 255, 0) !important;
      border: 1px solid rgb(50, 162, 170) !important;
      color: black !important;
   }
   a.accion:hover{
      background-color: rgb(50, 162, 170) !important;
      color: white !important;
   }

   .td-folio{
      width: 100px !important;
   }



   td{
      vertical-align: top !important;
     }

     .btn{
         background-color: #bdbdbd;
      }

      
      #tabla-indicios, #tabla-indicios td{
         border: 1px solid #c09f77 !important;
      }
      #tabla-indicios td{
         padding-left: 5px !important;
      }

      button{
         border: none;
         background-color: rgb(255, 255, 255,0.0);
      }

      .fas:hover{
         color:#c09f77 !important;
      }

      .modal{
        width: 30% !important;
      }

      .modal-seccion-enlaces{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
      }
      .modal-enlace{
        width: 40%;
        margin: 20px;
      }
      .modal-enlace a{
        font-size: 14px !important;
        color: #152f4a;
      }
      .modal-enlace a:hover{
        color: #c09f77;
        font-size: 15px !important;
        cursor: pointer;
      }

   </style>
@endsection

@section('titulo')
   ENTRADAS
@endsection
@section('seccion', 'ENTRADAS')


@section('contenido')

<span id="cadena-datos" data-cadena-id="{{$cadena->id}}"></span>

<div class="row">
   <div class="col s12">
      <table>
         <thead>
            <tr>
               <th>NUC</th>
               <th>FISCALÍA</th>
               <th>USUARIO</th>
               <th>DESCRIPCIÓN</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>{{$cadena->nuc}}</td>
               <td>{{$cadena->fiscalia->nombre}}</td>
               <td>{{$cadena->user->name}}</td>
               <td>
                  @foreach ($cadena->indicios as $indicio)
                      <b>{{$indicio->identificador}}</b>: {{$indicio->descripcion}} <br>
                  @endforeach
               </td>
            </tr>
         </tbody>
      </table>
   </div>
</div>

<br><br>

<div class="row">
   <form class="col s12" id="form-fiscalia-cambiar">
      {{ csrf_field() }}
      <input type="hidden" name="id_cadena" value="{{$cadena->id}}">
      <div class="row">
         <div class="input-field col s12">
            <select name="fiscalia">
               @foreach ($fiscalias as $fiscalia)
                  @if ($fiscalia->id == $cadena->fiscalia_id)
                     <option value="{{$fiscalia->id}}" selected>{{$fiscalia->nombre}}</option>
                  @else
                     <option value="{{$fiscalia->id}}">{{$fiscalia->nombre}}</option>
                  @endif
                  
               @endforeach
            </select>
            <label>Materialize Select</label>
         </div>
         <div class="col s2">
            <button id="btn-fiscalia-cambiar" class="btn waves-effect waves-light" type="submit" name="action">cambiar</button>
         </div>
      </div>
   </form>
</div>

   

@endsection

@section('js')
   <script type="text/javascript">
      $('.li-bodega').removeClass('active');
      $('#li-entradas').addClass('active').css({'font-weight':'bold'});
   </script>

   <script src="{{asset('js/busqueda.js')}}" charset="utf-8"></script>

   <!--Dropdown Acción
      <script src="{{asset('js/acciones.js')}}" charset="utf-8"></script>
   -->

   <script src="{{asset('js/administrador/cadenas/cadenas_accion.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/administrador/cadenas/cadena_fiscalia_cambiar.js')}}" charset="utf-8"></script>


@endsection
