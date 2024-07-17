<?php

namespace Database\Seeders\maestros;

use App\Models\PaisModel;
use Illuminate\Database\Seeder;

class PaisSeeder extends Seeder
{

    public function run()
    {
        $ds = DIRECTORY_SEPARATOR;
        $items = json_decode(file_get_contents(base_path() . $ds . 'database' . $ds . 'data' . $ds . 'paises.json'), true);

        foreach ($items as $item) {
            PaisModel::updateOrCreate(['idPais' => $item['idPais']], $item);
        }
    }
}
