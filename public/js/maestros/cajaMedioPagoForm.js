"use strict";
let errorClass = "is-invalid";
var configuracionCajaMedioPagoData = JSON.parse(usuarioCompaniaRol);
var configuracionCajaMedioPago = [];

$(function(){
    configuracionCajaMedioPago = new GeneradorMultiRegistro('configuracionCajaMedioPago', 'contenedorCajaMedioPago', 'configuracionCajaMedioPago');

    let optionsR=[JSON.parse(idCaja),JSON.parse(caja_id)]
    let optionsC=[JSON.parse(idMedioPago),JSON.parse(mediopago_id)]


    configuracionCajaMedioPago.campoid = 'idCajaMedioPago';
    configuracionCajaMedioPago.campoEliminacion = 'eliminarCajaMedioPago';
    configuracionCajaMedioPago.botonEliminacion = true;
    configuracionCajaMedioPago.funcionEliminacion = '';
    configuracionCajaMedioPago.campos = ['idCajaMedioPago', 'caja_id', 'mediopago_id'];
    configuracionCajaMedioPago.etiqueta = ['input', 'select', 'select'];
    configuracionCajaMedioPago.tipo = ['hidden','',''];
    configuracionCajaMedioPago.estilo = ['','', ''];
    configuracionCajaMedioPago.clase = ['', '', ''];
    configuracionCajaMedioPago.sololectura = [true,false,false];
    configuracionCajaMedioPago.opciones = ['', optionsR, optionsC];
    configuracionCajaMedioPago.funciones = ['','',''];
    configuracionCajaMedioPago.otrosAtributos = ['','',''];


    configuracionCajaMedioPagoData.forEach( dato => {configuracionCajaMedioPago.agregarCampos(dato , 'L');
    });
})

function showForm(formId, nameId) {
    document.getElementById('form1').style.display = 'none';
    document.getElementById('form2').style.display = 'none';

    document.getElementById(formId).style.display = 'block';

    document.getElementById('active-tab').classList.remove('active');
    document.getElementById('link-tab').classList.remove('active');

    if (formId === 'form1') {
        document.getElementById('active-tab').classList.add('active');
    } else if (formId === 'form2') {
        document.getElementById('link-tab').classList.add('active');
    }
}

function grabar(){
    modal.cargando();
    let mensajes = validarForm();
    if( mensajes && mensajes.length){
        modal.mostrarErrores(mensajes);
    }else{
        let formularioId = "#form-caja";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        $.post(route,data, function( resp ){
            modal.establecerAccionCerrar(function(){
                location.href = "/maestros/caja";
            });
            modal.mostrarModal("Información" , "<div class=\"alert alert-success\">Los datos han sido guardados correctamente</div>");
        },"json").fail( function(resp){
            $.each(resp.responseJSON.errors, function(index, value) {
                mensajes.push( value );
                $("#"+index).addClass(errorClass);
            });
            modal.mostrarErrores(mensajes);
        });
    }

    function validarForm() {
        let mensajes = [];


        var nombreCaja = obtenerCampos("nombreCaja");
        if (nombreCaja.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Nombre"));
        }

        var usuario_id = obtenerCampos("usuario_id");
        if (usuario_id.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Usuario"));
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
