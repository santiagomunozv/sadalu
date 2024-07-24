"use strict";
let errorClass = "is-invalid";

function grabar() {
    modal.cargando();
    let mensajes = validarForm();
    if (mensajes && mensajes.length) {
        modal.mostrarErrores(mensajes);
    } else {
        let formularioId = "#form-departamento";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        $.post(
            route,
            data,
            function () {
                modal.establecerAccionCerrar(function () {
                    location.href = "/maestros/departamento";
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

        var nombreDepartamento = obtenerCampos("nombreDepartamento");
        if (nombreDepartamento.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Nombre"));
        }

        var pais_id = obtenerCampos("pais_id");
        if (pais_id.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Pais"));
        }

        var codigoDepartamento = obtenerCampos("codigoDepartamento");
        if (codigoDepartamento.hasClass(errorClass)) {
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
