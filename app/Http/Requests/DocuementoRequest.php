<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocuementoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'consecutivo_id' => 'required',
            'tipoDocumento' => 'required',
            'nombreDocumento' => 'required'
        ];
    }

    public function messages()
    {
        $mensaje = array();
        $mensaje["consecutivo_id.required"] =  "El campo Consecutivo es obligatorio";
        $mensaje["tipoDocumento.required"] =  "El campo Tipo de docuemento es obligatorio";
        $mensaje["nombreDocumento.required"] =  "El campo Nombre es obligatorio";
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
