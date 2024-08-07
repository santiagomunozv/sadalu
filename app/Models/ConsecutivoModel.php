<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsecutivoModel extends Model
{
    protected $table = 'consecutivo';
    protected $primaryKey = 'idConsecutivo';
    protected $fillable = [
        'numeroConsecutivo',
        'nombreConsecutivo',
        'tipoConsecutivo',
        'estadoConsecutivo',
        'resolucionConsecutivo',
        'prefijoConsecutivo',
        'fechaInicioConsecutivo',
        'fechaFinConsecutivo',
        'numeroInicioConsecutivo',
        'numeroFinConsecutivo'
    ];
}
