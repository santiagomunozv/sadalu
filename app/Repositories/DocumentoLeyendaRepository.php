<?php

namespace App\Repositories;

use App\Models\DocumentoLeyendaModel;

class DocumentoLeyendaRepository
{
    public static function getAllDocumentoCodigo()
    {
        return DocumentoLeyendaModel::get();
    }

    public static function getDocumentoCodigoByNombreAndId()
    {
        return DocumentoLeyendaModel::All()->pluck('posicionDocumentoLeyenda', 'idDocumentoLeyenda');
    }

    public static function getDocumentoCodigoById()
    {
        return DocumentoLeyendaModel::All()->pluck('idDocumentoLeyenda');
    }

    public static function getDocumentoCodigoByNombre()
    {
        return DocumentoLeyendaModel::All()->pluck('posicionDocumentoLeyenda');
    }
}
