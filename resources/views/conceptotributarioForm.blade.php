@extends('layouts.principal')
@section('nombreModulo')
    Conceptos Tributarios
@stop
@section('scripts')
    {{ Html::script('js/maestros/conceptotributarioForm.js') }}
@endsection
@section('contenido')
    @if (isset($conceptotributario->idConceptoTributario))
        {!! Form::model($conceptotributario, [
            'route' => ['conceptotributario.update', $conceptotributario->idConceptoTributario],
            'method' => 'PUT',
            'id' => 'form-conceptotributario',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($conceptotributario, [
            'route' => ['conceptotributario.store', $conceptotributario->idConceptoTributario],
            'method' => 'POST',
            'id' => 'form-conceptotributario',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idConceptoTributario', null, ['id' => 'idConceptoTributario']) !!}
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('nombreConceptoTributario', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreConceptoTributario', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Nombre']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('grupoConceptoTributario', 'Grupo', ['class' => 'control-label required']) !!}
                        {!! Form::select('grupoConceptoTributario', ['Iva' => 'IVA', 'Retelva' => 'Retelva', 'Impoconsumo' => 'Impoconsumo', 'Estanpilla' => 'Estampilla', 'Ultraprocesados' => 'Ultraprocesados'], null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('tipoConceptoTributario', 'Tipo', ['class' => 'control-label required']) !!}
                        {!! Form::select('tipoConceptoTributario', ['Porcentaje' => 'Porcentaje', 'Valor' => 'Valor'], null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('operacionConceptoTributario', 'Operacion', ['class' => 'control-label required']) !!}
                        {!! Form::select('operacionConceptoTributario', ['Suma' => 'Suma', 'Resta' => 'Resta'], null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('operadorConceptoTributario', 'Operador', ['class' => 'control-label required']) !!}
                        {!! Form::select('operadorConceptoTributario', ['Menorque' => 'Menor que', 'Mayorque' => 'Mayor que', 'Menoroigual'=>'Menor o igual', 'Mayorigual'=>'Mayor o igual', 'igual'=>'Igual que', 'Diferente'=>'Diferente que'], null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        {!! Form::label('baseConceptoTributario', 'Base', ['class' => 'control-label required']) !!}
                        {!! Form::number('baseConceptoTributario', null, ['class' => 'form-control', 'placeholder' => 'Ingresa la Base']) !!}
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        {!! Form::label('tarifaConceptoTributario', 'Tarifa', ['class' => 'control-label required']) !!}
                        {!! Form::number('tarifaConceptoTributario', null, ['class' => 'form-control', 'placeholder' => 'Ingresa la Tarifa']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('codigoDianConceptoTributario', 'Codigo', ['class' => 'control-label required']) !!}
                        {!! Form::text('codigoDianConceptoTributario', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Codigo']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('nombreDianConceptoTributario', 'Codigo DIAN', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreDianConceptoTributario', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Codigo DIAN']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('estadoConceptoTributario', 'Estado', ['class' => 'control-label']) !!}
                        {!! Form::text('estadoConceptoTributario', null, [
                            'readonly' => 'readonly',
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el Estado',
                        ]) !!}
                    </div>
                </div>
            </div>
            @if (isset($mediopago->idConceptoTributario))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-info', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("maestros", "conceptotributario")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
