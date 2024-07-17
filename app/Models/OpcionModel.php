<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpcionModel extends Model
{
    protected $table = 'opcion';
    protected $primaryKey = 'idOpcion';
    protected $fillable = ['modulo_id', 'nombreOpcion', 'rutaOpcion', 'iconoOpcion'];
}
