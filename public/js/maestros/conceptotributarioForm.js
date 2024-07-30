"use strict";
let errorClass = "is-invalid";

function grabar() {
    modal.cargando();
    let mensajes = validarForm();
    if (mensajes && mensajes.length) {
        modal.mostrarErrores(mensajes);
    } else {
        let formularioId = "#form-conceptotributario";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        $.post(
            route,
            data,
            function (resp) {
                modal.establecerAccionCerrar(function () {
                    location.href = "/maestros/conceptotributario";
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
        var grupoConceptoTributario = obtenerCampos("grupoConceptoTributario");
        if (grupoConceptoTributario.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Grupo"));
        }
        var tipoConceptoTributario = obtenerCampos("tipoConceptoTributario");
        if (tipoConceptoTributario.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Tipo"));
        }
        var operacionConceptoTributario = obtenerCampos("operacionConceptoTributario");
        if (operacionConceptoTributario.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Operacion"));
        }
        var operadorConceptoTributario = obtenerCampos("operadorConceptoTributario");
        if (operadorConceptoTributario.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Operador"));
        }
        var baseConceptoTributario = obtenerCampos("baseConceptoTributario");
        if (baseConceptoTributario.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Base"));
        }
        var tarifaConceptoTributario = obtenerCampos("tarifaConceptoTributario");
        if (tarifaConceptoTributario.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Tarifa"));
        }
        var codigoDianConceptoTributario = obtenerCampos("codigoDianConceptoTributario");
        if (codigoDianConceptoTributario.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Codigo"));
        }
        var nombreDianConceptoTributario = obtenerCampos("nombreDianConceptoTributario");
        if (nombreDianConceptoTributario.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Codigo DIAN"));
        }
        var estadoConceptoTributario = obtenerCampos("estadoConceptoTributario");
        if (estadoConceptoTributario.hasClass(errorClass)) {
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
