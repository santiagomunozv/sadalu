<?php

namespace App\Repositories;

use App\Models\OpcionModel;

class OpcionRepository
{
    public static function getAllOptions()
    {
        return OpcionModel::get();
    }

    public static function getOptionsById()
    {
        return OpcionModel::All()->pluck('idOpcion');
    }

    public static function getOptionsByNombre()
    {
        return OpcionModel::All()->pluck('nombreOpcion');
    }
}
