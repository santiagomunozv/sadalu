"use strict";
let errorClass = "is-invalid";

function grabar() {
    modal.cargando();
    let mensajes = validarForm();
    if (mensajes && mensajes.length) {
        modal.mostrarErrores(mensajes);
    } else {
        let formularioId = "#form-paquete";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        $.post(
            route,
            data,
            function () {
                modal.establecerAccionCerrar(function () {
                    location.href = "/seguridad/paquete";
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

        var ordenPaquete = obtenerCampos("ordenPaquete");
        if (ordenPaquete.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Orden"));
        }

        var nombrePaquete = obtenerCampos("nombrePaquete");
        if (nombrePaquete.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Nombre"));
        }

        var iconoPaquete = obtenerCampos("iconoPaquete");
        if (iconoPaquete.hasClass(errorClass)) {
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
