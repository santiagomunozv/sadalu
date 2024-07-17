<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OpcionModel;
use App\Repositories\ModuloRepository;
use Http\Requests\OpcionRequest;

class OpcionController extends Controller
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
        $opcion = OpcionModel::from('opcion')->join('modulo', 'opcion.modulo_id', 'modulo.idModulo')->orderBy('idOpcion', 'DESC')->get();
        return view('opcionGrid', compact('opcion', 'permisos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $opcion = new OpcionModel();
        $modulo = ModuloRepository::getModulosByNombreAndId();
        return view('opcionForm', compact('opcion', 'modulo'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(OpcionRequest $request)
    {
        try {
            $opcion = OpcionModel::create($request->all());
            $opcion->fill($request->all());
            return response(['idOpcion' => $opcion->idOpcion], 201);
        } catch (\Exception $e) {
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
        $opcion = OpcionModel::find($id);
        $modulo = ModuloRepository::getModulosByNombreAndId();
        return view('opcionForm', compact('opcion', 'modulo'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(OpcionRequest $request, $id)
    {
        try {
            $opcion = OpcionModel::find($id);
            $opcion->fill($request->all());
            $opcion->save();
            return response(['idOpcion' => $opcion->idOpcion]);
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
