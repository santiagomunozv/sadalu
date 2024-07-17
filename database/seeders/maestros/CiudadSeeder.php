<?php

namespace Database\Seeders\maestros;

use App\Models\CiudadModel;
use Illuminate\Database\Seeder;

class CiudadSeeder extends Seeder
{
    public function run()
    {
        $ds = DIRECTORY_SEPARATOR;
        $items = json_decode(file_get_contents(base_path() . $ds . 'database' . $ds . 'data' . $ds . 'ciudades.json'), true);

        foreach ($items as $item) {
            CiudadModel::updateOrCreate(['idCiudad' => $item['idCiudad']], $item);
        }
    }
}
