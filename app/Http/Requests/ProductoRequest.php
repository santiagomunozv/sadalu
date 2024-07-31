<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreProducto' => 'required',
            'codigoProducto' => 'required',
            'eanProducto' => 'required',
            'estadoProducto' => 'required',
            'marca_id' => 'required',
            'tipoproducto_id' => 'required',
            'unidadmedida_id' => 'required'
        ];
    }

    public function messages()
    {
        $mensaje = array();
        $mensaje["nombreProducto.required"] =  "El campo Nombre es obligatorio";
        $mensaje["codigoProducto.required"] =  "El campo Codigo es obligatorio";
        $mensaje["eanProducto.required"] =  "El campo EAN es obligatorio";
        $mensaje["estadoProducto.required"] =  "El campo Estado es obligatorio";
        $mensaje["marca_id.required"] =  "El campo Marca es obligatorio";
        $mensaje["tipoproducto_id.required"] =  "El campo Tipo Producto es obligatorio";
        $mensaje["unidadmedida_id.required"] =  "El campo Unidad de Medida es obligatorio";
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
