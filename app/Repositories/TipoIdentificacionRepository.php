<?php

namespace App\Repositories;

use App\Models\TipoIdentificacionModel;

class TipoIdentificacionRepository
{
    public static function getAllTipoIdentificacion()
    {
        return TipoIdentificacionModel::get();
    }

    public static function getTipoIdentificacionByNombreAndId()
    {
        return TipoIdentificacionModel::All()->pluck('nombreTipoIdentificacion', 'idTipoIdentificacion');
    }

    public static function getTipoIdentificacionById()
    {
        return TipoIdentificacionModel::All()->pluck('idTipoIdentificacion');
    }

    public static function getTipoIdentificacionByNombre()
    {
        return TipoIdentificacionModel::All()->pluck('nombreTipoIdentificacion');
    }
}
