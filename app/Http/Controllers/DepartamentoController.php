<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartamentoRequest;
use App\Models\DepartamentoModel;
use App\Repositories\PaisRepository;

class DepartamentoController extends Controller
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
        $departamento = DepartamentoModel::from('departamento')
        ->join('pais', 'departamento.pais_id', '=', 'pais.idPais')
        ->select('departamento.idDepartamento', 'pais.nombrePais', 'departamento.codigoDepartamento', 'departamento.nombreDepartamento')
        ->get();
        return view('departamentoGrid', compact('departamento', 'permisos'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $departamento = new DepartamentoModel();
        $pais = PaisRepository::getPaisesByNombreAndId();
        return view('departamentoForm', compact('departamento', 'pais'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(DepartamentoRequest $request)
    {
        try {
            $departamento = DepartamentoModel::create($request->all());
            return response(['idDepartamento' => $departamento->idDepartamento], 201);
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
        $departamento = DepartamentoModel::find($id);
        $pais = PaisRepository::getPaisesByNombreAndId();
        return view('departamentoForm', compact('departamento', 'pais'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(DepartamentoRequest $request, $id)
    {
        try {
            $departamento = DepartamentoModel::find($id);
            $departamento->fill($request->all());
            $departamento->save();
            return response(['idDepartamento' => $departamento->idDepartamento], 200);
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
