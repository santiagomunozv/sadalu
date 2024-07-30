<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedioPagoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreMedioPago' => 'required',
            'estadoMedioPago' => 'required',
            'codigoDianMedioPago' => 'required'
        ];
    }
    public function messages()
    {
        $mensaje = array();
        $mensaje["nombreMedioPago.required"] =  "El campo Nombre es obligatorio";
        $mensaje["estadoMedioPago.required"] =  "El campo Estado es obligatorio";
        $mensaje["codigoDianMedioPago.required"] =  "El campo Codigo es obligatorio";
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
