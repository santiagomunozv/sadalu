@extends('layouts.principal')

@section('nombreModulo')
    Clientes
@stop

@section('scripts')
    <script type="text/javascript">
        $(function() {
            configurarDataTable("cliente-table");
        });
    </script>
@endsection

@section('contenido')
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="table-responsive">
                <table id="cliente-table" class="table table-hover table-sm sadalu-grid">
                    <thead class="bg-info text-light">
                        <tr>
                            <th style="width: 150px;" data-orderable="false">
                                @if ($permisos['adicionarRolOpcion'])
                                    <a class="btn btn-info btn-sm text-light" href="{!! URL::to('/maestros/cliente', ['create']) !!}">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                @endif
                                <button id="btnLimpiarFiltros" class="btn btn-info btn-sm text-light">
                                    <i class="fas fa-broom"></i>
                                </button>
                                <button id="btnRecargar" class="btn btn-info btn-sm text-light">
                                    <i class="fas fa-redo-alt"></i>
                                </button>
                            </th>
                            <th>Id</th>
                            <th>Tipo de documento</th>
                            <th>Identificación</th>
                            <th>DV</th>
                            <th>Razón social</th>
                            <th>Nombre comercial</th>
                            <th>Primer nombre</th>
                            <th>Segundo nombre</th>
                            <th>Primer apellido</th>
                            <th>Segundo apellido</th>
                            <th>Telefono</th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>Ciudad</th>
                            <th>Dirección</th>
                            <th>Código postal</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cliente as $clientereg)
                            <tr>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        @if ($permisos['modificarRolOpcion'])
                                            <a class="btn btn-success btn-sm" href="{!! URL::to('/maestros/cliente', [$clientereg->idCliente, 'edit']) !!}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endif
                                        @if ($permisos['eliminarRolOpcion'])
                                            <button type="button"
                                                onclick="confirmarEliminacion('{{ $clientereg->idCliente }}', 'cliente', 'Cliente')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $clientereg->idCliente }}</td>
                                <td>{{ $clientereg->nombreTipoIdentificacion }}</td>
                                <td>{{ $clientereg->identificacionCliente}}</td>
                                <td>{{ $clientereg->digitoVerificacionCliente }}</td>
                                <td>{{ $clientereg->razonSocialCliente }}</td>
                                <td>{{ $clientereg->nombreComercialCliente }}</td>
                                <td>{{ $clientereg->primerNombreCliente }}</td>
                                <td>{{ $clientereg->segundoNombreCliente }}</td>
                                <td>{{ $clientereg->primerApellidoCliente }}</td>
                                <td>{{ $clientereg->segundoApellidoCliente }}</td>
                                <td>{{ $clientereg->telefonoCliente }}</td>
                                <td>{{ $clientereg->celularCliente }}</td>
                                <td>{{ $clientereg->emailCliente }}</td>
                                <td>{{ $clientereg->nombreCiudad }}</td>
                                <td>{{ $clientereg->direccionCliente }}</td>
                                <td>{{ $clientereg->codigoPostalCliente }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Tipo de documento</th>
                            <th>Identificación</th>
                            <th>DV</th>
                            <th>Razón social</th>
                            <th>Nombre comercial</th>
                            <th>Primer nombre</th>
                            <th>Segundo nombre</th>
                            <th>Primer apellido</th>
                            <th>Segundo apellido</th>
                            <th>Telefono</th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>Ciudad</th>
                            <th>Dirección</th>
                            <th>Código postal</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
