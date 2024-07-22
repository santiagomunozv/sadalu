<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaisRequest;
use Illuminate\Http\Request;
use App\Models\PaisModel;
use Illuminate\Support\Facades\Session;


class PaisController extends Controller
{
    public function index()
    {
        $permisos = $this->consultarPermisos();
        if (!$permisos) {
            abort(401);
        }
        $pais = PaisModel::orderBy('idPais', 'DESC')->get();
        return view('paisGrid', compact('pais', 'permisos'));
    }

    public function create()
    {
        $pais = new PaisModel();
        return view('paisForm', compact('pais'));
    }

    public function store(PaisRequest $request)
    {
        try {
            $pais = PaisModel::create($request->all());
            return response(['idPais' => $pais->idPais], 201);
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
        $pais = PaisModel::find($id);
        return view('paisForm', compact('pais'));
    }

    public function update(PaisRequest $request, $id)
    {
        try {
            $pais = PaisModel::find($id);
            $pais->fill($request->all());
            $pais->save();
            return response(['idPais' => $pais->idPais], 200);
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }

    public function cambioPais(Request $request)
    {
        $request->validate(['pais' => 'required']);
        Session::put("idPais", $request->pais);
        return redirect('/');
    }
}
