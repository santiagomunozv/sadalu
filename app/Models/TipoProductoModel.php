<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProductoModel extends Model
{
    protected $table = 'tipo_producto';
    protected $primaryKey = 'idTipoProducto';
    protected $fillable = [
        'idTipoProducto',
        'nombreTipoProducto',
        'estadoTipoProducto'
    ];
    public $timestamps = false;
}
