<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedioPagoModel extends Model
{
    protected $table = 'medio_pago';
    protected $primaryKey = 'idMedioPago';
    protected $fillable = [
        'idMedioPago',
        'codigoDianMedioPago',
        'nombreMedioPago',
        'estadoMedioPago',

    ];
    public $timestamps = false;
}
