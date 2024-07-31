@extends('layouts.principal')
@section('nombreModulo')
    Marca
@stop
@section('scripts')
    {{ Html::script('js/maestros/marcaForm.js') }}
@endsection
@section('contenido')
    @if (isset($marca->idMarca))
        {!! Form::model($marca, [
            'route' => ['marca.update', $marca->idMarca],
            'method' => 'PUT',
            'id' => 'form-marca',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($marca, [
            'route' => ['marca.store', $marca->idMarca],
            'method' => 'POST',
            'id' => 'form-marca',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idMarca', null, ['id' => 'idMarca']) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('nombreMarca', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreMarca', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('estadoMarca', 'Estado', ['class' => 'control-label']) !!}
                        {!! Form::text('estadoMarca', null, [
                            'readonly' => 'readonly',
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el estado',
                        ]) !!}
                    </div>
                </div>
            </div>
            @if (isset($marca->idMarca))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-info', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("maestros", "marca")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
