@extends('layouts.principal')

@section('nombreModulo')
    Consecutivos
@stop

@section('scripts')
    <script type="text/javascript">
        $(function() {
            configurarDataTable("consecutivo-table");
        });
    </script>
@endsection

@section('contenido')
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="table-responsive">
                <table id="consecutivo-table" class="table table-hover table-sm sadalu-grid">
                    <thead class="bg-info text-light">
                        <tr>
                            <th style="width: 150px;" data-orderable="false">
                                @if ($permisos['adicionarRolOpcion'])
                                    <a class="btn btn-info btn-sm text-light" href="{!! URL::to('/maestros/consecutivos', ['create']) !!}">
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
                            <th>Consecutivo</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Número de resolución</th>
                            <th>Prefijo</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha final</th>
                            <th>Consecutivo inicial</th>
                            <th>Consecutivo final</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consecutivos as $consecutivoReg)
                            <tr class="{{ $consecutivoReg->estadoConsecutivo == 'Anulado' ? 'text-danger' : '' }}">
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        @if ($permisos['modificarRolOpcion'])
                                            <a class="btn btn-success btn-sm" href="{!! URL::to('/maestros/consecutivos', [$consecutivoReg->idConsecutivo, 'edit']) !!}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endif
                                        @if ($permisos['eliminarRolOpcion'])
                                            <button type="button"
                                                onclick="confirmarEliminacion('{{ $consecutivoReg->idConsecutivo }}', 'consecutivo', 'consecutivo')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                        @if ($permisos['modificarRolOpcion'])
                                            <button class="btn btn-warning btn-sm"
                                                onclick="cambiarEstado('{{ $consecutivoReg->idConsecutivo }}', 'consecutivo', 'consecutivo','{{ $consecutivoReg->estadoConsecutivo }}')">
                                                <i class="fas fa-power-off"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $consecutivoReg->idConsecutivo }}</td>
                                <td>{{ $consecutivoReg->numeroConsecutivo}}</td>
                                <td>{{ $consecutivoReg->nombreConsecutivo}}</td>
                                <td>{{ $consecutivoReg->tipoConsecutivo}}</td>
                                <td>{{ $consecutivoReg->estadoConsecutivo}}</td>
                                <td>{{ $consecutivoReg->resolucionConsecutivo}}</td>
                                <td>{{ $consecutivoReg->prefijoConsecutivo}}</td>
                                <td>{{ $consecutivoReg->fechaInicioConsecutivo}}</td>
                                <td>{{ $consecutivoReg->fechaFinConsecutivo}}</td>
                                <td>{{ $consecutivoReg->numeroInicioConsecutivo}}</td>
                                <td>{{ $consecutivoReg->numeroFinConsecutivo}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Consecutivo</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>EStado</th>
                            <th>Número de resolución</th>
                            <th>Prefijo</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha final</th>
                            <th>Consecutivo inicial</th>
                            <th>Consecutivo final</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
