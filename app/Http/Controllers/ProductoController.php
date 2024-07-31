<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductoRequest;
use App\Models\ProductoModel;
use App\Repositories\MarcaRepository;
use App\Repositories\TipoProductoRepository;
use App\Repositories\UnidadMedidaRepository;

class ProductoController extends Controller
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
        $producto = ProductoModel::select(
            'producto.idProducto',
            'producto.codigoProducto',
            'producto.nombreProducto',
            'producto.eanProducto',
            'producto.imagenProducto',
            'producto.estadoProducto',
            'marca.nombreMarca',
            'tipo_producto.nombreTipoProducto',
            'unidad_medida.nombreUnidadMedida'
        )
        ->join('marca', 'producto.marca_id', '=', 'marca.idMarca')
        ->join('tipo_producto', 'producto.tipoproducto_id', '=', 'tipo_producto.idTipoProducto')
        ->join('unidad_medida', 'producto.unidadmedida_id', '=', 'unidad_medida.idUnidadMedida')
        ->get();
        return view('productoGrid', compact('producto', 'permisos'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $producto = new ProductoModel();
        $producto->estadoProducto = "Activo";
        $marca = MarcaRepository::getMarcasByNombreAndId();
        $tipoproducto = TipoProductoRepository::getTipoProductoByNombreAndId();
        $unidadmedida = UnidadMedidaRepository::getUnidadMedidaByNombreAndId();
        return view('productoForm', compact('producto', 'marca', 'tipoproducto', 'unidadmedida'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ProductoRequest $request)
    {
        try {
            $producto = ProductoModel::create($request->all());
            return response(['idProducto' => $producto->idProducto], 201);
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
        $producto = ProductoModel::find($id);
        $marca = MarcaRepository::getMarcasByNombreAndId();
        $tipoproducto = TipoProductoRepository::getTipoProductoByNombreAndId();
        $unidadmedida = UnidadMedidaRepository::getUnidadMedidaByNombreAndId();
        return view('productoForm', compact('producto', 'marca', 'tipoproducto', 'unidadmedida'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ProductoRequest $request, $id)
    {
        try {
            $producto = ProductoModel::find($id);
            $producto->fill($request->all());
            $producto->save();
            return response(['idProducto' => $producto->idProducto], 200);
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
