<?php

namespace Database\Seeders\maestros;

use App\Models\DepartamentoModel;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    public function run()
    {
        $ds = DIRECTORY_SEPARATOR;
        $items = json_decode(file_get_contents(base_path() . $ds . 'database' . $ds . 'data' . $ds . 'departamentos.json'), true);

        foreach ($items as $item) {
            DepartamentoModel::updateOrCreate(['idDepartamento' => $item['idDepartamento']], $item);
        }
    }
}
