@extends('layouts.principal')

@section('nombreModulo')
    Modulos
@stop

@section('scripts')
    <script type="text/javascript">
        $(function() {
            configurarDataTable("modulo-table");
        });
    </script>
@endsection

@section('contenido')
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="table-responsive">
                <table id="modulo-table" class="table table-hover table-sm sadalu-grid">
                    <thead class="bg-info text-light">
                        <tr>
                            <th style="width: 150px;" data-orderable="false">
                                @if ($permisos['adicionarRolOpcion'])
                                    <a class="btn btn-info btn-sm text-light" href="{!! URL::to('/seguridad/modulo', ['create']) !!}">
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
                            <th>Paquete</th>
                            <th>Ícono</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modulo as $moduloReg)
                            <tr>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        @if ($permisos['modificarRolOpcion'])
                                            <a class="btn btn-success btn-sm" href="{!! URL::to('/seguridad/modulo', [$moduloReg->idModulo, 'edit']) !!}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endif
                                        @if ($permisos['eliminarRolOpcion'])
                                            <button type="button"
                                                onclick="confirmarEliminacion('{{ $moduloReg->idModulo }}', 'modulo', 'Modulo')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $moduloReg->idModulo }}</td>
                                <td>{{ $moduloReg->nombreModulo }}</td>
                                <td>{{ $moduloReg->nombrePaquete }}</td>
                                <td>{{ $moduloReg->iconoModulo }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Orden</th>
                            <th>Nombre</th>
                            <th>Icono</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
