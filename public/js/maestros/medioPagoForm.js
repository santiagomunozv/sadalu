"use strict";
let errorClass = "is-invalid";

function grabar() {
    modal.cargando();
    let mensajes = validarForm();
    if (mensajes && mensajes.length) {
        modal.mostrarErrores(mensajes);
    } else {
        let formularioId = "#form-mediopago";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        $.post(
            route,
            data,
            function (resp) {
                modal.establecerAccionCerrar(function () {
                    location.href = "/maestros/mediopago";
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

        var nombreMedioPago = obtenerCampos("nombreMedioPago");
        if (nombreMedioPago.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Nombre"));
        }
        var codigoDianMedioPago = obtenerCampos("codigoDianMedioPago");
        if (codigoDianMedioPago.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Codigo DIAN"));
        }

        var estadoMedioPago = obtenerCampos("estadoMedioPago");
        if (estadoMedioPago.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Estado"));
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
