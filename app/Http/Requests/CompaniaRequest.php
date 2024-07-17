<?php

namespace Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompaniaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreCompania' => 'required',
            'estadoCompania' => 'required',
        ];
    }
    public function messages()
    {
        $mensaje = array();
        $mensaje["nombreCompania.required"] =  "El campo Nombre es obligatorio";
        $mensaje["estadoCompania.required"] =  "El campo Estado es obligatorio";
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
