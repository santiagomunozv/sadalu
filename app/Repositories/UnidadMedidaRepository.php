<?php

namespace App\Repositories;

use App\Models\UnidadMedidaModel;

class UnidadMedidaRepository
{
    public static function getAllUnidadMedida()
    {
        return UnidadMedidaModel::get();
    }

    public static function getUnidadMedidaByNombreAndId()
    {
        return UnidadMedidaModel::All()->pluck('nombreUnidadMedida', 'idUnidadMedida');
    }

    public static function getUnidadMedidaById()
    {
        return UnidadMedidaModel::All()->pluck('idUnidadMedida');
    }

    public static function getUnidadMedidaByNombre()
    {
        return UnidadMedidaModel::All()->pluck('nombreUnidadMedida');
    }
}
