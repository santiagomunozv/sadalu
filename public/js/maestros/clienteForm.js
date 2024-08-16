"use strict";
let errorClass = "is-invalid";

function CalcularDv() {
    var nit1 = document.getElementById("identificacionCliente").value;
    if (isNaN(nit1)) {
        document.getElementById("digitoVerificacionCliente").value = '';
    } else {
        var vpri = [0, 3, 7, 13, 17, 19, 23, 29, 37, 41, 43, 47, 53, 59, 67, 71];
        var x = 0;
        var y = 0;
        var z = nit1.length;

        for (var i = 0; i < z; i++) {
            y = parseInt(nit1.substr(i, 1), 10);
            x += (y * vpri[z - i]);
        }

        y = x % 11;

        var dv1;
        if (y > 1) {
            dv1 = 11 - y;
        } else {
            dv1 = y;
        }
        document.getElementById("digitoVerificacionCliente").value = dv1;
    }
}

function grabar() {
    modal.cargando();
    let mensajes = validarForm();
    if (mensajes && mensajes.length) {
        modal.mostrarErrores(mensajes);
    } else {
        let formularioId = "#form-cliente";
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
                    location.href = "/maestros/cliente";
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
        var requiredRazonSocial = document.getElementById('requiereRazonSocial').value;
        let mensajes = [];
        if(requiredRazonSocial == 1){
            var razonSocialCliente = obtenerCampos("razonSocialCliente");
            if (razonSocialCliente.hasClass(errorClass)) {
                mensajes.push(marcarNegrita("Razón social"));
            }
            var nombreComercialCliente = obtenerCampos("nombreComercialCliente");
            if (nombreComercialCliente.hasClass(errorClass)) {
                mensajes.push(marcarNegrita("Nombre comercial"));
            }
        }else{
            var primerNombreCliente = obtenerCampos("primerNombreCliente");
            if (primerNombreCliente.hasClass(errorClass)) {
                mensajes.push(marcarNegrita("Primer nombre"));
            }

            var segundoNombreCliente = obtenerCampos("segundoNombreCliente");
            if (segundoNombreCliente.hasClass(errorClass)) {
                mensajes.push(marcarNegrita("Segundo nombre"));
            }

            var primerApellidoCliente = obtenerCampos("primerApellidoCliente");
            if (primerApellidoCliente.hasClass(errorClass)) {
                mensajes.push(marcarNegrita("Primer apellido"));
            }

            var segundoApellidoCliente = obtenerCampos("segundoApellidoCliente");
            if (segundoApellidoCliente.hasClass(errorClass)) {
                mensajes.push(marcarNegrita("Segundo apellido"));
            }
        }
        var tipoidentificacion_id = obtenerCampos("tipoidentificacion_id");
        if (tipoidentificacion_id.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Tipo de identificacion"));
        }

        var identificacionCliente = obtenerCampos("identificacionCliente");
        if (identificacionCliente.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Identificacion"));
        }

        var telefonoCliente = obtenerCampos("telefonoCliente");
        if (telefonoCliente.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Telefono"));
        }

        var celularCliente = obtenerCampos("celularCliente");
        if (celularCliente.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Telefono"));
        }

        var emailCliente = obtenerCampos("emailCliente");
        if (emailCliente.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Email"));
        }

        var ciudad_id = obtenerCampos("ciudad_id");
        if (ciudad_id.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Ciudad"));
        }

        var direccionCliente = obtenerCampos("direccionCliente");
        if (direccionCliente.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Dirección"));
        }

        var codigoPostalCliente = obtenerCampos("codigoPostalCliente");
        if (codigoPostalCliente.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Codigo postal"));
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

function toggleFields(idIdentificacion) {
    const currentIdentification = JSON.parse(tipoIdentificacion).find(item => item.idTipoIdentificacion == idIdentificacion);
    var camposPersonales = [
        'primerNombreCliente',
        'segundoNombreCliente',
        'primerApellidoCliente',
        'segundoApellidoCliente'
    ];
    var camposComerciales = [
        'razonSocialCliente',
        'nombreComercialCliente'
    ];

    // Si no se selecciona un registro válido, se bloquean todos los campos
    if (!idIdentificacion) {
        camposPersonales.forEach(function(campo) {
            document.getElementById(campo).disabled = true;
            document.getElementById(campo).value = ''; // Set value to null
        });
        camposComerciales.forEach(function(campo) {
            document.getElementById(campo).disabled = true;
            document.getElementById(campo).value = ''; // Set value to null
        });

        document.getElementById('requiereRazonSocial').value = 0;

        return;
    }

    document.getElementById('requiereRazonSocial').value = currentIdentification.requiereRazonSocialTipoIdentificacion;

    // Si se requiere razón social, se bloquean campos personales y se desbloquean comerciales
    if (currentIdentification.requiereRazonSocialTipoIdentificacion) {
        camposPersonales.forEach(function(campo) {
            document.getElementById(campo).disabled = true;
            document.getElementById(campo).value = ''; // Set value to null
        });
        camposComerciales.forEach(function(campo) {
            document.getElementById(campo).disabled = false;
        });
    } else {
        // Se desbloquean campos personales y se bloquean comerciales
        camposPersonales.forEach(function(campo) {
            document.getElementById(campo).disabled = false;
        });
        camposComerciales.forEach(function(campo) {
            document.getElementById(campo).disabled = true;
            document.getElementById(campo).value = ''; // Set value to null
        });
    }
}


