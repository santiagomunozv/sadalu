<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaisRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombrePais' => 'required',
            'codigoPais' => 'required',
        ];
    }
    public function messages()
    {
        $mensaje = array();
        $mensaje["nombrePais.required"] =  "El campo Nombre es obligatorio";
        $mensaje["codigoPais.required"] =  "El campo Codigo es obligatorio";
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