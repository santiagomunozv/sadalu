"use strict";
let errorClass = "is-invalid";

function grabar() {
    modal.cargando();
    let mensajes = validarForm();
    if (mensajes && mensajes.length) {
        modal.mostrarErrores(mensajes);
    } else {
        let formularioId = "#form-opcion";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        $.post(
            route,
            data,
            function () {
                modal.establecerAccionCerrar(function () {
                    location.href = "/seguridad/opcion";
                });
                modal.mostrarModal(
                    "Información",
                    '<div class="alert alert-success">Los datos han sido guardados correctamente</div>'
                );
            },
            "json"
        ).fail(function (resp) {
            $.each(resp.responseJSON.errors, function (index, value) {
                mensajes.push(value);
                $("#" + index).addClass(errorClass);
            });
            modal.mostrarErrores(mensajes);
        });
    }

    function validarForm() {
        let mensajes = [];

        var nombreOpcion = obtenerCampos("nombreOpcion");
        if (nombreOpcion.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Nombre"));
        }

        var modulo_id = obtenerCampos("modulo_id");
        if (modulo_id.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Modulo"));
        }

        var rutaOpcion = obtenerCampos("rutaOpcion");
        if (rutaOpcion.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Ruta"));
        }

        return mensajes;
    }

    function obtenerCampos(imput) {
        let campo = $("#" + imput);
        let campo_AE = campo.val();

        return !campo_AE
            ? campo.addClass(errorClass)
            : campo.removeClass(errorClass);
    }
}
