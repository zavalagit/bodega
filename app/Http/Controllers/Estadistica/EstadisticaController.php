<?php


namespace App\Http\Controllers\Estadistica;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DateTime;
use PDF;
use QrCode;
use App\Baja;
use App\Cadena;
use App\Entrada;
use App\Fiscalia;
use App\Naturaleza;
use App\Indicio;
use App\Prestamo;
use App\User;
use App\Exports\ExcelViewExport;
use Maatwebsite\Excel\Facades\Excel;

class EstadisticaController extends Controller
{
  public function estadistica_ie(Request $request){
    set_time_limit(0);
    setlocale(LC_TIME,"es_MX.UTF-8");
    date_default_timezone_set("America/Mexico_City");
    


    $fiscalias = Fiscalia::all();
    $array_estadistica = [];
    foreach ($fiscalias as $key => $fiscalia) {
      $array_estadistica[$fiscalia->nombre] = ['indicios'=>0,'evidencias'=>0,'prestamos'=>0,'bajas'=>0];   
    }

    if($request->filled('fecha_inicio')){
      //Dia siguiente de fecha inicio
      $dia_siguiente = date('Y-m-d',strtotime($request->fecha_inicio."+1 day"));
      //Dia anterior de fecha fin
      if($request->filled('fecha_fin'))
        $dia_anterior = date('Y-m-d',strtotime($request->fecha_fin."-1 day"));

      #tipo fecha acuse
      if($request->tipo_inventario == 'fecha_acuse'){
        #Entradas
          $entradas = Entrada::where(function($q) use($request){
                                if($request->filled(['hora_inicio','hora_fin'])){
                                  $q->where('fecha',$request->fecha_inicio)
                                    ->whereBetween('hora',[$request->hora_inicio,$request->hora_fin]);
                                }
                                else if($request->filled('fecha_fin')){
                                  $q->whereBetween('fecha',[$request->fecha_inicio,$request->fecha_fin]);
                                }
                                else{
                                  $q->where('fecha',$request->fecha_inicio);
                                }
                              })
                              ->get();
  
          if($request->filled(['fecha_fin','hora_inicio','hora_fin'])){
            //fecha inicio con hora inicio
            $entradas1 = Entrada::where('fecha',$request->fecha_inicio)
                                ->whereBetween('hora',[$request->hora_inicio,'23:59:59']);
            //Dias intermedios
              $entradas2="";
              //1 dia intermedio
              /*
			  if($dia_siguiente == $dia_anterior){
                $entradas2 = Entrada::where('fecha',$dia_siguiente);
              }
              //mas de un dia intermedio
              else if( ($dia_siguiente != $dia_anterior) && ($dia_siguiente != $request->fecha_fin) ){
                $entradas2 = Entrada::whereBetween('fecha',[$dia_siguiente,$dia_anterior]);
              }
			  */
            //fecha fin con hora fin
            $entradas = Entrada::where('fecha',$request->fecha_fin)
                                ->whereBetween('hora',['00:00:00',$request->hora_fin])
								->union($entradas1)
								->get();
								/*
                                ->where(function($q) use($dia_siguiente,$dia_anterior,$request,$entradas1,$entradas2){
                                  $q->union($entradas1);
                                  if($dia_siguiente == $dia_anterior)
                                    $q->union($entradas2);
                                  else if( ($dia_siguiente != $dia_anterior) && ($dia_siguiente != $request->fecha_fin) )
                                    $q->union($entradas2);
								
								->union($entradas1);
                                })
                                ->get();*/
          }
  
        #Prestamos
          $prestamos = Prestamo::where(function($q) use($request){
                                    if($request->filled(['hora_inicio','hora_fin'])){
                                      $q->where('prestamo_fecha',$request->fecha_inicio)
                                        ->whereBetween('prestamo_hora',[$request->hora_inicio,$request->hora_fin]);
                                    }
                                    else if($request->filled('fecha_fin')){
                                      $q->whereBetween('prestamo_fecha',[$request->fecha_inicio,$request->fecha_fin]);
                                    }
                                    else{
                                      $q->where('prestamo_fecha',$request->fecha_inicio);
                                    }
                                  })
                                  ->get();

          if($request->filled(['fecha_fin','hora_inicio','hora_fin'])){
            //fecha inicio con hora inicio
            $prestamos1 = Prestamo::where('prestamo_fecha',$request->fecha_inicio)
                      ->whereBetween('prestamo_hora',[$request->hora_inicio,'23:59:59']);
            //Dias intermedios
		/*	
              $prestamos2="";
              //1 dia intermedio
              if($dia_siguiente == $dia_anterior)
                $prestamos2 = Prestamo::where('prestamo_fecha',$dia_siguiente);
              //mas de un dia intermedio
              else if( ($dia_siguiente != $dia_anterior) && ($dia_siguiente != $request->fecha_fin) )
              $prestamos2 = Prestamo::whereBetween('prestamo_fecha',[$dia_siguiente,$dia_anterior]);
            */
			//fecha fin con hora fin
            $prestamos = Prestamo::where('prestamo_fecha',$request->fecha_fin)
                      ->whereBetween('prestamo_hora',['00:00:00',$request->hora_fin])
					  /*
                      ->where(function($q) use($dia_siguiente,$dia_anterior,$request,$prestamos1,$prestamos2){
                        $q->union($prestamos1);
                        if($dia_siguiente == $dia_anterior)
                          $q->union($prestamos2);
                        else if( ($dia_siguiente != $dia_anterior) && ($dia_siguiente != $request->fecha_fin) )
                          $q->union($prestamos2);
                      })
					  */
					  ->union($prestamos1)
                      ->get();
          }

        #Bajas
        $bajas = Baja::where(function($q) use($request){
                                if($request->filled(['hora_inicio','hora_fin'])){
                                  $q->where('fecha',$request->fecha_inicio)
                                    ->whereBetween('hora',[$request->hora_inicio,$request->hora_fin]);
                                }
                                else if($request->filled('fecha_fin')){
                                  $q->whereBetween('fecha',[$request->fecha_inicio,$request->fecha_fin]);
                                }
                                else{
                                  $q->where('fecha',$request->fecha_inicio);
                                }
                              })
                              ->get();
  
  $bajas2='';
          if($request->filled(['fecha_fin','hora_inicio','hora_fin'])){
            //fecha inicio con hora inicio
            $bajas1 = Baja::where('fecha',$request->fecha_inicio)
                                ->whereBetween('hora',[$request->hora_inicio,'23:59:59']);
            
			/*
			//Dias intermedios
              $bajas="";
              //1 dia intermedio
              if($dia_siguiente == $dia_anterior){
                $bajas2 = Baja::where('fecha',$dia_siguiente)
                                    ->union($bajas);
              }
              //mas de un dia intermedio
              else if( ($dia_siguiente != $dia_anterior) && ($dia_siguiente != $request->fecha_fin) ){
                $bajas2 = Baja::whereBetween('fecha',[$dia_siguiente,$dia_anterior])
                                    ->union($bajas);
              }
			  */
            //fecha fin con hora fin
            $bajas = Baja::where('fecha',$request->fecha_fin)
                                ->whereBetween('hora',['00:00:00',$request->hora_fin])
								/*
                                ->where(function($q) use($dia_siguiente,$dia_anterior,$request,$bajas1,$bajas2){
                                  $q->union($bajas1);
                                  if($dia_siguiente == $dia_anterior)
                                    $q->union($bajas2);
                                  else if( ($dia_siguiente != $dia_anterior) && ($dia_siguiente != $request->fecha_fin) )
                                    $q->union($bajas2);
                                })
								*/
								->union($bajas1)
                                ->get();
          }
      }
      #tipo fecha registro
      else if ($request->tipo_inventario == 'fecha_registro') {
        #Entradas
          $entradas = Entrada::where(function($q) use($request){
                                  if($request->filled(['fecha_fin','hora_inicio','hora_fin'])){
                                    $q->whereBetween('created_at',["{$request->fecha_inicio} {$request->hora_inicio}","{$request->fecha_fin} {$request->hora_fin}"]);
                                  }
                                  else if($request->filled(['hora_inicio','hora_fin'])){
                                    $q->whereBetween('created_at',["{$request->fecha_inicio} {$request->hora_inicio}","{$request->fecha_inicio} {$request->hora_fin}"]);
                                  }
                                  else if($request->filled('fecha_fin')){
                                    $q->whereBetween('created_at',["{$request->fecha_inicio} 00:00:00","{$request->fecha_fin} 23:59:59"]);
                                  }
                                  else{
                                    $q->whereDate('created_at',$request->fecha_inicio);
                                  }
                                })
                                ->get();
        #Prestamos
        $prestamos = Prestamo::where(function($q) use($request){
                                  if($request->filled(['fecha_fin','hora_inicio','hora_fin'])){
                                    $q->whereBetween('created_at',["{$request->fecha_inicio} {$request->hora_inicio}","{$request->fecha_fin} {$request->hora_fin}"]);
                                  }
                                  else if($request->filled(['hora_inicio','hora_fin'])){
                                    $q->whereBetween('created_at',["{$request->fecha_inicio} {$request->hora_inicio}","{$request->fecha_inicio} {$request->hora_fin}"]);
                                  }
                                  else if($request->filled('fecha_fin')){
                                    $q->whereBetween('created_at',["{$request->fecha_inicio} 00:00:00","{$request->fecha_fin} 23:59:59"]);
                                  }
                                  else{
                                    $q->whereDate('created_at',$request->fecha_inicio);
                                  }
                                })
                                ->get();
        #Bajas
        $bajas = Baja::where(function($q) use($request){
                          if($request->filled(['fecha_fin','hora_inicio','hora_fin'])){
                            $q->whereBetween('created_at',["{$request->fecha_inicio} {$request->hora_inicio}","{$request->fecha_fin} {$request->hora_fin}"]);
                          }
                          else if($request->filled(['hora_inicio','hora_fin'])){
                            $q->whereBetween('created_at',["{$request->fecha_inicio} {$request->hora_inicio}","{$request->fecha_inicio} {$request->hora_fin}"]);
                          }
                          else if($request->filled('fecha_fin')){
                            $q->whereBetween('created_at',["{$request->fecha_inicio} 00:00:00","{$request->fecha_fin} 23:59:59"]);
                          }
                          else{
                            $q->whereDate('created_at',$request->fecha_inicio);
                          }
                        })
                        ->get();
        


      }

      #Agregando datos a array
        //entradas
        $entradas = $entradas->unique();
        foreach ($entradas as $key => $entrada) {
          if ($entrada->tipo === 'indicio') {
            $array_estadistica[$entrada->cadena->fiscalia->nombre]['indicios'] +=  $entrada->cadena->indicios->sum('numero_indicios');
          }
          elseif ($entrada->tipo === 'evidencia') {
            $array_estadistica[$entrada->cadena->fiscalia->nombre]['evidencias'] +=  $entrada->cadena->indicios->sum('numero_indicios');
          }
        }
        //prestamos
        $prestamos = $prestamos->unique();    
        foreach ($prestamos as $key => $prestamo) {
          $array_estadistica[$prestamo->cadena->fiscalia->nombre]['prestamos'] += $prestamo->prestamo_numindicios;
        }
        //bajas
        foreach ($bajas as $key => $baja) {
          $array_estadistica[$baja->cadena->fiscalia->nombre]['bajas'] += $baja->numero_indicios;
        }
      
      return view('estadistica.estadistica',[
        'array_estadistica' => $array_estadistica,
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_fin' => $request->fecha_fin,
      ]);
    }
    
    
    return view('estadistica.estadistica');

  }
 #---------------------------------------------------------------------------------------------------------------------------------
  public function estadistica_anio(Request $request){
    set_time_limit(0);
    //dd($request->all());

    $fiscalias = Fiscalia::all();
    $array_estadistica = [];
    foreach ($fiscalias as $key => $fiscalia) {
      $array_estadistica[$fiscalia->nombre] = ['indicios'=>0,'evidencias'=>0,'prestamos'=>0,'bajas'=>0];   
    }

   $entradas = Entrada::whereYear('fecha','2017')->get();
  
   
   foreach ($entradas as $key => $entrada) {
     if ($entrada->tipo === 'indicio') {
       $array_estadistica[$entrada->cadena->fiscalia->nombre]['indicios'] +=  $entrada->cadena->indicios->sum('numero_indicios');
      }
      elseif ($entrada->tipo === 'evidencia') {
        $array_estadistica[$entrada->cadena->fiscalia->nombre]['evidencias'] +=  $entrada->cadena->indicios->sum('numero_indicios');
      }
    }
    
    $prestamos = Prestamo::whereYear('prestamo_fecha','2017')->get();  
    foreach ($prestamos as $key => $prestamo) {
      $array_estadistica[$prestamo->cadena->fiscalia->nombre]['prestamos'] += $prestamo->prestamo_numindicios;
    }

    $bajas = Baja::whereYear('fecha','2017')->get();
    foreach ($bajas as $key => $baja) {
      $array_estadistica[$baja->cadena->fiscalia->nombre]['bajas'] += $baja->numero_indicios;
    }


      return view('estadistica.estadistica',[
        'array_estadistica' => $array_estadistica,
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_fin' => $request->fecha_fin,
      ]);
    
    
    
    return view('estadistica.estadistica');

  }
  
  /******/
  public function set_entradas(){
    $this->entradas = Indicio::whereHas('cadena',function($q){
      $q->where('fiscalia_id',4)
      ->where('estado','validada')
      ->whereHas('entrada',function($a){
        $a->whereBetween('fecha',['2020-12-01','2020-12-31']);
      });
    })
    ->
    get();
  }
  public function set_prestamos(){
    // $this->prestamos = Indicio::whereHas('cadena',function($q){
    //   $q->where('fiscalia_id',4)
    //   ->whereHas('prestamos',function($a){
    //     $a->whereBetween('prestamo_fecha',['2020-12-01','2020-12-31']);
    //   });
    // })
    // ->
    // get();

    $this->prestamos = Prestamo::whereBetween('prestamo_fecha',['2020-12-01','2020-12-31'])
    ->whereHas('cadena',function($q){
      $q->where('fiscalia_id',4)
      ->where('estado','validada');
    })
    ->get();
  }
  public function set_bajas(){
    // $this->bajas = Indicio::whereHas('cadena',function($q){
    //   $q->where('fiscalia_id',4)
    //   ->whereHas('bajas',function($a){
    //     $a->whereBetween('fecha',['2020-12-01','2020-12-31']);
    //   });
    // })
    // ->
    // get();

    $this->bajas = Baja::whereBetween('fecha',['2020-12-01','2020-12-31'])
    ->whereHas('cadena',function($q){
      $q->where('fiscalia_id',4)
      ->where('estado','validada');
    })
    ->get();
  }
  public function estadistica_entradas_salidas(){
    $this->set_entradas();
    $this->set_prestamos();
    $this->set_bajas();

    $i_prestamos = 0;
    foreach ($this->prestamos as $key => $prestamo) {
      $i_prestamos = $i_prestamos + $prestamo->indicios->sum('numero_indicios');
    }
    $i_bajas = 0;
    foreach ($this->bajas as $key => $baja) {
      $i_bajas = $i_bajas + $baja->indicios->sum('numero_indicios');
    }

    echo "Entradas: {$this->entradas->sum('numero_indicios')} <br>";
    echo "Prestamos: {$i_prestamos} <br>";
    echo "Entradas: {$i_bajas} <br>";
  }
}
