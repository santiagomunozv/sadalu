class GeneradoMultiRegistroPlugin{
    setTdAndContador(td , contador){
        this.td = td;
        this.contador = contador;
    }
    setValor(valor){
        this.valor = valor;
    }
    execute(){
        throw "Este metodo debe ser implementado por el descendiente";
    }
    validateTd(){
        if( !this.td ){
            throw "No se ha llamado el metodo setTdAndValue";
        }
    }
}

class GeneradorMultiRegistro {
        constructor(nombreObjeto, nombreContenedor, nombreDiv) {
        this.altura = '35px;';
        this.ancho = '100%;';
        this.campoid = '';
        this.campoEliminacion = '';
        this.botonEliminacion = true;
        this.funcionEliminacion = '';
        this.nombre = nombreObjeto;
        this.contenedor = nombreContenedor;
        this.contenido = nombreDiv;
        this.contador = 0;
        this.campos = new Array();
        this.etiqueta = new Array();
        this.tipo = new Array();
        this.estilo = new Array();
        this.clase = new Array();
        this.sololectura = new Array();
        this.completar = new Array();
        this.opciones = new Array();
        this.funciones = new Array();
        this.nombreOpcion = new Array();
        this.valorOpcion = new Array();
        this.eventoclick = new Array();
        this.otrosAtributos = new Array();
        this.datePickerConfig = {
            format: 'yyyy-mm-dd',
            locale: 'es-es',
            uiLibrary: 'bootstrap4',
            showRightIcon: true,
            size: 'small'
        };
    };

    agregarCampos(datos , tipo){
        this.buildRow(datos, tipo);
    }

    buildRow(datos , tipo) {
        let valor = datos;
        let espacio = document.getElementById(this.contenedor);
        let tr = document.createElement('tr');
        tr.id = this.contenido + this.contador;
        let div = document.createElement('td');    
        // si esta habilitado el parametro de eliminacion de registros del detalle, adicionamos la caneca
        if (this.botonEliminacion) {
            let img = document.createElement('i');
            img.className = "fas fa-trash-alt";
            let caneca = document.createElement('button');
            caneca.id = 'eliminarRegistro' + this.contador;
            caneca.setAttribute('onclick', this.nombre + '.borrarCampos(\'' + tr.id + '\',\'' + this.campoEliminacion + '\',\'' + this.campoid + this.contador + '\'); ' + this.funcionEliminacion + '(\'' + this.contador + '\');');
            caneca.className = 'btn btn-sm btn-danger';
            caneca.type = 'button';
            caneca.appendChild(img);
            div.appendChild(caneca);
        }
        tr.appendChild(div);

        // utilizamos una varibale auxiliar para almacenar los ID de los campos de tipo WEEK
        let campoSemana = '';
        let campoSelect = '';
        for (let i = 0, e = this.campos.length; i < e; i++) {
            let inputTd = document.createElement('td');
            if (this.etiqueta[i] == 'input') {
                let input = document.createElement('input');
                input.type = this.tipo[i];
                input.id = this.campos[i] + this.contador;
                input.name = this.campos[i] + '[]';
                input.value = (typeof(valor[(tipo == 'A' ? i : this.campos[i])]) !== "undefined" ? valor[(tipo == 'A' ? i : this.campos[i])] : '');
                input.className = 'form-control form-control-sm '+this.clase[i];
                input.readOnly = this.sololectura[i];
                input.autocomplete = "off";
                if(input.type == "number"){
                    input.classList.add('text-right');
                }
                if (typeof(this.funciones[i]) !== "undefined") {
                    for (let h = 0, c = this.funciones[i].length; h < c; h += 2) {
                        input.setAttribute(this.funciones[i][h], this.funciones[i][h + 1]);
                    }
                }
                if (typeof(this.otrosAtributos[i]) !== "undefined") {
                    for (let h = 0, c = this.otrosAtributos[i].length; h < c; h += 2) {
                        if (this.otrosAtributos[i][h] != '')
                            input.setAttribute(this.otrosAtributos[i][h][0], this.otrosAtributos[i][h][1]);
                    }
                }
                //Verificar Tipo de campo hidden para omitir creacion de td
                if(this.tipo[i] != 'hidden'){
                    inputTd.appendChild(input);
                }else{
                    div.appendChild(input);
                    if (!this.botonEliminacion) {
                        div.className = "p-0";
                    }
                }
            } else if (this.etiqueta[i] == 'read'){
                let input = document.createElement('div');
                input.id = this.campos[i] + this.contador;
                input.innerHTML = (typeof(valor[(tipo == 'A' ? i : this.campos[i])]) !== "undefined" ? valor[(tipo == 'A' ? i : this.campos[i])] : '');
                input.className = this.clase[i];
                if (typeof(this.funciones[i]) !== "undefined") {
                    for (let h = 0, c = this.funciones[i].length; h < c; h += 2) {
                        input.setAttribute(this.funciones[i][h], this.funciones[i][h + 1]);
                    }
                }
                inputTd.appendChild(input);
            } else if (this.etiqueta[i] == 'date') {
                let input = document.createElement('input');
                $(input).datepicker(this.datePickerConfig);
                input.type = 'text';
                input.id = this.campos[i] + this.contador;
                input.name = this.campos[i] + '[]';
                input.value = (typeof(valor[(tipo == 'A' ? i : this.campos[i])]) !== "undefined" ? valor[(tipo == 'A' ? i : this.campos[i])] : '');
                input.className = 'date-picker form-control form-control-sm'+this.clase[i];
                input.readOnly = true;
                input.autocomplete = "off";
                if (typeof(this.funciones[i]) !== "undefined") {
                    for (let h = 0, c = this.funciones[i].length; h < c; h += 2) {
                        input.setAttribute(this.funciones[i][h], this.funciones[i][h + 1]);
                    }
                }
                if (typeof(this.otrosAtributos[i]) !== "undefined") {
                    for (let h = 0, c = this.otrosAtributos[i].length; h < c; h += 2) {
                        input.setAttribute(this.otrosAtributos[i][h][0], this.otrosAtributos[i][h][1]);
                    }
                }
                inputTd.appendChild(input);
            } else if (this.etiqueta[i] == 'week') {
                let input = document.createElement('input');
                input.type = 'text';
                input.id = this.campos[i] + this.contador;
                input.name = this.campos[i] + '[]';
                input.value = (typeof(valor[(tipo == 'A' ? i : this.campos[i])]) !== "undefined" ? valor[(tipo == 'A' ? i : this.campos[i])] : '');
                input.className = "form-control form-control-sm " + this.clase[i];
                input.readOnly = this.sololectura[i];
                input.autocomplete = "off";
                if (typeof(this.funciones[i]) !== "undefined") {
                    for (let h = 0, c = this.funciones[i].length; h < c; h += 2) {
                        input.setAttribute(this.funciones[i][h], this.funciones[i][h + 1]);
                    }
                }
                // guardamos el ID del campo WEEK
                campoSemana += this.campos[i] + this.contador + ',';
                inputTd.appendChild(input);
            } else if (this.etiqueta[i] == 'file') {
                let input = document.createElement('input');
                input.type = 'file';
                input.id = this.campos[i] + this.contador;
                input.name = this.campos[i] + '[]';
                input.filename = '';
                input.className = "form-control form-control-sm " + this.clase[i];
                input.readOnly = this.sololectura[i];
                if (typeof(this.funciones[i]) !== "undefined") {
                    for (let h = 0, c = this.funciones[i].length; h < c; h += 2) {
                        input.setAttribute(this.funciones[i][h], this.funciones[i][h + 1]);
                    }
                }
                inputTd.appendChild(input);    
            } else if (this.etiqueta[i] == 'textarea') {
                let input = document.createElement('textarea');
                input.id = this.campos[i] + this.contador;
                input.name = this.campos[i] + '[]';
                input.value = valor[(tipo == 'A' ? i : this.campos[i])];
                input.className = 'form-control form-control-sm '+this.clase[i];
                if (this.sololectura[i] === true)
                    input.setAttribute("readOnly", "readOnly");

                if (typeof(this.funciones[i]) !== "undefined") {
                    for (let h = 0, c = this.funciones[i].length; h < c; h += 2) {
                        input.setAttribute(this.funciones[i][h], this.funciones[i][h + 1]);
                    }
                }
                inputTd.appendChild(input);
            } else if (this.etiqueta[i] == 'select') {
                let select = document.createElement('select');
                let option = '';
                select.id = this.campos[i] + this.contador;
                select.name = this.campos[i] + '[]';
                select.className = 'form-control form-control-sm '+this.clase[i];
                if (typeof(this.funciones[i]) !== "undefined") {
                    for (let h = 0, c = this.funciones[i].length; h < c; h += 2) {
                        select.setAttribute(this.funciones[i][h], this.funciones[i][h + 1]);
                    }
                }
                
                option = document.createElement('option');
                option.value = '';
                option.text = 'Seleccione...';
                select.appendChild(option);

                for (let j = 0, k = this.opciones[i].length; j < k; j += 2) {
                    for (let p = 0, l = this.opciones[i][j].length; p < l; p++) {
                        option = document.createElement('option');
                        option.value = this.opciones[i][j][p];
                        option.text = this.opciones[i][j + 1][p];

                        option.selected = (valor[(tipo == 'A' ? i : this.campos[i])] == this.opciones[i][j][p] ? true : false);
                        select.appendChild(option);
                    }
                }
                
                // guardamos el ID del campo SELECT si en las clases tiene chosen-select, ya que al final debemos ejecutar la funcion que lo convierte
                if (this.clase[i].indexOf('chosen-select') >= 0) {
                    inputTd.style.maxWidth = '300px';
                    campoSelect += '#' + this.campos[i] + this.contador + ',';
                }

                if (typeof(this.otrosAtributos[i]) !== "undefined") {
                    for (let h = 0, c = this.otrosAtributos[i].length; h < c; h++) {
                        // Adicionamos atributos al html siempre y cuando no estén vacíos
                        if (this.otrosAtributos[i][h][0] != '')
                        {
                            // Para las listas de selección Multiples, cambiamos la forma del NAME como tipo ARRAY
                            if (this.otrosAtributos[i][h][0] == 'Multiple')
                                select.name = this.campos[i] + '['+this.contador+'][]';

                            // Adicionamos el atributo al HTML
                            select.setAttribute(this.otrosAtributos[i][h][0], this.otrosAtributos[i][h][1]);
                        }
                    }
                }
                inputTd.appendChild(select);    
            } else if (this.etiqueta[i] == 'checkbox') {
                let labelCheck = document.createElement('label');
                labelCheck.className = 'custom-checkbox-container';
                let inputHidden = document.createElement('input');
                inputHidden.type = 'hidden';
                inputHidden.id = this.campos[i] + this.contador;
                inputHidden.name = this.campos[i] + '[]';
                inputHidden.value = (valor[(tipo == 'A' ? i : this.campos[i])] ? valor[(tipo == 'A' ? i : this.campos[i])] : 0);
                labelCheck.appendChild(inputHidden);
                let input = document.createElement('input');
                input.type = "checkbox";
                input.id = this.campos[i] + 'C' + this.contador;
                input.name = this.campos[i] + 'C' + '[]';
                input.checked = (valor[(tipo == 'A' ? i : this.campos[i])] == 1 ? true : false);
                input.setAttribute("onclick", this.nombre + '.cambiarCheckbox("' + this.campos[i] + '",' + this.contador + ')');
                if (typeof(this.funciones[i]) !== "undefined") {
                    for (let h = 0, c = this.funciones[i].length; h < c; h += 2) {
                        input.setAttribute(this.funciones[i][h], this.funciones[i][h + 1]);
                    }
                }
                let span = document.createElement('span');
                span.className = "checkmark";

                labelCheck.appendChild(input);
                labelCheck.appendChild(span);
                inputTd.style.textAlign='center';
                inputTd.appendChild(labelCheck);

            } else if (this.etiqueta[i] == 'firma') {
                // conlos campos de firma creamos
                // un img para mostrar la firma en base64 y desde la vista
                // tambien debe crear un input hidden para
                // guardar el dato base64 para que el controlador lo guarde
                let firma = document.createElement('img');
                firma.id = this.campos[i] + this.contador;
                firma.src = (typeof(valor[(tipo == 'A' ? i : this.campos[i])]) !== "undefined" ? valor[(tipo == 'A' ? i : this.campos[i])] : '');
                input.className = 'form-control form-control-sm '+this.clase[i];
                firma.setAttribute("onclick", "mostrarFirma(" + this.contador + ")");
                if (typeof(this.funciones[i]) !== "undefined") {
                    for (let h = 0, c = this.funciones[i].length; h < c; h += 2) {
                        firma.setAttribute(this.funciones[i][h], this.funciones[i][h + 1]);
                    }
                }
                inputTd.appendChild(firma);
            } else if (this.etiqueta[i] == 'imagen') {
                // conlos campos de imagen creamos
                // un img para mostrarla  en base64
                let imagen = document.createElement('img');
                imagen.id = this.campos[i] + this.contador;
                imagen.src = (typeof(valor[(tipo == 'A' ? i : this.campos[i])]) !== "undefined" ? 'http://' + location.host + '/imagenes/' + valor[(tipo == 'A' ? i : this.campos[i])] : '');
                imagen.setAttribute("placeholder", 'Vista previa de la imagen');
                input.className = 'form-control form-control-sm '+this.clase[i];
                imagen.setAttribute("onclick", "mostrarImagen('" + 'http://' + location.host + '/imagenes/' + valor[this.campos[i]] + "')");
                if (typeof(this.funciones[i]) !== "undefined") {
                    for (let h = 0, c = this.funciones[i].length; h < c; h += 2) {
                        imagen.setAttribute(this.funciones[i][h], this.funciones[i][h + 1]);
                    }
                }
                inputTd.appendChild(imagen);
            } else if (this.etiqueta[i] == 'button') {
                let button = document.createElement('button');
                button.type = this.tipo[i];
                button.id = this.campos[i] + this.contador;
                button.name = this.campos[i] + '[]';
                button.disabled = this.sololectura[i];
                button.innerHTML = (typeof(valor[(tipo == 'A' ? i : this.campos[i])]) !== "undefined" ? valor[(tipo == 'A' ? i : this.campos[i])] : '');
                button.className = 'btn '+this.clase[i];
                if (typeof(this.funciones[i]) !== "undefined") {
                    for (let h = 0, c = this.funciones[i].length; h < c; h += 2) {
                        button.setAttribute(this.funciones[i][h], this.funciones[i][h + 1]);
                    }
                }

                if (typeof(this.otrosAtributos[i]) !== "undefined") {
                    for (let h = 0, c = this.otrosAtributos[i].length; h < c; h++) {
                        if (this.otrosAtributos[i][h] != '')
                        button.setAttribute(this.otrosAtributos[i][h][0], this.otrosAtributos[i][h][1]);
                    }
                }

                inputTd.appendChild(button);
            }else if(this.etiqueta[i] == 'plugin'){
                let plugin = valor[tipo == 'A' ? i: this.campos[i]];
                if( plugin instanceof GeneradoMultiRegistroPlugin ){
                    plugin.setTdAndContador( inputTd , this.contador);
                    plugin.execute();
                }
            }
            //Verificar Tipo de campo hidden para omitir creacion de td
            if(this.tipo[i] != 'hidden'){
                tr.appendChild(inputTd);
            }

            espacio.appendChild(tr);
        }
        // si hay campos WEEK, los convertimos
        if (campoSemana != '') {
            // quitamos la ultima coma concatenada
            campoSemana = campoSemana.substring(0, campoSemana.length - 1);
            IDS = campoSemana.split(',');

            for (sem = 0; sem < IDS.length; sem++) {
                //TODO: implementame
                throw 'aún no se ha definido la implementacion de este metodo ni los plugins necesarios para hacerlo.';
            }
        }

        // Si hay campos SELEC (chosen-select)
        if (campoSelect != '') {
            // quitamos la ultima coma concatenada
            campoSelect = campoSelect.substring(0, campoSelect.length - 1);
            $("select").trigger('liszt:updated');
        }

        // incrementamos el contador de registros
        this.contador++;
        $('.chosen-select').chosen(chosenConfig.multi);
        
    }

    borrarCampos(elemento, campoEliminacion, campoid) {
        if ($("#" + campoid) && ($("#" + campoid).val() == '' || $("#" + campoid).val() == 0 || $("#" + campoid).val() == null)) {
            $("#" + elemento).remove();
        } else {
            if (campoEliminacion && $("#" + campoEliminacion) && $("#" + campoid)){
                $("#" + campoEliminacion).val($("#" + campoEliminacion).val() + $("#" + campoid).val() + ',');
            }
            $("#" + elemento).remove();
        }
    }

    borrarTodosCampos() {
        for (let posborrar = 0; posborrar < this.contador; posborrar++) {
            this.borrarCampos(this.contenido + posborrar, this.campoEliminacion, this.campoid + posborrar);
        }
        this.contador = 0;
    }

    cambiarCheckbox(campo, registro) {
        document.getElementById(campo + registro).value = document.getElementById(campo + "C" + registro).checked ? 1 : 0;
        // document.getElementById(campo + registro).value = document.getElementById(campo + "C" + registro).checked ? 1 : 0;
    }
}