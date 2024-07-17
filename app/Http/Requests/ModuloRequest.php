<?php

namespace Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuloRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreModulo' => 'required',
            'paquete_id' => 'required',
            'iconoModulo' => 'required'
        ];
    }

    public function messages()
    {
        $mensaje = array();
        $mensaje["nombreModulo.required"] =  "El campo Nombre es obligatorio";
        $mensaje["paquete_id.required"] =  "El campo Paquete es obligatorio";
        $mensaje["iconoModulo.required"] =  "El campo Icono es obligatorio";
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
