<?php

use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\CompaniaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\OpcionController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConceptoTributarioController;
use App\Http\Controllers\ConsecutivoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MedioPagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TipoIdentificacionController;
use App\Http\Controllers\TipoProductoController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\CajaController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rutas login
Route::get('/login', [AutenticacionController::class, 'mostrarLoginForm'])->name('mostrarLoginForm');
Route::post('/login', [AutenticacionController::class, 'login'])->name('login');
Route::post('/logout', [AutenticacionController::class, 'logout'])->name('logout');
Route::get('/logout', [AutenticacionController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::post('/cambiarestadodata', function () {
        $id = (isset($_POST["id"]) ? $_POST["id"] : '');
        $tabla = (isset($_POST["tabla"]) ? $_POST["tabla"] : '');
        $campo = (isset($_POST["campo"]) ? $_POST["campo"] : '');
        DB::update("UPDATE $tabla SET estado$campo = CASE WHEN estado$campo = 'Activo' THEN 'Anulado' ELSE 'Activo' END WHERE id$campo = $id");
        return response(200);
    });

    Route::post('/eliminarregistrodata', function () {
        $id = (isset($_POST["id"]) ? $_POST["id"] : '');
        $tabla = (isset($_POST["tabla"]) ? $_POST["tabla"] : '');
        $terminacionTabla = (isset($_POST["terminacionTabla"]) ? $_POST["terminacionTabla"] : '');
        try {
            $consulta = DB::delete("DELETE FROM  $tabla WHERE id$terminacionTabla = $id");
            return response(200);
        } catch (Exception $e) {
            $bd = ENV('DB_DATABASE', 'sadalu');
            // cuando se genera error es porque el registro tiene FK que evitan su eliminación
            $tablas = DB::select(
                "SELECT TABLES.TABLE_NAME AS Tabla, COLUMN_COMMENT as Campo
                FROM information_schema.COLUMNS
                LEFT JOIN information_schema.TABLES ON COLUMNS.TABLE_NAME = TABLES.TABLE_NAME AND COLUMNS.TABLE_SCHEMA = TABLES.TABLE_SCHEMA
                where COLUMNS.TABLE_SCHEMA = '$bd'
                    and COLUMNS.COLUMN_NAME like CONCAT('$terminacionTabla','_%')
                    and COLUMNS.TABLE_NAME not like CONCAT('$tabla','%')
                ORDER BY COLUMNS.TABLE_NAME;"
            );

            $view = view('eliminarRegistro', compact('tablas'))->render();

            // devolvemos error 423 -> Locked: este recurso está bloqueado.
            return response(['tabla' => $view], 423);
        }
    });

    Route::prefix('seguridad')->group(function () {
        //     Route::post('/cambiocompania', 'CompaniaController@cambioCompania');
        //     Route::resource('/compania', 'CompaniaController');
        //     Route::resource('/rol', 'RolController');
        //     Route::resource('/paquete', 'PaquetesController');
        //     Route::resource('/modulo', 'ModuloController');
        //     Route::resource('/opcion', 'OpcionController');;

        Route::get('/cambiocompania', [CompaniaController::class, 'cambioCompania'])->name('cambioCompania');
        Route::resource('compania', CompaniaController::class);
        Route::resource('rol', RolController::class);
        Route::resource('paquete', PaqueteController::class);
        Route::resource('modulo', ModuloController::class);
        Route::resource('opcion', OpcionController::class);
        Route::resource('usuario', UsuarioController::class);
    });

    Route::prefix('maestros')->group(function () {
        //     Route::resource('/pais', PaisController::class);
        //     Route::resource('/departamento', PaisController::class);
        //     Route::resource('ciudad', CiudadController::class);
        //     Route::resource('tipoidentificacion', TipoIdentificacionController::class);
        //     Route::resource('mediopago', MedioPagoController::class);
        //     Route::resource('marca', MarcaController::class);
        //     Route::resource('tipoproducto', TipoProductoController::class);
        //     Route::resource('unidadmedida', UnidadMedidaController::class);
        //     Route::resource('producto', ProductoController::class);

        Route::resource('paises', PaisController::class);
        Route::resource('departamento', DepartamentoController::class);
        Route::resource('ciudad', CiudadController::class);
        Route::resource('tipoidentificacion', TipoIdentificacionController::class);
        Route::resource('mediopago', MedioPagoController::class);
        Route::resource('conceptotributario', ConceptoTributarioController::class);
        Route::resource('marca', MarcaController::class);
        Route::resource('tipoproducto', TipoProductoController::class);
        Route::resource('unidadmedida', UnidadMedidaController::class);
        Route::resource('producto', ProductoController::class);
        Route::resource('cliente', ClienteController::class);
        Route::resource('consecutivo', ConsecutivoController::class);
        Route::resource('documento', DocumentoController::class);
        Route::resource('caja', CajaController::class);

    });

});
