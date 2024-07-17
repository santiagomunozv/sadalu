<?php

namespace Database\Seeders\seguridad;

use App\Models\RolOpcionModel;
use Illuminate\Database\Seeder;

class RolOpcionSeeder extends Seeder
{

    public function run()
    {
        $ds = DIRECTORY_SEPARATOR;
        $items = json_decode(file_get_contents(base_path() . $ds . 'database' . $ds . 'data' . $ds . 'rolopcion.json'), true);

        foreach ($items as $item) {
            RolOpcionModel::updateOrCreate(['idRolOpcion' => $item['idRolOpcion']], $item);
        }
    }
}
