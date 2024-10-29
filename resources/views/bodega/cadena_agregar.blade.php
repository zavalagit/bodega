@extends('bodega.plantilla')

@section('css')
   <style media="screen">
      h5{
         padding: 2px 0 !important;
         margin: 0 !important;
      }
      td{
         margin: 0 !important;
         padding: 2px 3px !important;
      }
      .tr-encabezado{
         background-color: #112046 !important;
         color: #fff;
      }
      blockquote{
         font-size: 60px !important;
         padding: 1px 10px !important;
         color: #fff !important;
         background-color: #112046 !important;
      }
      section{
         background-color: #e1f5fe !important;         
      }
   </style>
@endsection

@section('contenido')

   
            
   <h5 class="amber center-align">
      <b>AGREGAR CADENA</b>
   </h5>   

   <div class="row">
      <form class="col s12" id="form-baja">
         <div class="row">
            <div class="input-field col s3">
               <input id="folio" type="text" name="folio">
               <label for="folio">FOLIO INTERNO BODEGA</label>
            </div>
            <div class="input-field col s4">
               <input id="nuc" type="text" name="nuc">
               <label for="nuc">NUC</label>
            </div>
            <div class="input-field col s4">
               <button class="btn waves-effect waves-light" type="submit" id="btn-agregar-cadena">agregar
            </button>   
            </div>
         </div>
      </form>
   </div>   

@endsection

@section('js')
   <script src="{{asset('js/bdefinitiva.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/numero_indicios.js')}}" charset="utf-8"></script>
   <script src="{{asset('js/bajas.js')}}" charset="utf-8"></script>
@endsection
