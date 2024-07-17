<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RolModel;
use App\Models\RolOpcionModel;
use App\Repositories\OpcionRepository;
use Illuminate\Support\Facades\DB;
use Http\Requests\RolRequest;

class RolController extends Controller
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
        $rol = RolModel::orderBy('idRol', 'DESC')->get();
        return view('rolGrid', compact('rol', 'permisos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $rol = new RolModel();
        $rol->estadoRol = "Activo";
        $idOpcion = OpcionRepository::getOptionsById();
        $nombreOpcion = OpcionRepository::getOptionsByNombre();
        $rolOpcion = new RolOpcionModel();

        return view('rolForm', compact('rol', 'idOpcion', 'nombreOpcion', 'rolOpcion'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RolRequest $request)
    {
        DB::beginTransaction();
        try {
            $rol = RolModel::create($request->all());
            $this->grabarDetalle($request, $rol->idRol);
            DB::commit();
            return response(['idRol' => $rol->idRol], 201);
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
        $rol = RolModel::find($id);
        $idOpcion = OpcionRepository::getOptionsById();
        $nombreOpcion = OpcionRepository::getOptionsByNombre();
        $rolOpcion = RolOpcionModel::where('rol_id', $id)->get();
        return view('rolForm', compact('rol', 'idOpcion', 'nombreOpcion', 'rolOpcion'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(RolRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $rol = RolModel::find($id);
            $rol->fill($request->all());
            $rol->save();
            $this->grabarDetalle($request, $rol->idRol);
            DB::commit();
            return response(['idRol' => $rol->idRol], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return abort(500, $e->getMessage());
        }
    }

    protected function grabarDetalle($request, $id)
    {
        $idsEliminar = explode(',', $request['eliminarRolOpcionId']);
        RolOpcionModel::whereIn('idRolOpcion', $idsEliminar)->delete();

        $total = ($request['idRolOpcion'] !== null) ? count($request['idRolOpcion']) : 0;
        for ($i = 0; $i < $total; $i++) {
            $indice = array(
                'idRolOpcion' => $request['idRolOpcion'][$i]
            );
            $datos = array(
                'rol_id' => $id,
                'opcion_id' => $request['opcion_id'][$i],
                'adicionarRolOpcion' => $request['adicionarRolOpcion'][$i],
                'modificarRolOpcion' => $request['modificarRolOpcion'][$i],
                'eliminarRolOpcion' => $request['eliminarRolOpcion'][$i],
                'consultarRolOpcion' => $request['consultarRolOpcion'][$i],
                'inactivarRolOpcion' => $request['inactivarRolOpcion'][$i],
            );

            RolOpcionModel::updateOrCreate($indice, $datos);
        }
    }
}
