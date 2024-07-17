<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaqueteModel extends Model
{
    protected $table = 'paquete';
    protected $primaryKey = 'idPaquete';
    protected $fillable = ['ordenPaquete', 'nombrePaquete', 'iconoPaquete'];

    public function modulos()
    {
        return $this->hasMany('App\ModuloModel', 'paquete_id');
    }
}
