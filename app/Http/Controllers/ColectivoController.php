<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ColectivoRequest;
use App\Http\Requests\ColectivoConsultarRequest;
use App\Traits\TraitEstadistica;
use App\Traits\TraitFechaFormato;
use Auth;
use Validator;
use App\Colectivo;
use App\Delegacion;
use App\Entidad;
use App\Fiscalia;
use App\Objeto;
use App\Parentesco;
use App\Prueba;
use App\Usuario;

class ColectivoController extends Controller
{
    public function __construct(){
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_TIME, "spanish");
    }

    use TraitEstadistica;
    use TraitFechaFormato;

    #Return vistas
    //vista de objeto aportado (input, btn de eliminar)
    public function colectivo_form_objeto_aportado(Request $request, $accion){
        return view('colectivo.colectivo_form_objeto_aportado',['accion' => $accion]);
    }
	public function colectivo_form_municipio_procedencia(Request $request, Entidad $entidad){
        $delegaciones = Delegacion::where('entidad_id',$entidad->id)->get();
        // return $entidad;
        // return $delegaciones;
        return view('colectivo.colectivo_form_municipio_procedencia',['delegaciones' => $delegaciones]);
    }

    #Form (crear,editar,clonar)
    public function colectivo_form($accion,Colectivo $colectivo){
        #accion: registrar, editar, clonar
        return view('colectivo.colectivo_form',[
            'colectivo' => $colectivo,
            'fiscalias' => Fiscalia::all(),
            'entidades' => Entidad::all(),
            'delegaciones' => Delegacion::where('entidad_id',16)->get(),
            'pruebas' => Prueba::all(),
            'parentescos' => Parentesco::all(),
            'accion' => $accion,
        ]);  
    }
    //guardar
    public function colectivo_save(ColectivoRequest $request, $accion, Colectivo $colectivo){
         // return response()->json([
             // 'request' => $request->all(),
             // //'route' => $request->route('accion'),
             // 'accion' => $accion,
             // 'colectivo' => $colectivo,
         // ]);

        #accion: registrar, editar, clonar, validar, entregar
        $this->formAccion = $accion;

        if( in_array($this->formAccion, ['registrar','clonar']) ) $this->colectivo_save_registrar_clonar($request,$colectivo);
        elseif ($accion == 'validar') $this->colectivo_save_validar($request, $colectivo);
        elseif ($accion == 'entregar')$this->colectivo_save_entregar($request, $colectivo);
        elseif ($accion == 'editar') $this->colectivo_save_editar($request, $colectivo);

        return response()->json([
            'accion' => $accion
        ]);
    }
    private function colectivo_save_registrar_clonar(Request $request, Colectivo $colectivo){
        if ( in_array($this->formAccion, ['registrar','clonar']) ) $colectivo = new Colectivo;

        $colectivo->colectivo_donante                                                   = $request->colectivo_donante;
        $colectivo->colectivo_fecha                                                     = $request->colectivo_fecha;
        $colectivo->entidad_id                                                          = $request->filled('colectivo_procedencia_entidad') ? $request->colectivo_procedencia_entidad : null;
        $colectivo->delegacion_id                                                       = $request->filled('colectivo_procedencia_municipio') ? $request->colectivo_procedencia_municipio : null;
        $colectivo->fiscalia_id                                                         = $request->colectivo_fiscalia;
        if( in_array($this->formAccion, ['registrar','clonar']) ) $colectivo->user1_id  = Auth::user()->id;
        $colectivo->save();
        /**
         * Relaciones
         */
        #objetos
        // $request_filtro_objetos = array_where($request->ausente_objeto_aportado, function ($value, $key) {
        //     return $value != null;
        // });
        // foreach ($request_filtro_objetos as $indice => $objeto_request) {
        //         $objeto = $colectivo->objetos->slice($indice,1)->first();
        //         if( is_null($objeto) )  $objeto = new Objeto;
        //         $objeto->nombre = $objeto_request;
        //         $objeto->colectivo_id = $colectivo->id;
        //         $objeto->save();
        // }
        #parentescos
        $colectivo->parentescos()->detach();
        foreach ($request->colectivo_parentesco as $i => $parentesco) {
            $colectivo->parentescos()->attach($parentesco, [
                'ausente_nombre'                => $request->ausente_nombre[$i], 
                'ausente_sexo'                  => $request->ausente_sexo[$i], 
                'ausente_fecha_nacimiento'      => $request->ausente_fecha_nacimiento[$i], 
                'ausente_edad'                  => $request->ausente_edad[$i], 
                'ausente_lugar_desaparicion'    => $request->ausente_lugar_desaparicion[$i], 
                'ausente_fecha_desaparicion'    => $request->ausente_fecha_desaparicion[$i],
                'ausente_objeto_aportado'       => implode('~',$request->ausente_objeto_aportado[$i]),
            ]);
        }
        #parentesco_otro
        if ( $colectivo->parentescos->contains('id',10) ) {
            foreach ($colectivo->parentescos->where('id',10)->values() as $i => $parentesco) {
                $colectivo->parentescos()->newPivotStatement()->where('id',$parentesco->pivot->id)->update([ 'parentesco_otro' => $request->colectivo_parentesco_otro[$i] ]);
            }
        }
        #pruebas
        $colectivo->pruebas()->sync($request->colectivo_pruebas);
        //prueba_otro
        if( $colectivo->pruebas->contains('id',5) ){
            $colectivo->pruebas()->updateExistingPivot(5, ['prueba_otro' => $request->prueba_otro]);
        }
    }
    private function colectivo_save_validar(Request $request, Colectivo $colectivo){
        $colectivo->colectivo_grupo_familiar = $request->colectivo_grupo_familiar;
        if($this->formAccion == 'validar') $colectivo->colectivo_estado = 'validada';
        $colectivo->documento_emitido = 'caravana';
        if($this->formAccion == 'validar') $colectivo->colectivo_validacion_fecha = date('Y-m-d');
        $colectivo->user2_id = $request->colectivo_perito_analiza_pruebas;
        $colectivo->save();
        //cantidad de estudios en pruebas
        foreach ($colectivo->pruebas as $i => $prueba) {
            $colectivo->pruebas()->updateExistingPivot($prueba->id, [
                'prueba_estudios' => $request->prueba_estudios[$i],
                'prueba_cim' => $request->prueba_cim[$i]
            ]);   
        }
    }
    private function colectivo_save_entregar(Request $request, Colectivo $colectivo){
        if($this->formAccion == 'entregar') $colectivo->colectivo_emision_fecha = $request->colectivo_emision_fecha;
        $colectivo->colectivo_emision_persona = $request->colectivo_emision_persona;
        if($this->formAccion == 'entregar') $colectivo->colectivo_estado = 'entregada';
        $colectivo->save();
    }
    private function colectivo_save_editar(Request $request, Colectivo $colectivo){
        if( $colectivo->colectivo_estado == 'revision' ){
            self::colectivo_save_registrar_clonar($request,$colectivo);
        }
        elseif( $colectivo->colectivo_estado == 'validada' ){
            self::colectivo_save_validar($request, $colectivo);
        }
        elseif ( $colectivo->colectivo_estado == 'entregada' ) {
            if ( $colectivo->colectivo_validacion_fecha == date('Y-m-d') ) {
                self::colectivo_save_validar($request, $colectivo);
                self::colectivo_save_entregar($request, $colectivo);
            }else{
                self::colectivo_save_entregar($request, $colectivo);
            }
        }

    }
    /*CONSULTAR*/
    private function validar_consultar(Request $request){
        $mensajes = [
            'buscar_colectivo_fecha.required_without' => 'Indique una fecha y/o nombre del ciudadano', 
            'buscar_colectivo_fecha.before_or_equal' => 'Fecha no valida', 
            'buscar_colectivo_ciudadano.required_without' => 'Indique una fecha y/o nombre del ciudadano', 
        ];
        
        $validacion = Validator::make($request->all(),[
            'buscar_colectivo_fecha' => 'required_without:buscar_colectivo_ciudadano',
            'buscar_colectivo_ciudadano' => 'required_without:buscar_colectivo_fecha',
        ], $mensajes)
        ->sometimes('buscar_colectivo_fecha', 'before_or_equal:today', function ($input) {
            return $input->buscar_colectivo_fecha != null;
        })
        ->validate();
    }
    private function colectivo_consultar_buscar(Request $request){
        // dd($request->all());
        $this->colectivos = Colectivo::where(function($q) use($request){
                                        #usuario
                                        if (Auth::user()->tipo == 'usuario')
                                            $q->where('user1_id',Auth::user()->id);
                                        #grupo_familiar
                                        if ($request->filled('b_grupo_familiar'))
                                            $q->where('colectivo_grupo_familiar','like', "%{$request->b_grupo_familiar}%");
                                        #fiscalia
                                        if ($request->b_fiscalia > 0)
                                            $q->where('fiscalia_id', $request->b_fiscalia); 
                                        #nombre
                                        if ($request->filled('b_nombre'))
                                            $q->where(function($a) use($request){
                                                $a->where('colectivo_donante','like' , "%{$request->b_nombre}%")
                                                ->orWhereHas('parentescos',function($b) use($request){
                                                    $b->where('ausente_nombre', 'like', "%{$request->b_nombre}%");
                                                });
                                            });
                                        #fecha
                                        if ($request->filled('b_fecha_inicio')){
                                            // dd('entra');
                                            $q->when($request->filled('b_fecha_fin'), function ($a) use ($request) {
                                                    return $a->whereBetween('colectivo_fecha',[$request->b_fecha_inicio, $request->b_fecha_fin]);
                                                }, function ($a) use($request) {
                                                    return $a->where('colectivo_fecha',$request->b_fecha_inicio);
                                                });
                                        }
                                    })
                                    ->get();

                                    // dd($this->colectivos);
    }
    private function colectivo_consultar_default(){
        $this->colectivos = Colectivo::where(function($q){
            if (Auth::user()->tipo == 'usuario')
                $q->where('user1_id',Auth::user()->id);
        })
        // ->orderBy('created_at','desc')
        ->latest()
        // ->first()
        
        ->take(5)
        ->get();

        // $this->colectivos = $this->colectivos->sortByDesc('created_at');
    }
    public function colectivo_consultar(Request $request, $colectivo_estado=0){
        if($request->filled('btn_colectivo_consultar')){
            // self::validar_consultar($request);
            self::colectivo_consultar_buscar($request);
        }
        else{
            self::colectivo_consultar_default();
        }
        $request->flash();
        return view('colectivo.colectivo_consultar',[
            'colectivos' => $this->colectivos,
            'colectivo_estado' => $colectivo_estado,
            'fiscalias' => Fiscalia::all(),
            'pruebas' => Prueba::all(),
        ]);
    }

    

    /**
     * Alta en Unidad de Quimica y Genetica
     */
    public function colectivo_validar(Request $request){
        $colectivos = Colectivo::latest()->take(20)->get();
        return view('colectivo.colectivo_consultar',[
            'colectivos' => $colectivos,
            'accion' => 'validar',
        ]);
    }

    public function colectivo_parentesco_modal(Colectivo $colectivo){
        return view('colectivo.colectivo_parentesco_modal',compact('colectivo'));
    }

    /**
     * Grupo familiar
     */
    public function colectivo_modal_grupo_familiar(Colectivo $colectivo){
        return view('colectivo.colectivo_grupo_familiar_modal',['colectivo' => $colectivo]);
    }
    public function colectivo_grupo_familiar_save(Request $request){
        //verificamos que si la variable colectivo_id es un array de id's
        if ( is_array($request->colectivo_id) ) {//llega desde el match
            Colectivo::whereIn('id',$request->colectivo_id)->update(['colectivo_grupo_familiar' => $request->colectivo_grupo_familiar]);
        }else{//llega desde el modal form grupo familiar
            $colectivo = Colectivo::find($request->colectivo_id);
            $colectivo->colectivo_grupo_familiar = $request->colectivo_grupo_familiar;
            $colectivo->save();
        }
        
        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * coincidencia de registros
     */
    public function colectivo_match(Colectivo $colectivo){
        // #ausente_nombre vs ausente_nombre
        $c1 = Colectivo::whereHas('parentescos',function($q) use($colectivo){
                foreach ($colectivo->parentescos as $i => $parentesco) {
                    $q->where('ausente_nombre','like',"%{$parentesco->pivot->ausente_nombre}%");
                }
            })->where('id','<>',$colectivo->id);
        #colectivo_donante vs ausente_nombre
        $c2 = Colectivo::whereHas('parentescos', function($q) use($colectivo){
                $q->where('ausente_nombre','like',"%{$colectivo->colectivo_donante}%");
            })->where('id','<>',$colectivo->id)->union($c1);
        #colectivo_donante vs colectivo_donante
        $colectivos = Colectivo::where('colectivo_donante','like',"%{$colectivo->colectivo_donante}%")
            ->where('id','<>',$colectivo->id)->union($c2)->get()->unique('id');
        
        return view('colectivo.colectivo_match',[
            'colectivo' => $colectivo,
            'colectivos' => $colectivos,
        ]);
    }

    /**
     * etapa
     */
    public static function colectivo_etapa(Colectivo $colectivo){
        // $colectivo = Colectivo::find($colectivo_id);
        $colectivo_etapa_collection = collect(['url' => '', 'mensaje' => '']);
        if ($colectivo->colectivo_estado == 'revision') {
            $colectivo_etapa_collection->url = route('colectivo_form',['accion' => 'validar', 'colectivo' => $colectivo]);
            $colectivo_etapa_collection->mensaje = 'Validar';
        }elseif ( $colectivo->colectivo_emision_fecha ){
            $colectivo_etapa_collection->url = '';
            $colectivo_etapa_collection->mensaje = 'CONCLUSA';
        }
        elseif ($colectivo->colectivo_estado == 'validada') {
            $colectivo_etapa_collection->url = route('colectivo_form',['accion' => 'entregar', 'colectivo' => $colectivo]);
            $colectivo_etapa_collection->mensaje = 'Entregar';
        }
        // $colectivo_etapa_collection->save();
        return $colectivo_etapa_collection;
    }
    /*ELIMINAR*/
    public function colectivo_eliminar(Request $request, Colectivo $colectivo){
        $colectivo->parentescos()->detach();
        $colectivo->pruebas ()->detach();
        $colectivo->delete();
        return response()->json([            
            'status' => true,
        ]);
    }


    /*ESTADISTICA*/
    public function colectivo_estadistica(Request $request, $modelo, $modelo_id=null){
        /*** $modelo -> deber ser user, unidad o fiscalia */
        #set_modelo
        $this->modelo = $request->filled('b_modelo') ? $request->b_modelo : $modelo;
        #set_modelo_id
        $this->modelo_id = isset($modelo_id) ? $modelo_id : ($request->filled('b_modelo_id') ? $request->b_modelo_id : null);
        $this->fecha_hoy = date('Y-m-d');
        $this->set_modelo();
        #set_fecha_formato
        $request->filled('b_fecha_fin') ? $this->set_fecha_formato($request->b_fecha_inicio, $request->b_fecha_fin) : ( $request->filled('b_fecha_inicio') ? $this->set_fecha_formato($request->b_fecha_inicio) : $this->set_fecha_formato($this->fecha_hoy) );
        $this->set_colectivos($request);

        $request->flash();
        // dd($this->fecha_hoy);
        return view('colectivo.colectivo_estadistica',[
            'fecha_hoy' => $this->fecha_hoy,
            'fecha_formato' => $this->fecha_formato,
            'pruebas' => Prueba::all(),
            'colectivos' => $this->colectivos,
        ]);
    }
    public function set_colectivos(Request $request){
        $this->colectivos = Colectivo::colectivos($request)->get();
    }
}
