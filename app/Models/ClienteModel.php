<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'idCliente';
    protected $fillable = [
        'tipoidentificacion_id',
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
    public function tipo_identificacion()
    {
        return $this->hasMany('App\TipoIdentificacionModel', 'tipoidentificacion_id');
    }
    public function CiudadModel()
    {
        return $this->hasMany('App\CiudadModel', 'ciudad_id');
    }
    public $timestamps = false;
}
