<?php

namespace App\Repositories;

use App\Models\CompaniaModel;

class UsuarioRepository
{
    public static function listSelect($orId = 0)
    {
        return CompaniaModel::where('estado', 'Activo')
            ->orWhere('id', $orId)
            ->orderBy('nombre', 'ASC')
            ->select('nombre', 'id')
            ->pluck('nombre', 'id');
    }
}
