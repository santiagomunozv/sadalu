@extends('layouts.principal')

@section('nombreModulo')
    Consecutivos
@stop

@section('scripts')
    {{ Html::script('js/seguridad/consecutivoForm.js') }}
@endsection
@section('contenido')
    @if (isset($consecutivo->idConsecutivo))
        {!! Form::model($consecutivo, [
            'route' => ['consecutivos.update', $consecutivo->idConsecutivo],
            'method' => 'PUT',
            'id' => 'form-consecutivos',
            'onsubmit' => 'return false;',
        ]) !!}
        @else
        {!! Form::model($consecutivo, [
            'route' => ['consecutivos.store'],
            'method' => 'POST',
            'id' => 'form-consecutivos',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
        <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idConsecutivo', null, ['id' => 'idConsecutivo']) !!}


            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('numeroConsecutivo', 'Consecutivo', ['class' => 'control-label required']) !!}
                        {!! Form::text('numeroConsecutivo', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el consecutivo']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('nombreConsecutivo', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreConsecutivo', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('tipoConsecutivo', 'Tipo', ['class' => 'control-label required']) !!}
                        {!! Form::select('tipoConsecutivo', [
                            'POS' => 'POS',
                            'Nota crédito POS' => 'Nota crédito POS',
                            'Nota débito POS' => 'Nota débito POS'
                        ], null, ['class' => 'form-control', 'placeholder' => 'Selecciona el tipo']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('estadoConsecutivo', 'Estado', ['class' => 'control-label']) !!}
                        {!! Form::text('estadoConsecutivo', 'Activo', [
                            'readonly' => 'readonly',
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el estado',
                        ]) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('resolucionConsecutivo', 'Número de resolución', ['class' => 'control-label']) !!}
                        {!! Form::text('resolucionConsecutivo', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el número de la resolución']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('prefijoConsecutivo', 'Prefijo', ['class' => 'control-label']) !!}
                        {!! Form::text('prefijoConsecutivo', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el prefijo']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('fechaInicioConsecutivo', 'Fecha de inicio', ['class' => 'control-label']) !!}
                        {!! Form::date('fechaInicioConsecutivo', null, ['class' => 'form-control', 'placeholder' => 'Ingresa la fecha de inicio']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('fechaFinConsecutivo', 'Fecha final', ['class' => 'control-label']) !!}
                        {!! Form::date('fechaFinConsecutivo', null, ['class' => 'form-control', 'placeholder' => 'Ingresa la fecha de finalización']) !!}
                    </div>
                </div> 

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('numeroInicioConsecutivo', 'Consecutivo inicial', ['class' => 'control-label']) !!}
                        {!! Form::text('numeroInicioConsecutivo', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el consecutivo inicial']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('numeroFinConsecutivo', 'Consecutivo final', ['class' => 'control-label']) !!}
                        {!! Form::text('numeroFinConsecutivo', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el consecutivo final']) !!}
                    </div>
                </div>
                
            </div>
            @if (isset($consecutivo->idConsecutivo))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-info', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("maestros", "consecutivos")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
