<?php

namespace App\Http\Requests;

use App\Colectivo;
use Illuminate\Foundation\Http\FormRequest;

class ColectivoRequest extends FormRequest
{
    private $reglas = [
        'revisar_clonar' => [
            // 'colectivo_cim' => 'required_unless:colectivo_accion,validar,entregar',
            'colectivo_fiscalia' => 'required',
            'colectivo_fecha' => 'required',
            'colectivo_donante' => 'required_without:ausente_objeto_aportado.*',
            'ausente_objeto_aportado.*.*' => 'required_without:colectivo_donante',
            //'colectivo_procedencia_entidad' => 'required',
            //'colectivo_procedencia_municipio' => 'required',
            'ausente_nombre.*' => 'required',
            // 'ausente_sexo.*' => 'required',
            'colectivo_parentesco.*' => 'required',
            'colectivo_parentesco_otro.*' => 'required_if:colectivo_parentesco.*,10',
            // 'ausente_fecha_nacimiento.*' => 'required_without:ausente_edad.*',
            // 'ausente_edad.*' => 'required_without:ausente_fecha_nacimiento.*',
            'colectivo_pruebas' => 'required|array',
        ],
        'validar' => [
            // 'colectivo_grupo_familiar' => 'required_if:colectivo_accion,validar',
            'colectivo_perito_analiza_pruebas' => 'required',
            'prueba_cim.*' => 'required',
            'prueba_estudios.*' => 'required|numeric|min:0,max:100 ',
        ],
        'entregar' => [
            'colectivo_emision_fecha' => 'required',
            'colectivo_emision_persona' => 'required',
        ]
    ];

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
    public function reglas_condicionales_registrar_clonar(){
        if ( $this->request->has('colectivo_pruebas') && in_array('5',$this->request->get('colectivo_pruebas')) )
                $this->reglas['revisar_clonar']['prueba_otro'] = 'required';
    }

    public function rules()
    {
        $formAccion =  $this->route('accion');

        #registrar
        if ( in_array($formAccion,['registrar','clonar']) ) {
            self::reglas_condicionales_registrar_clonar();
            return $this->reglas['revisar_clonar'];
        }
        #validar
        elseif( $formAccion == 'validar' ) {
            return $this->reglas['validar'];
        }
        #entregar
        elseif( $formAccion == 'entregar' ){
            return $this->reglas['entregar'];
        }
        #editar
        elseif ($formAccion == 'editar') {
            $colectivo = $this->route('colectivo');

            if ( $colectivo->colectivo_estado == 'revision' ) {
                self::reglas_condicionales_registrar_clonar();
                return $this->reglas['revisar_clonar'];
            }
            elseif ( $colectivo->colectivo_estado == 'validada' ) {
                return $this->reglas['validar'];
            }
            elseif ( $colectivo->colectivo_estado == 'entregada' ) {
                if ( $colectivo->colectivo_validacion_fecha == date('Y-m-d') ) {
                    return array_merge($this->reglas['validar'],$this->reglas['entregar']);
                }else{
                    return $this->reglas['entregar'];
                }
            }
        }
        
    }
    /**
     *  mensaje de error por cada atributo y por cada regla de validación que no fue aprobada.
     * 
     */
    public function messages(){
        return [
            //registrar, editar, clonar
            // 'colectivo_cim.required_unless' => 'El campo "Control Interno de Muestra" es requerido.',
            'colectivo_fiscalia.required_unless' => 'Indique la Región en donde se realizó el muestreo.',
            'colectivo_fecha.required_unless' => 'El campo "fecha de muestreo" es requerido.',
            'colectivo_donante.required_unless' => 'El campo "nombre de la persona u objeto a la que se le realizó el muestreo" es requerido.',
            'colectivo_procedencia_entidad.required_unless' => 'Indique la entidad federativa de procedencia.',
            'colectivo_procedencia_municipio.required_if' => 'Indique el municipio de procedencia.',
            'ausente_nombre.*.required_unless' => 'El campo "nombre de la persona desaparecida" es requerido',
            'ausente_sexo.*.required_unless' => 'Indique el "sexo" de la persona desaparecida',
            'colectivo_parentesco.*.required_unless' => 'El campo "parentesco" es requerido',
            'colectivo_parentesco_otro.*.required_if' => 'Indique el "otro parentesco".',
            'colectivo_pruebas.required_unless' => 'Indique las "Pruebas" realizadas.',
            //validar
            // 'colectivo_grupo_familiar.required_if' => 'El campo "Grupo familiar" es requerido.',
            'colectivo_perito_analiza_pruebas.required_if' => 'Indique al Perito químico que analizó las pruebas',
            'prueba_cim.*.required_if' => 'El campo "CIM" es requerido',
            'prueba_estudios.*.required_if' => 'La "cantidad de estudios" para cada muestra seleccionada es requerida.',
            'prueba_estudios.*.min' => 'La "cantidad de estudios" para cada muestra seleccionada no puede ser 0.',
            //entregar
            'colectivo_emision_fecha.required_if' => 'El campo "fecha de entrega" es requerido.',
            'colectivo_emision_persona.required_if' => 'Indique el nombre de la persona a quién se le entrega.',
        ];
    }
}
