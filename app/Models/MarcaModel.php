<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarcaModel extends Model
{
    protected $table = 'marca';
    protected $primaryKey = 'idMarca';
    protected $fillable = [
        'idMarca',
        'nombreMarca',
        'estadoMarca'
    ];
    public $timestamps = false;
}
