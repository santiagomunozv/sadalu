 @foreach (Session::get('packageDinamicMenuSadaluPaquetes') as $paquete)
    <!-- LINEA DE DIVISION -->
    <hr class="sidebar-divider">
    {{-- PAQUETE - NIVEL 1 DEL MENU --}}
    <div class="sidebar-heading">{{ $paquete->nombrePaquete }}</div>
    @foreach (Session::get('packageDinamicMenuSadaluModulos')[$paquete->idPaquete] as $modulo)
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse"
                data-target="#collapse{{ $modulo->idModulo }}" aria-expanded="true"
                aria-controls="collapse{{ $modulo->idModulo }}">
                <i class="{{ $modulo->iconoModulo }}"></i>
                <span>{{ $modulo->nombreModulo }}</span>
            </a>
            <div id="collapse{{ $modulo->idModulo }}" class="collapse" aria-labelledby="heading{{ $modulo->idModulo }}"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @foreach (Session::get('packageDinamicMenuSadaluOpciones')[$modulo->idModulo] as $opcion)
                        <a class="collapse-item" href="{{ url($opcion->rutaOpcion) }}">{{ $opcion->nombreOpcion }}</a>
                    @endforeach
                </div>
            </div>
        </li>
    @endforeach
@endforeach

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
