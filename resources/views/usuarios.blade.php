@extends('plantilla')


@section('contenido')
   <table>
        <thead>
          <tr>
              <th>id</th>
              <th>nombre</th>
              <th>foto</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($usuarios as $usuario)
             <tr>
                <td>{{$usuario->id}}</td>
                <td>{{$usuario->name}}</td>
                <td><a class="waves-effect waves-light btn" target="_blank" href="{{asset("fotos/{$usuario->id}.jpg")}}">button</a></td>
             </tr>
          @endforeach
        </tbody>
      </table>
@endsection
