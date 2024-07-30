@extends('layouts.principal')

@section('nombreModulo')
    Medios de Pago
@stop

@section('scripts')
    <script type="text/javascript">
        $(function() {
            configurarDataTable("medio_pago-table");
        });
    </script>
@endsection

@section('contenido')
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="table-responsive">
                <table id="medio_pago-table" class="table table-hover table-sm sadalu-grid">
                    <thead class="bg-info text-light">
                        <tr>
                            <th style="width: 150px;" data-orderable="false">
                                @if ($permisos['adicionarRolOpcion'])
                                    <a class="btn btn-info btn-sm text-light" href="{!! URL::to('/maestros/mediopago', ['create']) !!}">
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
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mediopago as $mediopagoReg)
                            <tr>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        @if ($permisos['modificarRolOpcion'])
                                            <a class="btn btn-success btn-sm" href="{!! URL::to('/maestros/mediopago', [$mediopagoReg->idMedioPago, 'edit']) !!}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endif
                                        @if ($permisos['eliminarRolOpcion'])
                                            <button type="button"
                                                onclick="confirmarEliminacion('{{ $mediopagoReg->idMedioPago }}', 'medio_pago', 'MedioPago')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                        @if ($permisos['modificarRolOpcion'])
                                            <button class="btn btn-warning btn-sm"
                                                onclick="cambiarEstado('{{ $mediopagoReg->idMedioPago }}', 'medio_pago', 'MedioPago','{{ $mediopagoReg->estadoMedioPago }}')">
                                                <i class="fas fa-power-off"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $mediopagoReg->idMedioPago }}</td>
                                <td>{{ $mediopagoReg->codigoDianMedioPago }}</td>
                                <td>{{ $mediopagoReg->nombreMedioPago}}</td>
                                <td>{{ $mediopagoReg->estadoMedioPago }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
