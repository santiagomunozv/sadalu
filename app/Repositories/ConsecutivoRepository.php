<?php

namespace App\Repositories;

use App\Models\ConsecutivoModel;

class ConsecutivoRepository
{
    public static function getAllConsecutivo()
    {
        return ConsecutivoModel::get();
    }

    public static function getConsecutivoByNombreAndId()
    {
        return ConsecutivoModel::All()->pluck('nombreConsecutivo', 'idConsecutivo');
    }

    public static function getConsecutivoById()
    {
        return ConsecutivoModel::All()->pluck('idConsecutivo');
    }

    public static function getConsecutivoByNombre()
    {
        return ConsecutivoModel::All()->pluck('nombreConsecutivo');
    }
}
