<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Deseas cerrar tu sesión?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">Selecciona "Salir" si ya quieres terminar tu sesión actual.</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <form action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
                <button class="btn btn-info">Salir</button>
            </form>
        </div>
    </div>
    </div>
</div>