"use strict";
let errorClass = "is-invalid";

function grabar() {
    modal.cargando();
    let mensajes = validarForm();
    if (mensajes && mensajes.length) {
        modal.mostrarErrores(mensajes);
    } else {
        let formularioId = "#form-consecutivos";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        $.post(
            route,
            data,
            function (resp) {
                modal.establecerAccionCerrar(function () {
                    location.href = "/maestros/consecutivo";
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

        var consecutivo = obtenerCampos("numeroConsecutivo");
        if (consecutivo.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Consecutivo"));
        }

        var nombre = obtenerCampos("nombreConsecutivo");
        if (nombre.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Nombre"));
        }

        var tipo = obtenerCampos("tipoConsecutivo");
        if (tipo.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Tipo"));
        }

        var nombre = obtenerCampos("estadoConsecutivo");
        if (nombre.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Estado"));
        }

        var numeroResolucion = obtenerCampos("resolucionConsecutivo");
        if (numeroResolucion.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Número de resolución"));
        }

        var prefijo = obtenerCampos("prefijoConsecutivo");
        if (prefijo.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Prefijo"));
        }

        var fechaInicio = obtenerCampos("fechaInicioConsecutivo");
        if (fechaInicio.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Fecha de inicio"));
        }
        
        var fechaFin = obtenerCampos("fechaFinConsecutivo");
        if (fechaFin.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Fecha final"));
        }

        var consecutivoInicial = obtenerCampos("numeroInicioConsecutivo");
        if (consecutivoInicial.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Consecutivo inicial"));
        }
        
        var consecutivoFinal = obtenerCampos("numeroFinConsecutivo");
        if (consecutivoFinal.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Consecutivo final"));
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
