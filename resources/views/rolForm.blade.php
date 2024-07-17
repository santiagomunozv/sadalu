@extends('layouts.principal')
@section('nombreModulo')
    Roles
@stop
@section('scripts')
    <script>
        let rolOpcion = '<?php echo json_encode($rolOpcion); ?>';
        let idOpcion = '<?php echo json_encode($idOpcion); ?>';
        let nombreOpcion = '<?php echo json_encode($nombreOpcion); ?>';
    </script>
    {{ Html::script('js/seguridad/rolForm.js') }}
@endsection
@section('contenido')
    @if (isset($rol->idRol))
        {!! Form::model($rol, [
            'route' => ['rol.update', $rol->idRol],
            'method' => 'PUT',
            'id' => 'form-rol',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($rol, [
            'route' => ['rol.store', $rol->idRol],
            'method' => 'POST',
            'id' => 'form-rol',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idRol', null, ['id' => 'idRol']) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('nombreRol', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreRol', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('estadoRol', 'Estado', ['class' => 'control-label']) !!}
                        {!! Form::text('estadoRol', null, [
                            'readonly' => 'readonly',
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el estado',
                        ]) !!}
                    </div>
                </div>
            </div>

            <h5 class="h5 mb-2 text-gray-800">Asignación de permisos</h5>
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="eliminarRolOpcionId" id="eliminarRolOpcionId" />
                        <div class="div card-body multi-max">
                            <table class="table table-hover table-borderless table-sm">
                                <thead class="bg-info text-light">
                                    <tr>
                                        <th>
                                            <button class="btn btn-info btn-sm"
                                                onclick="configuracionRolOpcion.agregarCampos([], 'L');">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </th>
                                        <th class="required">Opción</th>
                                        <th>Adicionar</th>
                                        <th>Modificar</th>
                                        <th>Eliminar</th>
                                        <th>Consultar</th>
                                        <th>Inactivar</th>
                                    </tr>
                                </thead>
                                <tbody id="contenedorRolOpcion"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            @if (isset($rol->idRol))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-info', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("seguridad", "rol")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
