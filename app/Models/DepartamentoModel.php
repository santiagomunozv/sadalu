<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartamentoModel extends Model
{
    protected $table = 'departamento';
    protected $primaryKey = 'idDepartamento';

    protected $fillable = [
        'pais_id',
        'codigo',
        'nombre'
    ];

    public function departamento()
    {
        return $this->hasMany('App\PaisModel', 'pais_id');
    }
}
