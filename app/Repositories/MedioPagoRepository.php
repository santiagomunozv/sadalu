<?php

namespace App\Repositories;

use App\Models\MedioPagoModel;

class MedioPagoRepository
{
    public static function getAllMedioPago()
    {
        return MedioPagoModel::get();
    }

    public static function getMedioPagoById()
    {
        return MedioPagoModel::All()->pluck('idMedioPago');
    }

    public static function getMedioPagoByNombre()
    {
        return MedioPagoModel::All()->pluck('nombreMedioPago');
    }
}
