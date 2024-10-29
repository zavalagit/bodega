<?php

namespace App\Http\Middleware;

use Closure;
use App\Cadena;

class VerificaCadenaAlta
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $id = substr($request->getRequestUri(), strrpos($request->getRequestUri(), "/")+1);

      $cadena = Cadena::find($id);
      $confirmado = $cadena->confirmado;

      if($confirmado == 1){
         return redirect('/bodega/cadenas');
      }

   //dd($confirmado);
      //dd(substr($request->getRequestUri(), strrpos($request->getRequestUri(), "/")+1));
        return $next($request);
    }
}
