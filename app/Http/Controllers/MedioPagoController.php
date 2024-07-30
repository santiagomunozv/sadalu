<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedioPagoRequest;
use App\Models\MedioPagoModel;

class MedioPagoController extends Controller
{

    public function index()
    {
        $permisos = $this->consultarPermisos();
        if (!$permisos) {
            abort(401);
        }
        $mediopago = MedioPagoModel::orderBy('idMedioPago', 'DESC')->get();
        return view('medioPagoGrid', compact('mediopago', 'permisos'));
    }

    public function create()
    {
        $mediopago = new MedioPagoModel();
        $mediopago->estadoMedioPago = "Activo";

        return view('medioPagoForm', compact('mediopago'));
    }

    public function store(MedioPagoRequest $request)
    {
        try {
            $mediopago = MedioPagoModel::create($request->all());
            return response(['idMedioPago' => $mediopago->idMedioPago], 201);
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
        $mediopago = MedioPagoModel::find($id);
        return view('medioPagoForm', compact('mediopago'));
    }

    public function update(MedioPagoRequest $request, $id)
    {
        try {
            $mediopago = MedioPagoModel::find($id);
            $mediopago->fill($request->all());
            $mediopago->save();
            return response(['idMedioPago' => $mediopago->idMedioPago], 200);
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }

}
