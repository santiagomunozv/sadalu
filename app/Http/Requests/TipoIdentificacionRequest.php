<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoIdentificacionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreTipoIdentificacion' => 'required',
            'codigoDianTipoIdentificacion' => 'required',
            'estadoTipoIdentificacion' => 'required',
            'requiereDigitoVerificationTipoIdentificacion' => 'required|boolean',
            'requiereRazonSocialTipoIdentificacion' => 'required|boolean'
        ];
    }

    public function messages()
    {
        $mensaje = array();
        $mensaje["nombreTipoIdentificacion.required"] =  "El campo Nombre es obligatorio";
        $mensaje["codigoDianTipoIdentificacion.required"] =  "El campo Codigo es obligatorio";
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
