@extends('layouts.principal')
@section('nombreModulo')
    Medios de Pago
@stop
@section('scripts')
    {{ Html::script('js/maestros/medioPagoForm.js') }}
@endsection
@section('contenido')
    @if (isset($mediopago->idMedioPago))
        {!! Form::model($mediopago, [
            'route' => ['mediopago.update', $mediopago->idMedioPago],
            'method' => 'PUT',
            'id' => 'form-mediopago',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($mediopago, [
            'route' => ['mediopago.store', $mediopago->idMedioPago],
            'method' => 'POST',
            'id' => 'form-mediopago',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idMedioPago', null, ['id' => 'idMedioPago']) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('codigoDianMedioPago', 'Codigo DIAN', ['class' => 'control-label required']) !!}
                        {!! Form::text('codigoDianMedioPago', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Codigo']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('nombreMedioPago', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreMedioPago', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('estadoMedioPago', 'Estado', ['class' => 'control-label']) !!}
                        {!! Form::text('estadoMedioPago', null, [
                            'readonly' => 'readonly',
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el Estado',
                        ]) !!}
                    </div>
                </div>
            </div>
            @if (isset($mediopago->idMedioPago))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-info', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("maestros", "mediopago")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
