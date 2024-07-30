<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConceptoTributarioRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'codigoDianConceptoTributario' => 'required',
            'nombreConceptoTributario' => 'required',
            'grupoConceptoTributario' => 'required',
            'tipoConceptoTributario' => 'required',
            'operacionConceptoTributario' => 'required',
            'operadorConceptoTributario' => 'required',
            'baseConceptoTributario' => 'required',
            'tarifaConceptoTributario' => 'required',
            'nombreDianConceptoTributario' => 'required',
            'estadoConceptoTributario' => 'required'
        ];
    }
    public function messages()
    {
        $mensaje = array();
        $mensaje["nombreConceptoTributario.required"] =  "El campo Nombre es obligatorio";
        $mensaje["codigoDianConceptoTributario.required"] =  "El campo Codigo es obligatorio";
        $mensaje["grupoConceptoTributario.required"] =  "El campo Grupo es obligatorio";
        $mensaje["tipoConceptoTributario.required"] =  "El campo Tipo de Concepto es obligatorio";
        $mensaje["operacionConceptoTributario.required"] =  "El campo Operacion es obligatorio";
        $mensaje["operadorConceptoTributario.required"] =  "El campo Operador es obligatorio";
        $mensaje["baseConceptoTributario.required"] =  "El campo Base es obligatorio";
        $mensaje["tarifaConceptoTributario.required"] =  "El campo Tarifa es obligatorio";
        $mensaje["nombreDianConceptoTributario.required"] =  "El Nombre DIAN Codigo es obligatorio";
        $mensaje["estadoConceptoTributario.required"] =  "El campo Estado es obligatorio";
        return $mensaje;
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
}
