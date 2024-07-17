<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UsuarioCompaniaRolModel;
use App\Models\UsuarioModel;
use App\Repositories\CompaniaRepository;
use App\Repositories\RolRepository;
use Illuminate\Support\Facades\DB;
use Http\Requests\UsuarioRequest;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $permisos = $this->consultarPermisos();
        if (!$permisos) {
            abort(401);
        }
        $usuario = UsuarioModel::orderBy('idUsuario', 'DESC')->get();
        return view('usuarioGrid', compact('usuario', 'permisos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $usuario = new UsuarioModel();
        $usuario->estadoUsuario = "Activo";
        $idRol = RolRepository::getRolById();
        $nombreRol = RolRepository::getRolByNombre();
        $idCompania = CompaniaRepository::getCompaniaById();
        $nombreCompania = CompaniaRepository::getCompaniaByNombre();
        $usuarioCompaniaRol = new UsuarioCompaniaRolModel();

        return view('usuarioForm', compact('usuario', 'idRol', 'nombreRol', 'idCompania', 'nombreCompania', 'usuarioCompaniaRol'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(UsuarioRequest $request)
    {
        DB::beginTransaction();
        try {
            $usuario = UsuarioModel::create($request->all());
            $this->grabarDetalle($request, $usuario->idUsuario);
            DB::commit();
            return response(['idUsuario' => $usuario->idUsuario], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return abort(500, $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $usuario = UsuarioModel::find($id);
        $idRol = RolRepository::getRolById();
        $nombreRol = RolRepository::getRolByNombre();
        $idCompania = CompaniaRepository::getCompaniaById();
        $nombreCompania = CompaniaRepository::getCompaniaByNombre();
        $usuarioCompaniaRol = UsuarioCompaniaRolModel::where('usuario_id', $id)->get();

        return view('usuarioForm', compact('usuario', 'idRol', 'nombreRol', 'idCompania', 'nombreCompania', 'usuarioCompaniaRol'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UsuarioRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $usuario = UsuarioModel::find($id);
            $usuario->fill($request->all());
            $usuario->save();
            $this->grabarDetalle($request, $usuario->idUsuario);
            DB::commit();
            return response(['idUsuario' => $usuario->idUsuario], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return abort(500, $e->getMessage());
        }
    }

    protected function grabarDetalle($request, $id)
    {
        $idsEliminar = explode(',', $request['eliminarUsuarioCompaniaRolId']);
        UsuarioCompaniaRolModel::whereIn('idUsuarioCompaniaRol', $idsEliminar)->delete();

        $total = ($request['idUsuarioCompaniaRol'] !== null) ? count($request['idUsuarioCompaniaRol']) : 0;
        for ($i = 0; $i < $total; $i++) {
            $indice = array(
                'idUsuarioCompaniaRol' => $request['idUsuarioCompaniaRol'][$i]
            );
            $datos = array(
                'usuario_id' => $id,
                'rol_id' => $request['rol_id'][$i],
                'compania_id' => $request['compania_id'][$i],
            );

            UsuarioCompaniaRolModel::updateOrCreate($indice, $datos);
        }
    }
}
