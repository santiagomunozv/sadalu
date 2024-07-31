@extends('layouts.principal')
@section('nombreModulo')
    Unidades de Medida
@stop
@section('scripts')
    {{ Html::script('js/maestros/unidadMedidaForm.js') }}
@endsection
@section('contenido')
    @if (isset($unidadmedida->idUnidadMedida))
        {!! Form::model($unidadmedida, [
            'route' => ['unidadmedida.update', $unidadmedida->idUnidadMedida],
            'method' => 'PUT',
            'id' => 'form-unidadmedida',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($unidadmedida, [
            'route' => ['unidadmedida.store', $unidadmedida->idUnidadMedida],
            'method' => 'POST',
            'id' => 'form-unidadmedida',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idUnidadMedida', null, ['id' => 'idUnidadMedida']) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('nombreUnidadMedida', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreUnidadMedida', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('codigoDianUnidadMedida', 'Codigo DIAN', ['class' => 'control-label required']) !!}
                        {!! Form::text('codigoDianUnidadMedida', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Codigo']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('simboloUnidadMedida', 'Simbolo', ['class' => 'control-label required']) !!}
                        {!! Form::text('simboloUnidadMedida', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Simbolo']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('estadoUnidadMedida', 'Estado', ['class' => 'control-label']) !!}
                        {!! Form::text('estadoUnidadMedida', null, [
                            'readonly' => 'readonly',
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el estado',
                        ]) !!}
                    </div>
                </div>
            </div>
            @if (isset($unidadmedida->idUnidadMedida))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-info', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("maestros", "unidadmedida")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
