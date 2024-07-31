<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoModel extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'idProducto';

    protected $fillable = [
        'marca_id',
        'tipoproducto_id',
        'unidadmedida_id',
        'codigoProducto',
        'nombreProducto',
        'eanProducto',
        'imagenProducto',
        'estadoProducto'
    ];

    public function marca()
    {
        return $this->hasMany('App\MarcaModel', 'marca_id');
    }
    public function tipoProducto()
    {
        return $this->hasMany('App\TipoProductoModel', 'tipoproducto_id');
    }
    public function unidadMedida()
    {
        return $this->hasMany('App\UnidadMedidaModel', 'unidadmedida_id');
    }
    public $timestamps = false;
}
