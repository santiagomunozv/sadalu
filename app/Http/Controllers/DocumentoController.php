<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentoRequest;
use App\Models\DocumentoCodigoModel;
use App\Models\DocumentoLeyendaModel;
use App\Models\DocumentoModel;
use App\Repositories\ConsecutivoRepository;
use Illuminate\Support\Facades\DB;

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
        $documento = DocumentoModel::from('documento')
    ->join('consecutivo', 'documento.consecutivo_id', '=', 'consecutivo.idConsecutivo')
    ->select('documento.idDocumento', 'consecutivo.nombreConsecutivo', 'documento.tipoDocumento', 'documento.nombreDocumento', 'documento.estadoDocumento')
    ->get();
        return view('documentoGrid', compact('documento', 'permisos'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $documento = new DocumentoModel();
        $documento->estadoDocumento = "Activo";
        $consecutivo = ConsecutivoRepository::getConsecutivoByNombreAndId();
        $idEtiqueta = ['Tipo documento', 'Código documento', 'Versión documento', 'Operación normal',
        'Operacion referenciado', 'Operación mandato',
        'Etiqueta factura', 'Identificador item mandato',
        'Nota credito referenciado', 'Nota credito ajuste',
        'Nota credito sin referenciar'];
        $nombreEtiqueta = ['Tipo documento', 'Código documento', 'Versión documento', 'Operación normal',
        'Operacion referenciado', 'Operación mandato',
        'Etiqueta factura', 'Identificador item mandato',
        'Nota credito referenciado', 'Nota credito ajuste',
        'Nota credito sin referenciar'];
        $documentoCodigo = new DocumentoCodigoModel();
        $documentoLeyenda = new DocumentoLeyendaModel();
        return view('documentoForm', compact('documento', 'consecutivo', 'documentoCodigo', 'idEtiqueta', 'nombreEtiqueta', 'documentoLeyenda'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(DocumentoRequest $request)
    {
        DB::beginTransaction();
        try {
            $documento = DocumentoModel::create($request->all());
            $this->grabarDetalleCodigo($request, $documento->idDocumento);
            $this->grabarDetalleLeyenda($request, $documento->idDocumento);
            DB::commit();
            return response(['idDocumento' => $documento->idDocumento], 201);
        } catch (\Exception $e) {
            DB::rollback();
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
        $documento = DocumentoModel::find($id);
        $consecutivo = ConsecutivoRepository::getConsecutivoByNombreAndId();
        $idEtiqueta = ['Tipo documento', 'Código documento', 'Versión documento', 'Operación normal',
        'Operacion referenciado', 'Operación mandato',
        'Etiqueta factura', 'Identificador item mandato',
        'Nota credito referenciado', 'Nota credito ajuste',
        'Nota credito sin referenciar'];
        $nombreEtiqueta = ['Tipo documento', 'Código documento', 'Versión documento', 'Operación normal',
        'Operacion referenciado', 'Operación mandato',
        'Etiqueta factura', 'Identificador item mandato',
        'Nota credito referenciado', 'Nota credito ajuste',
        'Nota credito sin referenciar'];
        $documentoCodigo = DocumentoCodigoModel::where('documento_id', $id)->get();
        $documentoLeyenda = DocumentoLeyendaModel::where('documento_id', $id)->get();
        return view('documentoForm', compact('documento', 'consecutivo', 'idEtiqueta', 'nombreEtiqueta', 'documentoCodigo', 'documentoLeyenda'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(DocumentoRequest $request, $id)
    {
        try {
            $documento = DocumentoModel::find($id);
            $documento->fill($request->all());
            $documento->save();
            $this->grabarDetalleCodigo($request, $documento->idDocumento);
            $this->grabarDetalleLeyenda($request, $documento->idDocumento);
            DB::commit();
            return response(['idDocumento' => $documento->idDocumento], 200);
        } catch (\Exception $e) {
            DB::rollBack();
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

    protected function grabarDetalleCodigo($request, $id)
    {
        $idsEliminarCodigo = explode(',', $request['eliminarDocumentoCodigo']);
        DocumentoCodigoModel::whereIn('idDocumentoCodigo', $idsEliminarCodigo)->delete();

        $totalCodigo = ($request['idDocumentoCodigo'] !== null) ? count($request['idDocumentoCodigo']) : 0;
        for ($i = 0; $i < $totalCodigo; $i++) {
            $indiceCodigo = array(
                'idDocumentoCodigo' => $request['idDocumentoCodigo'][$i]
            );
            $datosCodigo = array(
                'documento_id' => $id,
                'codigoDocumentoCodigo' => $request['codigoDocumentoCodigo'][$i],
                'etiquetaDocumentoCodigo' => $request['etiquetaDocumentoCodigo'][$i],
            );

            DocumentoCodigoModel::updateOrCreate($indiceCodigo, $datosCodigo);
        }
    }

    protected function grabarDetalleLeyenda($request, $id)
    {
        $idsEliminarLeyenda = explode(',', $request['eliminarLeyendaId']);
        DocumentoLeyendaModel::whereIn('idDocumentoLeyenda', $idsEliminarLeyenda)->delete();

        $totalLeyenda = ($request['idDocumentoLeyenda'] !== null) ? count($request['idDocumentoLeyenda']) : 0;
        for ($i = 0; $i < $totalLeyenda; $i++) {
            $indiceLeyenda = array(
                'idDocumentoLeyenda' => $request['idDocumentoLeyenda'][$i]
            );
            $datosLeyenda = array(
                'documento_id' => $id,
                'posicionDocumentoLeyenda' => $request['posicionDocumentoLeyenda'][$i],
                'mensajeDocumentoLeyenda' => $request['mensajeDocumentoLeyenda'][$i],
            );

            DocumentoLeyendaModel::updateOrCreate($indiceLeyenda, $datosLeyenda);
        }
    }
}
