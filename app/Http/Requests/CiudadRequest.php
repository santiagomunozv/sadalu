<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CiudadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreCiudad' => 'required',
            'codigoCiudad' => 'required',
            'departamento_id' => 'required'
        ];
    }

    public function messages()
    {
        $mensaje = array();
        $mensaje["nombreCiudad.required"] =  "El campo Nombre es obligatorio";
        $mensaje["codigoCiudad.required"] =  "El campo Paquete es obligatorio";
        $mensaje["departamento_id.required"] =  "El campo Departamento es obligatorio";
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
