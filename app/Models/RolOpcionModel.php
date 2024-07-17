<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolOpcionModel extends Model
{
    protected $table = 'rolopcion';
    protected $primaryKey = 'idRolOpcion';
    protected $fillable = ['rol_id', 'opcion_id', 'adicionarRolOpcion', 'modificarRolOpcion', 'eliminarRolOpcion', 'consultarRolOpcion', 'inactivarRolOpcion'];
    public $timestamps = false;

    public function opcion()
    {
        return $this->hasOne('\Modules\Seguridad\Entities\OpcionModel', 'idOpcion', 'opcion_id');
    }
}
