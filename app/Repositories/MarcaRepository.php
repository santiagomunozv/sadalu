<?php

namespace App\Repositories;

use App\Models\MarcaModel;

class MarcaRepository
{
    public static function getAllMarcas()
    {
        return MarcaModel::get();
    }

    public static function getMarcasByNombreAndId()
    {
        return MarcaModel::All()->pluck('nombreMarca', 'idMarca');
    }

    public static function getMarcasById()
    {
        return MarcaModel::All()->pluck('idMarca');
    }

    public static function getMarcasByNombre()
    {
        return MarcaModel::All()->pluck('nombreMarca');
    }
}
