<?php

namespace Database\Seeders\seguridad;

use App\Models\PaqueteModel;
use Illuminate\Database\Seeder;

class SeguridadPaqueteSeeder extends Seeder
{

    public function run()
    {
        $items = [
            ['idPaquete' => 1, 'ordenPaquete' => 1, 'nombrePaquete' => 'Seguridad', 'iconoPaquete' => 'fa fa-user-lock'],
            ['idPaquete' => 2, 'ordenPaquete' => 2, 'nombrePaquete' => 'Maestros', 'iconoPaquete' => 'fa fa-folder-open'],
            ['idPaquete' => 3, 'ordenPaquete' => 3, 'nombrePaquete' => 'Movimientos', 'iconoPaquete' => 'fa fa-folder-open'],

        ];

        foreach ($items as $item) {
            PaqueteModel::updateOrCreate(['idPaquete' => $item['idPaquete']], $item);
        }
    }
}
