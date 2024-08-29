<?php

namespace App\Repositories;

use App\Models\UsuarioModel;

class UsuarioCajaRepository
{
    public static function getAllUsuarioCaja()
    {
        return UsuarioModel::get();
    }

    public static function getUsuarioCajaByNombreAndId()
    {
        return UsuarioModel::All()->pluck('loginUsuario', 'idUsuario');
    }

    public static function getUsuarioCajaById()
    {
        return UsuarioModel::All()->pluck('idUsuario');
    }

    public static function getUsuarioCajaByNombre()
    {
        return UsuarioModel::All()->pluck('loginUsuario');
    }
}
