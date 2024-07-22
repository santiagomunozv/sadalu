@extends('layouts.principal')
@section('nombreModulo')
    Paises
@stop
@section('scripts')
    {{ Html::script('js/maestros/paisForm.js') }}
@endsection
@section('contenido')
    @if (isset($pais->idPais))
        {!! Form::model($pais, [
            'route' => ['paises.update', $pais->idPais],
            'method' => 'PUT',
            'id' => 'form-paises',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($pais, [
            'route' => 'paises.store',
            'method' => 'POST',
            'id' => 'form-paises',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idPais', null, ['id' => 'idPais']) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('codigoPais', 'Codigo', ['class' => 'control-label required']) !!}
                        {!! Form::text('codigoPais', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el codigo']) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('nombrePais', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombrePais', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre']) !!}
                    </div>
                </div>
                {{--
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
                --}}
            </div>
            @if (isset($pais->idPais))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-info', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("maestros", "paises")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
