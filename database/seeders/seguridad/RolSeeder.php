<?php

namespace Database\Seeders\seguridad;

use App\Models\RolModel;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    public function run()
    {
        $items = [
            ['idRol' => 1, 'nombreRol' => 'Administrador', 'estadoRol' => 'Activo'],
        ];

        foreach ($items as $item) {
            RolModel::updateOrCreate(['idRol' => $item['idRol']], $item);
        }
    }
}
