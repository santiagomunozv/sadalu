<?php

namespace Database\Seeders\seguridad;

use App\Models\UsuarioModel;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{

    public function run()
    {
        $items = [
            [
                'idUsuario'         => 1,
                'loginUsuario'      => 'santiagom',
                'password'          => 'santiago',
                'estadoUsuario'     => 'Activo',
                'remember_token'    => null,
            ],
        ];

        foreach ($items as $item) {
            UsuarioModel::updateOrCreate(['idUsuario' => $item['idUsuario']], $item);
        }
    }
}
