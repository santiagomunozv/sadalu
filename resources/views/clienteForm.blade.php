@extends('layouts.principal')

@section('nombreModulo')
    Clientes
@stop

@section('scripts')
<script>
    // Acá los asigno a una variable javascript para poder acceder a ellos desde el js,
    // se puede asignar ya que en el blade mediante la etiqueta script se puede escribir código js
    let tipoIdentificacion = '<?php echo $tiposIdentificaciones; ?>';
</script>
    {{ Html::script('js/maestros/clienteForm.js') }}
@endsection

@section('contenido')
    @if (isset($cliente->idCliente))
        {!! Form::model($cliente, [
            'route' => ['cliente.update', $cliente->idCliente],
            'method' => 'PUT',
            'id' => 'form-cliente',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($cliente, [
            'route' => ['cliente.store', $cliente->idCliente],
            'method' => 'POST',
            'id' => 'form-cliente',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idCliente', null, ['id' => 'idCliente']) !!}

            {!! Form::hidden('requiereRazonSocial', null, ['id' => 'requiereRazonSocial']) !!}


            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('tipoidentificacion_id', 'Tipo de identificación', ['class' => 'control-label required']) !!}
                        {!! Form::select('tipoidentificacion_id', $tipoidentificacion, isset($cliente->idCliente) ? $cliente->tipoidentificacion_id : null,
                        [
                            'class' => 'chosen-select form-control',
                            'onchange' => 'toggleFields(this.value)',
                            'placeholder' => 'Seleccione el tipo de identificación'
                        ]) !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('identificacionCliente', 'Identificación', ['class' => 'control-label required']) !!}
                        {!! Form::number('identificacionCliente', null, ['class' => 'form-control', 'onchange' => 'CalcularDv()', 'placeholder' => 'Ingresa la identificación']) !!}
                    </div>
                </div>

                <div class="col-sm-1">
                    <div class="form-group">
                        {!! Form::label('digitoVerificacionCliente', 'DV', ['class' => 'control-label required']) !!}
                        {!! Form::text('digitoVerificacionCliente', null, ['class' => 'form-control', 'readonly']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('razonSocialCliente', 'Razón social', ['class' => 'control-label required']) !!}
                        {!! Form::text('razonSocialCliente', null, ['class' => 'form-control', 'placeholder' => 'Ingresa la razón social', 'id' => 'razonSocialCliente']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('nombreComercialCliente', 'Nombre comercial', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreComercialCliente', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre comercial', 'id' => 'nombreComercialCliente']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('primerNombreCliente', 'Primer nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('primerNombreCliente', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el primer nombre', 'id' => 'primerNombreCliente']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('segundoNombreCliente', 'Segundo nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('segundoNombreCliente', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el segundo nombre', 'id' => 'segundoNombreCliente']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('primerApellidoCliente', 'Primer apellido', ['class' => 'control-label required']) !!}
                        {!! Form::text('primerApellidoCliente', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el primer apellido', 'id' => 'primerApellidoCliente']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('segundoApellidoCliente', 'Segundo apellido', ['class' => 'control-label required']) !!}
                        {!! Form::text('segundoApellidoCliente', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el segundo apellido', 'id' => 'segundoApellidoCliente']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('telefonoCliente', 'Teléfono', ['class' => 'control-label required']) !!}
                        {!! Form::number('telefonoCliente', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el número de teléfono']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('celularCliente', 'Celular', ['class' => 'control-label required']) !!}
                        {!! Form::number('celularCliente', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el número de celular']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('emailCliente', 'Email', ['class' => 'control-label required']) !!}
                        {!! Form::email('emailCliente', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el correo']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('ciudad_id', 'Ciudad', ['class' => 'control-label required']) !!}
                        {!! Form::select('ciudad_id', $ciudad, isset($cliente->idCliente) ? $cliente->ciudad_id : null, [
                            'class' => 'chosen-select form-control',
                            'placeholder' => 'Seleccione la ciudad',
                        ]) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('direccionCliente', 'Dirección', ['class' => 'control-label required']) !!}
                        {!! Form::text('direccionCliente', null, ['class' => 'form-control', 'placeholder' => 'Ingresa la dirección']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('codigoPostalCliente', 'Código postal', ['class' => 'control-label required']) !!}
                        {!! Form::text('codigoPostalCliente', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el código postal']) !!}
                    </div>
                </div>
            </div>

            @if (isset($C->idCliente))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-success', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("maestros", "cliente")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
