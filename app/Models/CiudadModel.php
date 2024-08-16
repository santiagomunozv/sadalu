<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CiudadModel extends Model
{
    protected $table = 'ciudad';
    protected $primaryKey = 'idCiudad';
    protected $fillable = [
        'departamento_id',
        'codigoCiudad',
        'nombreCiudad',
    ];

    public function departamento()
    {
        return $this->hasMany('App\DepartamentoModel', 'departamento_id');
    }
}
