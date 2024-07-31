"use strict";
let errorClass = "is-invalid";

function grabar() {
    modal.cargando();
    let mensajes = validarForm();
    if (mensajes && mensajes.length) {
        modal.mostrarErrores(mensajes);
    } else {
        let formularioId = "#form-unidadmedida";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        $.post(
            route,
            data,
            function (resp) {
                modal.establecerAccionCerrar(function () {
                    location.href = "/maestros/unidadmedida";
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

        var nombreUnidadMedida = obtenerCampos("nombreUnidadMedida");
        if (nombreUnidadMedida.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Nombre"));
        }

        var codigoUnidadMedida = obtenerCampos("codigoUnidadMedida");
        if (codigoUnidadMedida.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Codigo DIAN"));
        }

        var simboloUnidadMedida = obtenerCampos("simboloUnidadMedida");
        if (simboloUnidadMedida.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Simbolo"));
        }

        var estadoUnidadMedida = obtenerCampos("estadoUnidadMedida");
        if (estadoUnidadMedida.hasClass(errorClass)) {
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
