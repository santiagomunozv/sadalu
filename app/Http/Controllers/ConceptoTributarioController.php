<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConceptoTributarioRequest;
use App\Models\ConceptoTributarioModel;
use Illuminate\Http\Request;

class ConceptoTributarioController extends Controller
{

    public function index()
    {
        $permisos = $this->consultarPermisos();
        if (!$permisos) {
            abort(401);
        }
        $conceptotributario = ConceptoTributarioModel::orderBy('idConceptoTributario', 'DESC')->get();
        return view('conceptotributarioGrid', compact('conceptotributario', 'permisos'));
    }

    public function create()
    {
        $conceptotributario = new ConceptoTributarioModel();
        $conceptotributario->estadoConceptoTributario = "Activo";

        return view('conceptotributarioForm', compact('conceptotributario'));
    }

    public function store(ConceptoTributarioRequest $request)
    {
        try {
            $conceptotributario = ConceptoTributarioModel::create($request->all());
            return response(['idConceptoTributario' => $conceptotributario->idConceptoTributario], 201);
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
        $conceptotributario = ConceptoTributarioModel::find($id);
        return view('conceptotributarioForm', compact('conceptotributario'));
    }

    public function update(ConceptoTributarioRequest $request, $id)
    {
        try {
            $conceptotributario = ConceptoTributarioModel::find($id);
            $conceptotributario->fill($request->all());
            $conceptotributario->save();
            return response(['idConceptoTributario' => $conceptotributario->idConceptoTributario], 200);
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }

}
