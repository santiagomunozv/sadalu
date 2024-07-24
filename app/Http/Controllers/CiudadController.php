<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CiudadRequest;
use App\Models\CiudadModel;
use App\Repositories\DepartamentoRepository;

class CiudadController extends Controller
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
        $ciudad = CiudadModel::from('ciudad')
        ->join('departamento', 'ciudad.departamento_id', '=', 'departamento.idDepartamento')
        ->select('ciudad.idCiudad', 'ciudad.nombreCiudad', 'ciudad.codigoCiudad', 'departamento.nombreDepartamento')
        ->get();
        return view('ciudadGrid', compact('ciudad', 'permisos'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $ciudad = new CiudadModel();
        $departamento = DepartamentoRepository::getDepartamentoByNombreAndId();
        return view('ciudadForm', compact('ciudad', 'departamento'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CiudadRequest $request)
    {
        try {
            $ciudad = CiudadModel::create($request->all());
            return response(['idCiudad' => $ciudad->idCiudad], 201);
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
        $ciudad = CiudadModel::find($id);
        $departamento = DepartamentoRepository::getDepartamentoByNombreAndId();
        return view('ciudadForm', compact('ciudad', 'departamento'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CiudadRequest $request, $id)
    {
        try {
            $ciudad = CiudadModel::find($id);
            $ciudad->fill($request->all());
            $ciudad->save();
            return response(['idCiudad' => $ciudad->idCiudad], 200);
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
