<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadMedidaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreUnidadMedida' => 'required',
            'codigoDianUnidadMedida' => 'required',
            'simboloUnidadMedida' => 'required',
            'estadoUnidadMedida' => 'required',
        ];
    }
    public function messages()
    {
        $mensaje = array();
        $mensaje["nombreUnidadMedida.required"] =  "El campo Nombre es obligatorio";
        $mensaje["codigoDianUnidadMedida.required"] =  "El campo Codigo es obligatorio";
        $mensaje["simboloUnidadMedida.required"] =  "El campo Simbolo es obligatorio";
        $mensaje["estadoUnidadMedida.required"] =  "El campo Estado es obligatorio";
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
