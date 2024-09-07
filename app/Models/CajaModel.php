<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CajaModel extends Model
{
    protected $table = 'caja';
    protected $primaryKey = 'idCaja';
    protected $fillable = ['idCaja', 'nombreCaja', 'usuario_id', 'estadoCaja'];
    public $timestamps = false;
}
