"use strict";
let errorClass = "is-invalid";

function grabar() {
    modal.cargando();
    let mensajes = validarForm();
    if (mensajes && mensajes.length) {
        modal.mostrarErrores(mensajes);
    } else {
        let formularioId = "#form-producto";
        let route = $(formularioId).attr("action");
        let formData = new FormData($(formularioId)[0]);

        $.ajax({
            url: route,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function () {
                modal.establecerAccionCerrar(function () {
                    location.href = "/maestros/producto";
                });
                modal.mostrarModal(
                    "Información",
                    '<div class="alert alert-success">Los datos han sido guardados correctamente</div>'
                );
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (index, value) {
                    mensajes.push(value);
                    $("#" + index).addClass(errorClass);
                });
                modal.mostrarErrores(mensajes);
            }
        });
    }

    function validarForm() {
        let mensajes = [];

        var nombreProducto = obtenerCampos("nombreProducto");
        if (nombreProducto.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Nombre"));
        }

        var marca_id = obtenerCampos("marca_id");
        if (marca_id.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Marca"));
        }

        var tipoproducto_id = obtenerCampos("tipoproducto_id");
        if (tipoproducto_id.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Tipo de Producto"));
        }

        var unidadmedida_id = obtenerCampos("unidadmedida_id");
        if (unidadmedida_id.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Unidad de Medida"));
        }

        var codigoProducto = obtenerCampos("codigoProducto");
        if (codigoProducto.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Codigo"));
        }

        var eanProducto = obtenerCampos("eanProducto");
        if (eanProducto.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Codigo EAN"));
        }

        var imagenProducto = obtenerCampos("imagenProducto");
        if (imagenProducto.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Imagen de Producto"));
        }

        var estadoProducto = obtenerCampos("estadoProducto");
        if (estadoProducto.hasClass(errorClass)) {
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
