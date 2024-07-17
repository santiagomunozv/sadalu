<?php

namespace Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaqueteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'ordenPaquete' => ['required', Rule::unique('paquete')->ignore($this->get('idPaquete'), 'idPaquete')],
            'nombrePaquete' => 'required',
            'iconoPaquete' => 'required'
        ];
    }

    public function messages()
    {
        $mensaje = array();
        $mensaje["ordenPaquete.required"] =  "El campo Orden es obligatorio";
        $mensaje["ordenPaquete.unique"] =  "El campo Orden no se puede repetir";
        $mensaje["nombrePaquete.required"] =  "El campo Nombre es obligatorio";
        $mensaje["iconoPaquete.required"] =  "El campo Icono es obligatorio";
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
