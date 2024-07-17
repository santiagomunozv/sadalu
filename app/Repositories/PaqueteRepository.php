<?php

namespace App\Repositories;

use App\Models\PaqueteModel;

class PaqueteRepository
{
    public static function getAllPaquetes()
    {
        return PaqueteModel::get();
    }

    public static function getPaquetesByNombreAndId()
    {
        return PaqueteModel::All()->pluck('nombrePaquete', 'idPaquete');
    }

    public static function getPaquetesById()
    {
        return PaqueteModel::All()->pluck('idPaquete');
    }

    public static function getPaquetesByNombre()
    {
        return PaqueteModel::All()->pluck('nombrePaquete');
    }
}
