<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckFiscalMiddleware
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
        if (Auth::check() && (Auth::user()->tipo == 'fiscal')) {
            return $next($request);
        }
         
         Auth::logout();
         return redirect('/');
    }
}
