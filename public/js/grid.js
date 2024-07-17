var lastIdx = null;
var DATA_TABLE_BASIC_CONFIG = {
    "searchDelay" : 1000,
    "aaSorting": [],
    "aProcessing": true,
    "aServerSide": true,
    "stateSave":false,
    "lengthMenu": [ 10, 25, 50,100,200] ,
    "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ning&uacute;n dato disponible en esta tabla",
                "sInfo":           "Registros del _START_ al _END_ de un total de _TOTAL_ ",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "&Uacute;ltimo",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
}

function configurarGrid(idTabla){
    let GRID_CONFIG = Object.assign({}, DATA_TABLE_BASIC_CONFIG)
    GRID_CONFIG.buttons = [ { extend: 'excel', text:'<i class="fa fa-download" aria-hidden="true"></i>',className: 'btn btn-sm btn-primary'} ];
    GRID_CONFIG.dom = 'Blfrtip';
    configurarDataTable(idTabla,GRID_CONFIG);
}

function configurarGridAjax(idTabla,ruta){
    let GRID_CONFIG = Object.assign({}, DATA_TABLE_BASIC_CONFIG)
    GRID_CONFIG.buttons = [ { extend: 'excel', text:'<i class="fa fa-download" aria-hidden="true"></i>',className: 'btn btn-sm btn-primary'} ];
    GRID_CONFIG.dom = 'Blfrtip';
    GRID_CONFIG.processing = true;
    GRID_CONFIG.serverSide = true;
    GRID_CONFIG.ajax = {url:ruta,type:"GET"}
    configurarDataTable(idTabla,GRID_CONFIG);
}

function configurarGridSelect(idTabla){
    let GRID_SELECT_CONFIG = Object.assign({}, DATA_TABLE_BASIC_CONFIG)
    GRID_SELECT_CONFIG.gridSelect = true;
    configurarDataTable(idTabla,GRID_SELECT_CONFIG);
}

function configurarDataTable(idTabla,config){
    "use strict";
    let table = $('#'+idTabla).DataTable(config);

    if(!config || (config && !config.serverSide)){
        $('#'+idTabla+' tfoot th').each( function () {
            if((config && config.gridSelect) || $(this).index() > 0){
                var title = $('#'+idTabla+' thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" class="form-control form-control-sm searchGrid" /><span class="fas fa-search errspan"></span>' );
            }
        });

        table.columns().every( function () {
            let that = this;
            $( 'input', this.footer() ).on( 'change', function () {
                if ( that.search() !== this.value ) {
                    table.search('');
                    that
                        .search( this.value )
                        .draw();
                }
            });
    
            $('#btnLimpiarFiltros').click(function(){
                that.search('').draw();
                $( "#"+idTabla+' tfoot input').val("");
            });
        });
    }
    
    $('#btnRecargar').click(function(){
        location.reload(true);
    });

    if(config && config.gridSelect){
        $('#'+idTabla+' tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('table-info');    
        } );
    }
}

function laravelDatatable(url,columnData,idTabla , orderBy){

    let GRID_CONFIG = Object.assign({}, DATA_TABLE_BASIC_CONFIG);
    GRID_CONFIG.processing = true;
    GRID_CONFIG.serverSide = true;
    GRID_CONFIG.ajax = url;
    GRID_CONFIG.columns = columnData;
    if(orderBy){
        GRID_CONFIG.order = orderBy;
    }

    GRID_CONFIG.initComplete= function() {
        let filter = false;
        this.api().columns().eq(0).each(function(index) {
            if(index > 0){
                var column = this.column(index);
                var input = document.createElement("input");
                input.className = "form-control form-control-sm";
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val()).draw();
                });

                if(!filter){
                    let that = this;
                    $('#btnLimpiarFiltros').click(function(){
                        $( "#"+idTabla+' tfoot input').val("");
                        that.search('')
                        .columns().search( '' )
                        .draw();
                    });
                    filter = true;
                }
            }
        });

        $('#btnRecargar').click(function(){
            location.reload(true);
        });
    }

    $('#'+idTabla).DataTable(GRID_CONFIG);
}
