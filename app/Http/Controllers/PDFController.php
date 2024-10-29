<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;
use QrCode;
use App\Baja;
use App\Cadena;
use App\Entrada;
use App\Fiscalia;
use App\Naturaleza;
use App\Prestamo;
use App\User;
use App\Exports\ExcelViewExport;
use Maatwebsite\Excel\Facades\Excel;

class PDFController extends Controller
{
   public function __construct()
    {
		set_time_limit(0);
		ini_set('memory_limit', '-1');
        //setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
		setlocale(LC_TIME, "spanish");
    }

   public function anexosPDF($id){
      return view('anexos-pdf',[
         'id' => $id
      ]);
   }

   public function anexo3pdf($id){
      $data = Cadena::find($id);
      //QrCode::generate('Transfórmame en un QrCode!', public_path('codigoQr/codigoqr.png'));
      QrCode::format('png');
      QrCode::size(100);
      QrCode::color(0,0,0);
      QrCode::errorCorrection('M');
      QrCode::generate("http://127.0.0.1:8000/codigoQR/{$data->id}", '../public/codigoQr/codigoqr.png');
      $pdf = PDF::loadView('vistaPdf', compact('data','codigoqr'));
      return $pdf->stream();
   }

   public function anexo4pdf($id){
      $data = Cadena::find($id);
      QrCode::format('png');
      QrCode::size(100);
      QrCode::color(0,0,0);
      QrCode::errorCorrection('M');
      QrCode::generate("http://201.116.252.147:8000/codigoQR/{$data->id}", '../public/codigoQr/codigoqr.png');
      $pdf = PDF::loadView('pdf.anexo4', compact('data'));
      return $pdf->stream();
   }

   public function etiquetapdf($tipo,$id){
      $data = Cadena::find($id);
      //QrCode::generate('Transfórmame en un QrCode!', public_path('codigoQr/codigoqr.png'));
      QrCode::format('png');
      QrCode::size(100);
      QrCode::color(255,0,255);
      QrCode::errorCorrection('M');
      QrCode::generate("http://201.116.252.147:8000/codigoQR/{$data->id}", '../public/codigoQr/codigoqr.png');
/*
      if($tipo == 1)
         $pdf = PDF::loadView('pdf.etiqueta_chica', compact('data'));
      elseif ($tipo == 2)
         $pdf = PDF::loadView('pdf.etiqueta_mediana', compact('data'));
      elseif ($tipo == 3)
         $pdf = PDF::loadView('pdf.etiqueta_grande', compact('data'));
      elseif ($tipo == 4)
         $pdf = PDF::loadView('pdf.etiqueta_chica_identificador', compact('data'));
*/

      switch ($tipo) {
         case 1:
            $pdf = PDF::loadView('pdf.etiqueta_chica', compact('data'));
            break;
         case 2:
            $pdf = PDF::loadView('pdf.etiqueta_mediana', compact('data'));
            break;
         case 3:
            $pdf = PDF::loadView('pdf.etiqueta_grande', compact('data'));
            break;
         case 4:
            $pdf = PDF::loadView('pdf.etiqueta_chica_identificador', compact('data'));
            break;
         case 5:
            $pdf = PDF::loadView('pdf.etiqueta_mediana_identificador', compact('data'));
            break;
         case 6:
            $pdf = PDF::loadView('pdf.etiqueta_grande_identificador', compact('data'));
            break;
         default:
            # code...
            break;
      }


      return $pdf->stream();
   }

   public function etiqueta_id_pdf($id){
      $data = Cadena::find($id);
      //QrCode::generate('Transfórmame en un QrCode!', public_path('codigoQr/codigoqr.png'));
      QrCode::format('png');
      QrCode::size(100);
      QrCode::color(255,0,255);
      QrCode::errorCorrection('M');
      QrCode::generate("http://201.116.252.147:8000/codigoQR/{$data->id}", '../public/codigoQr/codigoqr.png');
      $pdf = PDF::loadView('pdf.etiqueta_id', compact('data'));
      return $pdf->stream();
   }

   public function prestamo($id_prestamo){
      $prestamo = Prestamo::find($id_prestamo);

      QrCode::format('png');
      QrCode::size(100);
      QrCode::color(0,0,0);
      QrCode::errorCorrection('M');
      QrCode::generate("http://201.116.252.147:8000/codigoQR-prestamo/{$prestamo->id}", '../public/codigoQr/codigoqr_prestamo.png');
      $pdf = PDF::loadView('pdf.prestamo', compact('prestamo'));
      $pdf->setPaper('A4', 'portrait');
      return $pdf->stream();
   }


   public function baja_pdf($id_baja){
      $baja = Baja::find($id_baja);

   //   dd($baja);

      $pdf = PDF::loadView('pdf.baja', compact('baja'));
      return $pdf->stream();
   }



   public function reporte_diario(Request $request){
      //set_time_limit(0);

      // dd($request->all());


      $reporte_tipo = substr( $request->reporte_tipo, strpos($request->reporte_tipo,'_') + 1 );
      $datos = [
         'request' => $request->all(),
         'rb1' => User::find($request->rb1)->name,
         'rb2' => User::find($request->rb2)->name,
         'reporte_tipo' => $reporte_tipo,
      ];

      //  dd($datos);

      switch ($request->reporte_tipo) {
         case 'reporte_entradas':
            #Entradas
            $entradas = Entrada::where(function($q) use($request){
                                    $q->where(function($a) use($request){
                                       $a->where('fecha',$request->fecha1)
                                          ->whereBetween('hora', [$request->hora1,'23:59:59']);
                                    })
                                    ->orWhere(function($a) use($request){
                                       $a->where('fecha',$request->fecha2)
                                          ->whereBetween('hora', ['00:00:00',$request->hora2]);
                                    });
                                 })
                                 ->whereHas('cadena',function($q){
                                    $q->where('fiscalia_id',Auth::user()->fiscalia_id);
                                 })
                                 ->get();
            // $dia1_entradas = Entrada::where('fecha',$request->fecha1)
            //                            ->whereBetween('hora', [$request->hora1,'23:59:59'])
            //                            ->whereHas('cadena',function($q){
            //                               $q->where('fiscalia_id',Auth::user()->fiscalia_id);
            //                            })
            //                            ->get();
            // $dia2_entradas = Entrada::where('fecha', $request->fecha2)
            //                            ->whereBetween('hora', ['00:00:00',$request->hora2])
            //                            ->whereHas('cadena',function($q){
            //                               $q->where('fiscalia_id',Auth::user()->fiscalia_id);
            //                            })
            //                            ->get();
            // $entradas = $dia1_entradas->concat($dia2_entradas);
            $collection = $entradas->sortBy(function($entrada){
               return $entrada->cadena->folio_bodega;
            });

            // $pdf = PDF::loadView(
            //    "bodega.pdf.reportes.reporte_{$reporte_tipo}",
            //    [
            //       'datos' => $datos,
            //       'entradas' => $entradas,
            //    ] 
            // );
            break;
         case 'reporte_prestamos':
            #Prestamos
            $prestamos_dia1 = Prestamo::where('prestamo_fecha',$request->fecha1)
                                 ->whereBetween('prestamo_hora', [$request->hora1,'23:59:59'])
                                 //->where('estado','activo')
                                 ->whereHas('cadena',function($q){
                                    $q->where('fiscalia_id',Auth::user()->fiscalia_id);
                                 })
                                 ->orderBy('prestamo_hora','asc')
                                 ->get();
            $prestamos_dia2 = Prestamo::where('prestamo_fecha',$request->fecha2)
                                 ->whereBetween('prestamo_hora', ['00:00:00',$request->hora2])
                                 //->where('estado','activo')
                                 ->whereHas('cadena',function($q){
                                    $q->where('fiscalia_id',Auth::user()->fiscalia_id);
                                 })
                                 ->orderBy('prestamo_hora','asc')
                                 ->get();
            $prestamos = $prestamos_dia1->concat($prestamos_dia2);
            #Reingresos
            $reingresos_dia1 = Prestamo::where('reingreso_fecha',$request->fecha1)
                                 ->whereBetween('reingreso_hora', [$request->hora1,'23:59:59'])
                                 //->where('estado','activo')
                                 ->whereHas('cadena',function($q){
                                    $q->where('fiscalia_id',Auth::user()->fiscalia_id);
                                 })
                                 ->orderBy('reingreso_hora','asc')
                                 ->get();
            $reingresos_dia2 = Prestamo::where('reingreso_fecha',$request->fecha2)
                                 ->whereBetween('reingreso_hora', ['00:00:00',$request->hora2])
                                 //->where('estado','activo')
                                 ->whereHas('cadena',function($q){
                                    $q->where('fiscalia_id',Auth::user()->fiscalia_id);
                                 })
                                 ->orderBy('reingreso_hora','asc')
                                 ->get();
            $reingresos = $reingresos_dia1->concat($reingresos_dia2);

            $collection = $reingresos->concat($prestamos)->unique();

            //dd($reingre);

            // $pdf = PDF::loadView(
            //    "bodega.pdf.reportes.reporte_{$reporte_tipo}",
            //    [
            //       'datos' => $datos,
            //       'prestamos' => $prestamos,
            //    ] 
            // );
            break;
         case 'reporte_bajas':
            $bajas_dia1 = Baja::where('fecha',$request->fecha1)
                           ->whereBetween('hora', [$request->hora1,'23:59:59'])
                           ->whereHas('cadena',function($q){
                              $q->where('fiscalia_id',Auth::user()->fiscalia_id);
                           })
                           ->orderBy('hora','asc')
                           ->get();
            $bajas_dia2 = Baja::where('fecha', $request->fecha2)
                           ->whereBetween('hora', ['00:00:00',$request->hora2])
                           ->whereHas('cadena',function($q){
                              $q->where('fiscalia_id',Auth::user()->fiscalia_id);
                           })
                           ->orderBy('hora','asc')
                           ->get();
            
            $collection = $bajas_dia1->concat($bajas_dia2);
            break;
         default:
            # code...
            break;
      }


      // //ETRADAS
      // $entradas = Entrada::where(function($q) use($request){
      //                               $q->where('fecha',$request->fecha1)
      //                                  ->whereBetween('hora', [$request->hora1,'23:59:59']);
      //                            })
      //                            ->where(function($q) use($request){
      //                               $q->where('fecha',$request->fecha2)
      //                                  ->whereBetween('hora', ['00:00:00',$request->hora2]);
      //                            })
      //                            ->where('fiscalia_id',Auth::user()->fiscalia_id)
      //                            ->get();

      // $dia1_entradas = Entrada::where('fecha',$request->fecha1)
      //                            ->whereBetween('hora', [$request->hora1,'23:59:59'])
      //                            ->whereHas('cadena',function($q){
      //                               $q->where('fiscalia_id',Auth::user()->fiscalia_id);
      //                            })
      //                            ->get();
      // $dia2_entradas = Entrada::where('fecha', $request->fecha2)
      //                            ->whereBetween('hora', ['00:00:00',$request->hora2])
      //                            ->whereHas('cadena',function($q){
      //                               $q->where('fiscalia_id',Auth::user()->fiscalia_id);
      //                            })
      //                            ->get();
      // $entradas = $dia1_entradas->concat($dia2_entradas);
      // $entradas = $entradas->sortBy(function($entrada){
      //    return $entrada->cadena->folio_bodega;
      // });

      //PRESTAMOS
      // $dia1_prestamos = Prestamo::where('prestamo_fecha',$request->fecha1)
      //                               ->whereBetween('prestamo_hora', [$request->hora1,'23:59:59'])
      //                               ->whereHas('cadena',function($q){
      //                                  $q->where('fiscalia_id',Auth::user()->fiscalia_id);
      //                               })
      //                               ->get();
      // $dia1_reingresos = Prestamo::where('reingreso_fecha',$request->fecha1)
      //                               ->whereBetween('reingreso_hora', [$request->hora1,'23:59:59'])
      //                               ->whereHas('cadena',function($q){
      //                                  $q->where('fiscalia_id',Auth::user()->fiscalia_id);
      //                               })
      //                               ->get();
      // $dia2_prestamos = Prestamo::where('prestamo_fecha', $request->fecha2)
      //                               ->whereBetween('prestamo_hora', ['00:00:00',$request->hora2])
      //                               ->whereHas('cadena',function($q){
      //                                  $q->where('fiscalia_id',Auth::user()->fiscalia_id);
      //                               }
      //                               )->get();
      // $dia2_reingresos = Prestamo::where('reingreso_fecha', $request->fecha2)
      //                               ->whereBetween('reingreso_hora', ['00:00:00',$request->hora2])
      //                               ->whereHas('cadena',function($q){
      //                                  $q->where('fiscalia_id',Auth::user()->fiscalia_id);
      //                               })
      //                               ->get();



      
      // $reingresos = $dia1_reingresos->concat($dia2_reingresos);

      // $prestamos = $prestamos->concat($reingresos)->unique()->sortBy('prestamo_fecha');

/*
      $diff = $reingresos->diff($prestamos);

      if( (count($diff)) != 0 )
         $prestamos = $prestamos->concat($diff)->sortBy('prestamo_fecha')->sortBy('prestamo_hora');
      else
         $prestamos = $prestamos->concat($reingresos)->sortBy('prestamo_fecha');

*/


      //BAJAS
      // $dia1_bajasd = Baja::where('fecha',$request->fecha1)->where('tipo','definitiva')
      //       ->whereBetween('hora', [$request->hora1,'23:59:59'])->with('cadena')->whereHas('cadena',function($q){
      //          $q->where('fiscalia_id',Auth::user()->fiscalia_id);
      //       })->get();
      // $dia2_bajasd = Baja::where('fecha', $request->fecha2)->where('tipo','definitiva')
      //       ->whereBetween('hora', ['00:00:00',$request->hora2])->with('cadena')->whereHas('cadena',function($q){
      //          $q->where('fiscalia_id',Auth::user()->fiscalia_id);
      //       })->get();
      // $bajas_d = $dia1_bajasd->concat($dia2_bajasd)->sortBy('hora');


      // $dia1_bajasp = Baja::where('fecha',$request->fecha1)->where('tipo','parcial')
      //       ->whereBetween('hora', [$request->hora1,'23:59:59'])->with('cadena')->whereHas('cadena',function($q){
      //          $q->where('fiscalia_id',Auth::user()->fiscalia_id);
      //       })->get();
      // $dia2_bajasp = Baja::where('fecha', $request->fecha2)->where('tipo','parcial')
      //       ->whereBetween('hora', ['00:00:00',$request->hora2])->with('cadena')->whereHas('cadena',function($q){
      //          $q->where('fiscalia_id',Auth::user()->fiscalia_id);
      //       })->get();
      // $bajas_p = $dia1_bajasp->concat($dia2_bajasp)->sortBy('hora');

      // $dia1_bajasper = Baja::where('fecha',$request->fecha1)->where('tipo','pertenencia')
      //       ->whereBetween('hora', [$request->hora1,'23:59:59'])->with('cadena')->whereHas('cadena',function($q){
      //          $q->where('fiscalia_id',Auth::user()->fiscalia_id);
      //       })->get();
      // $dia2_bajasper = Baja::where('fecha', $request->fecha2)->where('tipo','pertenencia')
      //       ->whereBetween('hora', ['00:00:00',$request->hora2])->with('cadena')->whereHas('cadena',function($q){
      //          $q->where('fiscalia_id',Auth::user()->fiscalia_id);
      //       })->get();
      // $bajas_per = $dia1_bajasper->concat($dia2_bajasper)->sortBy('hora');


      
      
      
      
      
      
      $pdf = PDF::loadView(
         "bodega.pdf.reportes.reporte_{$reporte_tipo}",
         [
            'datos' => $datos,
            $reporte_tipo => $collection,
         ] 
      );
      

      
      $pdf->setPaper('A4', 'landscape');
      return $pdf->stream();

      // $pdf = PDF::loadView('pdf.reporte_ingresos', compact(['entradas','prestamos','bajas_d','bajas_p','bajas_per','fecha1','fecha2','rb1','rb2']));
      // $pdf->setPaper('A4', 'landscape');
      // return $pdf->stream();

     // return view('pdf.reporte_ingresos',['entradas' => $entradas]);
   }


   public function caratula(Request $request){
      $entradas = Entrada::where('fecha',$request->fecha)
                        ->whereHas('cadena',function($q){
                           $q->where('fiscalia_id',Auth::user()->fiscalia_id)->where('estado','validada');
                        })->get()
                        ->sortBy(function($entrada){
                           return $entrada->cadena->folio_bodega;
                        });


      
      $fecha = mb_strtoupper(strftime('%d-%B-%Y',strtotime($request->fecha)));

      $pdf = PDF::loadView('pdf.caratula_pdf', compact(['entradas','fecha']));
//      $pdf->setPaper('A4', 'portrait');
      return $pdf->stream();
   }


   public function lista_cadenas_pdf(Request $request){
      set_time_limit(0);

      // dd(var_dump(Auth::user()->fiscalia_id));

      $nucs = $request->nucs;
      $textos = $request->buscar_texto;

   //  dd($request->all());

      //NUEVO


     $cadenas = Cadena::where('estado','validada')
                        #Fiscalia
                        ->where(function($q) use($request){
                           if(Auth::user()->fiscalia_id != 4){
                              $q->where('fiscalia_id',(Auth::user()->fiscalia_id));
                           }
                           else{
                              if( !($request->buscar_fiscalias[0] === "0") ){
                                 $q->whereIn('fiscalia_id',$request->buscar_fiscalias);
                              }
                           }
                        })
                        #Texto
                        ->where(function($q) use($request){
                           foreach ($request->buscar_texto as $key => $texto) {
                              if($texto != null){
                                 $q->orWhereHas('indicios',function($a) use($texto){
                                       $a->where('descripcion','like',"%{$texto}%");
                                 });   
                              }
                           }
                        })
                        #NUCS
                        ->where(function($q) use($request){
                           foreach ($request->nucs as $key => $nuc) {
                              if($nuc != null)
                                 $q->orWhere('nuc','like',"%{$nuc}%");
                           }
                        })
                        #Naturaleza
                        ->where(function($q) use($request){
                           if ( !($request->buscar_naturalezas[0] === "0") ) {
                              $q->whereHas('entrada',function($a) use($request){
                                 $a->whereIn('naturaleza_id',$request->buscar_naturalezas);
                              });
                           }
                        })
                        #Fechas
                        ->where(function($q) use($request){
                           $q->whereHas('entrada',function($a) use($request){
                              if($request->filled('buscar_fecha_inicio')){
                                 if($request->filled('buscar_fecha_fin'))
                                    $a->whereBetween('fecha',[$request->buscar_fecha_inicio,$request->buscar_fecha_fin]);
                                 else
                                    $a->where('fecha',$request->buscar_fecha_inicio);
                              }
                           });
                        })
						//->whereIn('unidad_id',[18,60,91,92])
                        ->get();

      $cadenas = $cadenas->unique()->sortBy('folio_bodega');
      // $cadenas = $cadenas->unique()->sortBy(function($cadena,$key){
      //    return $cadena->entrada->fecha;
      // });

      $campo_folio = FALSE;
      $campo_sp_entrega = FALSE;
      $campo_indicio_estado = FALSE;
      $campo_indicio_resguardo = FALSE;

      if ($request->has('campo_folio'))
        $campo_folio = TRUE;
      if($request->has('campo_sp_entrega'))
         $campo_sp_entrega = TRUE;
      if($request->has('campo_indicio_estado'))
         $campo_indicio_estado = TRUE;
      if($request->has('campo_indicio_resguardo'))
         $campo_indicio_resguardo = TRUE;


         $datos = [
            'request' => $request->all(),
            'campo_folio' => $campo_folio,
            'campo_sp_entrega' => $campo_sp_entrega,
            'campo_indicio_estado' => $campo_indicio_estado,
            'campo_indicio_resguardo' => $campo_indicio_resguardo,
         ];

         // $pdf = PDF::loadView('pdf.listado_folio', compact('cadenas'));
         // $pdf->setPaper('A4', 'landscape');
         // return $pdf->stream();


         // dd( count($datos['request']['nucs']) );
         //dd($datos);
         

      
         // if ($request->btn_listado === 'pdf') {
         //    $pdf = PDF::loadView('pdf.listado_cadenas_pdf', compact('nucs','cadenas','folio','sp_entrega','indicio_estado','indicio_resguardo'));
         //    $pdf->setPaper('A4', 'landscape');
         //    return $pdf->stream();
         // }
         // elseif($request->btn_listado === 'excel'){
         //    return Excel::download(new ExcelViewExport("excel.listado_general", ['nucs'=>$nucs,'cadenas'=>$cadenas,'folio'=>$folio,'sp_entrega'=>$sp_entrega,'indicio_estado'=>$indicio_estado,'indicio_resguardo'=>$indicio_resguardo]),'consulta_entradas.xlsx');
         // }
     

         $fiscalias = Fiscalia::all();
         $naturalezas = Naturaleza::all();

         

         if($request->listado_tipo === 'listado_oficio'){
            return view('bodega.listado_oficio',
            [
                'cadenas' => $cadenas,
                'datos' => $datos,
            ]
            );
         }
         elseif($request->listado_tipo === 'listado_general'){
            if($request->listado_archivo === 'listado_pdf'){
               $pdf = PDF::loadView("bodega.pdf.listados.{$request->listado_tipo}", compact('cadenas','fiscalias','naturalezas','datos'));
               $pdf->setPaper('A4', 'landscape');
               return $pdf->stream();
            }
            elseif($request->listado_archivo === 'listado_excel'){
               return Excel::download(new ExcelViewExport("bodega.excel.listados.{$request->listado_tipo}", ['cadenas'=>$cadenas,'datos'=>$datos]),'consulta_entradas.xlsx');
            }
         }
         elseif($request->listado_tipo === 'listado_folio'){
            $pdf = PDF::loadView("bodega.pdf.listados.{$request->listado_tipo}", compact('cadenas','fiscalias','naturalezas','datos'));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream();
         }


         // if ($request->btn_listado === 'pdf') {
         //    $pdf = PDF::loadView("bodega.pdf.listados.{$request->listado_tipo}", compact('cadenas','fiscalias','naturalezas','datos'));
         //    $pdf->setPaper('A4', 'landscape');
         //    return $pdf->stream();
         // }
         // elseif($request->btn_listado === 'excel'){
         //    return Excel::download(new ExcelViewExport("bodega.excel.listados.{$request->listado_tipo}", ['cadenas'=>$cadenas,'datos'=>$datos]),'consulta_entradas.xlsx');
         // }
         // elseif($request->btn_listado === 'oficio'){
         //    return view('bodega.listado_oficio',
         //    [
         //        'cadenas' => $cadenas,
         //        'datos' => $datos,
         //    ]
         //    );
         // }

   }


   public function lista_general(Request $request){

      //dd($request->all());
/*
      $cadenas = collect();
      $nucs = $request->nuc;

      foreach ($nucs as $key => $nuc) {
         $consulta = Cadena::where('nuc','like',"%$nuc%")
                           ->where('estado','validada')
                           ->where(function($a) use($request){
                              if( !($request->fiscalias[0] === "0") )
                                 $a->whereIn('fiscalia_id',$request->fiscalias);
                              if( !($request->naturalezas[0] === "0") ){
                                 $a->whereHas('entrada',function($b) use($request){
                                    $b->whereIn('naturaleza_id',$request->naturalezas);
                                 });
                              }  
                           })
                           ->get();
         $cadenas->push($consulta);
      }
*/

      $cadenas = Cadena::where('estado','validada')->
                        where(function($a) use($request){
                           if ( !($request->fiscalias[0] === "0") ) {
                              $a->whereIn('fiscalia_id',$request->fiscalias);
                           }
                           if( !($request->naturalezas[0] === "0") ){
                              $a->whereHas('entrada',function($b) use($request){
                                 $b->whereIn('naturaleza_id',$request->naturalezas);
                              });
                           }
                        })->get();


      $cadenas = $cadenas->collapse()->unique()->sortBy('folio_bodega');

      //NUEVO

      /*
       
       $cadenas = Cadena::where(function($q) use($nucs){
          foreach ($nucs as $key => $nuc) {
             if($key === 0)
             $q->where('nuc','like',)
            }
         })
         
         */


      $folio = FALSE;
      $sp_entrega = FALSE;
      $indicio_estado = FALSE;
      if ($request->has('folio'))
        $folio = TRUE;
      if($request->has('sp_entrega'))
         $sp_entrega = TRUE;
      if($request->indicio_estado)
         $indicio_estado = TRUE;

      if ($request->btn_archivo === 'pdf') {
         $pdf = PDF::loadView('pdf.listado_general', compact('cadenas','folio','sp_entrega','indicio_estado'));
         $pdf->setPaper('A4', 'landscape');
         return $pdf->stream();
      }
      if ($request->btn_archivo === 'excel') {
         # code...
      }




   }


   public function listado_anio(){
      set_time_limit(0);
      $cadenas = Cadena::where('fiscalia_id',4)
                        ->whereHas('entrada',function($q){
                           $q->whereYear('fecha','2018');
                        })
                        ->get();

      $pdf = PDF::loadView('pdf.listado_anio',
         compact(
            'cadenas'
         )
      );
      $pdf->setPaper('A4', 'landscape');
      return $pdf->stream();
   }


   public function reporte_armas(Request $request){
      if ($request->btn === 'btn_entradas') {
         $entradas = Entrada::whereBetween('fecha',[$request->fecha_inicio,$request->fecha_fin])
                           
                           ->whereHas('cadena',function($a) use($request){
                              $a->where('estado','validada')->whereIn('naturaleza_id',[1,2]);
							   if(Auth::user()->tipo == 'responsable_bodega'){
								   $a->where('fiscalia_id',Auth::user()->fiscalia->id);
							   }
							   if($request->filled('region_id')){
									$a->where('fiscalia_id',$request->region_id);
							   }
                           })
                           ->get();
         
         $pdf = PDF::loadView('pdf.armas_entradas',
            [
               'entradas' => $entradas,
               'fecha_inicio' => $request->fecha_inicio,
               'fecha_fin' => $request->fecha_fin,
            ]
         );

      }
      elseif($request->btn === 'btn_bajas'){
         $bajas = Baja::whereBetween('fecha',[$request->fecha_inicio,$request->fecha_fin])
                        ->whereHas('cadena',function($a) use($request){
                           $a->where('estado','validada')->whereIn('naturaleza_id',[1,2]);
						   if(Auth::user()->tipo == 'responsable_bodega'){
							   $a->where('fiscalia_id',Auth::user()->fiscalia->id);
						   }
						   if($request->filled('region_id')){
								$a->where('fiscalia_id',$request->region_id);
						   }
                        })
                        ->get();

         $pdf = PDF::loadView('pdf.armas_bajas',
            [
               'bajas' => $bajas,
               'fecha_inicio' => $request->fecha_inicio,
               'fecha_fin' => $request->fecha_fin,
            ]
         );
      }

      
      $pdf->setPaper('A4', 'landscape');
      return $pdf->stream();
   }

}
