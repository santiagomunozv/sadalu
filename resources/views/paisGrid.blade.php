@extends('layouts.principal')
@section('nombreModulo')
    Paises
@stop
@section('scripts')
    <script type="text/javascript">
        $(function() {
            configurarDataTable("pais-table");
        });
    </script>
@endsection
@section('contenido')
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="table-responsive">
                <table id="pais-table" class="table table-hover table-sm sadalu-grid">
                    <thead class="bg-info text-light">
                        <tr>
                            <th style="width: 150px;" data-orderable="false">
                                @if ($permisos['adicionarRolOpcion'])
                                    <a class="btn btn-info btn-sm text-light" href="{!! URL::to('/maestros/paises', ['create']) !!}">
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pais as $paisreg)
                            <tr class="{{ $paisreg->estadoCompania == 'Anulado' ? 'text-danger' : '' }}">
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        @if ($permisos['modificarRolOpcion'])
                                            <a class="btn btn-success btn-sm" href="{!! URL::to('/maestros/paises', [$paisreg->idPais, 'edit']) !!}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endif
                                        @if ($permisos['eliminarRolOpcion'])
                                            <button type="button"
                                                onclick="confirmarEliminacion('{{ $paisreg->idPais }}', 'pais', 'Pais')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $paisreg->idPais }}</td>
                                <td>{{ $paisreg->codigoPais }}</td>
                                <td>{{ $paisreg->nombrePais }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
