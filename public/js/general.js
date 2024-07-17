var appWrapper = {
    'regex': {
        'email': /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    }
}

var modal;
var chosenConfig = [];
chosenConfig.single = {
    search_contains: true,
    no_results_text: "No se encontraron registros para",
    placeholder_text_single: "Seleccione",
}

chosenConfig.multi = {
    search_contains: true,
    no_results_text: "No se encontraron registros para",
    width: '300px',
    placeholder_text_multiple: "Seleccione",
}

//Habilitamos Tooltip Bootstrap
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
    modal = new SadaluModal();
    $('input').attr('autocomplete', 'off');

    var config = {
        ".chosen-select": {},
        ".chosen-select-deselect": { allow_single_deselect: true },
        ".chosen-select-no-single": { disable_search_threshold: 10 },
        ".chosen-select-no-results": { no_results_text: "Oops, nothing found!" },
        ".chosen-select-width": { width: "100%" }
    }

    for (let selector in config) {
        $(selector).chosen(config[selector]);
    }
})

function quitarCaracterEspecial(str) {
    var lower = str.toLowerCase();
    var upper = str.toUpperCase();
    var res = "";
    for (var i = 0; i < lower.length; ++i) {
        if (lower[i] != upper[i] || lower[i].trim() === '' || (lower[i].trim() >= 0 && lower[i].trim() <= 9))
            res += str[i];
    }
    return res;
}

function cambiarEstado(id, tabla, campo, estadoActual) {

    let clase = 'alert-success';
    let titulo = 'Activar Información';
    let mensaje = '¿Realmente deseas activar de nuevo este registro?, los datos activos se volverán a mostrar en listas de selección al tratar de relacionarlos en nuevas transacciones';

    if (estadoActual == 'Activo') {
        clase = 'alert-danger';
        titulo = 'Inactivar Información';
        mensaje = '¿Realmente deseas inactivar este registro?, los datos inactivos se siguen visualizando en los informes pero no se muestran en listas de selección al tratar de relacionarlos en nuevas transacciones';
    }
    modal.mostrarModal(titulo,
        '<div class="alert ' + clase + ' text-justify">' + mensaje + '</div>',
        function () {

            let token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                headers: { 'X-CSRF-TOKEN': token },
                dataType: "json",
                url: '/cambiarestadodata',
                data: { 'id': id, 'tabla': tabla, 'campo': campo },
                type: 'POST',
                success: function (resp) {
                    location.reload(true);
                },
                error: function (xhr, err) {
                    modal.mostrarModal('Error', 'Ocurrio un problema al intentar cambiar de estado');
                }
            });

        }
    ).grande();

}

function confirmarEliminacion(id, tabla, terminacionTabla) {

    modal.mostrarModal('Cuidado',
        '<div class="alert alert-danger">¿Realmente deseas eliminar este registro?</div>',
        function () {
            eliminarRegistro(id, tabla, terminacionTabla);
        }
    );
}

function eliminarRegistro(id, tabla, terminacionTabla) {
    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        dataType: "json",
        url: '/eliminarregistrodata',
        data: { 'id': id, 'tabla': tabla, 'terminacionTabla': terminacionTabla },
        type: 'POST',
        success: function (resp) {
            modal.mostrarModal('Eliminación exitosa', 'Se ha eliminado correctamente el registro ', function () {
                location.reload(true);
            });
        },
        error: function (err) {
            modal.mostrarModal('Error al eliminar', err.responseJSON.tabla);
        }
    });
}

function retornarToGrid(modulo, vista) {
    window.location = '/' + modulo + '/' + vista;
}

function convertirInputMayusculas(e) {
    e.value = e.value.toUpperCase();
}

function convertirInputMinusculas(e) {
    e.value = e.value.toLowerCase();
}

function marcarNegrita(campo) {
    let text = "El campo " + campo.bold() + " es obligatorio";
    return text;
}
