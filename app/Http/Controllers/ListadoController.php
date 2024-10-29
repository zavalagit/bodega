<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;
use QrCode;
use App\Cadena;
use App\Entrada;

class ListadoController extends Controller
{
    public function listado_oficio (Request $request){
        set_time_limit(0);
  
        // dd('Jessie');
  
        $nucs = $request->nucs;
        $textos = $request->buscar_texto;
  
      //dd($request->all());
  
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
                                if($texto != null)
                                   $q->orWhereHas('indicios',function($a) use($texto){
                                         //dd('holassss');
                                         $a->where('descripcion','like',"%{$texto}%");
                                   });
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
                          // #Texto
                          // ->where(function($q) use($request){
                          //    if ( $request->filled('buscar_texto') ) {
                          //       $q->whereHas('indicios',function($a) use($request){
                          //          $a->where('descripcion','like',"%{$request->buscar_texto}%");
                          //       });
                          //    }
                          // })
                          // ->where(function($q) use($request){
                            
                          //       $q->whereHas('indicios',function($a) use($request){
                          //          $a->where('descripcion','not likexº',"%amorf%");
                          //       });
                             
                          // })
                          ->get();
        
        $cadenas = $cadenas->unique()->sortBy('folio_bodega');
        // $cadenas = $cadenas->unique()->sortBy(function($cadena,$key){
        //    return $cadena->entrada->fecha;
        // });

        $datos = [
            'request' => $request->all(),
        ];

        return view('bodega.listado_oficio',
            [
                'cadenas' => $cadenas,
                'datos' => $datos,
            ]
        );

  
        $folio = FALSE;
        $sp_entrega = FALSE;
        $indicio_estado = FALSE;
        $indicio_resguardo = FALSE;
  
        if ($request->has('folio'))
          $folio = TRUE;
        if($request->has('sp_entrega'))
           $sp_entrega = TRUE;
        if($request->has('indicio_estado'))
           $indicio_estado = TRUE;
        if($request->has('indicio_resguardo'))
           $indicio_resguardo = TRUE;
  
  
           $datos = [
              'request' => $request->all(),
              'folio' => $folio,
              'sp_entrega' => $sp_entrega,
              'indicio_estado' => $indicio_estado,
              'indicio_resguardo' => $indicio_resguardo,
           ];
  
           // $pdf = PDF::loadView('pdf.listado_folio', compact('cadenas'));
           // $pdf->setPaper('A4', 'landscape');
           // return $pdf->stream();
  
  
           // dd( count($datos['request']['nucs']) );
           // dd($datos);
           
  
        
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
  
           
           if ($request->btn_listado === 'pdf') {
              $pdf = PDF::loadView("bodega.pdf.listados.{$request->listado_tipo}", compact('cadenas','fiscalias','naturalezas','datos'));
              $pdf->setPaper('A4', 'landscape');
              return $pdf->stream();
           }
           elseif($request->btn_listado === 'excel'){
              return Excel::download(new ExcelViewExport("bodega.excel.listados.{$request->listado_tipo}", ['nucs'=>$nucs,'cadenas'=>$cadenas,'folio'=>$folio,'sp_entrega'=>$sp_entrega,'indicio_estado'=>$indicio_estado,'indicio_resguardo'=>$indicio_resguardo]),'consulta_entradas.xlsx');
           }
  
     }

     public function listado_oficio_historial(Request $request){
        dd($request->all());
     }
}
