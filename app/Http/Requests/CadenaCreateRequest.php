<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadenaCreateRequest extends FormRequest
{
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
    public function rules()
    {
        $reglas = [
            'nuc' => 'required|min:13',
            'unidad' => 'required',
            'intervencion_lugar' => 'required',
            'intervencion_hora' => 'required',
            'intervencion_fecha' => 'required|date|before_or_equal:today',
            'motivo' => 'required',
            //1. Identidad
            'identificador.*' => 'required',
            'descripcion.*' => 'required',
            'ubicacion.*' => 'required',
            'recoleccion_hora.*' => 'required',
            'recoleccion_fecha.*' => 'required|after_or_equal:fecha_peticion|before_or_equal:today',
            //2. Documentación
            'escrito' => 'required',
            'fotografico' => 'required',
            'croquis' => 'required',
            'otro' => 'required',
            //3. Recoleccion
            //5. servidores publicos
            'etapa.*' => 'required',
            //6. Traslado
            'traslado' => 'required',
            'trasladoCondiciones' => 'required',
            //Anexo 4
            'embalaje' => 'required',
        ];

        $intervencion_fecha = $this->request->get('intervencion_fecha'); // Get the input value
        if($intervencion_fecha == date('Y-m-d')){
            $reglas['intervencion_hora'] = "required|before_or_equal:".date('H:i:s');
        }

        return $reglas;

        /**
         * 'intervencion_lugar' => 'required',
         * 'intervencion_hora' => 'required',
         * 'ubicacion.*' => 'required',
         * 'recolectado_de.*' => 'required',
         * 'recoleccion_hora.*' => 'required',
         * 
         * no required cuando es perito quimico
         */
    }

    /**
     *  mensaje de error por cada atributo y por cada regla de validación que no fue aprobada.
     * 
     */
    public function messages(){
        return [
            'nuc.required' => 'El campo "NUC" es requerido.',
            'nuc.min' => 'El campo "NUC" debe contener al menos 13 caracteres.',
            'unidad.required' => 'El campo "UNIDAD" es requerido.',
            'intervencion_lugar.required' => 'El campo "LUGAR DE INTERVENCIÓN" es requerido.',
            'intervencion_hora.required' => 'El campo "HORA DE INTERVENCIÓN" es requerido.',
            'intervencion_fecha.required' => 'El campo "FECHA DE INTERVENCIÓN" es requerido.',
            'reingreso_fecha.before_or_equal' => 'La "FECHA DE INTERVENCIÓN" debe ser menor o igual a '.date('d-m-Y').'.',
            'motivo.required' => 'El campo "MOTIVO DEL REGISTRO" es requerido.',
            'identificador.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "IDENTIFICADOR" es requerido.',
            'descripcion.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "DESCRIPCIÓN" es requerido.',
            'ubicacion.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "UBICACIÓN DEL LUGAR" es requerido.',
            'recoleccion_hora.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "HORA DE RECOLECCIÓN" es requerido.',
            'recoleccion_fecha.*.required' => 'Verifique el apartado "1. IDENTIDAD" el campo "FECHA DE RECOLECCIÓN" es requerido.',
            'escrito.required' => 'Verifique el apartado "2. DOCUMENTACIÓN" el campo "ESCRITO" es requerido.',
            'fotografico.required' => 'Verifique el apartado "2. DOCUMENTACIÓN" el campo "FOTOGRÁFICO" es requerido.',
            'croquis.required' => 'Verifique el apartado "2. DOCUMENTACIÓN" el campo "CROQUIS" es requerido.',
            'otro.required' => 'Verifique el apartado "2. DOCUMENTACIÓN" el campo "OTRO" es requerido.',
            'etapa.*.required' => 'Verifique el apartado "5. SERVIDORES PÚBLICOS" el campo "ETAPA" es requerido.',
            'traslado.required' => 'Verifique el apartado "6. TRASLADO" el campo "VÍA" es requerido.',
            'trasladoCondiciones.required' => 'Verifique el apartado "6. TRASLADO" el campo "CONDICIONES DEL TRASLADO" es requerido.',
            'embalaje.required' => 'Verifique el apartado "ANEXO 4".',
        ];
    }
}
