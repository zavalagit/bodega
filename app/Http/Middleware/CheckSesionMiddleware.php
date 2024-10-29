<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckSesionMiddleware
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
        if(Auth::check()){
            $tipo = Auth::user()->tipo;
            if($tipo == 'usuario')
                return redirect('/registrar-cadena');
            elseif($tipo == 'responsable_bodega')
                return redirect('/bodega/revisar');
            elseif($tipo == 'administrador')
                return redirect('/administrador/inicio');
        }

        return $next($request);
    }
}
