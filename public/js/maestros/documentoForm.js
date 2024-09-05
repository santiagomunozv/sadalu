"use strict";

let errorClass = "is-invalid";
var configuracionDocumentoData = JSON.parse(documentoCodigo);
var configuracionDocumento = [];

var configuracionDocumentoLeyendaData = JSON.parse(documentoLeyenda);
var configuracionDocumentoLeyenda = [];

$(function(){
    configuracionDocumento = new GeneradorMultiRegistro('configuracionDocumento', 'contenedorDocumentoCodigo', 'configuracionDocumento');

    let codigo=[JSON.parse(idEtiqueta),JSON.parse(nombreEtiqueta)]

    configuracionDocumento.campoid = 'idDocumentoCodigo';
    configuracionDocumento.campoEliminacion = 'eliminarDocumentoCodigo';
    configuracionDocumento.botonEliminacion = true;
    configuracionDocumento.funcionEliminacion = '';
    configuracionDocumento.campos = ['idDocumentoCodigo', 'codigoDocumentoCodigo', 'etiquetaDocumentoCodigo'];
    configuracionDocumento.etiqueta = ['input', 'input', 'select'];
    configuracionDocumento.tipo = ['hidden','number',''];
    configuracionDocumento.estilo = ['','', '','','','',''];
    configuracionDocumento.clase = ['', '', 'chosen-select'];
    configuracionDocumento.sololectura = [true,false,false];
    configuracionDocumento.opciones = ['', '',codigo];
    configuracionDocumento.funciones = ['','',''];
    configuracionDocumento.otrosAtributos = ['','',''];


    configuracionDocumentoData.forEach( dato => {configuracionDocumento.agregarCampos(dato , 'L');
    });

    configuracionDocumentoLeyenda = new GeneradorMultiRegistro('configuracionDocumentoLeyenda', 'contenedorDocumentoLeyenda', 'configuracionDocumentoLeyenda');

    //let leyenda=[JSON.parse(idEtiqueta),JSON.parse(nombreEtiqueta)]

    configuracionDocumentoLeyenda.campoid = 'idDocumentoLeyenda';
    configuracionDocumentoLeyenda.campoEliminacion = 'eliminarLeyendaId';
    configuracionDocumentoLeyenda.botonEliminacion = true;
    configuracionDocumentoLeyenda.funcionEliminacion = '';
    configuracionDocumentoLeyenda.campos = ['idDocumentoLeyenda', 'posicionDocumentoLeyenda', 'mensajeDocumentoLeyenda'];
    configuracionDocumentoLeyenda.etiqueta = ['input', 'input', 'input'];
    configuracionDocumentoLeyenda.tipo = ['hidden','number','text'];
    configuracionDocumentoLeyenda.estilo = ['','', '','','','',''];
    configuracionDocumentoLeyenda.clase = ['', '', ''];
    configuracionDocumentoLeyenda.sololectura = [true,false,false];
    configuracionDocumentoLeyenda.opciones = ['', '',''];
    configuracionDocumentoLeyenda.funciones = ['','',''];
    configuracionDocumentoLeyenda.otrosAtributos = ['','',''];


    configuracionDocumentoLeyendaData.forEach( dato => {configuracionDocumentoLeyenda.agregarCampos(dato , 'L');
    });
})

function showForm(formId) {
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
    //modal.cargando();
    let mensajes = validarForm();
    if( mensajes && mensajes.length){
        modal.mostrarErrores(mensajes);
    }else{
        let formularioId = "#form-documento";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        $.post(route,data, function( resp ){
            modal.establecerAccionCerrar(function(){
                location.href = "/maestros/documento";
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

        for (let i = 0; i < configuracionDocumento.contador; i++) {
                var codigoDocumentoCodigo = obtenerCampos("codigoDocumentoCodigo"+i);
                if (codigoDocumentoCodigo.hasClass(errorClass)) {
                    mensajes.push(marcarNegrita("Codigo "+(i+1)));
                }
                var etiquetaDocumentoCodigo = obtenerCampos("etiquetaDocumentoCodigo"+i);
                if (etiquetaDocumentoCodigo.hasClass(errorClass)) {
                    mensajes.push(marcarNegrita("Etiqueta "+(i+1)));
                }

        }

        for (let i = 0; i < configuracionDocumentoLeyenda.contador; i++) {
            var posicionDocumentoLeyenda = obtenerCampos("posicionDocumentoLeyenda"+i);
            if (posicionDocumentoLeyenda.hasClass(errorClass)) {
                mensajes.push(marcarNegrita("Posicion "+(i+1)));
            }
            var mensajeDocumentoLeyenda = obtenerCampos("mensajeDocumentoLeyenda"+i);
            if (mensajeDocumentoLeyenda.hasClass(errorClass)) {
                mensajes.push(marcarNegrita("Mensaje "+(i+1)));
            }

        }

        var nombreDocumento = obtenerCampos("nombreDocumento");
        if (nombreDocumento.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Nombre"));
        }

        var tipoDocumento = obtenerCampos("tipoDocumento");
        if (tipoDocumento.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Tipo de Documento"));
        }

        var consecutivo_id = obtenerCampos("consecutivo_id");
        if (consecutivo_id.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Consecutivo"));
        }

        var estadoDocumento = obtenerCampos("estadoDocumento");
        if (estadoDocumento.hasClass(errorClass)) {
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
