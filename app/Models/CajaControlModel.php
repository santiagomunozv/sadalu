<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CajaControlModel extends Model
{
    protected $table = 'caja_control';
    protected $primaryKey = 'idCajaControl';
    protected $fillable = ['caja_id', 'fechaAperturaCajaControl', 'fechaCierreCajaControl', 'baseCajaControl', 'entregadoCajaControl', 'usuario_id'];
    public $timestamps = false;
}
