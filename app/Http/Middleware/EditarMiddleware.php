<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Cadena;

class EditarMiddleware
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
        $id = $request->route('id');
        $cadena = Cadena::find($id);

        if ((Auth::id() == $cadena->user_id) && (Auth::user()->tipo == 'usuario') && ($cadena->editar === 'si')) {
           return $next($request);
          }
        elseif (Auth::user()->tipo === 'administrador') {
            return $next($request);
        }

//        Auth::logout();
        return redirect('/consultar-cadena');



//        return $next($request);
    }
}
