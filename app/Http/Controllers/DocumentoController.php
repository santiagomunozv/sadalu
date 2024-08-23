<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocuementoRequest;
use App\Models\DocuementoModel;
use App\Repositories\ConsecutivoRepository;

class DocumentoController extends Controller
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
        $documento = DocuementoModel::from('documento')
        ->join('consecutivo', 'documento.consecutivo_id', '=', 'consecutivo.idConsecutivo')
        ->select('documento.idDocumento', 'documento.consecutivo_id', 'documento.tipoDocumento', 'documento.nombreDocumento')
        ->get();
        return view('docuemntoGrid', compact('documento', 'permisos'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $documento = new DocuementoModel();
        $consecutivo = ConsecutivoRepository::getConsecutivoByNombreAndId();
        return view('documentoForm', compact('documento', 'consecutivo'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(DocuementoRequest $request)
    {
        try {
            $documento = DocuementoModel::create($request->all());
            return response(['idDepartamento' => $documento->idDepartamento], 201);
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
        $documento = DocuementoModel::find($id);
        $pais = ConsecutivoRepository::getConsecutivoByNombreAndId();
        return view('documentoForm', compact('documento', 'consecutivo'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(DocuementoRequest $request, $id)
    {
        try {
            $documento = DocuementoModel::find($id);
            $documento->fill($request->all());
            $documento->save();
            return response(['idDepartamento' => $documento->idDepartamento], 200);
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
