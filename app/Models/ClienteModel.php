<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'idCliente';
    protected $fillable = [
        'tipo_identificacion_id',
        'identificacionCliente',
        'digitoVerificacionCliente',
        'razonSocialCliente',
        'nombreComercialCliente',
        'primerNombreCliente',
        'segundoNombreCliente',
        'primerApellidoCliente',
        'segundoApellidoCliente',
        'telefonoCliente',
        'celularCliente',
        'emailCliente',
        'ciudad_id',
        'direccionCliente',
        'codigoPostalCliente'

    ];
    public $timestamps = false;
}
