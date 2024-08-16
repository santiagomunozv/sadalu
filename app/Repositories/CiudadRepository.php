<?php

namespace App\Repositories;

use App\Models\CiudadModel;

class CiudadRepository
{
    public static function getAllCiudad()
    {
        return CiudadModel::get();
    }

    public static function getCiudadByNombreAndId()
    {
        return CiudadModel::All()->pluck('nombreCiudad', 'idCiudad');
    }

    public static function getCiudadById()
    {
        return CiudadModel::All()->pluck('idCiudad');
    }

    public static function getCiudadByNombre()
    {
        return CiudadModel::All()->pluck('nombreCiudad');
    }
}
