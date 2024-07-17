<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CiudadModel extends Model
{
    protected $table = 'ciudad';
    protected $primaryKey = 'idCiudad';
    protected $fillable = [
        'codigo',
        'nombre',
        'departamento_id'
    ];

    public function departamento()
    {
        return $this->hasMany('App\DepartamentoModel', 'departamento_id');
    }
}
