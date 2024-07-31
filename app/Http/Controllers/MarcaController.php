<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarcaRequest;
use App\Models\MarcaModel;

class MarcaController extends Controller
{

    public function index()
    {
        $permisos = $this->consultarPermisos();
        if (!$permisos) {
            abort(401);
        }
        $marca = MarcaModel::orderBy('idMarca', 'DESC')->get();
        return view('marcaGrid', compact('marca', 'permisos'));
    }

    public function create()
    {
        $marca = new MarcaModel();
        $marca->estadoMarca = "Activo";

        return view('marcaForm', compact('marca'));
    }

    public function store(MarcaRequest $request)
    {
        try {
            $marca = MarcaModel::create($request->all());
            return response(['idMarca' => $marca->idMarca], 201);
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
        $marca = MarcaModel::find($id);
        return view('marcaForm', compact('marca'));
    }

    public function update(MarcaRequest $request, $id)
    {
        try {
            $marca = MarcaModel::find($id);
            $marca->fill($request->all());
            $marca->save();
            return response(['idMarca' => $marca->idMarca], 200);
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }
}
