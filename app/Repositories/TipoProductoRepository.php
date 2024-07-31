<?php

namespace App\Repositories;

use App\Models\TipoProductoModel;

class TipoProductoRepository
{
    public static function getAllTipoProducto()
    {
        return TipoProductoModel::get();
    }

    public static function getTipoProductoByNombreAndId()
    {
        return TipoProductoModel::All()->pluck('nombreTipoProducto', 'idTipoProducto');
    }

    public static function getTipoProductoById()
    {
        return TipoProductoModel::All()->pluck('idTipoProducto');
    }

    public static function getTipoProductoByNombre()
    {
        return TipoProductoModel::All()->pluck('nombreTipoProducto');
    }
}
