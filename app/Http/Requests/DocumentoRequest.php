<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
{
    $validacion = [];

    $codigo = ($this->get('idDocumentoCodigo') !== null) ? count($this->get('idDocumentoCodigo')) : 0;
    for ($i = 0; $i < $codigo; $i++) {
        if(trim($this->get('codigoDocumentoCodigo')[$i]) == '' )
        {
            $validacion['codigoDocumentoCodigo'.$i] =  'required';
        }
        if(trim($this->get('etiquetaDocumentoCodigo')[$i]) == '' )
        {
            $validacion['etiquetaDocumentoCodigo'.$i] =  'required';
        }
    }

    $leyenda = ($this->get('idDocumentoLeyenda') !== null) ? count($this->get('idDocumentoLeyenda')) : 0;
    for ($j = 0; $j < $leyenda; $j++) {
        if(trim($this->get('posicionDocumentoLeyenda')[$j]) == '' )
        {
            $validacion['posicionDocumentoLeyenda'.$j] =  'required';
        }
        if(trim($this->get('mensajeDocumentoLeyenda')[$j]) == '' )
        {
            $validacion['mensajeDocumentoLeyenda'.$j] =  'required';
        }
    }

    $validacion['consecutivo_id'] = 'required';
    $validacion['tipoDocumento'] = 'required';
    $validacion['nombreDocumento'] = 'required';
    $validacion['estadoDocumento'] = 'required';
    return $validacion;
}


public function messages()
{
    $mensaje = [
        'consecutivo_id.required' => 'El campo Consecutivo es obligatorio',
        'tipoDocumento.required' => 'El campo Tipo de documento es obligatorio',
        'nombreDocumento.required' => 'El campo Nombre es obligatorio',
        'estadoDocumento.required' => 'El campo Estado es obligatorio',
    ];

    $codigo = ($this->get('idDocumentoCodigo') !== null) ? count($this->get('idDocumentoCodigo')) : 0;
    for ($i = 0; $i < $codigo; $i++) {
        $mensaje['codigoDocumentoCodigo' . $i . '.required'] = "El campo Código es obligatorio en el registro ". $i+1;
        $mensaje['etiquetaDocumentoCodigo' . $i . '.required'] = "El campo Etiqueta es obligatorio en el registro ". $i+1;
    }

    $leyenda = ($this->get('idDocumentoLeyenda') !== null) ? count($this->get('idDocumentoLeyenda')) : 0;
    for ($j = 0; $j < $leyenda; $j++) {
        $mensaje['posicionDocumentoLeyenda' . $j . '.required'] = "El campo Posición es obligatorio en el registro ". $j+1;
        $mensaje['mensajeDocumentoLeyenda' . $j . '.required'] = "El campo Mensaje es obligatorio en el registro ". $j+1;
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
