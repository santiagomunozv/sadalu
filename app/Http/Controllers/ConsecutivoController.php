<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsecutivoModel;

class ConsecutivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = $this->consultarPermisos();
        if (!$permisos) {
            abort(401);
        }
        $consecutivos = ConsecutivoModel::orderBy('idConsecutivo', 'DESC')->get();
        return view('consecutivos.consecutivosGrid', compact('consecutivos','permisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $consecutivo = new ConsecutivoModel();
        $consecutivo->estadoConsecutivo = "Activo";

        return view('consecutivos.consecutivos', compact('consecutivo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $consecutivo = ConsecutivoModel::create($request->all());
            return response(['si?' => 'si'], 201);
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $consecutivo = ConsecutivoModel::find($id);
        return view('consecutivos.consecutivos', compact('consecutivo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $consecutivo = ConsecutivoModel::find($id);
            $consecutivo->fill($request->all());
            $consecutivo->save();
            return response(['idConsecutivo' => $consecutivo->idConsecutivo], 200);
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
