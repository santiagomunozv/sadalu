<?php

namespace App\Repositories;

use App\Models\CompaniaModel;

class CompaniaRepository
{
    public static function getAllCompania()
    {
        return CompaniaModel::get();
    }

    public static function getCompaniaById()
    {
        return CompaniaModel::All()->pluck('idCompania');
    }

    public static function getCompaniaByNombre()
    {
        return CompaniaModel::All()->pluck('nombreCompania');
    }
}
