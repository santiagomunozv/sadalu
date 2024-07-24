<?php

namespace App\Repositories;

use App\Models\PaisModel;

class PaisRepository
{
    public static function getAllPaises()
    {
        return PaisModel::get();
    }

    public static function getPaisesByNombreAndId()
    {
        return PaisModel::All()->pluck('nombrePais', 'idPais');
    }

    public static function getPaisesById()
    {
        return PaisModel::All()->pluck('idPais');
    }

    public static function getPaisesByNombre()
    {
        return PaisModel::All()->pluck('nombrePaises');
    }
}
