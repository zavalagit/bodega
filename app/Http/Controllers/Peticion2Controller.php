<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\TraitFechaFormato;
use App\Traits\TraitPeticiones;
use App\Http\Requests\PeticionFormRequest;
use Auth;
use PDF;
use App\Especialidad;
use App\Fiscalia;
use App\Necropsia;
use App\NecropsiaClasificacion;
use App\Peticion;
use App\Solicitud;
use App\Unidad;
use App\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class Peticion2Controller extends Controller
{
    public function __construct(){
        set_time_limit(0);
		ini_set('memory_limit', '-1');
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_TIME, "spanish");
    }
    
    #Traits
    use TraitPeticiones;
    // use TraitEstadistica;
    use TraitFechaFormato;

    #vistas return js
    public function vista_return_select_regiones(){
        return view('peticion.vistas_return.vista_select_regiones',[
            'regiones' => Fiscalia::all(),
        ]);
    }
    public function vista_return_select_unidades(){
        return view('peticion.vistas_return.vista_select_unidades',[
            'unidades' => Unidad::where('coordinacion','si')->get(),
        ]);
    }
    #peticion_form
    Public function peticion_form($formAccion, Peticion $peticion){

        if( in_array(Auth::user()->unidad_id,[66,108] ) )
            $especialidades = Especialidad::where('id','<>',26)->get();
        else
            $especialidades = Especialidad::where('unidad_id',Auth::user()->unidad_id)->get();

        return view('peticion.peticion_form',
            [
                'peticion' => $peticion,
                'formAccion' => $formAccion,
                'fecha_hoy' => date('Y-m-d'),
                'solicitudes' => isset($peticion->id) ? Solicitud::where('especialidad_id',$peticion->solicitud->especialidad_id)->get() : null,
                'especialidades' => $especialidades,
                // 'especialidades' => $this->get_especialidades()
                'unidades' => Unidad::where('peticion','si')->get(),
                'unidades1' => Unidad::whereIn('nivel',[0,1])->where('unidad_estado','activo')->get(),
                // 'unidades2' => isset($peticion) ? Unidad::where('nivel',[0,1])->where('unidad_estado','activo')->get(),
                'unidades_apoyo' => Unidad::where('es_apoyo_necropsia',1)->get(), 
                'fiscalias' => Fiscalia::all(),
                'necropsia_clasificaciones' => NecropsiaClasificacion::all(),
                'necropsias' => isset($peticion->necropsia_id) ? Necropsia::where('necropsia_clasificacion_id',$peticion->necropsia->necropsia_clasificacion_id)->get() : null,
            ]
        );
    }
    #peticion_save
    public function peticion_save(PeticionFormRequest $request, $formAccion, Peticion $peticion){
        $this->formAccion = $formAccion;
        $this->peticion = isset($peticion->id) ? $peticion : new Peticion;

        if ($formAccion == 'clonar') $this->peticion = $this->peticion->replicate();

        if ( in_array($formAccion,['registrar','continuar']) ) {
            if ($request->peticion_etapa == 'etapa_uno') {
                $this->peticion_save_etapa_uno($request);
            }
            elseif ($request->peticion_etapa == 'etapa_dos') {
                $this->peticion_save_etapa_dos($request);
            }
            elseif ($request->peticion_etapa == 'etapa_tres') {
                $this->peticion_save_etapa_tres($request);
            }
        }
        //save_por_estado
        elseif ( in_array($formAccion,['editar','clonar']) ) {
            $this->peticion_save_etapa_uno($request);
            if ( in_array($this->peticion->estado,['atendida','entregada']))
                $this->peticion_save_etapa_dos($request);
            if ($this->peticion->estado == 'entregada')
                $this->peticion_save_etapa_tres($request);
        }

        $this->peticion->save();

        return response()->json([
            'satisfactorio' => true,
            'peticion' => $this->peticion,
            'formAccion' => $formAccion,
            'etapa' => $request->peticion_etapa,
        ]);
    }
    protected function peticion_save_etapa_uno(Request $request){
        $this->peticion->nuc = $request->nuc;
        $this->peticion->fiscalia1_id = $request->fiscalia1;
        $this->peticion->fiscalia2_id = $request->fiscalia2;
        $this->peticion->unidad_id = $request->unidad;
        $this->peticion->fecha_peticion = $request->fecha_peticion;
        $this->peticion->fecha_recepcion = $request->fecha_recepcion;
        $this->peticion->oficio_numero = $request->oficio_numero;
        $this->peticion->folio_interno = $request->folio_interno;
        $this->peticion->sp_solicita = $request->sp_solicita;
        // $this->peticion->petfiscalia_id = $request->petfiscalia;
        // $this->peticion->petadscripcion_id = $request->petadscripcion;
        $this->peticion->unidad1_id = $request->unidad1;
        $this->peticion->unidad2_id = $request->unidad2;
        $this->peticion->solicitud_id = $request->solicitud;
        //user_id
        ($request->filled('peticion_user')) ?  $this->peticion->user_id = $request->peticion_user : $this->peticion->user_id = Auth::id();
        //estado
        $this->peticion->estado == null ? $this->peticion->estado = 'pendiente' : '';
        #Si es necropsia
        //necropsia_causa
        $this->peticion->necropsia_id = in_array($request->solicitud,['61','62']) ? $request->necropsia_causa : null;
        //unidad_necropsia_es_de_apoyo
        $this->peticion->unidad3_id = $request->filled('necropsia_clasificacion') && ($request->necropsia_clasificacion == 1) && ($request->unidad_necropsia_apoyo != 'no') ? $request->unidad_necropsia_apoyo : null;
    }
    protected function peticion_save_etapa_dos(Request $request){
        $this->peticion->fecha_elaboracion = $request->fecha_elaboracion;
        $this->peticion->documento_emitido = $request->documento_emitido;
        $this->peticion->cantidad_estudios = $request->cantidad_estudios;
        //fecha_de_necro
        $this->peticion->fecha_necropsia = $request->filled('fecha_necropsia') ? $request->fecha_necropsia : null;
        //fecha_sistema
        $this->peticion->fecha_sistema == null || $this->formAccion == 'clonar' ?  $this->peticion->fecha_sistema = date('Y-m-d') : '';
        //estado
        $this->peticion->estado == 'pendiente' ? $this->peticion->estado = 'atendida' : '';
    }
    protected function peticion_save_etapa_tres(Request $request){
        $this->peticion->fecha_entrega = $request->fecha_entrega;
        $this->peticion->sp_recibe = $request->sp_recibe;
        //estado
        $this->peticion->estado == 'atendida' ? $this->peticion->estado = 'entregada' : '';
        //fecha_entrega_sistema
        $this->peticion->fecha_entrega_sistema == null || $this->formAccion == 'clonar' ?  $this->peticion->fecha_entrega_sistema = date('Y-m-d') : '';
    }
    #peticion_consultar
    public function peticion_consultar(Request $request){
        // dd($request->all());
        $this->set_modelo($request);
        $request->flash();
        return view('peticion.peticion_consultar',[
            'peticiones' => $request->filled('btn_buscar') ? $this->peticiones_consultar($request) : $this->peticiones_consultar_default(),
            'regiones' => Fiscalia::all(),
            'especialidades' => $this->get_especialidades(),
            'solicitudes' => Solicitud::all(),
        ]);
    }
    public function peticion_informacion(Peticion $peticion){
        return view('peticion.peticion_informacion',compact('peticion'));
    }
    #peticion_dia
    public function peticion_dia(Request $request){
        $this->set_modelo($request);
        $request->flash();
        return view('peticion.peticion_dia',[
            'recibidas' => $this->get_peticiones_dia($request,'recibidas'),
            'atendidas' => $this->get_peticiones_dia($request,'atendidas'),
            'rezago' => $this->get_peticiones_dia($request,'rezago'),
            'necros' => $this->get_peticiones_dia($request,'necros'),
            'regiones' => Fiscalia::all(),
            'unidades' => Unidad::where('peticion','si')->get(),
            'especialidades' => $this->get_especialidades(),
            'solicitudes' => Solicitud::all(),
            'necropsia_clasificaciones' => NecropsiaClasificacion::all(),
            'necropsias' => Necropsia::all(),
            'fecha_formato' => $this->get_fecha_formato($request->b_fecha_inicio ?? date('Y-m-d')),
        ]);
    }
    #peticion_concentrado
    public function peticion_concentrado(Request $request){
        // dd($request->all());
        $this->set_modelo($request);
        $request->flash();

        // dd( $this->get_peticiones_dia($request,'atendidas')->where('fiscalia2_id',5) );

        return view('peticion.peticion_concentrado',
            [
                // 'peticiones' => isset($peticiones) ? $peticiones->unique() : null,
                'recibidas' => $this->get_peticiones_dia($request,'recibidas'),
                'atendidas' => $this->get_peticiones_estadistica($request,'atendidas'),
                'rezago' => $this->get_peticiones_dia($request,'rezago'),
                'necros' => $this->get_peticiones_dia($request,'necros'),
                'regiones' => Fiscalia::where('id','<>',4)->get(),
                'unidades' => Unidad::where('coordinacion','si')->get(),
            ]
        );
    }
    #peticion_estadistica
    public function peticion_estadistica(Request $request){
        $this->set_modelo($request);
        $request->flash();
        return view('peticion.peticion_estadistica',
            [
                'recibidas' => $this->get_peticiones_estadistica($request,'recibidas'),
                'atendidas' => $this->get_peticiones_estadistica($request,'atendidas'),
                'pendientes' => $this->get_peticiones_estadistica($request,'pendientes'),
                'necros' => $this->get_peticiones_estadistica($request,'necros'),
                'especialidades' => $this->get_especialidades(),
                'regiones' => Fiscalia::all(),
                'unidades' => Unidad::where('peticion','si')->get(),
                'unidades_necropsias' => Unidad::where('realiza_necropsias',1)->get(), 
                'unidades_apoyo' => Unidad::where('es_apoyo_necropsia',1)->get(),
                'necropsia_clasificaciones' => NecropsiaClasificacion::all(),
                // 'necropsia_causas' => Necropsia::all(),
                'fecha_formato' => $this->get_fecha_formato($request->b_fecha_inicio ?? date('Y-m-d'),$request->b_fecha_fin),
            ]
        );
    }
    
    public function peticion_reporte(){
        return view('peticion.peticion_reporte_form');
    }

    public function peticion_reporte_pdf(Request $request){
        // $this->set_modelo($request);
        // $this->set_propiedades_metodos($request,$modelo,$modelo_id);
        #set_peticiones()
        // $this->set_peticiones_atendidas($request);
        #set_necropsias()
        // $this->set_necro_peticiones($request);

        $directorio = '';
        switch (Auth::user()->unidad_id) {
            case 1: $directorio = 'quimica_genetica'; break;
            case 2: $directorio = 'medicina_forense'; break;
            case 3: $directorio = 'criminalistica'; break;            
        }

        $request->flash();
        return PDF::loadView("peticion.reportes.{$directorio}.{$request->reporte_tipo}",[
            // 'modelo' => $modelo,
            // 'modelo_id' => $modelo_id,
            'atendidas' => $this->get_peticiones_estadistica($request,'atendidas'),
            'necros' => $this->get_peticiones_estadistica($request,'necros'),
            'necropsia_clasificaciones' => NecropsiaClasificacion::all(),
            'necropsias' => Necropsia::all(),
            // 'peticiones' => $this->peticiones,
            // 'necro_peticiones' => $this->necro_peticiones,
            'fiscalias' => Fiscalia::all(),
            'especialidades' => Especialidad::where('unidad_id',Auth::user()->unidad_id)->get(),
            // 'necropsias' => Necropsia::all(),
            // 'fecha_formato' => $this->fecha_formato,
            // 'reporte_tipo' => $request->reporte_tipo,
            // 'necropsia_clasificaciones' => NecropsiaClasificacion::all(),
            'fecha_formato' => $this->get_fecha_formato($request->b_fecha_inicio ?? date('Y-m-d'),$request->b_fecha_fin),
        ])
        ->setPaper('a4', 'landscape')
        ->stream('archivo.pdf');
    }
	#peticion_consultar_necropsias
    public function peticion_consultar_necropsias(Request $request){
        //dd($request->all());
		$this->set_modelo($request);
        $request->flash();
		//dd( $this->get_peticiones_estadistica($request,'necros') );
        return view('peticion.peticion_consultar_necropsias',[
            'necros' => $this->get_peticiones_estadistica($request,'necros'),
            'regiones' => Fiscalia::all(),
            'unidades' => Unidad::where('peticion','si')->get(),
        ]);
    }    
    #Eliminar
    public function peticion_eliminar(Request $request, Peticion $peticion){
        $peticion->delete();
        return response()->json([            
            'status' => true,
        ]);
    }
}
