<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocuementoModel extends Model
{
    protected $table = 'documento';
    protected $primaryKey = 'idDocumento';
    protected $fillable = [
        'consecutivo_id',
        'tipoDocumento',
        'nombreDocumento'

    ];
    public function consecutivo()
    {
        return $this->hasMany('App\ConsecutivoModel', 'consecutivo_id');
    }
    public $timestamps = false;
}