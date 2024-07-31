@extends('layouts.principal')

@section('nombreModulo')
    Productos
@stop

@section('scripts')
    <script type="text/javascript">
        $(function() {
            configurarDataTable("producto-table");
        });
    </script>
@endsection

@section('contenido')
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="table-responsive">
                <table id="producto-table" class="table table-hover table-sm sadalu-grid">
                    <thead class="bg-info text-light">
                        <tr>
                            <th style="width: 150px;" data-orderable="false">
                                @if ($permisos['adicionarRolOpcion'])
                                    <a class="btn btn-info btn-sm text-light" href="{!! URL::to('/maestros/producto', ['create']) !!}">
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
                            <th>Descripción</th>
                            <th>Codigo EAN</th>
                            <th>Marca</th>
                            <th>Tipo de Producto</th>
                            <th>Unidad de Medida</th>
                            <th>Cargar Imagen</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($producto as $productoReg)
                            <tr class="{{ $productoReg->estadoProducto == 'Anulado' ? 'text-danger' : '' }}">
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        @if ($permisos['modificarRolOpcion'])
                                            <a class="btn btn-success btn-sm" href="{!! URL::to('/maestros/producto', [$productoReg->idProducto, 'edit']) !!}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endif
                                        @if ($permisos['eliminarRolOpcion'])
                                            <button type="button"
                                                onclick="confirmarEliminacion('{{ $productoReg->idProducto }}', 'producto', 'Producto')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                        @if ($permisos['modificarRolOpcion'])
                                            <button class="btn btn-warning btn-sm"
                                                onclick="cambiarEstado('{{ $productoReg->idProducto }}', 'producto', 'Producto','{{ $productoReg->estadoProducto }}')">
                                                <i class="fas fa-power-off"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $productoReg->idProducto }}</td>
                                <td>{{ $productoReg->codigoProducto }}</td>
                                <td>{{ $productoReg->nombreProducto}}</td>
                                <td>{{ $productoReg->eanProducto }}</td>
                                <td>{{ $productoReg->nombreMarca }}</td>
                                <td>{{ $productoReg->nombreTipoProducto }}</td>
                                <td>{{ $productoReg->nombreUnidadMedida }}</td>
                                <td>{{ $productoReg->imagenProducto }}</td>
                                <td>{{ $productoReg->estadoProducto }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Codigo</th>
                            <th>Descripción</th>
                            <th>Codigo EAN</th>
                            <th>Marca</th>
                            <th>Tipo de Producto</th>
                            <th>Unidad de Medida</th>
                            <th>Cargar Imagen</th>
                            <th>Estado</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
