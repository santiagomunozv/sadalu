"use strict";
let errorClass = "is-invalid";
var configuracionUsuarioCompaniaRolData = JSON.parse(usuarioCompaniaRol);
var configuracionUsuarioCompaniaRol = [];

$(function(){
    configuracionUsuarioCompaniaRol = new GeneradorMultiRegistro('configuracionUsuarioCompaniaRol', 'contenedorUsuarioCompaniaRol', 'configuracionUsuarioCompaniaRol');

    let optionsR=[JSON.parse(idRol),JSON.parse(nombreRol)]
    let optionsC=[JSON.parse(idCompania),JSON.parse(nombreCompania)]


    configuracionUsuarioCompaniaRol.campoid = 'idUsuarioRol';
    configuracionUsuarioCompaniaRol.campoEliminacion = 'eliminarUsuarioCompaniaRolId';
    configuracionUsuarioCompaniaRol.botonEliminacion = true;
    configuracionUsuarioCompaniaRol.funcionEliminacion = '';
    configuracionUsuarioCompaniaRol.campos = ['idUsuarioRol', 'rol_id', 'compania_id'];
    configuracionUsuarioCompaniaRol.etiqueta = ['input', 'select', 'select'];
    configuracionUsuarioCompaniaRol.tipo = ['hidden','',''];
    configuracionUsuarioCompaniaRol.estilo = ['','', ''];
    configuracionUsuarioCompaniaRol.clase = ['', '', ''];
    configuracionUsuarioCompaniaRol.sololectura = [true,false,false];
    configuracionUsuarioCompaniaRol.opciones = ['', optionsR, optionsC];
    configuracionUsuarioCompaniaRol.funciones = ['','',''];
    configuracionUsuarioCompaniaRol.otrosAtributos = ['','',''];


    configuracionUsuarioCompaniaRolData.forEach( dato => {configuracionUsuarioCompaniaRol.agregarCampos(dato , 'L');
    });
})

function grabar(){
    modal.cargando();
    let mensajes = validarForm();
    if( mensajes && mensajes.length){
        modal.mostrarErrores(mensajes);
    }else{
        let formularioId = "#form-usuario";
        let route = $(formularioId).attr("action");
        let data = $(formularioId).serialize();
        $.post(route,data, function( resp ){
            modal.establecerAccionCerrar(function(){
                location.href = "/seguridad/usuario";
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

        var loginUsuario = obtenerCampos("loginUsuario");
        if (loginUsuario.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Nombre de usuario"));
        }

        var password = obtenerCampos("password");
        if (password.hasClass(errorClass)) {
            mensajes.push(marcarNegrita("Contraseña"));
        }

        var estadoUsuario = obtenerCampos("estadoUsuario");
        if (estadoUsuario.hasClass(errorClass)) {
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
