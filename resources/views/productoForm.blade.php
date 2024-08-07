@extends('layouts.principal')

@section('nombreModulo')
    Productos
@stop

@section('scripts')
    {{ Html::script('js/maestros/productoForm.js') }}
@endsection

@section('contenido')
    @if (isset($producto->idProducto))
        {!! Form::model($producto, [
            'route' => ['producto.update', $producto->idProducto],
            'method' => 'PUT',
            'id' => 'form-producto',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($producto, [
            'route' => ['producto.store', $producto->idProducto],
            'method' => 'POST',
            'id' => 'form-producto',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idProducto', null, ['id' => 'idProducto']) !!}

            <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('codigoProducto', 'Codigo', ['class' => 'control-label required']) !!}
                        {!! Form::text('codigoProducto', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Codigo']) !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('nombreProducto', 'Descripcion', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreProducto', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Nombre']) !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('eanProducto', 'Codigo EAN', ['class' => 'control-label required']) !!}
                        {!! Form::text('eanProducto', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el codigo EAN']) !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('tipoproducto_id', 'Tipo de Producto', ['class' => 'control-label required']) !!}
                        {!! Form::select('tipoproducto_id', $tipoproducto, isset($producto->idProducto) ? $producto->tipoproducto_id : null, [
                            'class' => 'chosen-select form-control',
                            'placeholder' => 'Seleccione el Producto',
                        ]) !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('marca_id', 'Marca', ['class' => 'control-label required']) !!}
                        {!! Form::select('marca_id', $marca, isset($producto->idProducto) ? $producto->marca_id : null, [
                            'class' => 'chosen-select form-control',
                            'placeholder' => 'Seleccione la Marca',
                        ]) !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('unidadmedida_id', 'Unidad de Medida', ['class' => 'control-label required']) !!}
                        {!! Form::select('unidadmedida_id', $unidadmedida, isset($producto->idProducto) ? $producto->unidadmedida_id : null, [
                            'class' => 'chosen-select form-control',
                            'placeholder' => 'Seleccione la Unidad de Medida',
                        ]) !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('imagenProducto', 'Imagen de Producto', ['class' => 'control-label required']) !!}
                        {!! Form::file('imagenProducto', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                    </div>
                </div>


                <div class="col-sm-2">
                    <div class="form-group">
                        {!! Form::label('estadoProducto', 'Estado', ['class' => 'control-label']) !!}
                        {!! Form::text('estadoProducto', null, [
                            'readonly' => 'readonly',
                            'class' => 'form-control',
                            'placeholder' => 'Ingresa el estado',
                        ]) !!}
                    </div>
                </div>

            </div>
            @if (isset($C->idProducto))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-success', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("maestros", "producto")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
