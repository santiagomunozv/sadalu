@extends('layouts.principal')
@section('nombreModulo')
    Compañías
@stop
@section('scripts')
    {{ Html::script('js/seguridad/companiaForm.js') }}
@endsection
@section('contenido')
    @if (isset($compania->idCompania))
        {!! Form::model($compania, [
            'route' => ['compania.update', $compania->idCompania],
            'method' => 'PUT',
            'id' => 'form-compania',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($compania, [
            'route' => ['compania.store', $compania->idCompania],
            'method' => 'POST',
            'id' => 'form-compania',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idCompania', null, ['id' => 'idCompania']) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('nombreCompania', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreCompania', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('estadoCompania', 'Estado', ['class' => 'control-label']) !!}
                        {!! Form::text('estadoCompania', null, [
                            'readonly' => 'readonly',
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el estado',
                        ]) !!}
                    </div>
                </div>
            </div>
            @if (isset($compania->idCompania))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-info', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("seguridad", "compania")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
