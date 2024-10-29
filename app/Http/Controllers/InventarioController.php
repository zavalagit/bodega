<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Cadena;
use App\Entrada;
use App\Naturaleza;
use App\Fiscalia;
use App\Indicio;
use App\Ifiscalia;
use App\Inaturaleza;

class InventarioController extends Controller
{
    public function inventario(Request $request){
      $naturalezas = Naturaleza::all();

      if ($request->has('naturaleza')) {
        $entradas = Entrada::with('naturaleza')->whereHas('naturaleza', function($q) use ($request){
          $q->where('id',$request->naturaleza);
        })->get();

        $nat = Naturaleza::find($request->naturaleza);

        $fiscalias = Fiscalia::all();
        return view('bodega.inventario',[
          'nat' => $nat,
          'entradas' => $entradas,
          'naturalezas' => $naturalezas,
          'fiscalias' => $fiscalias,
        ]);
      }else{
        return view('bodega.inventario',[
          'naturalezas' => $naturalezas,
        ]);
      }
  }//funcion inventario


  public function inventario_general(){
    $fiscalias = Fiscalia::all();
    $naturalezas = Naturaleza::all();
    $i_fiscalias = Ifiscalia::all();
    $i_naturalezas = Inaturaleza::all();

    return view('inventario.inventario_general',[
      'regiones' => $fiscalias,
      'naturalezas' => $naturalezas,
      'i_fiscalias' => $i_fiscalias,
      'i_naturalezas' => $i_naturalezas,
    ]);
  }

  public function indicio_inventario(){
    set_time_limit(0);
    ini_set('memory_limit', '-1');
    // Post::query()
    // ->with(['user' => function ($query) {
    //     $query->select('id', 'username');
    // }])
    // ->get()
    // $regiones = Fiscalia::with(['indicios_indicio' => function($q){
    //                         $q->select('numero_indicios','indicio_cantidad_disponible');
    //                       }])
    //                       ->get();
    return view('indicio.indicio_inventario',[
      'regiones' => Fiscalia::with(['indicios' => function($q){
        $q->select('numero_indicios','indicio_cantidad_disponible');
      }])->get(),

      // 'regiones' => Fiscalia::all(),

      'naturalezas' => Naturaleza::all(),
    ]);
  }

  public function inventario_general_actualizar(){
    set_time_limit(0);
    setlocale(LC_TIME,"es_MX.UTF-8");
    date_default_timezone_set('America/Mexico_City');

    $fiscalias = Fiscalia::all();
    $naturalezas = Naturaleza::all();
      
    $cadenas = Cadena::where('estado','validada')->get();
    $cadenas = $cadenas->sortBy('fiscalia_id');

    $array_fiscalias=array();
    $array_naturalezas=array();
    foreach ($fiscalias as $key => $fiscalia) {
      $array_fiscalias[$fiscalia->nombre] = ['indicio_activo'=>0,'indicio_prestamo' =>0,'indicio_baja' =>0,'evidencia_activo'=>0,'evidencia_prestamo'=>0,'evidencia_baja'=>0];
      
      foreach ($naturalezas as $key => $naturaleza) {
        $array_naturalezas[$fiscalia->nombre][$naturaleza->nombre]['activo'] = 0;
        $array_naturalezas[$fiscalia->nombre][$naturaleza->nombre]['prestamo'] = 0;
        $array_naturalezas[$fiscalia->nombre][$naturaleza->nombre]['baja'] = 0;
      }
    }
   
    

    foreach ($cadenas as $j => $cadena) {
      if(isset($cadena->entrada->tipo))
        $entrada_tipo = $cadena->entrada->tipo;
      else
        dd($cadena->id);

      foreach ($cadena->indicios as $key => $indicio) {
        if($cadena->entrada->tipo === 'indicio'){
          switch ($indicio->estado) {
            case 'activo':
              $array_fiscalias[$cadena->fiscalia->nombre]['indicio_activo'] += $indicio->numero_indicios;
              $array_naturalezas[$cadena->fiscalia->nombre][$cadena->entrada->naturaleza->nombre]['activo'] += $indicio->numero_indicios;
              break;
            case 'prestamo':
              $array_fiscalias[$cadena->fiscalia->nombre]['indicio_prestamo'] += $indicio->numero_indicios;
              $array_naturalezas[$cadena->fiscalia->nombre][$cadena->entrada->naturaleza->nombre]['prestamo'] += $indicio->numero_indicios;
              break;
            case 'baja':
              $array_fiscalias[$cadena->fiscalia->nombre]['indicio_baja'] += $indicio->numero_indicios;
              $array_naturalezas[$cadena->fiscalia->nombre][$cadena->entrada->naturaleza->nombre]['baja'] += $indicio->numero_indicios;
              break;
            default:
             echo 'hola';
              // return response()->json([
              //   'satisfactorio' => false,
              //   'mensaje' => "Error switch indicio, cadena: {$cadena->id}", 
              // ]);
          } 
        }
        elseif($cadena->entrada->tipo === 'evidencia'){
          switch ($indicio->estado) {
            case 'activo':
              $array_fiscalias[$cadena->fiscalia->nombre]['evidencia_activo'] += $indicio->numero_indicios;
              $array_naturalezas[$cadena->fiscalia->nombre][$cadena->entrada->naturaleza->nombre]['activo'] += $indicio->numero_indicios;
              break;
            case 'prestamo':
              $array_fiscalias[$cadena->fiscalia->nombre]['evidencia_prestamo'] += $indicio->numero_indicios;
              $array_naturalezas[$cadena->fiscalia->nombre][$cadena->entrada->naturaleza->nombre]['prestamo'] += $indicio->numero_indicios;
              break;
            case 'baja':
              $array_fiscalias[$cadena->fiscalia->nombre]['evidencia_baja'] += $indicio->numero_indicios;
              $array_naturalezas[$cadena->fiscalia->nombre][$cadena->entrada->naturaleza->nombre]['baja'] += $indicio->numero_indicios;
              break;
            default:
            echo 'hola';
            // dd($cadena->id);
              // return response()->json([
              //   'satisfactorio' => false,
              //   'mensaje' => "Error switch evidencia, cadena: {$cadena->id}", 
              // ]);
          }
        }
      }
    }

    echo $array_fiscalias;
    echo $array_naturalezas;

    // DB::table('ifiscalias')->delete();
    // DB::table('inaturalezas')->delete();

    // $n = 1;
    // $m = 1;
    // foreach ($fiscalias as $i => $fiscalia) {
    //   $i_fiscalia = new Ifiscalia;
    //   $i_fiscalia->id = $n++;
    //   $i_fiscalia->indicio_activo = $array_fiscalias[$fiscalia->nombre]['indicio_activo'];
    //   $i_fiscalia->indicio_prestamo = $array_fiscalias[$fiscalia->nombre]['indicio_prestamo'];
    //   $i_fiscalia->indicio_baja = $array_fiscalias[$fiscalia->nombre]['indicio_baja'];
    //   $i_fiscalia->evidencia_activo = $array_fiscalias[$fiscalia->nombre]['evidencia_activo'];
    //   $i_fiscalia->evidencia_prestamo = $array_fiscalias[$fiscalia->nombre]['evidencia_prestamo'];
    //   $i_fiscalia->evidencia_baja = $array_fiscalias[$fiscalia->nombre]['evidencia_baja'];
    //   $i_fiscalia->fiscalia_id = $fiscalia->id;
    //   $i_fiscalia->save();

    //   foreach ($naturalezas as $j => $naturaleza) {
    //     $i_naturaleza = new Inaturaleza;
    //     $i_naturaleza->id = $m++;
    //     $i_naturaleza->activo = $array_naturalezas[$fiscalia->nombre][$naturaleza->nombre]['activo'];
    //     $i_naturaleza->prestamo = $array_naturalezas[$fiscalia->nombre][$naturaleza->nombre]['prestamo'];
    //     $i_naturaleza->baja = $array_naturalezas[$fiscalia->nombre][$naturaleza->nombre]['baja'];
    //     $i_naturaleza->naturaleza_id = $naturaleza->id;
    //     $i_naturaleza->fiscalia_id = $fiscalia->id;
    //     $i_naturaleza->save();
    //   }

    // }

    // //Mandando mensaje satisfactorio
    // return response()->json([
    //   'satisfactorio' => true,
    // ]);

    // dd('listo');

  }

  public function ingresos_prestamos_bajas(){
    
  }


}
