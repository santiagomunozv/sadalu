"use strict";
/**
 * SadaluModal v 1.0
 *
 * Clase diseñada para cumplir como modal dinamico de la aplicacion
 * @author Santiago Muñoz
 */
class SadaluModal {
    /**
     * Constructor preferido para esta clase, se puede o no indicar un id al modal
     * para acceder a el através de bootstrap
     *
     * @param {string:opcional} modalId representa el id que se utilizará para este modal
     * @author Santiago Muñoz
     * @since v 1.0
     */
    constructor(modalId) {
        this.verificarId(modalId);
        this.id = modalId;
        this.setTituloPrevio = false;
        //el contenedor siempre será el body :)
        let contenedor = document.getElementsByTagName('body')[0];
        if (!contenedor) {
            throw 'El contenedor especificado no existe';
        }
        this.construirModal(contenedor);
    }

    /**
     * Metodo encargado de mostrar una barra de cargando en la interfaz, al ser llamado oculta
     * el contenido real del modal.
     *
     * @param {string:opcional} titulo el titulo que se desea mostrar en el modal
     * @author Santiago Muñoz
     * @since v 1.0
     */
    cargando(titulo) {
        this.mediano().sinPie();
        this.establecerTitulo(titulo ? titulo : 'Cargando...');
        this.contenido.classList.add('d-none');
        this.progresoSpinner.classList.add('d-none');
        this.progresoIndefinido.classList.remove('d-none');
        this.botonCerrar.classList.add('d-none');
        this.mostrar();
        return this;
    }

    /**
     * Metodo encargado de mostrar un spinner de carga en la interfaz, al ser llamado oculta
     * el contenido real del modal.
     *
     * @param {string:opcional} titulo el titulo que se desea mostrar en el modal
     * @author Sergio Gonzalez Cargando
     * @since v 1.1
     */
    cargandoSpinner(titulo) {
        this.mediano().sinPie();
        this.establecerTitulo(titulo ? titulo : 'Cargando...');
        this.contenido.classList.add('d-none');
        this.progresoIndefinido.classList.add('d-none');
        this.progresoSpinner.classList.remove('d-none');
        this.botonCerrar.classList.add('d-none');
        this.mostrar();
        return this;
    }

    /**
     * Metodo que permite ocultar el pie del modal y por ende los botones que este provee,
     * su uso puede ser bueno cuando el desarrollador ya posee sus propias acciones dentro
     * del contenido que cargó en el modal
     *
     * @returns {SadaluModal} este mismo objeto
     * @author Santiago Muñoz
     * @since v 1.0
     */
    sinPie() {
        this.pieModal.classList.add('d-none');
        return this;
    }

    /**
     * Metodo que permite mostrar el pie del modal y por ende los botones que este provee,
     * es el metodo empleado por defecto por esta clase en el metodo @see {SadaluModal#mostrarModal}.
     *
     * @returns {SadaluModal} este mismo objeto
     * @author Santiago Muñoz
     * @since v 1.0
     */
    conPie() {
        this.pieModal.classList.remove('d-none');
        return this;
    }

    /**
     * Método empleado para lanzar el modal, con un nuevo titulo y un nuevo contenido.
     * Dicho contenido puede ser un string, un string que representa HTML o un objeto
     * DOM creado directamente con javascript.
     *
     * @param {string:requerido} titulo el texto que se mostrará como título de este modal
     * @param {string , Object : requerido} contenido el contenido que se mostrará en el cuerpo del modal
     * @param {function:opcional} callback la acción que se ejecutará cuando el botón aceptar sea presionado
     *
     * @returns {SadaluModal} este mismo objeto
     *
     * @author Santiago Muñoz
     * @since v 1.0
     */
    mostrarModal(titulo, contenido, callback) {
        this.establecerTitulo(titulo);
        this.establecerContenido(contenido);
        this.establecerAccionAceptar(callback);
        return this.mostrarSinCambios();
    }

    /**
     * Método recomendado para volver a mostrar el contenido actualmente cargado en el modal después de haber
     * activado el metodo #cargando PD: el título del modal puede no ser el adecuado para este metodo. Un
     * workaround para este caso sería:
     * <code>
     *      //llamar el metodo cargando con parámetro de titulo
     *      modal.cargando('El titulo que deseo ver al momento de activar "mostrarSinCambios()"');
     *      modal.mostrarSinCambios();
     * </code>
     */
    mostrarSinCambios() {
        this.mostrarContenido();
        this.conPie().mediano();
        this.mostrar();
        return this;
    }

    /**
     * Metodo empleado para cerrar el modal y todo su contenido.
     * @author Santiago Muñoz
     * @since v 1.0
     */
    cerrarModal() {
        $(this.contenedorPrincipal).modal('hide');
    }

    /**
     * Metodo empleado para mostrar el modal y todo su contenido dependiendo del estado
     * en que estos estén actualmente.
     * @author Santiago Muñoz
     * @since v 1.0
     */
    mostrar() {
        $(this.contenedorPrincipal).modal('show');
    }

    /**
     * Método empleado para indicar el tamaño del modal con el tamaño mínimo para esta clase,
     * en bootstrap 4 esta opción representa los resultados obtenidos por class="modal-sm".
     * La llamada de este metodo sobreescribirá las llamadas de cualquiera de los metodos de tamaño
     *
     * @see {SadaluModal#mediano}
     * @see {SadaluModal#grande}
     * @see {SadaluModal#extraGrande}
     *
     * @returns {SadaluModal} este mismo objeto
     * @author Santiago Muñoz
     * @since v 1.0
     */
    pequeno() {
        this.mediano();
        this.contenedorModal.classList.add('modal-sm');
        return this;
    }

    /**
     * Método empleado para mostrar un modal con tamaño mediano, este es
     * el tamaño por defecto si no se utiliza una opcion específica.
     * La llamada de este metodo sobreescribirá las llamadas de cualquiera de los metodos de tamaño
     *
     * @see {SadaluModal#pequeno}
     * @see {SadaluModal#grande}
     * @see {SadaluModal#extraGrande}
     *
     * @returns {SadaluModal} este mismo objeto
     * @author Santiago Muñoz
     * @since v 1.0
     */
    mediano() {
        let clases = ['modal-sm', 'modal-lg', 'modal-xl'];
        clases.forEach(clase => {
            this.contenedorModal.classList.remove(clase);
        });
        return this;
    }

    /**
      * Método empleado para indicar el tamaño del modal con el segundo tamaño mas grande
      * para esta clase, en bootstrap 4 esta opción representa los resultados obtenidos
      * por class="modal-lg".
      * La llamada de este metodo sobreescribirá las llamadas de cualquiera de los metodos de tamaño
      *
      * @see {SadaluModal#pequeno}
      * @see {SadaluModal#mediano}
      * @see {SadaluModal#extraGrande}
      *
      * @returns {SadaluModal} este mismo objeto
      * @author Santiago Muñoz
      * @since v 1.0
      */
    grande() {
        this.mediano();
        this.contenedorModal.classList.add('modal-lg');
        return this;
    }

    /**
     * Método empleado para indicar el tamaño del modal con el tamaño mas grande
     * para esta clase, en bootstrap 4 esta opción representa los resultados obtenidos
     * por class="modal-xl".
     * La llamada de este metodo sobreescribirá las llamadas de cualquiera de los metodos de tamaño
     *
     * @see {SadaluModal#pequeno}
     * @see {SadaluModal#mediano}
     * @see {SadaluModal#grande}
     *
     * @returns {SadaluModal} este mismo objeto
     * @author Santiago Muñoz
     * @since v 1.0
     */
    extraGrande() {
        this.mediano();
        this.contenedorModal.classList.add('modal-xl');
        return this;
    }

    /**
     * Metodo encargado de mostrar errores BASICO en la aplicacion
     *
     * @param {string[] requerido} errores los errores que se mostraran al usuario
     * @param { string : opcional } url la url en la que se ha producido el error.
     * @param { xhr : opcion} response la respuesta desde servidor
     */
    mostrarErrores(errores, url, response) {
        if (response && response.status === 500) {
            this.mostrarModal('OOOOooopssss...', '<div class="alert alert-danger">Ha ocurrido un error en el servidor.<br>status: ' + response.status + '<br>URL: ' + url + '</div>');
        } else {
            let ul = document.createElement('ul');
            errores.forEach(function (error) {
                let li = document.createElement('li');
                li.innerHTML = error;
                ul.appendChild(li);
            });
            let div = document.createElement('div');
            div.appendChild(ul);
            div.className = 'alert alert-warning';
            this.mostrarModal('Atención', div);
        }
        this.grande();
    }

    /**
     * Metodo que permite especificar la accion para los botones que permiten cerrar el modal
     *
     * @param {function : requerida} action la accion que se ejecutará al momento de cerrar el modal
     */
    establecerAccionCerrar(action) {
        this.botonCerrar.onclick = action;
        this.botonCancelar.onclick = action;
    }


    /************************************* METODOS NO USABLES **********************************
     ******************************************* WARNING ***************************************
     ******************************************** DANGER****************************************
     * A pesar de que algunos de los metodos indicados en esta sección de la clase puedan
     * ofrecer alternativas extras al desarrollador, NO SE RECOMIENDA el uso de estos métodos
     * directamente si no se tiene conocimiento de los posibles resultados. Éstos métodos
     * son empleados SOLO para construir el objeto y realizar algunas operaciones internas.
     */

    /**
     * Método que se encarga de ocultar la barra de progreso y muestra
     * el contenido cargado en el modal. ADVERTENCIA: este método NO muestra
     * el modal como tal solo hace switch de los dos posibles contenidos del modal
     * Se añadio un spinner de carga
     * @author Santiago Muñoz
     * @since v 1.1
     */
    mostrarContenido() {
        this.botonCerrar.classList.remove('d-none');
        this.progresoIndefinido.classList.add('d-none');
        this.progresoSpinner.classList.add('d-none');
        this.contenido.classList.remove('d-none');
    }

    /**
     * Método encargado de establecer el titulo del modal.
     *
     * @param {string : opcional} titulo el titulo que se mostrará en este modal
     * @author Santiago Muñoz
     * @since v 1.0
     */
    establecerTitulo(titulo) {
        this.titulo.innerHTML = titulo ? titulo : 'No has especificado un título...';
    }

    /**
     * Método que cuenta con una validación básica para definir si el id indicado
     * ya ha sido utilizado en otro objeto durante la creacion de este objeto. Solo valida
     * los objetos que existen en el DOM al momento de instanciar este objeto.
     *
     * @param {string} id el id que se desea validar
     * @author Santiago Muñoz
     * @since v 1.0
     */
    verificarId(id) {
        let elementoDOM = document.getElementById(id);
        if (elementoDOM) {
            throw 'El id indicado ya está en uso';
        }
    }

    /**
     * Metodo que contiene la logica de construiccion de este objeto cuando
     * la variables ya han sido definidas. Se encarga de generar los elementos DOM
     * necesarios para la existencia/usabilidad de este objeto.
     *
     * @see {SadaluModal#construirTitulo}
     * @see {SadaluModal#construirCuerpo}
     * @see {SadaluModal#construirPie}
     * @see {SadaluModal#construirContenedorPrincipal}
     *
     * @param {Object:requerido} contenedor el contenedor al que se le añadiran el titulo,
     * el cuerpo y el footer
     * @author Santiago Muñoz
     * @since v 1.0
     */
    construirModal(contenedor) {
        let contenidoDelModal = document.createElement('div');
        contenidoDelModal.className = 'modal-content';
        this.construirTitulo(contenidoDelModal);
        this.construirCuerpo(contenidoDelModal);
        this.construirPie(contenidoDelModal);
        this.construirContenedorPrincipal(contenidoDelModal);
        contenedor.appendChild(this.contenedorPrincipal);
    }

    /**
     * Método que contiene la logica necesaria para construir el
     * titulo del modal.
     *
     * @param {Object:requerido} contenedor el objeto al que se añadira el titulo
     * @author Santiago Muñoz
     * @since v 1.0
     */
    construirTitulo(contenedor) {
        this.titulo = document.createElement('h5');
        this.titulo.classList.add('modal-title');
        let iconoCerrar = document.createElement('span');
        iconoCerrar.innerHTML = '&times;';
        this.botonCerrar = document.createElement('button');
        this.botonCerrar.classList.add('close');
        this.botonCerrar.type = 'button';
        this.botonCerrar.setAttribute('data-dismiss', 'modal');
        this.botonCerrar.appendChild(iconoCerrar);
        let encabezadoModal = document.createElement('div');
        encabezadoModal.classList.add('modal-header');
        encabezadoModal.appendChild(this.titulo);
        encabezadoModal.appendChild(this.botonCerrar);
        contenedor.appendChild(encabezadoModal);
    }

    /**
     * Método que contiene la lógica para generar el espacio dentro del modal
     * para que insertar el contenido dinamico del modal
     *
     * @param {Object:requerido} contenedor
     * @author Santiago Muñoz
     * @since v 1.0
     */
    construirCuerpo(contenedor) {
        this.contenido = document.createElement('div');
        this.contenido.className = 'col';
        let cuerpo = document.createElement('div');
        cuerpo.className = 'modal-body';
        cuerpo.appendChild(this.contenido);
        this.construirCargando(cuerpo);
        this.construirSpinner(cuerpo);
        contenedor.appendChild(cuerpo);
    }

    /**
     * Método encargado de construir la barra que se muestra cuando el desarrollador llama el
     * metodo @see {SadaluModal#cargando}
     *
     * @param {Object:requerido} contenedor
     * @author Santiago Muñoz
     * @since v 1.0
     */
    construirCargando(contenedor) {
        let barraProgreso = document.createElement('div');
        barraProgreso.className = 'progress-bar progress-bar-striped progress-bar-animated';
        barraProgreso.setAttribute('aria-valuenow', '100');
        barraProgreso.style.width = '100%';
        let contenedorBarraProgreso = document.createElement('div');
        contenedorBarraProgreso.className = 'progress progress-sm  mb-2';
        contenedorBarraProgreso.appendChild(barraProgreso);
        this.progresoIndefinido = document.createElement('div');
        this.progresoIndefinido.className = 'col';
        this.progresoIndefinido.appendChild(contenedorBarraProgreso);
        contenedor.appendChild(this.progresoIndefinido);
    }

    /**
     * Método encargado de construir el spinner de carga que se muestra cuando el desarrollador llama el
     * metodo @see {SadaluModal#cargando}
     *
     * @param {Object:requerido} contenedor
     * @author Sergio Gonzalez Cardona
     * @since v 1.1
     */
    construirSpinner(contenedor) {
        let contenedorSpinner = document.createElement('div');
        let spinner = document.createElement('div');
        spinner.className = 'spinner-border text-primary';
        spinner.style.width = '3rem';
        spinner.style.height = '3rem';
        contenedorSpinner.appendChild(spinner);
        this.progresoSpinner = document.createElement('div');
        this.progresoSpinner.className = 'col text-center p-2';
        this.progresoSpinner.appendChild(spinner);
        contenedor.appendChild(this.progresoSpinner);
    }

    /**
     * Metodo encargado de construir el footer y sus botones.
     *
     * @param {Object:requerido} contenedor el elemento al que se agregará el pie del modal
     * @author Santiago Muñoz
     * @since v 1.0
     */
    construirPie(contenedor) {
        this.botonAceptar = document.createElement('button');
        this.botonAceptar.className = 'btn btn-success btn-sm d-none';
        this.botonAceptar.innerHTML = 'Aceptar';
        this.botonAceptar.type = 'button';
        this.botonCancelar = document.createElement('button');
        this.botonCancelar.className = 'btn btn-secondary btn-sm';
        this.botonCancelar.innerHTML = 'Cerrar';
        this.botonCancelar.setAttribute('data-dismiss', 'modal');
        this.botonCancelar.type = 'button';
        this.pieModal = document.createElement('div');
        this.pieModal.className = 'modal-footer';
        this.pieModal.appendChild(this.botonCancelar);
        this.pieModal.appendChild(this.botonAceptar);
        contenedor.appendChild(this.pieModal);
    }

    /**
     * Metodo encargado de definir los divs que contienen al modal
     *
     * @param {Object:requerido} contenidoDelModal todos los elementos con los que el programador y el usuario
     * interactuan en el modal
     * @author Santiago Muñoz
     * @since v 1.0
     */
    construirContenedorPrincipal(contenidoDelModal) {
        this.contenedorModal = document.createElement('div');
        this.contenedorModal.className = 'modal-dialog';
        this.contenedorModal.setAttribute('role', 'document');
        this.contenedorModal.appendChild(contenidoDelModal);
        this.contenedorPrincipal = document.createElement('div');
        if (this.id)
            this.contenedorPrincipal.id = this.id;
        //favor evita la clase fade para este contenedor Gracias ;) parece dar
        //problemas cuando la ventana es abierta y cerrada rápidamente
        this.contenedorPrincipal.className = 'modal';
        this.contenedorPrincipal.tabIndex = '-1';
        this.contenedorPrincipal.setAttribute('role', 'dialog');
        this.contenedorPrincipal.setAttribute('aria-hidden', 'true');
        this.contenedorPrincipal.setAttribute('data-backdrop', 'static');
        this.contenedorPrincipal.setAttribute('data-keyboard', 'false');
        this.contenedorPrincipal.appendChild(this.contenedorModal);
    }

    /**
     * Método que contiene la lógica mas adecuada para establecer el contenido
     * que el desarrollador proporciona al modal, es limitado así que no esperes milagros
     *
     * @param {string,Object,html :requerido} contenido
     * @author Santiago Muñoz
     * @since v 1.0
     */

    establecerContenido(contenido) {
        if (typeof contenido === 'string' || typeof contenido === 'number') {
            this.contenido.innerHTML = contenido;
        } else if (typeof contenido === 'Node' || contenido instanceof Element) {
            this.contenido.innerHTML = '';
            this.contenido.appendChild(contenido);
        } else {
            throw 'El contenido ingresado no es soportado por esta libreria';
        }
    }

    /**
     * Método encargado de administrar el boton
     * @param {function:opcional} accion
     * @author Santiago Muñoz
     * @since v 1.0
     */
    establecerAccionAceptar(accion) {
        if (accion !== void 0 && typeof accion === 'function') {
            this.botonAceptar.onclick = accion;
            this.botonAceptar.classList.remove('d-none');
        } else {
            this.botonAceptar.onclick = '';
            this.botonAceptar.classList.add('d-none');
        }
    }
}
