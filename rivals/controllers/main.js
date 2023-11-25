// Funciones de Swal
const swalLoading = function (title) {
    Swal.fire({
        title: title,
        didOpen: () => {
            swal.showLoading()
        },
        allowOutsideClick: false,
        allowEscapeKey: false
    });
}

const soloNum = function(e) {
    var keynum = window.event ? window.event.keyCode : e.which;
    if (keynum <= 13 || ((keynum >= 48) && (keynum <= 57)))
        return true;
    else
        return false;
}

/**
 * Cerrar sesión
 */
$('#close-sesion').on('click', function (ev) {
    ev.preventDefault();

    $.ajax({
        url: 'models/closeSession.php',
        type: 'POST',
        dataType: 'JSON',
        beforeSend: () => {
            swalLoading('Cerrando sesión')
        },
    }).done((data) => {
        if (data.status) {
            location.reload();
        } else {
            Swal.fire("Error", 'Error cerrando sesión intente nuevamente', 'error')
                .then(() => {
                    location.reload();
                });
        }
    }).fail(() => {
        Swal.fire("Error", 'Hubo un problema al conectar con el servidor', 'error');
    });

});