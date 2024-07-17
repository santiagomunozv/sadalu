<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompaniaModel extends Model
{
    protected $table = 'compania';
    protected $primaryKey = 'idCompania';
    protected $fillable = ['codigoCompania', 'nombreCompania', 'estadoCompania'];
}
