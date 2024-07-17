<?php

namespace Database\Seeders\seguridad;

use App\Models\UsuarioCompaniaRolModel;
use Illuminate\Database\Seeder;

class UsuarioCompaniaRolSeeder extends Seeder
{

    public function run()
    {
        $items = [
            ['idUsuarioCompaniaRol' => 1, 'usuario_id' => 1, 'rol_id' => 1, 'compania_id' => 1],


        ];

        foreach ($items as $item) {
            UsuarioCompaniaRolModel::updateOrCreate(['idUsuarioCompaniaRol' => $item['idUsuarioCompaniaRol']], $item);
        }
    }
}
