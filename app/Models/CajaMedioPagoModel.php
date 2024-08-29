<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CajaMedioPagoModel extends Model
{
    protected $table = 'cajamediopago';
    protected $primaryKey = 'idCajaMedioPago';
    protected $fillable = ['caja_id', 'mediopago_id'];
}
