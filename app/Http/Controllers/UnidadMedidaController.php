<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnidadMedidaRequest;
use App\Models\UnidadMedidaModel;

class UnidadMedidaController extends Controller
{

    public function index()
    {
        $permisos = $this->consultarPermisos();
        if (!$permisos) {
            abort(401);
        }
        $unidadmedida = UnidadMedidaModel::orderBy('idUnidadMedida', 'DESC')->get();
        return view('unidadMedidaGrid', compact('unidadmedida', 'permisos'));
    }

    public function create()
    {
        $unidadmedida = new UnidadMedidaModel();
        $unidadmedida->estadoUnidadMedida = "Activo";

        return view('unidadMedidaForm', compact('unidadmedida'));
    }

    public function store(UnidadMedidaRequest $request)
    {
        try {
            $unidadmedida = UnidadMedidaModel::create($request->all());
            return response(['idUnidadMedida' => $unidadmedida->idUnidadMedida], 201);
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }

    public function show($id)
    {
        return view('show');
    }

    public function edit($id)
    {
        $unidadmedida = UnidadMedidaModel::find($id);
        return view('unidadMedidaForm', compact('unidadmedida'));
    }

    public function update(UnidadMedidaRequest $request, $id)
    {
        try {
            $unidadmedida = UnidadMedidaModel::find($id);
            $unidadmedida->fill($request->all());
            $unidadmedida->save();
            return response(['idUnidadMedida' => $unidadmedida->idUnidadMedida], 200);
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }
}
