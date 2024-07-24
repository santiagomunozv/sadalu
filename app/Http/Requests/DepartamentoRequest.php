<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartamentoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreDepartamento' => 'required',
            'codigoDepartamento' => 'required',
            'pais_id' => 'required'
        ];
    }

    public function messages()
    {
        $mensaje = array();
        $mensaje["nombreDepartamento.required"] =  "El campo Nombre es obligatorio";
        $mensaje["codigoDepartamento.required"] =  "El campo Paquete es obligatorio";
        $mensaje["pais_id.required"] =  "El campo pais es obligatorio";
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
