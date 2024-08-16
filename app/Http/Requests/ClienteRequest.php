<?php

namespace App\Http\Requests;

use App\Models\TipoIdentificacionModel;
use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
{
    $tipoIdentificacionId = $this->get('tipoidentificacion_id');

    $tipoIdentificacion = TipoIdentificacionModel::where('idTipoIdentificacion', $tipoIdentificacionId)->first();

    $validacion = [];

    if($tipoIdentificacion->requiereRazonSocialTipoIdentificacion)
    {
    $validacion = [
        'razonSocialCliente' => 'required',
        'nombreComercialCliente' => 'required'
    ];
    }else{
    $validacion = [
        'primerNombreCliente' => 'required',
        'segundoNombreCliente' => 'required',
        'primerApellidoCliente' => 'required',
        'segundoApellidoCliente' => 'required'
    ];
    }

    $validacion = [
        'tipoidentificacion_id' => 'required',
        'identificacionCliente' => 'required',
        'digitoVerificacionCliente' => 'required',
        'telefonoCliente' => 'required',
        'celularCliente' => 'required',
        'emailCliente' => 'required',
        'ciudad_id' => 'required',
        'direccionCliente' => 'required',
        'codigoPostalCliente' => 'required'
    ];
    return $validacion;
}



    public function messages()
    {
        $mensaje = array();
        $mensaje["tipoidentificacion_id.required"] =  "El campo Tipo de identificacion es obligatorio";
        $mensaje["identificacionCliente.required"] =  "El campo Identificacion es obligatorio";
        $mensaje["digitoVerificacionCliente.required"] =  "El campo DV es obligatorio";
        $mensaje["razonSocialCliente.required"] =  "El campo Razon social es obligatorio";
        $mensaje["nombreComercialCliente.required"] =  "El campo Nombre comercial es obligatorio";
        $mensaje["primerNombreCliente.required"] =  "El campo Primer nombre es obligatorio";
        $mensaje["segundoNombreCliente.required"] =  "El campo Segundo nombre es obligatorio";
        $mensaje["primerApellidoCliente.required"] =  "El campo Primer apellido es obligatorio";
        $mensaje["segundoApellidoCliente.required"] =  "El campo Segundo apellido es obligatorio";
        $mensaje["telefonoCliente.required"] =  "El campo Telefono es obligatorio";
        $mensaje["celularCliente.required"] =  "El campo Celular es obligatorio";
        $mensaje["emailCliente.required"] =  "El campo Email es obligatorio";
        $mensaje["ciudad_id.required"] =  "El campo Ciudad es obligatorio";
        $mensaje["direccionCliente.required"] =  "El campo Dirección es obligatorio";
        $mensaje["codigoPostalCliente.required"] =  "El campo Codigo postal es obligatorio";
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
