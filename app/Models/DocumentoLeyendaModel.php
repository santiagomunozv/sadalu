<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoLeyendaModel extends Model
{
    protected $table = 'documento_leyenda';
    protected $primaryKey = 'idDocumentoLeyenda';
    protected $fillable = [
        'documento_id',
        'posicionDocumentoLeyenda',
        'mensajeDocumentoLeyenda'

    ];
    public function documento()
    {
        return $this->hasMany('App\DocuementoModel', 'documento_id');
    }
    public $timestamps = false;
}