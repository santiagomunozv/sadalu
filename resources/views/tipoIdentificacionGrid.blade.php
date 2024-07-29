@extends('layouts.principal')

@section('nombreModulo')
Tipos de Identificaciones
@stop

@section('scripts')
    <script type="text/javascript">
        $(function() {
            configurarDataTable("tipo_identificacion-table");
        });
    </script>
@endsection

@section('contenido')
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tipo_identificacion-table" class="table table-hover table-sm sadalu-grid">
                    <thead class="bg-info text-light">
                        <tr>
                            <th style="width: 150px;" data-orderable="false">
                                @if ($permisos['adicionarRolOpcion'])
                                    <a class="btn btn-info btn-sm text-light" href="{!! URL::to('/maestros/tipoidentificacion', ['create']) !!}">
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
                            <th>Codigo DIAN</th>
                            <th>Nombre</th>
                            <th>Requiere digito verificacion</th>
                            <th>Requiere razon social</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipoidentificacion as $tipoidentificacionreg)
                            <tr>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        @if ($permisos['modificarRolOpcion'])
                                            <a class="btn btn-success btn-sm" href="{!! URL::to('/maestros/tipoidentificacion', [$tipoidentificacionreg->idTipoIdentificacion, 'edit']) !!}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endif
                                        @if ($permisos['eliminarRolOpcion'])
                                            <button type="button"
                                                onclick="confirmarEliminacion('{{ $tipoidentificacionreg->idTipoIdentificacion }}', 'tipo_identificacion', 'TipoIdentificacion')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                        @if ($permisos['modificarRolOpcion'])
                                            <button class="btn btn-warning btn-sm"
                                                onclick="cambiarEstado('{{ $tipoidentificacionreg->idTipoIdentificacion }}', 'tipo_identificacion', 'TipoIdentificacion','{{ $tipoidentificacionreg->estadoTipoIdentificacion }}')">
                                                <i class="fas fa-power-off"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $tipoidentificacionreg->idTipoIdentificacion }}</td>
                                <td>{{ $tipoidentificacionreg->codigoDianTipoIdentificacion }}</td>
                                <td>{{ $tipoidentificacionreg->nombreTipoIdentificacion }}</td>
                                <td>{{ $tipoidentificacionreg->requiereDigitoVerificationTipoIdentificacion }}</td>
                                <td>{{ $tipoidentificacionreg->requiereRazonSocialTipoIdentificacion }}</td>
                                <td>{{ $tipoidentificacionreg->estadoTipoIdentificacion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Codigo DIAN</th>
                            <th>Nombre</th>
                            <th>Requiere digito verificacion</th>
                            <th>Requiere razon social</th>
                            <th>Estado</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection