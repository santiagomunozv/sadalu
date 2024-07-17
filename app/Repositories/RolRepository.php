<?php

namespace App\Repositories;

use App\Models\RolModel;

class RolRepository
{
    public static function getAllRol()
    {
        return RolModel::get();
    }

    public static function getRolById()
    {
        return RolModel::All()->pluck('idRol');
    }

    public static function getRolByNombre()
    {
        return RolModel::All()->pluck('nombreRol');
    }
}
