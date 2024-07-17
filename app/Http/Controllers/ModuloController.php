<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ModuloModel;
use App\Repositories\PaqueteRepository;
use Http\Requests\ModuloRequest;

class ModuloController extends Controller
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

        $modulo = ModuloModel::from('modulo')->join('paquete', 'modulo.paquete_id', 'paquete.idPaquete')->orderBy('idModulo', 'DESC')->get();
        return view('moduloGrid', compact('modulo', 'permisos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $modulo = new ModuloModel();
        $paquete = PaqueteRepository::getPaquetesByNombreAndId();
        return view('moduloForm', compact('modulo', 'paquete'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ModuloRequest $request)
    {
        try {
            $modulo = ModuloModel::create($request->all());
            return response(['idModulo' => $modulo->idModulo], 201);
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
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $modulo = ModuloModel::find($id);
        $paquete = PaqueteRepository::getPaquetesByNombreAndId();
        return view('moduloForm', compact('modulo', 'paquete'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ModuloRequest $request, $id)
    {
        try {
            $modulo = ModuloModel::find($id);
            $modulo->fill($request->all());
            $modulo->save();
            return response(['idModulo' => $modulo->idModulo]);
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
