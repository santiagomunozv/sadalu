"use strict";
let errorClass = "is-invalid";

function grabar() {
    modal.cargando();
    let mensajes = validarForm();
    if (mensajes && mensajes.length) {
        modal.mostrarErrores(mensajes);
    } else {
        let formularioId = "#form-modulo";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        $.post(
            route,
            data,
            function () {
                modal.establecerAccionCerrar(function () {
                    location.href = "/seguridad/modulo";
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

        var nombreModulo = obtenerCampos("nombreModulo");
        if (nombreModulo.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Nombre"));
        }

        var paquete_id = obtenerCampos("paquete_id");
        if (paquete_id.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Paquete"));
        }

        var iconoModulo = obtenerCampos("iconoModulo");
        if (iconoModulo.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Icono"));
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
