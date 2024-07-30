"use strict";
let errorClass = "is-invalid";

function grabar() {
    modal.cargando();
    let mensajes = validarForm();
    if (mensajes && mensajes.length) {
        modal.mostrarErrores(mensajes);
    } else {
        let formularioId = "#form-tipoidentificacion";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        $.post(
            route,
            data,
            function (resp) {
                modal.establecerAccionCerrar(function () {
                    location.href = "/maestros/tipoidentificacion";
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

        var nombreTipoIdentificacion = obtenerCampos("nombreTipoIdentificacion");
        if (nombreTipoIdentificacion.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Nombre"));
        }

        var codigoDianTipoIdentificacion = obtenerCampos("codigoDianTipoIdentificacion");
        if (codigoDianTipoIdentificacion.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Codigo"));
        }

        var requiereDigitoVerificationTipoIdentificacion = obtenerCampos("requiereDigitoVerificationTipoIdentificacion");
        if (requiereDigitoVerificationTipoIdentificacion.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Codigo"));
        }

        var requiereRazonSocialTipoIdentificacion = obtenerCampos("requiereRazonSocialTipoIdentificacion");
        if (requiereRazonSocialTipoIdentificacion.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Codigo"));
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
