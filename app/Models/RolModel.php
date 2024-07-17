<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolModel extends Model
{
    protected $table = 'rol';
    protected $primaryKey = 'idRol';
    protected $fillable = ['codigoRol', 'nombreRol'];
}
