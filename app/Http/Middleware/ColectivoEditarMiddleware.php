<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Colectivo;

class ColectivoEditarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function __construct()
    {
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
    }
    public function handle($request, Closure $next)
    {
        $formAccion = $request->route('accion');

        if ( $formAccion == 'editar' ) {
            // dd($request->route('colectivo'));

            $colectivo = $request->route('colectivo');
            $created_at = date('Y-m-d', strtotime($colectivo->created_at));
            $fecha_hoy = date('Y-m-d');
            
            #Comparando_dia
            // if($created_at != $fecha_hoy )
            //     return back();
            #Comparando_estado
            if(in_array($colectivo->colectivo_estado,['validada','entregada']) && (Auth::user()->tipo == 'usuario') )
                return back();
            #comparando user
            if( ($colectivo->user1_id != Auth::user()->id) && (Auth::user()->tipo != 'coordinador_colectivos') )
                return back();
            
        }
        elseif ($formAccion == 'validar') {
            if (Auth::user()->tipo == 'usuario') {
                return back();
            }
        }

        // dd( $request->route('accion') );
        return $next($request);
    }
}
