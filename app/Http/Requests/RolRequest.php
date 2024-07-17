<?php

namespace Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     *
     */
    public function rules()
    {
        $validacion = array(
            'nombreRol' => 'required',
            'estadoRol' => 'required',
            'opcion_id.*' => 'required',
        );
        return $validacion;
    }
    public function messages()
    {
        $mensaje = array();
        $mensaje["nombreRol.required"] =  "El campo Nombre es obligatorio";
        $mensaje["estadoRol.required"] =  "El campo Estado es obligatorio";

        $total = ($this->get("idRolOpcion") !== null) ? count($this->get("idRolOpcion")) : 0;
        for ($j = 0; $j < $total; $j++) {
            $mensaje['opcion_id.' . $j . '.required'] = "El campo Opción es obligatorio en el registro " . ($j + 1);
        }
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
