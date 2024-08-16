<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Models\ClienteModel;
use App\Repositories\CiudadRepository;
use App\Repositories\TipoIdentificacionRepository;

class ClienteController extends Controller
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
        $cliente = ClienteModel::select(
            'cliente.idCliente',
            'cliente.identificacionCliente',
            'cliente.digitoVerificacionCliente',
            'cliente.razonSocialCliente',
            'cliente.nombreComercialCliente',
            'cliente.primerNombreCliente',
            'cliente.segundoNombreCliente',
            'cliente.primerApellidoCliente',
            'cliente.segundoApellidoCliente',
            'cliente.telefonoCliente',
            'cliente.celularCliente',
            'cliente.emailCliente',
            'cliente.direccionCliente',
            'cliente.codigoPostalCliente',
            'ciudad.nombreCiudad',
            'tipo_identificacion.nombreTipoIdentificacion'
        )
        ->join('ciudad', 'cliente.ciudad_id', '=', 'ciudad.idCiudad')
        ->join('tipo_identificacion', 'cliente.tipoidentificacion_id', '=', 'tipo_identificacion.idTipoIdentificacion')
        ->get();
        return view('clienteGrid', compact('cliente', 'permisos'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $cliente = new ClienteModel();
        $ciudad = CiudadRepository::getCiudadByNombreAndId();
        $tipoidentificacion = TipoIdentificacionRepository::getTipoIdentificacionByNombreAndId();
        // Acá retorno tooooodos los tipos de identificación con todos sus campos
        $tiposIdentificaciones = TipoIdentificacionRepository::getAllTipoIdentificacion();
        //$unidadmedida = UnidadMedidaRepository::getUnidadMedidaByNombreAndId();
        return view('clienteForm', compact('cliente', 'ciudad', 'tipoidentificacion', 'tiposIdentificaciones'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ClienteRequest $request)
    {
        try {
            $cliente = ClienteModel::create($request->all());
            return response(['idCliente' => $cliente->idCliente], 201);
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
        $cliente = ClienteModel::find($id);
        $ciudad = CiudadRepository::getCiudadByNombreAndId();
        $tipoidentificacion = TipoIdentificacionRepository::getTipoIdentificacionByNombreAndId();
        $tiposIdentificaciones = TipoIdentificacionRepository::getAllTipoIdentificacion();
        //$unidadmedida = UnidadMedidaRepository::getUnidadMedidaByNombreAndId();
        return view('clienteForm', compact('cliente', 'ciudad', 'tipoidentificacion', 'tiposIdentificaciones'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ClienteRequest $request, $id)
    {
        try {
            $cliente = ClienteModel::find($id);
            $cliente->fill($request->all());
            $cliente->save();
            return response(['idCliente' => $cliente->idCliente], 200);
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
