<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\utils\LoginFactory;
use Illuminate\Support\Facades\DB;

/**
 * Esta clase contiene la logica necesaria para establecer los objetos de la sesión
 * de acuerdo al usuario que hace login en la aplicacion.
 * Los únicos metodos que deberían ser llamados son setSessionModels y setSessionModelsByCompania
 *
 */
class AuthService
{
    //El id de la compania que el usuario tiene en sesión
    public static $COMPANIA_ID = "idCompania";
    public static $USER_ROLE = "rolUsuario";
    public static $TERCERO_NAME = "session_usr_nombreLogin";
    public static $USER_COMPANIES = 'session_usr_companiasAsociadas';

    private static $BASE_SQL = "SELECT
    usuario_id,
    compania_id AS idCompania,
    loginUsuario as nombreLogin,
    rol_id
    FROM usuariocompaniarol
    INNER JOIN usuario ON usuario_id = idUsuario
    INNER JOIN compania ON compania_id = idCompania
    WHERE estadoUsuario = 'Activo' AND usuario_id =";

    /**
     *
     * Metodo que establece los valores de la sesion con la primer compañia
     * que se encuentre en la base de datos para el usuario que hace login
     *
     * @return true si se encuentran datos en la tabla usuariocompaniarol
     */
    public static function setSessionModels()
    {
        $data = self::getSessionDataByUsuario(Auth::id());
        return self::validateAndSetSessionModels($data);
    }


    /**
     *
     * Metodo que establece los valores de la sesion con la compania indicada como parametro
     * que se encuentre en la base de datos para el usuario que hace login
     *
     * @param idCompania el id de la compañia a la cual se está cambiando
     * @return true si se encuentran datos en la tabla usuariocompaniarol
     */
    public static function setSessionModelsByCompania($idCompania)
    {
        $data = self::getSessionDataByUsuarioAndCompania(Auth::id(), $idCompania);
        return self::validateAndSetSessionModels($data);
    }

    private static function validateAndSetSessionModels($data)
    {
        if (!$data || count($data) < 1) {
            return false;
        }
        self::setModels($data[0]);
        return true;
    }

    /**
     * Metodo encargado de determinar cuales variables de sesion se establecen
     */
    private static function setModels($data)
    {
        self::setUserModels($data);
        self::setMenuModels($data);
    }

    /**
     * Metodo encargado de establecer los modelos relacionados al usuario que está logueado
     */
    private static function setUserModels($data)
    {
        Session::put(self::$COMPANIA_ID, $data->idCompania);
        Session::put(self::$USER_ROLE, $data->rol_id);
        Session::put(self::$TERCERO_NAME, $data->nombreLogin);
        Session::put(self::$USER_COMPANIES, self::getCompaniasByUsuarioId(Auth::id()));
    }

    /**
     * Metodo encargado de establecer los modelos usados para construir el menu de la aplicacion
     *
     */
    private static function setMenuModels($data)
    {
        $idRol = $data->rol_id;
        $menuGeneral = LoginFactory::getMenuData($idRol);
        Session::put('packageDinamicMenuSadaluPaquetes', LoginFactory::buildPaquetes($menuGeneral));
        Session::put('packageDinamicMenuSadaluModulos', LoginFactory::buildModulos($menuGeneral));
        Session::put('packageDinamicMenuSadaluOpciones', LoginFactory::buildOpcion($menuGeneral));
    }

    private static function getSessionDataByUsuario($idUsuario)
    {
        return DB::select(self::$BASE_SQL . "{$idUsuario} LIMIT 1");
    }

    private static function getSessionDataByUsuarioAndCompania($idUsuario, $idCompania)
    {
        return DB::select(self::$BASE_SQL . "{$idUsuario}
            AND compania_id = {$idCompania} LIMIT 1");
    }

    private static function getCompaniasByUsuarioId($usuarioId)
    {
        return DB::select(
            "SELECT
                idCompania,
                nombreCompania
            FROM usuariocompaniarol
            INNER JOIN compania ON idCompania = compania_id
            WHERE usuario_id = {$usuarioId}
            ORDER BY nombreCompania ASC"
        );
    }
}
