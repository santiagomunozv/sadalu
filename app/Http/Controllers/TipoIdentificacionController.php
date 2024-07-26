<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoIdentificacionRequest;
use App\Models\TipoIdentificacionModel;

class TipoIdentificacionController extends Controller
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
        $tipoidentificacion = TipoIdentificacionModel::orderBy('idTipoIdentificacion', 'DESC')->get();
        return view('tipoIdentificacionGrid', compact('tipoidentificacion', 'permisos'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $tipoidentificacion = new TipoIdentificacionModel();
        $tipoidentificacion->estadoTipoIdentificacion = "Activo";

        return view('tipoIdentificacionForm', compact('tipoidentificacion'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TipoIdentificacionRequest $request)
    {
        try {
            $tipoidentificacion = TipoIdentificacionModel::create($request->all());
            return response(['idTipoIdentificacion' => $tipoidentificacion->idTipoIdentificacion], 201);
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
        $tipoidentificacion = TipoIdentificacionModel::find($id);
        return view('tipoIdentificacionForm', compact('tipoidentificacion'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TipoIdentificacionRequest $request, $id)
    {
        try {
            $tipoidentificacion = TipoIdentificacionModel::find($id);
            $tipoidentificacion->fill($request->all());
            $tipoidentificacion->save();
            return response(['idTipoIdentificacion' => $tipoidentificacion->idTipoIdentificacion], 200);
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
