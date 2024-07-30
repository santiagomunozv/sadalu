<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConceptoTributarioModel extends Model
{
    protected $table = 'concepto_tributario';
    protected $primaryKey = 'idConceptoTributario';
    protected $fillable = [
        'idConceptoTributario',
        'codigoDianConceptoTributario',
        'nombreConceptoTributario',
        'grupoConceptoTributario',
        'tipoConceptoTributario',
        'operacionConceptoTributario',
        'operadorConceptoTributario',
        'baseConceptoTributario',
        'tarifaConceptoTributario',
        'nombreDianConceptoTributario',
        'estadoConceptoTributario',

    ];
    public $timestamps = false;
}
