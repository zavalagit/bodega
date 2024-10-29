<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class PeticionFormRequest extends FormRequest
{
    private $formAccion;
    private $peticion;
    private $pendiente = 0, $atendida = 0, $entregada = 0; //peticion_estado
    private $etapa; //peticion_etapa
    private $reglas;

    public function __construct()
    {
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set('America/Mexico_City');
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    private function reglas_por_etapa(){        
        return $this->reglas[$this->etapa];
    }
    private function reglas_en_conjunto(){
        if ( $this->pendiente ) {
            return $this->reglas['etapa_uno'];
        }
        elseif ( $this->atendida ) {
            return array_collapse( array_except($this->reglas,['etapa_tres']) );
        }
        elseif ( $this->entregada ){
            return array_collapse( $this->reglas );
        }
    }
    private function set_parametros(){
        $this->formAccion = $this->route('formAccion');
        $this->peticion = $this->route('peticion');
        $this->etapa = $this->request->get('peticion_etapa');
    }
    private function set_reglas(){
        $this->reglas = [
            'etapa_uno' => [
                'nuc' => 'required',
                'fiscalia1' => 'required',
                'fiscalia2' => 'required',
                'fecha_peticion' => 'required|date|before_or_equal:today',
                'fecha_recepcion' => 'required|date|after_or_equal:fecha_peticion|before_or_equal:today',
                'oficio_numero' => 'required',
                'sp_solicita' => 'required',
                // 'petfiscalia' => 'required',
                'unidad1' => 'required',
                'especialidad' => 'required',
                'solicitud' => 'required',
                'necropsia_clasificacion' => 'required_if:solicitud,61,62',
                'necropsia_causa' => 'required_with:necropsia_clasificacion',
                'unidad_necropsia_apoyo' => 'required_if:necropsia_clasificacion,1',
                // 'necropsia_pertenece' => in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_unidad']) ? 'required_if:necropsia_apoyo,no' : 'nullable',
                'peticion_user' => in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_unidad','coordinador_peticiones_unidad']) ? 'required' : 'nullable',
            ],
            'etapa_dos' => [
                'fecha_elaboracion' => 'required|date|after_or_equal:fecha_recepcion|before_or_equal:today',
                //'fecha_necropsia' => 'nullable|required_if:solicitud,61,62|date|' . ( Auth::user()->tipo != 'administrador_peticiones' ? 'after_or_equal:yesterday|' : '') . 'before_or_equal:today',
				'fecha_necropsia' => 'nullable|required_if:solicitud,61,62|date|before_or_equal:today',
                'documento_emitido' => 'required',
                'cantidad_estudios' => 'required|numeric|min:0',
            ],
            'etapa_tres' => [            
                'fecha_entrega' => 'required|date|after_or_equal:fecha_elaboracion|before_or_equal:today',
                'sp_recibe' => 'required',
            ],
        ];
    }
    private function set_estado(){
        $this->pendiente = $this->peticion->estado == 'pendiente' ? 1 : 0;
        $this->atendida = $this->peticion->estado == 'atendida' ? 1 : 0;
        $this->entregada = $this->peticion->estado == 'entregada' ? 1 : 0;
    }

    public function rules()
    {
        $this->set_parametros();
        $this->set_reglas();
        

        if ( in_array($this->formAccion,['registrar','continuar']) ) {      
            $reglas = $this->reglas_por_etapa();
            // if( ($this->etapa == 'etapa_dos') && ( in_array($this->request->get('solicitud'),['61','62']) ) ){
            //     $reglas['fecha_necropsia'] = 'required_if:solicitud,61,62|date|before_or_equal:fecha_elaboracion';
            // }
        }
        elseif ( in_array($this->formAccion,['editar','clonar']) ){
            $this->set_estado();
            $reglas = $this->reglas_en_conjunto();
        }
        
        return $reglas;

    }
    /**
     *  mensaje de error por cada atributo y por cada regla de validación que no fue aprobada.
     */
    public function messages(){
        return [        
            'nuc.required' => 'Indique el N.U.C.',
            'fiscalia1.required' => 'Indique la Región 1',
            // 'colectivo_fecha.required_unless' => 'El campo "fecha de muestreo" es requerido.',
            // 'colectivo_donante.required_unless' => 'El campo "nombre de la persona u objeto a la que se le realizó el muestreo" es requerido.',
            // 'colectivo_procedencia_entidad.required_unless' => 'Indique la entidad federativa de procedencia.',
            // 'colectivo_procedencia_municipio.required_if' => 'Indique el municipio de procedencia.',
            // 'ausente_nombre.*.required_unless' => 'El campo "nombre de la persona desaparecida" es requerido',
            // 'ausente_sexo.*.required_unless' => 'Indique el "sexo" de la persona desaparecida',
            // 'colectivo_parentesco.*.required_unless' => 'El campo "parentesco" es requerido',
            // 'colectivo_parentesco_otro.*.required_if' => 'Indique el "otro parentesco".',
            // 'colectivo_pruebas.required_unless' => 'Indique las "Pruebas" realizadas.',
            // //validar
            // // 'colectivo_grupo_familiar.required_if' => 'El campo "Grupo familiar" es requerido.',
            // 'colectivo_perito_analiza_pruebas.required_if' => 'Indique al Perito químico que analizó las pruebas',
            // 'prueba_cim.*.required_if' => 'El campo "CIM" es requerido',
            // 'prueba_estudios.*.required_if' => 'La "cantidad de estudios" para cada muestra seleccionada es requerida.',
            // 'prueba_estudios.*.min' => 'La "cantidad de estudios" para cada muestra seleccionada no puede ser 0.',
            // //entregar
            // 'colectivo_emision_fecha.required_if' => 'El campo "fecha de entrega" es requerido.',
            // 'colectivo_emision_persona.required_if' => 'Indique el nombre de la persona a quién se le entrega.',
            'fecha_necropsia.after_or_equal' => 'La fecha de reporte de necropsia solo puede ser con fecha de ayer o hoy'
        ];
    }
}
