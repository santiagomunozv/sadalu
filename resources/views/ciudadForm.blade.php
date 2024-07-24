@extends('layouts.principal')

@section('nombreDepartamento')
    Ciudades
@stop

@section('scripts')
    {{ Html::script('js/maestros/ciudadForm.js') }}
@endsection

@section('contenido')
    @if (isset($ciudad->idCiudad))
        {!! Form::model($ciudad, [
            'route' => ['ciudad.update', $ciudad->idCiudad],
            'method' => 'PUT',
            'id' => 'form-ciudad',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($ciudad, [
            'route' => ['ciudad.store', $ciudad->idCiudad],
            'method' => 'POST',
            'id' => 'form-ciudad',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idCiudad', null, ['id' => 'idCiudad']) !!}

            <div class="row">

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('codigoCiudad', 'Codigo', ['class' => 'control-label required']) !!}
                        {!! Form::text('codigoCiudad', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Codigo de la Ciudad']) !!}
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('nombreCiudad', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreCiudad', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Nombre de la Ciudad']) !!}
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('departamento_id', 'Departamento', ['class' => 'control-label required']) !!}
                        {!! Form::select('departamento_id', $departamento, isset($ciudad->idCiudad) ? $ciudad->departamento_id : null, [
                            'class' => 'chosen-select form-control',
                            'placeholder' => 'Seleccione el Departamento',
                        ]) !!}
                    </div>
                </div>

            </div>
            @if (isset($C->idCiudad))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-success', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("maestros", "ciudad")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
