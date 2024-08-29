<?php

namespace App\Repositories;

use App\Models\DocumentoCodigoModel;

class DocumentoCodigoRepository
{
    public static function getAllDocumentoCodigo()
    {
        return DocumentoCodigoModel::get();
    }

    public static function getDocumentoCodigoByNombreAndId()
    {
        return DocumentoCodigoModel::All()->pluck('etiquetaDocumentoCodigo', 'idDocumentoCodigo');
    }

    public static function getDocumentoCodigoById()
    {
        return DocumentoCodigoModel::All()->pluck('idDocumentoCodigo');
    }

    public static function getDocumentoCodigoByNombre()
    {
        return DocumentoCodigoModel::All()->pluck('etiquetaDocumentoCodigo');
    }
}
