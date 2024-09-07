@extends('layouts.principal')

@section('nombreModulo')
    Cajas
@stop

@section('scripts')
<script>
        let medio_pago = '<?php echo json_encode($medio_pago); ?>';
        let idMedioPago = '<?php echo json_encode($idMedioPago); ?>';
        let nombreMedioPago = '<?php echo json_encode($nombreMedioPago); ?>';
        let caja_id = '<?php echo json_encode($caja->idCaja); ?>';
    </script>
    {{ Html::script('js/maestros/cajaMedioPagoForm.js') }}
@endsection

@section('contenido')
    @if (isset($caja->idCaja))
        {!! Form::model($caja, [
            'route' => ['caja.update', $caja->idCaja],
            'method' => 'PUT',
            'id' => 'form-caja',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($caja, [
            'route' => ['caja.store', $caja->idCaja],
            'method' => 'POST',
            'id' => 'form-caja',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idCaja', null, ['id' => 'idCaja']) !!}

            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('idCaja', 'Código', ['class' => 'control-label required']) !!}
                        {!! Form::text('idCaja', $caja->idCaja, ['class' => 'form-control', 'placeholder' => 'Ingresa el Código']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('nombreCaja', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreCaja', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('usuario_id', 'Usuario', ['class' => 'control-label required']) !!}
                        {!! Form::select('usuario_id', $usuario, isset($usuario->idUsuario) ? $caja->usuario_id : null, [
                            'class' => 'chosen-select form-control',
                            'placeholder' => 'Seleccione el usuario',
                        ]) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('estadoCaja', 'Estado', ['class' => 'control-label']) !!}
                        {!! Form::text('estadoCaja', null, [
                            'readonly' => 'readonly',
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el estado',
                        ]) !!}
                    </div>
        </div>
                        </div>
        <div class="card border-left-info shadow h-100 py-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" id="active-tab" href="#" onclick="showForm('form1', 'name1')">Medios de pago</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="link-tab" href="#" onclick="showForm('form2', 'name2')">Control</a>
                </li>
            </ul>

            <div id="form1">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="eliminarCajaMedioPago" id="eliminarCajaMedioPago" />
                        <div class="div card-body multi-max">
                            <table class="table table-hover table-borderless table-sm">
                                <thead class="bg-info text-light">
                                    <tr>
                                        <th>
                                            <button class="btn btn-info btn-sm" onclick="configuracionCajaMedioPago.agregarCampos([], 'L');">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </th>
                                        <th>Nombre</th>
                                    </tr>
                                </thead>
                                <tbody id="contenedorCajaMedioPago"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="form2" style="display: none;">
    <div class="card-body">
        <div class="row">
            <input type="hidden" name="eliminarCajaMedioPago" id="eliminarCajaMedioPago" />
            <div class="div card-body multi-max">
                <table class="table table-hover table-borderless table-sm">
                    <thead class="bg-info text-light">
                        <tr>
                            <th>Usuario</th>
                            <th>Base</th>
                            <th>Apertura</th>
                            <th>Cierre</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="contenedorRolOpcion">
                        @foreach ($caja_control as $caja_controlreg)
                        <tr>
                            <td>{{ $caja_controlreg->usuario_id }}</td>
                            <td>{{ $caja_controlreg->baseCajaControl }}</td>
                            <td>{{ $caja_controlreg->fechaAperturaCajaControl }}</td>
                            <td>{{ $caja_controlreg->fechaCierreCajaControl }}</td>
                            <td>{{ $caja_controlreg->entregadoCajaControl }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
            @if (isset($caja->idCaja))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-success', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("maestros", "caja")',
            ]) !!}
            {!! Form::close() !!}
       
    </div>
@endsection
