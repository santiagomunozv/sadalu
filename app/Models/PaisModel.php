<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaisModel extends Model
{
    protected $table = 'pais';
    protected $primaryKey = 'idPais';
    protected $fillable = [
        'codigo',
        'nombre'
    ];
}
