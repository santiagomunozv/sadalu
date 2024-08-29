<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoCodigoModel extends Model
{
    protected $table = 'documento_codigo';
    protected $primaryKey = 'idDocumentoCodigo';
    protected $fillable = [
        'documento_id',
        'codigoDocumentoCodigo',
        'etiquetaDocumentoCodigo'

    ];
    public function documento()
    {
        return $this->hasMany('App\DocuementoModel', 'documento_id');
    }
    public $timestamps = false;
}