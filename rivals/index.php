<?php
session_start();
if (!isset($_SESSION['rivals'])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Overwatch Rivals</title>
    <link rel="shortcut icon" href="assets/images/rivals2.png">
    <!-- Bootstrap CSS CDN -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Our Custom CSS -->
    <!-- <link rel="stylesheet" href="assets/css/style2.css"> -->
    <!-- Custom styles for this page -->
    <!-- <link href="datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/b-print-1.5.4/datatables.min.css" /> -->
        <link rel="stylesheet" href="assets/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css" />



    <style>
        @import url('https://fonts.googleapis.com/css?family=Delius&display=swap');

        .btnCerrarNotif:hover{
            cursor: pointer;
        }

    </style>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="in-left navbar-collapse" style="background: #1c222b;">
            <div class="sidebar-header p-2" style="height: 135px; background: #28303f;">
                <img src="assets/images/rivals2.png" class="img-fluid iconlogo" alt="rivals" height="90px"
                    width="auto">
            </div>
            <div class="scroll_vertical" style="height: 100%;
                width: 250px;
                overflow: auto;">
                <ul class="list-unstyled components navbar-nav" id="menu-cm">

                    <?php
                    if ($_SESSION['rivals_user'] == "poyo") {
                    ?>
                        <li class="nav-item">
                            <a href="panel_control.html" class="ajaxLink"><i class="fas fa-clipboard-list mr-2"></i> Panel de control</a>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    if ($_SESSION['rivals_user'] == "poyo" || $_SESSION['rivals_caster'] == 1) {
                    ?>
                        <li class="nav-item">
                            <a href="caster.html" class="ajaxLink"><i class="fab fa-teamspeak"></i> Caster</a>
                        </li>
                    <?php
                    }
                    ?>

                    <li class="nav-item">
                        <a href="inicio.html" class="ajaxLink"><i class="fas fa-home"></i>
                            Inicio 
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="perfil.html" class="ajaxLink"><i class="fas fa-user-circle"></i> 
                            Mi perfil
                            <span style="height: auto; width: auto;" id="badgeInv" class="badge bg-danger ml-2"></span>
                        </a>
                        
                    </li>

                    <li class="nav-item">
                        <a href="equipos.html" class="ajaxLink"><i class="fas fa-flag"></i> Mis equipos</a>
                    </li>


                     <li class="nav-item">
                        <a href="faq.html" class="ajaxLink"><i class="fas fa-question-circle"></i> FAQ</a>
                    </li>

                </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content" style="background: #151b27;">

            <nav class="navbar navbar-expand-lg" style="height: 135px; background: #1c222b;">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <button style="background-color: #EF6C00;" id="toggsidebar" class="togbtn" type="button">
                            <i style="color: #ECEFF1;" class="fas fa-bars"></i>
                        </button>

                        <ul>


                        <div class="notificacion" style="display: none; box-shadow: 0 5px 5px 0 rgba(255, 255, 255, 0.1);  border-radius: 8px; background-color: #f7f7f7; position: absolute; right: 50px; top: 0px; z-index: 10000 !important; width: 250px;">
                        </div>


                        </ul>
                        

                        <ul class="nav navbar-nav ml-auto" style="background: #28303f;">
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow " style="background: #28303f;">
                                <a class="nav-link dropdown-toggl" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    
                                    <span id="spanNomUsuario" class="mr-2  d-lg-inline" style="color: #FFF;"></span>
                                    <img id="imgPerfilUsuario" class="img-profile rounded-circle"  width="50px">
                                    
                                    <!-- <i class="fas fa-user fa-2x"></i> -->
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <!--<a class="dropdown-item" href="#cambiarPass" data-toggle="modal"> <i
                                            class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Cambiar Contraseña
                                    </a>-->
                                    <!-- <a class="dropdown-item" href="#"> <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Ajustes</a> -->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" id="close-sesion" href="#"> <i
                                            class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Cerrar
                                        sesión</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="content-replace">

            </div>
        </div>
        <!--content-->
    </div>
    <!--wrapper-->

    <!-- The Modal -->
    <div class="modal fade" id="cambiarPass">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Cambio de Contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="row msg_pass d-none">
                        <div class="col">
                            <div class="alert alert-danger">
                                Debes cambiar tu contraseña por seguridad
                            </div>
                        </div>
                    </div>

                    <form action="" method="get" accept-charset="utf-8" name="edit_pass" id="edit_pass">

                        <div class="form row">

                            <div class="col-6">
                                <label>Contraseña</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                    </div>
                                    <input type="password" name="password" placeholder="contraseña del usuario"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <label>Repetir Contraseña</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                    </div>
                                    <input type="password" name="password_repeat" placeholder="repetir contraseña"
                                        class="form-control" required>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-retweet"></i> Cambiar
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>

        <script src="assets/js/all.js"></script>

        <script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datepicker/datepicker.min.js" type="text/javascript"></script>
        <script src="assets/plugins/datepicker/datepicker.es.js" type="text/javascript"></script>

        <!-- Page level plugins -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/es.js"></script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.min.js">
        </script>

        <script src="assets/js/app.js"></script>
        <script src="assets/js/datatableController.js"></script>
        <script src="controllers/main.js"></script>
        <script>
        /* $("nav .components li").css('display', 'list-item');
        setTimeout(() => {
            $('#menu-cm li a').first().click();
        }, 10); */
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3/dist/chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2  "></script>
        <script>


            function getDatosUsuario(){

                let data = {
                    "function": "getDatosPerfil"
                };

                $.ajax({
                    url: 'models/funciones.php',
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    success: function(resp) {
        
                        if(resp.status == 1){
            
                           $('#spanNomUsuario').html(resp.data[0].usuario);
                           $('#imgPerfilUsuario').attr("src", resp.data[0].perfil);
                        }
                    },
                    error:function(xhr, ajaxOptions, thrownError){
                        console.log(xhr);
                    }
            
                });

            }
            getDatosUsuario();

            function getInvitaciones(){

                let data = {
                    "function": "getInvitaciones"
                };

                $.ajax({
                    url: 'models/funciones.php',
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    success: function(resp) {
                        
                        if(resp.status == 1){
            
                           $('#badgeInv').html(resp.total);
            
                        }
                    },
                    error:function(xhr, ajaxOptions, thrownError){
                        console.log(xhr);
                    }
            
                });
            }
            getInvitaciones();


            function getNotificaciones(){

                let data = {
                    "function": "getNotificaciones"
                };

                $.ajax({
                    url: 'models/funciones.php',
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    success: function(resp) {

                        if(resp.status == 1){
                            let notif = `
                            <div style="width: 100% !important; padding: 4px; background-color: #EF6C00; border-radius: 5px 5px 0 0;" >
                                <center><img style="opacity: 0.5; width: 30px; height: 30px;" src="../img/logoow.png"/></center>
                                <p style="margin-bottom: 0; text-align: center; color: #f7f7f7; font-weight: 800; font-size: 12px; ">${resp.data[0].titulo}</p>
                                <i data-id="${resp.data[0].id}" style="position: absolute; right: -15px; top: 5px; color: #f7f7f7;" class="fas fa-times btnCerrarNotif"></i>
                            </div>
                            <p style="border-radius: 0 0 8px 8px; color: #263238; text-align: center; margin-bottom: 0; font-weight: 600; font-family: 'Delius' font-size: 12px; background-image: url('/img/back_calendario.jpg'); background-repeat: no-repeat; background-size: cover;  background-position: center center;">${resp.data[0].mensaje}</p>
                            `;
                            $('.notificacion').append(notif);
                        }
                        
                       
                    },
                    error:function(xhr, ajaxOptions, thrownError){
                        console.log(xhr);
                    }
            
                });

            }
            getNotificaciones();


            $('.notificacion').animate({ marginTop: '120px', opacity: 'toggle' }, 500);

            $('body').off('click', '.btnCerrarNotif').on('click', '.btnCerrarNotif', function(){

                let id = $(this).data("id");

                let data = {
                    "id": id,
                    "function": "eliminarNotif"
                };

                $.ajax({
                    url: 'models/funciones.php',
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    success: function(resp) {                       
                    },
                    error:function(xhr, ajaxOptions, thrownError){
                        console.log(xhr);
                    }
            
                });


                
                $(this).parent().parent().parent().fadeOut();
            });
            

        </script>
</body>




</html>
            