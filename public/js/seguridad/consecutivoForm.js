"use strict";
let errorClass = "is-invalid";
//  hola day, si ves esto me debes un elao

function grabar() {
    modal.cargando();
    let mensajes = validarForm();
    if (mensajes && mensajes.length) {
        console.log('hay campos vacios');
        modal.mostrarErrores(mensajes);
    } else {
        console.log('va a enviar el formulario');
        let formularioId = "#form-consecutivos";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        console.log("route", route);
        console.log("formularioId", formularioId);
        $.post(
            route,
            data,
            function (resp) {
                console.log('respuesta', resp);
                modal.establecerAccionCerrar(function () {
                    location.href = "/maestros/consecutivos";
                });
                modal.mostrarModal(
                    "Información",
                    '<div class="alert alert-success">Los datos han sido guardados correctamente</div>'
                );
            },
            "json"
        ).fail(function (resp) {
            console.log('falló el post', resp);
            $.each(resp.responseJSON.errors, function (index, value) {
                mensajes.push(value);
                $("#" + index).addClass(errorClass);
            });
            modal.mostrarErrores(mensajes);
        });
    }

    function validarForm() {
        let mensajes = [];

        var consecutivo = obtenerCampos("consecutivo");
        if (consecutivo.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("consecutivo"));
        }

        var nombre = obtenerCampos("nombre");
        if (nombre.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("nombre"));
        }

        var tipo = obtenerCampos("tipo");
        if (tipo.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("tipo"));
        }

        var numeroResolucion = obtenerCampos("numeroResolucion");
        if (numeroResolucion.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("numeroResolucion"));
        }

        var prefijo = obtenerCampos("prefijo");
        if (prefijo.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("prefijo"));
        }

        var fechaInicio = obtenerCampos("fechaInicio");
        if (fechaInicio.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("fechaInicio"));
        }
        
        var fechaFin = obtenerCampos("fechaFin");
        if (fechaFin.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("fechaFin"));
        }

        var consecutivoInicial = obtenerCampos("consecutivoInicial");
        if (consecutivoInicial.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("consecutivoInicial"));
        }
        
        var consecutivoFinal = obtenerCampos("consecutivoFinal");
        if (consecutivoFinal.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("consecutivoFinal"));
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
