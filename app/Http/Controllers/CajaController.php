<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CajaModel;
use App\Models\MedioPagoModel;
use App\Models\CajaMedioPagoModel;
use App\Models\UsuarioModel;
use App\Models\CajaControlModel;
use App\Repositories\UsuarioCajaRepository;
use App\Repositories\MedioPagoRepository;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $permisos = $this->consultarPermisos();
        if (!$permisos) {
            abort(401);
        }
        $caja = CajaModel::orderBy('idCaja', 'DESC')->get();
        return view('cajaGrid', compact('caja', 'permisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $caja = new cajaModel();
        $usuario = UsuarioCajaRepository::getUsuarioCajaByNombreAndId();
        $caja_control = CajaControlModel::where('caja_id', $caja->idCaja)->get();
        $idMedioPago = MedioPagoRepository::getMedioPagoById();
        $nombreMedioPago = MedioPagoRepository::getMedioPagoByNombre();
        $medio_pago = new MedioPagoModel();
        $caja->estadoCaja = "Activo";
        return view('cajaForm', compact('caja', 'usuario', 'caja_control', 'idMedioPago', 'nombreMedioPago', 'medio_pago'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $caja = CajaModel::create($request->all());
            DB::commit();
            return response(['idCaja' => $caja->idCaja], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return abort(500, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $caja = CajaModel::where('idCaja', $id)->get();
        $caja = $caja[0];
        $usuario = UsuarioCajaRepository::getUsuarioCajaByNombreAndId();
        $caja_control = CajaControlModel::where('caja_id', $caja->idCaja)->get();
        $idMedioPago = MedioPagoRepository::getMedioPagoById();
        $nombreMedioPago = MedioPagoRepository::getMedioPagoByNombre();
        $medio_pago = MedioPagoModel::where('idMedioPago', $id)->get();
        return view('cajaForm', compact('caja', 'usuario', 'caja_control', 'idMedioPago', 'nombreMedioPago', 'medio_pago'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $caja = CajaModel::find($id);
            $caja->fill($request->all());
            $caja->save();
            return response(['idCaja' => $caja->idCaja], 200);
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
