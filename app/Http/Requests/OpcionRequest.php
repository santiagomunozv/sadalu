<?php

namespace Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OpcionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreOpcion' => ['required', Rule::unique('opcion')->ignore($this->get('idOpcion'), 'idOpcion')],
            'rutaOpcion' => 'required',
            'modulo_id' => 'required'
        ];
    }

    public function messages()
    {
        $mensaje = array();
        $mensaje["nombreOpcion.required"] =  "El campo Nombre es obligatorio";
        $mensaje["nombreOpcion.unique"] =  "El nombre de la opción ya existe";
        $mensaje["rutaOpcion.required"] =  "El campo Paquete es obligatorio";
        $mensaje["modulo_id.required"] =  "El campo Modulo es obligatorio";
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
