// https://stackoverflow.com/questions/32692618/how-to-export-all-rows-from-datatables-using-ajax
// codigo para obtener todas las filas de la datatable usando la opción de serverSide solo funcional para excel

var oldExportAction = function (self, e, dt, button, config) {
    if (button[0].className.indexOf('buttons-excel') >= 0) {
        if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
            $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
        } else {
            $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
        }
    } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
        if ($.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config)) {
            $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config);
        } else {
            $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
        }
    } else if (button[0].className.indexOf('buttons-print') >= 0) {
        $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
    }
};

var newExportAction = function (e, dt, button, config) {
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;

    dt.one('preXhr', function (e, s, data) {
        // Just this once, load all data from the server...
        data.start = 0;
        data.length = 2147483647;

        dt.one('preDraw', function (e, settings) {
            // Call the original action function 
            oldExportAction(self, e, dt, button, config);

            dt.one('preXhr', function (e, s, data) {
                // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                // Set the property to what it was before exporting.
                settings._iDisplayStart = oldStart;
                data.start = oldStart;
            });

            // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
            setTimeout(dt.ajax.reload, 0);

            // Prevent rendering of the full data to the DOM
            return false;
        });
    });

    // Requery the server with the new one-time export settings
    dt.ajax.reload();
};

var anonymous = {
    modifyInput: selector => {
        const oTable = $(selector).DataTable();
        selector += '_filter';
        $(selector).find("input").off().on("keyup", function (ev) {
            if (this.value.length >= 3 && this.value != '') {
                //console.log( this.value);
                oTable.search(this.value).draw();
            }
            if (this.value == '') {
                oTable.search('').draw();
            }
        });
    }
};

var total = {
    cargos: selector => {
        const oTable = $(selector).DataTable();
        let total = 0;

        oTable.rows().every((rowIdx, tableLoop, rowLoop) => {
            const rowData = oTable.row(rowIdx).data();
            if (rowData.cargo != '') {
                total += parseFloat(rowData.cargo);
            }
        });

        total = new Intl.NumberFormat('es-MX', {
            style: 'currency',
            currency: 'MXN'
        }).format(total);

        $(oTable.column(5).footer()).html(total);
    }, 
    abonos: selector => {
        const oTable = $(selector).DataTable();
        let total = 0;

        oTable.rows().every((rowIdx, tableLoop, rowLoop) => {
            const rowData = oTable.row(rowIdx).data();
            if (rowData.abono != '') {
                total += parseFloat(rowData.abono);
            }
        });

        total = new Intl.NumberFormat('es-MX', {
            style: 'currency',
            currency: 'MXN'
        }).format(total);

        $(oTable.column(6).footer()).html(total);
    }
};