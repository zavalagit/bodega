@extends('plantilla')


@section('contenido')
   <a href="/anexo-3/{{$id}}" class="waves-effect waves-light btn" target="_blank" data-id={{$id}} id="btn-anexo3">anexo 3</a>
   <a class="waves-effect waves-light btn" data-id={{$id}} id="anexo4">anexo 4</a>
   <a class="waves-effect waves-light btn" data-id={{$id}} id="etiqueta">etiqueta</a>
   <a class="waves-effect waves-light btn" data-id={{$id}}>Editar</a>
@endsection

@section('js')
<script src="{{asset('js/anexosPDF.js')}}" ></script>
@endsection
