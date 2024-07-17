<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\maestros\CiudadSeeder;
use Database\Seeders\maestros\DepartamentoSeeder;
use Database\Seeders\maestros\PaisSeeder;
use Database\Seeders\seguridad\CompaniaSeeder;
use Database\Seeders\seguridad\RolOpcionSeeder;
use Database\Seeders\seguridad\RolSeeder;
use Database\Seeders\seguridad\SeguridadModuloSeeder;
use Database\Seeders\seguridad\SeguridadOpcionSeeder;
use Database\Seeders\seguridad\SeguridadPaqueteSeeder;
use Database\Seeders\seguridad\UsuarioCompaniaRolSeeder;
use Database\Seeders\seguridad\UsuarioSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CompaniaSeeder::class,
            RolSeeder::class,
            UsuarioSeeder::class,
            UsuarioCompaniaRolSeeder::class,
            SeguridadPaqueteSeeder::class,
            SeguridadModuloSeeder::class,
            SeguridadOpcionSeeder::class,
            RolOpcionSeeder::class,
            PaisSeeder::class,
            DepartamentoSeeder::class,
            CiudadSeeder::class,
        ]);
    }
}
