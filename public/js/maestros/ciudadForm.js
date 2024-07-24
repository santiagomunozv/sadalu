"use strict";
let errorClass = "is-invalid";

function grabar() {
    modal.cargando();
    let mensajes = validarForm();
    if (mensajes && mensajes.length) {
        modal.mostrarErrores(mensajes);
    } else {
        let formularioId = "#form-ciudad";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        $.post(
            route,
            data,
            function () {
                modal.establecerAccionCerrar(function () {
                    location.href = "/maestros/ciudad";
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

        var nombreCiudad = obtenerCampos("nombreCiudad");
        if (nombreCiudad.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Nombre"));
        }

        var departamento_id = obtenerCampos("departamento_id");
        if (departamento_id.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Departamento"));
        }

        var codigoCiudad = obtenerCampos("codigoCiudad");
        if (codigoCiudad.hasClass(errorClass)) {
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
