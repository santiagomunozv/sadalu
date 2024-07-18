<?php

namespace Database\Seeders\seguridad;

use App\Models\ModuloModel;
use Illuminate\Database\Seeder;

class SeguridadModuloSeeder extends Seeder
{

    public function run()
    {
        $items = [
            ['idModulo' => 1, 'paquete_id' => 1, 'nombreModulo' => 'Menu', 'iconoModulo' => 'fa fa-user-lock'],
            ['idModulo' => 2, 'paquete_id' => 2, 'nombreModulo' => 'General ', 'iconoModulo' => 'fa fa-folder-open'],
            ['idModulo' => 3, 'paquete_id' => 2, 'nombreModulo' => 'Inventario ', 'iconoModulo' => 'fa fa-warehouse'],
        ];

        foreach ($items as $item) {
            ModuloModel::updateOrCreate(['idModulo' => $item['idModulo']], $item);
        }
    }
}
