<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioCompaniaRolModel extends Model
{
    protected $table = 'usuariocompaniarol';
    protected $primaryKey = 'idUsuarioCompaniaRol';
    protected $fillable = ['usuario_id', 'compania_id', 'rol_id',];
    public $timestamps = false;

    public function compania()
    {
        return $this->hasOne('\Modules\Seguridad\Entities\CompaniaModel', 'idCompania', 'compania_id');
    }

    public function rol()
    {
        return $this->hasOne('\Modules\Seguridad\Entities\RolModel', 'idRol', 'rol_id');
    }
}
