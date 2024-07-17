<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuloModel extends Model
{
    protected $table = 'modulo';
    protected $primaryKey = 'idModulo';
    protected $fillable = ['paquete_id', 'nombreModulo', 'iconoModulo'];

    public function opciones()
    {
        return $this->hasMany('App\OpcionModel', 'modulo_id');
    }
}
