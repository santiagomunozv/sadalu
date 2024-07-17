<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaqueteModel;
use Http\Requests\PaqueteRequest;

class PaqueteController extends Controller
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
        $paquete = PaqueteModel::orderBy('idPaquete', 'DESC')->get();
        return view('paqueteGrid', compact('paquete', 'permisos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $paquete = new PaqueteModel();
        return view('paqueteForm', compact('paquete'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PaqueteRequest $request)
    {
        try {
            $paquete = PaqueteModel::create($request->all());
            return response(['idPaquete' => $paquete->idPaquete], 201);
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show()
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
        $paquete = PaqueteModel::find($id);
        return view('paqueteForm', compact('paquete'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(PaqueteRequest $request, $id)
    {
        try {
            $paquete = PaqueteModel::find($id);
            $paquete->fill($request->all());
            $paquete->save();
            return response(['idPaquete' => $paquete->idPaquete], 200);
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }
}
