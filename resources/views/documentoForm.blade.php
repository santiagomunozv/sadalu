@extends('layouts.principal')

@section('nombreDepartamento')
    Documentos
@stop

@section('scripts')
    <script>
        let documentoCodigo = '<?php echo json_encode($documentoCodigo); ?>';
        let idEtiqueta = '<?php echo json_encode($idEtiqueta); ?>';
        let nombreEtiqueta = '<?php echo json_encode($nombreEtiqueta); ?>';
        let documentoLeyenda = '<?php echo json_encode($documentoLeyenda); ?>';
    </script>
    {{ Html::script('js/maestros/documentoForm.js') }}
@endsection

@section('contenido')
    @if (isset($documento->idDocumento))
        {!! Form::model($documento, [
            'route' => ['ciudad.update', $documento->idDocumento],
            'method' => 'PUT',
            'id' => 'form-documento',
            'onsubmit' => 'return false;',
        ]) !!}
    @else
        {!! Form::model($documento, [
            'route' => ['documento.store', $documento->idDocumento],
            'method' => 'POST',
            'id' => 'form-documento',
            'onsubmit' => 'return false;',
        ]) !!}
    @endif
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

            {!! Form::hidden('idDocumento', null, ['id' => 'idDocumento']) !!}

            <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('nombreDocumento', 'Nombre', ['class' => 'control-label required']) !!}
                        {!! Form::text('nombreDocumento', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre del documento']) !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('tipoDocumento', 'Tipo', ['class' => 'control-label required']) !!}
                        {!! Form::select('tipoDocumento', ['POS' => 'POS', 'Nota crédito POS' => 'Nota crédito POS', 'Nota débito POS' => 'Nota débito POS',
                        ], null, ['class' => 'form-control', 'placeholder' => 'Seleccione el tipo de documento']) !!}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('consecutivo_id', 'Consecutivo', ['class' => 'control-label required']) !!}
                        {!! Form::select('consecutivo_id', $consecutivo, isset($documento->idDocumento) ? $documento->consecutivo_id : null, [
                            'class' => 'chosen-select form-control',
                            'placeholder' => 'Seleccione el consecutivo',
                        ]) !!}
                    </div>
                </div>
        </div>
        <div class="card border-left-info shadow h-100 py-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" id="active-tab" href="#" onclick="showForm('form1', 'name1')">Codigo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="link-tab" href="#" onclick="showForm('form2', 'name2')">Leyenda</a>
                </li>
            </ul>

            <div id="form1">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="eliminarDocumentoCodigo" id="eliminarDocumentoCodigo" />
                        <div class="div card-body multi-max">
                            <table class="table table-hover table-borderless table-sm">
                                <thead class="bg-info text-light">
                                    <tr>
                                        <th>
                                            <button class="btn btn-info btn-sm"
                                                onclick="configuracionDocumento.agregarCampos([], 'L');">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </th>
                                        <th>Codigo</th>
                                        <th>Etiqueta</th>
                                    </tr>
                                </thead>
                                <tbody id="contenedorDocumento"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="form2" style="display: none;">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="eliminarLeyendaId" id="eliminarLeyendaId" />
                        <div class="div card-body multi-max">
                            <table class="table table-hover table-borderless table-sm">
                                <thead class="bg-info text-light">
                                    <tr>
                                        <th>
                                            <button class="btn btn-info btn-sm" onclick="configuracionDocumentoLeyenda.agregarCampos([], 'L');">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </th>
                                        <th>Posicion</th>
                                        <th>Mensaje</th>
                                    </tr>
                                </thead>
                                <tbody id="contenedorDocuemntoLeyenda"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @if (isset($documento->idDocumento))
                {!! Form::button('Modificar', ['type' => 'button', 'class' => 'btn btn-primary', 'onclick' => 'grabar()']) !!}
            @else
                {!! Form::button('Adicionar', ['type' => 'button', 'class' => 'btn btn-success', 'onclick' => 'grabar()']) !!}
            @endif
            {!! Form::button('Cancelar', [
                'type' => 'button',
                'class' => 'btn btn-secondary',
                'onclick' => 'retornarToGrid("maestros", "documento")',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
