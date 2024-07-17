@extends('layouts.principal')
@section('nombreModulo')
    Usuarios
@stop
@section('scripts')
    <script>
        let idRol = '<?php echo json_encode($idRol); ?>';
        let nombreRol = '<?php echo json_encode($nombreRol); ?>';
        let idCompania = '<?php echo json_encode($idCompania); ?>';
        let nombreCompania = '<?php echo json_encode($nombreCompania); ?>';
        let usuarioCompaniaRol = '<?php echo json_encode($usuarioCompaniaRol); ?>';
    </script>
    {{ Html::script('js/seguridad/usuarioForm.js') }}
@endsection
@section('contenido')
    @if (isset($usuario->idUsuario))
        {!! Form::model($usuario, [
            'route' => ['usuario.update', $usuario->idUsuario],
            'method' => 'PUT',
            'id' => 'form-usuario',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($usuario, [
            'route' => ['usuario.store', $usuario->idUsuario],
            'method' => 'POST',
            'id' => 'form-usuario',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idUsuario', null, ['id' => 'idUsuario']) !!}
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('loginUsuario', 'Nombre de usuario', ['class' => 'control-label required']) !!}
                        {!! Form::text('loginUsuario', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el nombre de usuario',
                        ]) !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('password', 'Contraseña', ['class' => 'control-label required']) !!}
                        {!! Form::password('password', [
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa una contraseña',
                            'autocomplete' => 'off',
                        ]) !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('estadoUsuario', 'Estado', ['class' => 'control-label']) !!}
                        {!! Form::text('estadoUsuario', null, [
                            'readonly' => 'readonly',
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el estado',
                        ]) !!}
                    </div>
                </div>
            </div>

            <h5 class="h5 mb-2 text-gray-800">Permisos</h5>
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="eliminarUsuarioCompaniaRolId" id="eliminarUsuarioCompaniaRolId" />
                        <div class="div card-body multi-max">
                            <table class="table table-hover table-borderless table-sm">
                                <thead class="bg-info text-light">
                                    <tr>
                                        <th>
                                            <button class="btn btn-info btn-sm"
                                                onclick="configuracionUsuarioCompaniaRol.agregarCampos([], 'L');">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </th>
                                        <th class="required text-center">Rol</th>
                                        <th class="required text-center">Compania</th>
                                    </tr>
                                </thead>
                                <tbody id="contenedorUsuarioCompaniaRol"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            @if (isset($usuario->idUsuario))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-info', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("seguridad", "usuario")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
