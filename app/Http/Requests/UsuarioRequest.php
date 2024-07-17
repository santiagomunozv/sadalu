<?php

namespace Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioRequest extends FormRequest
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
            'loginUsuario' => ['required', Rule::unique('usuario')->ignore($this->get('idUsuario'), 'idUsuario')],
            'password' => 'required',
            'estadoUsuario' => 'required',
            'rol_id.*' => 'required',
            'compania_id.*' => 'required',
        );
        return $validacion;
    }
    public function messages()
    {
        $mensaje = array();
        $mensaje["loginUsuario.required"] =  "El Nombre de usuario es obligatorio";
        $mensaje["loginUsuario.unique"] =  "El Nombre de usuario debe ser único";
        $mensaje["password.required"] =  "El campo Contraseña es obligatorio";
        $mensaje["estadoUsuario.required"] =  "El campo Estado es obligatorio";

        $total = ($this->get("idUsuarioCompaniaRol") !== null) ? count($this->get("idUsuarioCompaniaRol")) : 0;
        for ($j = 0; $j < $total; $j++) {
            $mensaje['rol_id.' . $j . '.required'] = "El campo Rol es obligatorio en el registro " . ($j + 1);
            $mensaje['compania_id.' . $j . '.required'] = "El campo Compañía es obligatorio en el registro " . ($j + 1);
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
