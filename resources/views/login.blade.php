@extends('plantilla')

@section('css')
   <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('contenido')
   <div class="wrapper">

    <form class="form-signin">

      <h2 class="form-signin-heading">Inicia Sesion</h2>
      <input type="text" class="form-control" name="email" placeholder="Introduce Usuario" required="" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
      <label class="checkbox">

      </label>
      <button class="btn btn-lg btn-primary btn-block" type="submit" align="Left" >Entrar</button>

    </form>
      </div>

@endsection
