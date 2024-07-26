@extends('layouts.principal')
@section('nombreModulo')
    Tipos de Identificaciones
@stop
@section('scripts')
    {{ Html::script('js/maestros/tipoIdentificacionForm.js') }}
@endsection
@section('contenido')
    @if (isset($tipoidentificacion->idTipoIdentificacion))
        {!! Form::model($tipoidentificacion, [
            'route' => ['tipoidentificacion.update', $tipoidentificacion->idTipoIdentificacion],
            'method' => 'PUT',
            'id' => 'form-tipoidentificacion',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($tipoidentificacion, [
            'route' => ['tipoidentificacion.store', $tipoidentificacion->idTipoIdentificacion],
            'method' => 'POST',
            'id' => 'form-tipoidentificacion',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idTipoIdentificacion', null, ['id' => 'idTipoIdentificacion']) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('codigoDianTipoIdentificacion', 'Codigo', ['class' => 'control-label required']) !!}
                        {!! Form::text('codigoDianTipoIdentificacion', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el codigo']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('nombreTipoIdentificacion', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreTipoIdentificacion', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('estadoTipoIdentificacion', 'Estado', ['class' => 'control-label']) !!}
                        {!! Form::text('estadoTipoIdentificacion', null, [
                            'readonly' => 'readonly',
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el estado',
                        ]) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('requiereDigitoVerificationTipoIdentificacion', 'Requiere digito verificacion', ['class' => 'control-label required']) !!}
                        <div class="form-check">
                            {!! Form::checkbox('requiereDigitoVerificationTipoIdentificacion', true, false, ['class' => 'form-check-input', 'id' => 'activo']) !!}
                            {!! Form::label('activo', 'Activo', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('requiereRazonSocialTipoIdentificacion', 'Requiere razon social', ['class' => 'control-label required']) !!}
                            <div class="form-check">
                                {!! Form::checkbox('requiereRazonSocialTipoIdentificacion', true, false, ['class' => 'form-check-input', 'id' => 'activo']) !!}
                                {!! Form::label('activo', 'Activo', ['class' => 'form-check-label']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($tipoidentificacion->idTipoIdentificacion))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-info', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("maestros", "tipoidentificacion")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
