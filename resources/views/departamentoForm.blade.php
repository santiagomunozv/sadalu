@extends('layouts.principal')

@section('nombreDepartamento')
    Departamentos
@stop

@section('scripts')
    {{ Html::script('js/maestros/departamentoForm.js') }}
@endsection

@section('contenido')
    @if (isset($departamento->idDepartamento))
        {!! Form::model($departamento, [
            'route' => ['departamento.update', $departamento->idDepartamento],
            'method' => 'PUT',
            'id' => 'form-departamento',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($departamento, [
            'route' => ['departamento.store', $departamento->idDepartamento],
            'method' => 'POST',
            'id' => 'form-departamento',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idDepartamento', null, ['id' => 'idDepartamento']) !!}

            <div class="row">

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('codigoDepartamento', 'Codigo', ['class' => 'control-label required']) !!}
                        {!! Form::text('codigoDepartamento', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Codigo']) !!}
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('nombreDepartamento', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreDepartamento', null, ['class' => 'form-control', 'placeholder' => 'Ingresa Nombre del Departamento']) !!}
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('pais_id', 'Pais', ['class' => 'control-label required']) !!}
                        {!! Form::select('pais_id', $pais, isset($departamento->idDepartamento) ? $departamento->pais_id : null, [
                            'class' => 'chosen-select form-control',
                            'placeholder' => 'Seleccione el Pais',
                        ]) !!}
                    </div>
                </div>

            </div>
            @if (isset($C->idDepartamento))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-success', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("maestros", "departamento")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
