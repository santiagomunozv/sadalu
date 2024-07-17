<?php

namespace App\utils;

use Illuminate\Support\Facades\DB;

class LoginFactory
{

    public static function buildOpcion($rows)
    {
        $modulosAssoc = [];
        foreach ($rows as $modulo) {
            $key = $modulo->idModulo;
            if (!array_key_exists($key, $modulosAssoc)) {
                $modulosAssoc[$key] = collect();
            }
            $modulosAssoc[$key]->push($modulo);
        }
        return $modulosAssoc;
    }

    public static function buildModulos($rows)
    {
        $modulosAssoc = [];
        $modulosAdded = [];
        foreach ($rows as $modulo) {
            $key = $modulo->idPaquete;
            if (!array_key_exists($key, $modulosAssoc)) {
                $modulosAssoc[$key] = collect();
            }
            if (!in_array($modulo->idModulo, $modulosAdded)) {
                $modulosAssoc[$key]->push($modulo);
                array_push($modulosAdded, $modulo->idModulo);
            }
        }
        return $modulosAssoc;
    }

    public static function buildPaquetes($rows)
    {
        $paquetesAssoc = [];
        foreach ($rows as $paquete) {
            $key = $paquete->idPaquete;
            if (!array_key_exists($key, $paquetesAssoc)) {
                $paquetesAssoc[$key] = $paquete;
            }
        }
        return $paquetesAssoc;
    }

    public static function getMenuData($rol)
    {
        return $rol ? DB::select("SELECT idPaquete, nombrePaquete, idModulo, nombreModulo, iconoModulo, nombreOpcion, rutaOpcion
            FROM rolopcion
            join opcion on opcion_id = idOpcion
            join modulo on idModulo = modulo_id
            join paquete on idPaquete = paquete_id
            where rol_id = $rol
            order by ordenPaquete, nombreModulo, nombreOpcion") : [];
    }
}
