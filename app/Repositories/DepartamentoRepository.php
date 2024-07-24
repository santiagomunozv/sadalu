<?php

namespace App\Repositories;

use App\Models\DepartamentoModel;

class DepartamentoRepository
{
    public static function getAllDepartamento()
    {
        return DepartamentoModel::get();
    }

    public static function getDepartamentoByNombreAndId()
    {
        return DepartamentoModel::All()->pluck('nombreDepartamento', 'idDepartamento');
    }

    public static function getDepartamentoById()
    {
        return DepartamentoModel::All()->pluck('idDepartamento');
    }

    public static function getDepartamentoByNombre()
    {
        return DepartamentoModel::All()->pluck('nombreDepartamento');
    }
}
