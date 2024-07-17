<?php

namespace App\Repositories;

use App\Models\ModuloModel;

class ModuloRepository
{
    public static function getAllModulos()
    {
        return ModuloModel::get();
    }

    public static function getModulosById()
    {
        return ModuloModel::All()->pluck('idModulo');
    }

    public static function getModulosByNombre()
    {
        return ModuloModel::All()->pluck('nombreModulo');
    }

    public static function getModulosByNombreAndId()
    {
        return ModuloModel::All()->pluck('nombreModulo', 'idModulo');
    }
}
