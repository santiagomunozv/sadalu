<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadMedidaModel extends Model
{
    protected $table = 'unidad_medida';
    protected $primaryKey = 'idUnidadMedida';
    protected $fillable = [
        'idUnidadMedida',
        'nombreUnidadMedida',
        'codigoDianUnidadMedida',
        'simboloUnidadMedida',
        'estadoUnidadMedida'
    ];
    public $timestamps = false;
}
