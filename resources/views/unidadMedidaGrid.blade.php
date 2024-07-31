@extends('layouts.principal')
@section('nombreModulo')
    Unidades de Medida
@stop
@section('scripts')
    <script type="text/javascript">
        $(function() {
            configurarDataTable("unidad_medida-table");
        });
    </script>
@endsection
@section('contenido')
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="table-responsive">
                <table id="unidad_medida-table" class="table table-hover table-sm sadalu-grid">
                    <thead class="bg-info text-light">
                        <tr>
                            <th style="width: 150px;" data-orderable="false">
                                @if ($permisos['adicionarRolOpcion'])
                                    <a class="btn btn-info btn-sm text-light" href="{!! URL::to('/maestros/unidadmedida', ['create']) !!}">
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
                            <th>Nombre</th>
                            <th>Simbolo</th>
                            <th>Codigo DIAN</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unidadmedida as $unidadmedidareg)
                            <tr class="{{ $unidadmedidareg->estadoUnidadMedida == 'Anulado' ? 'text-danger' : '' }}">
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        @if ($permisos['modificarRolOpcion'])
                                            <a class="btn btn-success btn-sm" href="{!! URL::to('/maestros/unidadmedida', [$unidadmedidareg->idUnidadMedida, 'edit']) !!}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endif
                                        @if ($permisos['eliminarRolOpcion'])
                                            <button type="button"
                                                onclick="confirmarEliminacion('{{ $unidadmedidareg->idUnidadMedida }}', 'unidad_medida', 'UnidadMedida')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                        @if ($permisos['modificarRolOpcion'])
                                            <button class="btn btn-warning btn-sm"
                                                onclick="cambiarEstado('{{ $unidadmedidareg->idUnidadMedida }}', 'unidad_medida', 'UnidadMedida','{{ $unidadmedidareg->estadoUnidadMedida }}')">
                                                <i class="fas fa-power-off"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $unidadmedidareg->idUnidadMedida }}</td>
                                <td>{{ $unidadmedidareg->nombreUnidadMedida }}</td>
                                <td>{{ $unidadmedidareg->simboloUnidadMedida }}</td>
                                <td>{{ $unidadmedidareg->codigoDianUnidadMedida }}</td>
                                <td>{{ $unidadmedidareg->estadoUnidadMedida }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Simbolo</th>
                            <th>Codigo DIAN</th>
                            <th>Estado</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
