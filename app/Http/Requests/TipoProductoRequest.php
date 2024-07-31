<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoProductoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreTipoProducto' => 'required',
            'estadoTipoProducto' => 'required',
        ];
    }
    public function messages()
    {
        $mensaje = array();
        $mensaje["nombreTipoProducto.required"] =  "El campo Nombre es obligatorio";
        $mensaje["estadoTipoProducto.required"] =  "El campo Estado es obligatorio";
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
