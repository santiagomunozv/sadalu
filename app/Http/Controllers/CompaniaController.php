<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CompaniaModel;
use Http\Requests\CompaniaRequest;
use Illuminate\Support\Facades\Session;

class CompaniaController extends Controller
{

    public function index()
    {
        $permisos = $this->consultarPermisos();
        if (!$permisos) {
            abort(401);
        }
        $compania = CompaniaModel::orderBy('idCompania', 'DESC')->get();
        return view('companiaGrid', compact('compania', 'permisos'));
    }

    public function create()
    {
        $compania = new CompaniaModel();
        $compania->estadoCompania = "Activo";

        return view('companiaForm', compact('compania'));
    }

    public function store(CompaniaRequest $request)
    {
        try {
            $compania = CompaniaModel::create($request->all());
            return response(['idCompania' => $compania->idCompania], 201);
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
        $compania = CompaniaModel::find($id);
        return view('companiaForm', compact('compania'));
    }

    public function update(CompaniaRequest $request, $id)
    {
        try {
            $compania = CompaniaModel::find($id);
            $compania->fill($request->all());
            $compania->save();
            return response(['idCompania' => $compania->idCompania], 200);
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }

    public function cambioCompania(Request $request)
    {
        $request->validate(['compania' => 'required']);

        Session::put("idCompania", $request->compania);

        return redirect('/');
    }
}
