@extends('layouts.principal')
@section('nombreModulo')
    Tipo de Producto
@stop
@section('scripts')
    {{ Html::script('js/maestros/tipoproductoForm.js') }}
@endsection
@section('contenido')
    @if (isset($tipoproducto->idTipoProducto))
        {!! Form::model($tipoproducto, [
            'route' => ['tipoproducto.update', $tipoproducto->idTipoProducto],
            'method' => 'PUT',
            'id' => 'form-tipoproducto',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($tipoproducto, [
            'route' => ['tipoproducto.store', $tipoproducto->idTipoProducto],
            'method' => 'POST',
            'id' => 'form-tipoproducto',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idTipoProducto', null, ['id' => 'idTipoProducto']) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('nombreTipoProducto', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreTipoProducto', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('estadoTipoProducto', 'Estado', ['class' => 'control-label']) !!}
                        {!! Form::text('estadoTipoProducto', null, [
                            'readonly' => 'readonly',
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el estado',
                        ]) !!}
                    </div>
                </div>
            </div>
            @if (isset($tipoproducto->idTipoProducto))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-info', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("maestros", "tipoproducto")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
