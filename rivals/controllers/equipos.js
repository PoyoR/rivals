/**
 * Creado el 01-Octubre-2021 por Aldo Castañeda V.
 * 
 * Comentarios:
 * Este archivo se usa tanto en la lista de equipos como en buscar por IMEI para los eventos
 */

// <---------------------------- VARIABLES ------------------------------>
/*var datatable = null;
var firebaseConfig = {
    apiKey: "AIzaSyAYCVq6ZRgKEJNRdYDRwM8YLmI6095CzTE",
    authDomain: "microtecadmin.firebaseapp.com",
    projectId: "microtecadmin",
    storageBucket: "microtecadmin.appspot.com",
    messagingSenderId: "1039423512582",
    appId: "1:1039423512582:web:6136e8ebdc997e335aa387",
    measurementId: "G-H66CJTDSM6"
};*/

// Initialize Firebase
//firebase.initializeApp(firebaseConfig);

// <---------------------------- EVENTOS ------------------------------>

$(document).on('click', '.notificacion', function (event) {
    let id = $(this).data('id');
    let imei = $(this).data('imei');
    
    Swal.fire({
        title: 'Panel de Acciones',
        text: 'Haz click sobre la acción a realizar...',
        input: 'radio',
        inputOptions: {
            "5": '<div class="iconpanel iconpanel--yell"><img src="./assets/images/icons/notificacion.gif" alt="" class="icon"><span>Enviar notificación</span></div>',
            "8": '<div class="iconpanel iconpanel--purple"><img src="./assets/images/icons/modo-credito.gif" alt="" class="icon"><span>Modo crédito</span></div>',
            "9": '<div class="iconpanel iconpanel--orange"><img src="./assets/images/icons/modotienda.gif" alt="" class="icon"><span>Modo Tienda</span></div>',
            "1": '<div class="iconpanel iconpanel--red"><img src="./assets/images/icons/bloqpago.gif" alt="" class="icon"><span>Bloqueo por pago</span></div>',
            "3": '<div class="iconpanel iconpanel--red"><img src="./assets/images/icons/bloqrobo.gif" alt="" class="icon"><span>Bloqueo por robo</span></div>',
            "0": '<div class="iconpanel iconpanel--green"><img src="./assets/images/icons/desbpago.gif" alt="" class="icon"><span>Desbloqueo por pago</span></div>',
            "2": '<div class="iconpanel iconpanel--green"><img src="./assets/images/icons/desbrobo.gif" alt="" class="icon"><span>Desbloqueo por robo</span></div>',
            "4": '<div class="iconpanel iconpanel--blueaq"><img src="./assets/images/icons/explorar.gif" alt="" class="icon"><span>Explorar Dispositivo (30 seg)</span></div>',
            "6": '<div class="iconpanel iconpanel--blueaq"><img src="./assets/images/icons/ubicacion.gif" alt="" class="icon"><span>Solicitar ubicación dispositivo</span></div>',
            "7": '<div class="iconpanel iconpanel--red0"><img src="./assets/images/icons/marker.gif" alt="" class="icon"><span>Ping</span></div>',
            "10": '<div class="iconpanel iconpanel--blueaq"><img src="./assets/images/icons/sms.gif" alt="" class="icon"><span>Solicitar SMS</span></div>',
        },
        inputPlaceholder: 'Seleccione una opción',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Enviar',
        reverseButtons: true,
        customClass: {
          container: 'action-panel',
          popup: 'action-panel--popup',
        },
        inputValidator: (value) => {
            return new Promise((resolve) => {
                if (value !== '') {
                    resolve()
                } else {
                    resolve('Necesitas seleccionar una opción')
                }
            })
        }
    }).then(result => {
        if (result.isConfirmed) {
            let opcion = result.value;
            let funcion = "";
            if (opcion == 0 || opcion == 1) {
                funcion = "actualizarStatusPago";
                enviarNotif(funcion, opcion, imei, id);
            } else if (opcion == 2 || opcion == 3) {
                opcion = opcion == 2 ? 0 : 1;
                funcion = "actualizarStatusRobo";
                enviarNotif(funcion, opcion, imei, id);
            }else if (opcion == 4) {
                funcion = "explorarDispositivo";
                enviarNotif(funcion, opcion, imei, id);
            }else if (opcion == 5) {
                sendNotif(imei, id);
            } else if (opcion == 6) {
                funcion = "getUbicacion";
                enviarNotif(funcion, opcion, imei, id);
            }else if (opcion == 7) {
            	funcion = "enviarPing";
                enviarNotif(funcion, opcion, imei, id);
            }else if (opcion == 8) {
                funcion = "liberarTienda";
                enviarNotif(funcion, opcion, imei, id);
            }else if(opcion == 9){
                funcion = "ingresarTienda";
                enviarNotif(funcion, opcion, imei, id);
            }else if(opcion == 10){
                funcion = "solicitarSms";
                enviarNotif(funcion, opcion, imei, id);
            }

            

            /*firebase.auth().signInAnonymously()
                .then(() => {
                    console.log("logueado");
                    
                    var db = firebase.firestore();
                    var ref = db.collection("dispositivos").doc(imei.toString());
                    

                    switch (opcion) {
                        case "0":
                            ref.update({
                                pago: false
                            }).then(() => {
                                enviarNotif(funcion, opcion, imei, id);
                            }).catch((error) => {
                                // The document probably doesn't exist.
                                console.error("Error updating document: ", error);
                                enviarNotif(funcion, opcion, imei, id);
                            });
                            break;
                        case "1":
                            ref.update({
                                pago: true
                            }).then(() => {
                                enviarNotif(funcion, opcion, imei, id);
                            }).catch((error) => {
                                // The document probably doesn't exist.
                                console.error("Error updating document: ", error);
                                enviarNotif(funcion, opcion, imei, id);
                            });
                            break;
                        case "8":
                            ref.update({
                                tienda: false
                            }).then(() => {
                                enviarNotif(funcion, opcion, imei, id);
                            }).catch((error) => {
                                // The document probably doesn't exist.
                                console.error("Error updating document: ", error);
                                enviarNotif(funcion, opcion, imei, id);
                            });
                            break;
                        case "9":
                            ref.update({
                                tienda: true
                            }).then(() => {
                                enviarNotif(funcion, opcion, imei, id);
                            }).catch((error) => {
                                // The document probably doesn't exist.
                                console.error("Error updating document: ", error);
                                enviarNotif(funcion, opcion, imei, id);
                            });
                            break;
                        default:
                            enviarNotif(funcion, opcion, imei, id);
                            break;
                        }
                    
                })
                .catch((error) => {
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    console.log("error "+ error.message);
                });*/
        }
    })
})

function sendNotif(imei, id){

    Swal.fire({
        title: 'Enviar Notificación',
        icon: 'info',
        html: `
            <div class="form-group">
                <label for="txtNotif">Ingrese el mensaje a enviar</label>
                <input type="text" class="form-control" id="txtNotif">
            </div>`,
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {

            var texto = $('#txtNotif').val();
            
            $.ajax({
                url: 'models/funciones.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    function: "enviarNotif",
                    txt: texto,
                    imei: imei,
                    id: id
                },
                beforeSend: () => {
                    swalLoading('Enviando información');
                }
            }).done(response => {
                console.log(response);
                if (response.status) {

                    datatable.ajax.reload();
                    Swal.close('Éxito', response.msg, 'success');
                } else {
                    Swal.fire('Error', response.msg, 'error');
                }
            }).fail((xhr, status, problem) => {
                Swal.fire("Error", 'Hubo un problema al conectar con el servidor', 'error');
                console.log(xhr, status, problem);
            });

        }

    });

}

$(document).on('click', '.garantia', function (event) {
    let id = $(this).data('id');
    let garantia = $(this).data('garantia');
    let imei = $(this).data('imei');

    let textTipo = garantia == 1 ? '¿Retirar equipo de garantía?' : '¿Ingresar equipo a garantía?'
    let notificacion = garantia == 1 ? 0 : 1 // Si la bandera de garantia esta como 1 entonces se envia la notificacion 0 para retirar de garantia el equipo
    Swal.fire({
        title: 'Cuidado',
        text: textTipo,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'models/funciones.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    function: "actualizarStatusGarantia",
                    notificacion: notificacion,
                    imei: imei,
                    id: id
                },
                beforeSend: () => {
                    swalLoading('Enviando información');
                }
            }).done(response => {
                if (response.status) {
                
                    datatable.ajax.reload();
                    Swal.close('Éxito', response.msg, 'success');
                } else {
                    Swal.fire('Error', response.msg, 'error');
                }
            }).fail((xhr, status, problem) => {
                Swal.fire("Error", 'Hubo un problema al conectar con el servidor', 'error');
                console.log(xhr, status, problem);
            });
        }
    })
})

$(document).on('click', '.borrar', function (event) {
    let id = $(this).data('id');
    let imei = $(this).data('imei');

    Swal.fire({
        title: 'Liberar equipo',
        text: 'Está acción no se puede revertir',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, continuar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            enviarLiberacion(imei, id);

            /*var db = firebase.firestore();
            firebase.auth().signInAnonymously()
                .then(() => {
                    console.log("logueado");
                    //var ref = db.collection("dispositivos").doc(imei.toString());

                    ref.update({
                        habilitado: false
                    }).then(() => {
                        enviarLiberacion(imei, id);
                    }).catch((error) => {
                        // The document probably doesn't exist.
                        console.error("Error updating document: ", error);
                        enviarLiberacion(imei, id);
                    });
                    
                })
                .catch((error) => {
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    console.log("error"+ error.message);
                });*/
            
        }
    })
})

$(document).on('click', '.cancelar', function (event) {
    let id = $(this).data('id');
    let imei = $(this).data('imei');

    Swal.fire({
        title: 'Cancelar equipo',
        text: 'Está acción no se puede revertir',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, continuar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            
            $.ajax({
                url: 'models/funciones.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    function: 'cancelarVenta',
                    imei: imei
                },
                beforeSend: () => {
                    swalLoading('Enviando información');
                }
            }).done(response => {
                console.log(response);
            }).fail((xhr, status, problem) => {
                Swal.fire("Error", 'Hubo un problema al conectar con el servidor', 'error');
                console.log(xhr, status, problem);
            });

        }
    })
})


// <---------------------------- FUNCIONES ------------------------------>

/**
 * Indentifica la compañía y devuelve un Badge
 * @param {String} data Nombre de la compañía
 * @returns Badge con el color y nombre
 */
var getCompania = function (data) {
    let red = {
        'TELCEL': 'primary',
        'ATT': 'info',
        'MOVISTAR': 'success',
        'UNEFON': 'warning'
    };
    let badge = 'default';
    // Revisamos si existe la compañía
    if (Object.keys(red).find(key => key === data) !== undefined) {
        badge = red[data];
    }
    return '<span class="badge badge-' + badge + '">' + data + '</span>';
}

function getEquipos() {
    const columnas = [{
        data: "fecha",
        title: "Fecha creación"
    }, {
        data: "imei",
        title: "IMEI",
        className: 'text-center'
    }, {
        data: "equipo",
        title: "Equipo"
    }, {
        data: "iccid",
        title: "ICCID"
    }, {
        data: "red",
        title: "Red",
        className: 'text-center'
    }, {
        data: 'status',
        title: 'Estatus',
    }/*, {
        data: 'tienda',
        title: 'Tienda',
    }, {
        data: 'robo',
        title: 'Robado',
        className: 'text-center'
    }*/, {
        data: 'garantia',
        title: 'En garantía',
        className: 'text-center'
    }, {
        data: null,
        title: 'Acciones'
    }];

    datatable = $('#tabla_equipos').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        pageLength: 10,
        processing: true,
        serverSide: true,
        destroy: true,
        searching: true,
        order: [
            [0, "desc"]
        ],
         buttons: [
            {
                extend: 'pdf',
                className: 'btn btn-secondary btn-sm',
                text: 'Exportar PDF',
                action: newExportAction,
                download: 'open',
                messageTop: 'Equipos atrasados',
                footer: true
            }, {
                extend: 'excel',
                className: 'btn btn-secondary btn-sm',
                text: 'Exportar Excel',
                action: newExportAction,
                download: 'open',
                messageTop: 'Equipos atrasados',
                footer: true
            }],
            dom: 'Blfrtip',
        ajax: {
            url: "models/equipos.php",
            type: "POST",
            dataType: 'JSON',
            data: {
                function: "getAllEquipos",
                data: columnas
            }
        },
        columns: columnas,
        columnDefs: [{
            targets: 4,
            render: (data, type, row) => {
                return getCompania(data);
            }
        }, {
            targets: 5,
            render: (data, type, row) => {
                return '<span class="badge badge-primary">'+data+'</span>';
            }
        }, /*{
            targets: [6],
            render: (data, type, row) => {
                return data == 1 ? '<span class="badge badge-warning">Modo tienda</span>' : '<span class="badge badge-success">Modo crédito</span>';
            }
        }, */{
            targets: 6,
            render: (data, type, row) => {
                return data == 1 ? 'Sí' : 'No';
            }
        }, {
            targets: [7],
            searchable: false,
            orderable: false,
            render: (data, type, row) => {
                let buttons = "";
                let espacio = 'style="margin-right: 1px;"';
                buttons += `<button class="btn btn-success btn-sm notificacion" data-id="${row.id}" data-imei="${row.imei}" title="Enviar notificaciones" ${espacio} data-toggle="tooltip"> <i class="fa fa-bell"></i> </button>`;
                // buttons += '<button id="btn_esquema" data-chip="${element.chip}" data-id="${element.id}" data-key="${element.esquema}" class="btn btn-primary btn-sm" title="Modificar esquemas de bloqueo" data-toggle="tooltip"><i class="fa fa-cog" aria-hidden="true"></i></button>';
                buttons += `<button class="btn btn-warning btn-sm garantia" data-garantia="${row.garantia}" data-id="${row.id}" data-imei="${row.imei}" title="Ingresar/retirar equipo a garantía" ${espacio} data-toggle="tooltip"><i class="fa fa-wrench" aria-hidden="true"></i></button>`;
                buttons += `<button class="btn btn-danger btn-sm borrar" data-id="${row.id}" data-imei="${row.imei}" title="Liberar equipo" ${espacio}  data-toggle="tooltip"><i class="fa fa-minus-circle fa-lg"></i></button>`;
                buttons += `<button class="btn btn-danger btn-sm cancelar" data-id="${row.id}" data-imei="${row.imei}" title="Cancelar equipo" ${espacio}  data-toggle="tooltip"><i class="fa fa-lock fa-lg"></i></button>`;
                return buttons;
            }
        }],
        initComplete: (settings, json) => {
            anonymous.modifyInput('#tabla_equipos');
        },
        // createdRow: (row, data, dataIndex) => {
        //     $(row).css("background-color", getColorCodigo(data.codigo));
        //     $(row).find('td').css("color", '#f1f2f1');
        // }
    });
}


function enviarNotif(funcion, opcion, imei, id){
    $.ajax({
        url: 'models/funciones.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
            function: funcion,
            notificacion: opcion,
            imei: imei,
            id: id
        },
        beforeSend: () => {
            swalLoading('Enviando información');
        }
    }).done(response => {
        console.log(response);
        if (response.status) {

            datatable.ajax.reload();
            Swal.close('Éxito', response.msg, 'success');
        } else {
            Swal.fire('Error', response.msg, 'error');
        }
    }).fail((xhr, status, problem) => {
        Swal.fire("Error", 'Hubo un problema al conectar con el servidor', 'error');
        console.log(xhr, status, problem);
    });
}

function enviarLiberacion(imei, id){
    $.ajax({
        url: 'models/funciones.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
            function: "actualizarStatusLiberar",
            notificacion: 1,
            imei: imei,
            id: id
        },
        beforeSend: () => {
            swalLoading('Enviando información');
        }
    }).done(response => {
        if (response.status) {

            datatable.ajax.reload();
            Swal.close('Éxito', response.msg, 'success');
        } else {
            Swal.fire('Error', response.msg, 'error');
        }
    }).fail((xhr, status, problem) => {
        Swal.fire("Error", 'Hubo un problema al conectar con el servidor', 'error');
        console.log(xhr, status, problem);
    });
}