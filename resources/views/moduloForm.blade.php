@extends('layouts.principal')

@section('nombreModulo')
    Modulos
@stop

@section('scripts')
    {{ Html::script('js/seguridad/moduloForm.js') }}
@endsection

@section('contenido')
    @if (isset($modulo->idModulo))
        {!! Form::model($modulo, [
            'route' => ['modulo.update', $modulo->idModulo],
            'method' => 'PUT',
            'id' => 'form-modulo',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($modulo, [
            'route' => ['modulo.store', $modulo->idModulo],
            'method' => 'POST',
            'id' => 'form-modulo',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idModulo', null, ['id' => 'idModulo']) !!}

            <div class="row">

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('nombreModulo', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreModulo', null, ['class' => 'form-control', 'placeholder' => 'Ingresa Nombre del Módulo']) !!}
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('paquete_id', 'Paquete', ['class' => 'control-label required']) !!}
                        {!! Form::select('paquete_id', $paquete, isset($modulo->idModulo) ? $modulo->paquete_id : null, [
                            'class' => 'chosen-select form-control',
                            'placeholder' => 'Seleccione el Paquete',
                        ]) !!}
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('iconoModulo', 'Icono', ['class' => 'control-label required']) !!}
                        {!! Form::text('iconoModulo', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Icono']) !!}
                    </div>
                </div>

            </div>
            @if (isset($modulo->idModulo))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-success', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("seguridad", "modulo")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
