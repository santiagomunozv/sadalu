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
                        @foreach ($tipoidentificacion as $tipoidentificacionReg)
                            <tr class="{{ $tipoidentificacionReg->estadoTipoIdentificacion == 'Anulado' ? 'text-danger' : '' }}">
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        @if ($permisos['modificarRolOpcion'])
                                            <a class="btn btn-success btn-sm" href="{!! URL::to('/maestros/tipoidentificacion', [$tipoidentificacionReg->idTipoIdentificacion, 'edit']) !!}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endif
                                        @if ($permisos['eliminarRolOpcion'])
                                            <button type="button"
                                                onclick="confirmarEliminacion('{{ $tipoidentificacionReg->idTipoIdentificacion }}', 'tipo_identificacion', 'TipoIdentificacion')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                        @if ($permisos['modificarRolOpcion'])
                                            <button class="btn btn-warning btn-sm"
                                                onclick="cambiarEstado('{{ $tipoidentificacionReg->idTipoIdentificacion }}', 'tipo_identificacion', 'TipoIdentificacion','{{ $tipoidentificacionReg->estadoTipoIdentificacion }}')">
                                                <i class="fas fa-power-off"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $tipoidentificacionReg->idTipoIdentificacion }}</td>
                                <td>{{ $tipoidentificacionReg->codigoDianTipoIdentificacion }}</td>
                                <td>{{ $tipoidentificacionReg->nombreTipoIdentificacion}}</td>
                                <td>{{ $tipoidentificacionReg->requiereDigitoVerificationTipoIdentificacion}}</td>
                                <td>{{ $tipoidentificacionReg->requiereRazonSocialTipoIdentificacion}}</td>
                                <td>{{ $tipoidentificacionReg->estadoTipoIdentificacion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Codigo</th>
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
