"use strict";
let errorClass = "is-invalid";
var configuracionRolOpcionData = JSON.parse(rolOpcion);
var configuracionRolOpcion = [];

$(function(){
    configuracionRolOpcion = new GeneradorMultiRegistro('configuracionRolOpcion', 'contenedorRolOpcion', 'configuracionRolOpcion');

    let options=[JSON.parse(idOpcion),JSON.parse(nombreOpcion)]

    configuracionRolOpcion.campoid = 'idRolOpcion';
    configuracionRolOpcion.campoEliminacion = 'eliminarRolOpcionId';
    configuracionRolOpcion.botonEliminacion = true;
    configuracionRolOpcion.funcionEliminacion = '';
    configuracionRolOpcion.campos = ['idRolOpcion', 'opcion_id', 'adicionarRolOpcion', 'modificarRolOpcion', 'eliminarRolOpcion', 'consultarRolOpcion', 'inactivarRolOpcion'];
    configuracionRolOpcion.etiqueta = ['input', 'select', 'checkbox', 'checkbox', 'checkbox', 'checkbox', 'checkbox'];
    configuracionRolOpcion.tipo = ['hidden','','','', '','',''];
    configuracionRolOpcion.estilo = ['','', '','','','',''];
    configuracionRolOpcion.clase = ['', 'chosen-select', '', '', '', '', ''];
    configuracionRolOpcion.sololectura = [true,false,false,false,false,false,false];
    configuracionRolOpcion.opciones = ['', options, '', '', '', '', ''];
    configuracionRolOpcion.funciones = ['','','','','',''];
    configuracionRolOpcion.otrosAtributos = ['','','','','','',''];


    configuracionRolOpcionData.forEach( dato => {configuracionRolOpcion.agregarCampos(dato , 'L');
    });
})

function grabar(){
    modal.cargando();
    let mensajes = validarForm();
    if( mensajes && mensajes.length){
        modal.mostrarErrores(mensajes);
    }else{
        let formularioId = "#form-rol";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        $.post(route,data, function( resp ){
            modal.establecerAccionCerrar(function(){
                location.href = "/seguridad/rol";
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

        var nombreRol = obtenerCampos("nombreRol");
        if (nombreRol.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Nombre"));
        }

        var estadoRol = obtenerCampos("estadoRol");
        if (estadoRol.hasClass(errorClass)) {
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
