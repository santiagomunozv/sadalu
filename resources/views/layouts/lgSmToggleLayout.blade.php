<div id="modal-sm-messages" class="sm-messages"></div>
<div id="modal-dynamic-container">
    @yield('contenido')
</div>
<div class="d-none" id="modal-lg-messages">
    <div class="alert alert-light" role="alert">
        <div class="row">
            <div class="col text-right">
                <button type="button" id="btn-toggle-to-sm-container" class="btn btn-sm btn-primary">
                    <i class="fas fa-hand-point-left"></i>
                    <span class="d-none d-lg-inline">Volver</span>
                </button>
            </div>
        </div>
    </div>
    <div id="lg-dynamic-messages-container" class="overflow-auto" style="max-height: 400px"></div>
</div>