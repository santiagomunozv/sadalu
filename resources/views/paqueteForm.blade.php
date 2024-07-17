@extends('layouts.principal')

@section('nombreModulo')
    Paquetes
@stop

@section('scripts')
    {{ Html::script('js/seguridad/paqueteForm.js') }}
@endsection

@section('contenido')
    @if (isset($paquete->idPaquete))
        {!! Form::model($paquete, [
            'route' => ['paquete.update', $paquete->idPaquete],
            'method' => 'PUT',
            'id' => 'form-paquete',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($paquete, [
            'route' => ['paquete.store', $paquete->idPaquete],
            'method' => 'POST',
            'id' => 'form-paquete',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idPaquete', null, ['id' => 'idPaquete']) !!}

            <div class="row">

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('ordenPaquete', 'Orden', ['class' => 'control-label required']) !!}
                        {!! Form::number('ordenPaquete', null, ['class' => 'form-control', 'placeholder' => 'Ingresa Orden']) !!}
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('nombrePaquete', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombrePaquete', null, ['class' => 'form-control', 'placeholder' => 'Ingresa Nombre']) !!}
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('iconoPaquete', 'Icono', ['class' => 'control-label required']) !!}
                        {!! Form::text('iconoPaquete', null, ['class' => 'form-control', 'placeholder' => 'Ingresa Icono']) !!}
                    </div>
                </div>

            </div>
            @if (isset($paquete->idPaquete))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-success', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("seguridad", "paquete")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
