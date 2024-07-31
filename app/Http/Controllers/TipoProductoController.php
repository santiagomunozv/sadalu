<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoProductoRequest;
use App\Models\TipoProductoModel;

class TipoProductoController extends Controller
{

    public function index()
    {
        $permisos = $this->consultarPermisos();
        if (!$permisos) {
            abort(401);
        }
        $tipoproducto = TipoProductoModel::orderBy('idTipoProducto', 'DESC')->get();
        return view('tipoProductoGrid', compact('tipoproducto', 'permisos'));
    }

    public function create()
    {
        $tipoproducto = new TipoProductoModel();
        $tipoproducto->estadoTipoProducto = "Activo";

        return view('tipoProductoForm', compact('tipoproducto'));
    }

    public function store(TipoProductoRequest $request)
    {
        try {
            $tipoproducto = TipoProductoModel::create($request->all());
            return response(['idTipoProducto' => $tipoproducto->idTipoProducto], 201);
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
        $tipoproducto = TipoProductoModel::find($id);
        return view('tipoProductoForm', compact('tipoproducto'));
    }

    public function update(TipoProductoRequest $request, $id)
    {
        try {
            $tipoproducto = TipoProductoModel::find($id);
            $tipoproducto->fill($request->all());
            $tipoproducto->save();
            return response(['idTipoProducto' => $tipoproducto->idTipoProducto], 200);
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }
}
