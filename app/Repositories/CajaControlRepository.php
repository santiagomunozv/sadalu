<?php

namespace App\Repositories;

use App\Models\CajaModel;

class CajaControlRepository
{
    public static function getAllCajaControl()
    {
        return CajaModel::get();
    }

    public static function getCajaControlByNombreAndId()
    {
        return CajaModel::All()->pluck('loginUsuario', 'idUsuario');
    }

    public static function getUsuarioCajaById()
    {
        return CajaModel::All()->pluck('idUsuario');
    }

    public static function getUsuarioCajaByNombre()
    {
        return CajaModel::All()->pluck('loginUsuario');
    }
}
