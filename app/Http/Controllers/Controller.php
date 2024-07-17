<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function phpSelfClear()
    {
        $server = $_SERVER['PHP_SELF'];
        $sustituir = ['/index.php'];
        foreach ($sustituir as $valor) {
            $server = str_replace($valor, "", $server);
        }

        return $server;
    }

    protected function consultarPermisos()
    {
        return $this->consultarPermisosUrl($this->phpSelfClear());
    }

    protected function consultarPermisosUrl($url)
    {
        $datos = DB::table('rol as R')
            ->select('nombreOpcion', 'nombreRol', 'rutaOpcion', 'adicionarRolOpcion', 'modificarRolOpcion', 'eliminarRolOpcion', 'consultarRolOpcion', 'inactivarRolOpcion')
            ->join('usuariocompaniarol as UR', 'UR.rol_id', '=', 'R.idRol')
            ->join('rolopcion as RO', 'RO.rol_id', '=', 'UR.rol_id')
            ->join('opcion as O', 'opcion_id', '=', 'O.idOpcion')
            ->join('modulo as M', 'modulo_id', '=', 'M.idModulo')
            ->join('paquete as P', 'paquete_id', '=', 'P.idPaquete')
            ->orderby('idPaquete')->orderby('nombrePaquete')->orderby('iconoPaquete')
            ->orderby('idModulo')->orderby('nombreModulo')->orderby('iconoModulo')
            ->orderby('idOpcion')->orderby('nombreOpcion')->orderby('rutaOpcion')
            ->orderby('iconoOpcion')
            ->where('UR.usuario_id', '=',  Auth::id())
            ->where('UR.compania_id', '=', Session::get("idCompania"))
            ->where('rutaOpcion', '=', $url)
            ->get()->toArray();

        $permiso = $datos ? get_object_vars($datos[0]) : array('nombreOpcion' => '', 'nombreRol' => '', 'rutaOpcion' => '', 'adicionarRolOpcion' => 1, 'modificarRolOpcion' => 1, 'eliminarRolOpcion' => 1, 'consultarRolOpcion' => 1);
        return ($permiso);
    }

    /**
     * Método generico para construir los datos de una "Multi"
     *
     * @param Request $request una solicitud del cliente la cual contiene los datos para poblar el array de datos
     * @param String $idPadreKey representa la columna por la cual se relaciona datos hacia otra tabla}
     * @param Int $index representa el indice al cual se está construyendo
     * @param String[] $fields los campos fillables del objeto que se está construyendo
     *
     * @return Object[] un array con los datos especificados.
     */
    protected function buildDatos($request, $idPadreKey, $index, $fields)
    {
        $datos = [];
        foreach ($fields as $field) {
            if (isset($request[$field][$index])) {
                $datos[$field] = $request[$field][$index];
            } else {
                $datos[$field] = null;
            }
        }
        $datos[$idPadreKey] = $request->get($idPadreKey);
        return $datos;
    }
}
