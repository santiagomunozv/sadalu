@extends('layouts.principal')

@section('nombreModulo')
    Opciones
@stop

@section('scripts')
    {{ Html::script('js/seguridad/opcionForm.js') }}
@endsection

@section('contenido')
    @if (isset($opcion->idOpcion))
        {!! Form::model($opcion, [
            'route' => ['opcion.update', $opcion->idOpcion],
            'method' => 'PUT',
            'id' => 'form-opcion',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($opcion, [
            'route' => ['opcion.store', $opcion->idOpcion],
            'method' => 'POST',
            'id' => 'form-opcion',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idOpcion', null, ['id' => 'idOpcion']) !!}

            <div class="row">

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('nombreOpcion', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreOpcion', null, ['class' => 'form-control', 'placeholder' => 'Ingresa Nombre del Módulo']) !!}
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('modulo_id', 'Modulo', ['class' => 'control-label required']) !!}
                        {!! Form::select('modulo_id', $modulo, isset($opcion->idOpcion) ? $opcion->modulo_id : null, [
                            'class' => 'chosen-select form-control',
                            'placeholder' => 'Seleccione el Modulo',
                        ]) !!}
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('rutaOpcion', 'Ruta', ['class' => 'control-label required']) !!}
                        {!! Form::text('rutaOpcion', null, ['class' => 'form-control', 'placeholder' => 'Ingresa la Ruta']) !!}
                    </div>
                </div>

            </div>
            @if (isset($opcion->idOpcion))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-success', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("seguridad", "opcion")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
