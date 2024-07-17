@extends('layouts.principal')

@section('nombreModulo')
    Opciones
@stop

@section('scripts')
    <script type="text/javascript">
        $(function() {
            configurarDataTable("opcion-table");
        });
    </script>
@endsection

@section('contenido')
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="table-responsive">
                <table id="opcion-table" class="table table-hover table-sm sadalu-grid">
                    <thead class="bg-info text-light">
                        <tr>
                            <th style="width: 150px;" data-orderable="false">
                                @if ($permisos['adicionarRolOpcion'])
                                    <a class="btn btn-info btn-sm text-light" href="{!! URL::to('/seguridad/opcion', ['create']) !!}">
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
                            <th>Módulo</th>
                            <th>Ruta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($opcion as $opcionReg)
                            <tr>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        @if ($permisos['modificarRolOpcion'])
                                            <a class="btn btn-success btn-sm" href="{!! URL::to('/seguridad/opcion', [$opcionReg->idOpcion, 'edit']) !!}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endif
                                        @if ($permisos['eliminarRolOpcion'])
                                            <button type="button"
                                                onclick="confirmarEliminacion('{{ $opcionReg->idOpcion }}', 'opcion', 'Opcion')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $opcionReg->idOpcion }}</td>
                                <td>{{ $opcionReg->nombreOpcion }}</td>
                                <td>{{ $opcionReg->nombreModulo }}</td>
                                <td>{{ $opcionReg->rutaOpcion }}</td>
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
