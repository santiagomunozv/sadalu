<?php

namespace Database\Seeders\seguridad;

use App\Models\OpcionModel;
use Illuminate\Database\Seeder;

class SeguridadOpcionSeeder extends Seeder
{

    public function run()
    {
        $ds = DIRECTORY_SEPARATOR;
        $items = json_decode(file_get_contents(base_path() . $ds . 'database' . $ds . 'data' . $ds . 'opcion.json'), true);

        foreach ($items as $item) {
            OpcionModel::updateOrCreate(['idOpcion' => $item['idOpcion']], $item);
        }
    }
}
