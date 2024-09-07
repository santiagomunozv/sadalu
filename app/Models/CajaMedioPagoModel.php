<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CajaMedioPagoModel extends Model
{
    protected $table = 'caja_medio_pago';
    protected $primaryKey = 'idCajaMedioPago';
    protected $fillable = ['caja_id', 'mediopago_id'];
    public function medioPago()
    {
        return $this->belongsTo(MedioPagoModel::class, 'idMedioPago', 'idMedioPago');
    }
}
