<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoIdentificacionModel extends Model
{
    protected $table = 'tipo_identificacion';
    protected $primaryKey = 'idTipoIdentificacion';
    protected $fillable = [
        'idTipoIdentificacion',
        'codigoDianTipoIdentificacion',
        'nombreTipoIdentificacion',
        'estadoTipoIdentificacion',
        'requiereDigitoVerificationTipoIdentificacion',
        'requiereRazonSocialTipoIdentificacion'

    ];
    public $timestamps = false;
}
