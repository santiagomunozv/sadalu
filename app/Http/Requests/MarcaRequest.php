<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreMarca' => 'required',
            'estadoMarca' => 'required',
        ];
    }
    public function messages()
    {
        $mensaje = array();
        $mensaje["nombreMarca.required"] =  "El campo Nombre es obligatorio";
        $mensaje["estadoMarca.required"] =  "El campo Estado es obligatorio";
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
