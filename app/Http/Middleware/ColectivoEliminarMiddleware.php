<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ColectivoEliminarMiddleware
{
    public function __construct()
    {
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $colectivo = $request->route('colectivo');        

        #comprobando si el "colectivo" es un registro del usuario autenticado
        if( $colectivo->user1_id != Auth::user()->id )
            return back();
        #comparando estado
        if ( $colectivo->colectivo_estado != 'revision' )
            return back();
        #comparando fecha
        if (  date('Y-m-d',strtotime($colectivo->created_at)) != /*today*/date('Y-m-d') )
            return back();

        return $next($request);
    }
}
