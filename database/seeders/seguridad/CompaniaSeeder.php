<?php

namespace Database\Seeders\seguridad;

use App\Models\CompaniaModel;
use Illuminate\Database\Seeder;

class CompaniaSeeder extends Seeder
{

    public function run()
    {
        $items = [
            [
                'idCompania' => 1,
                'nombreCompania' => 'Sadalu',
                'estadoCompania' => 'Activo'
            ]
        ];

        foreach ($items as $item) {
            CompaniaModel::updateOrCreate(['idCompania' => $item['idCompania']], $item);
        }
    }
}
