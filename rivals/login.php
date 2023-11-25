<?php
session_start();
if (isset($_SESSION["rivals"])) {
    header("location: index.php");
}

/*// Funcion para reedireccionar cualquier pagina con https://
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}*/
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="assets/images/icon.png">

    <title>OW Rivals</title>

    <style>

    div:where(.swal2-container) div:where(.swal2-popup){
        background-image: url('../img/fondo9.jpg') !important; background-repeat: no-repeat; background-size: cover;  background-position: center !important;   
    }

        body{
            overflow: hidden;
        }
        

        .login {
            position: fixed;
            right: 12%;
            top: 17%;
            width: 350px
        }

        * {
            box-sizing: border-box;
        }

        .input-container {
            display: -ms-flexbox;
            /* IE10 */
            display: flex;
            width: 100%;
            margin-bottom: 15px;
        }

        .icon {
            padding: 10px;
            background: dodgerblue;
            color: white;
            min-width: 50px;
            text-align: center;
        }

        .input-field {
            width: 100%;
            padding: 5px;
            outline: none;
        }

        .input-field:focus {
            border: 2px solid dodgerblue;
        }

        /* Set a style for the submit button */
        .boton {
            background: dodgerblue;
            color: white;
            padding: 5px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }
    </style>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <video autoplay muted loop id="bg-video">
          <source src="assets/images/login.mp4" type="video/mp4" />
    </video>

    <div class="login">
        <center><a href="../index.html"><img width="330px" height="240px" src="assets/images/rivals2.png"></a></center><br>
        <form name="form_login" id="form_login">
            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="Usuario" id="usuario" required>
            </div>
            <div class="input-container">
                <i class="fa fa-key icon"></i>
                <input class="input-field" type="password" placeholder="Contraseña" id="pass" required>
            </div>
           <center> <button id="btnLogin" type="button" class="btn btn-primary">Iniciar sesión</button></center><br>
        </form>
        <!--<a href="#resetPass" data-toggle="modal" class="btn-link" id="forgotPass"><center>¿Olvidaste tu Contraseña?</center></a>-->
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="resetPass">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reestablecimiento de Contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <div class="alert alert-info">
                                Por favor ingresa tu nombre de usuario, para reestablecer tu contraseña
                            </div>
                        </div>
                    </div>

                    <form action="" method="get" accept-charset="utf-8" name="recuperar_pass" id="recuperar_pass">

                        <div class="form row">

                            <div class="col">
                                <label>Nombre de usuario</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"> <i class="fa fa-user"></i> </div>
                                    </div>
                                    <input type="search" name="username" placeholder="ingresa tu nombre de usuario"
                                        class="form-control" required>
                                </div>
                            </div>

                        </div>

                        <div class="row justify-content-center">
                            <div class="col-auto">
                            </div>
                        </div>

                    </form>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"> <i class="fa fa-wrench"></i> Recuperar
                                </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="verificarToken">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reestablecimiento de Contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <div class="alert alert-info">
                                Por favor ingresa el token enviado a tu correo a 10 dígitos
                            </div>
                        </div>
                    </div>

                    <form action="" method="get" accept-charset="utf-8" name="checkToken" id="checkToken">

                        <div class="form row">

                            <div class="col">
                                <label>Token</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"> <i class="fa fa-user-secret"></i> </div>
                                    </div>
                                    <input type="password" name="token" placeholder="token recibido"
                                        class="form-control" required>
                                </div>
                            </div>

                        </div>

                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-wrench"></i> Recuperar
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="reestablecer">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reestablecimiento de Contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <div class="alert alert-info">
                                Ingresa la nueva contraseña
                            </div>
                        </div>
                    </div>

                    <form action="" method="get" accept-charset="utf-8" name="reestablecerPass" id="reestablecerPass">

                        <div class="form row">

                            <input type="hidden" name="username">
                            <input type="hidden" name="validar">

                            <div class="col-6">
                                <label>Contraseña</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"> <i class="fa fa-lock"></i> </div>
                                    </div>
                                    <input type="password" name="password" minlength="8"
                                        placeholder="contraseña del usuario" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <label>Repetir Contraseña</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"> <i class="fa fa-lock"></i> </div>
                                    </div>
                                    <input type="password" name="password_repeat" minlength="8"
                                        placeholder="repetir contraseña" class="form-control" required>
                                </div>
                            </div>

                        </div>

                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-cog"></i> Reestablecer
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>
</body>

<!-- Page level plugins -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
</script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const loginForm = document.getElementById('form_login');

    var checkLogin = function (ev) {
        // console.log(ev);
        ev.preventDefault();
        //grecaptcha.execute();
    };

    $('#btnLogin').on('click', function(){

        console.log("CLICK");

        let usuario = $('#usuario').val();
        let pass = $('#pass').val();

        let datos = {
            "usuario": usuario,
            "pass": pass,
            "function": "login"
        };

        showCargandoDialog();


        $.ajax({
            url: 'models/checkLogin.php',
            type: 'POST',
            dataType: 'JSON',
            data: datos,
            
        }).done(response => {
            let timerInterval;
            if (response.status == 1) {
                Swal.fire({
                    html: `
                        <img width="120" height="120" src="../img/logo-rivals.png"></img>
                        <h1 style="margin-top: 20px; text-shadow: .1em .1em 0 hsl(200 50% 30%); color: hsl(200 50% 90%); font-size: 24px; font-weight: 900; line-height: 1.1;  font-family: 'Fugaz One', cursive;">${response.msg}</h1>
                    `,
                    timer: 3000,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    },
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    location.reload();
                });
            } else {

                showMessage(response.msg);
            }
        }).fail((err, text, thr) => {

            showMessage("Hubo un problema al conectar con el servidor");
            console.log(err, text, thr);
        });

    });

    function showMessage(msg){
        Swal.fire({
            html:`
                <img width="120" height="120" src="../img/logo-rivals.png"></img>
                <h1 style="margin-top: 20px; text-shadow: .1em .1em 0 hsl(200 50% 30%); color: hsl(200 50% 90%); font-size: 24px; font-weight: 900; line-height: 1.1;  font-family: 'Ow', cursive;">${msg}</h1>

                <button style="font-size: 20px;" width="100" type="button" class="btn btn-outline-light mt-5 btnCloseMsg">Aceptar</button>
                
            `,
            showCloseButton: false,
            showCancelButton: false,
            showConfirmButton: false,
            focusConfirm: false
           
        });
    }

    $('body').on('click', '.btnCloseMsg', function(){
        Swal.close();
    });
   

    function showCargandoDialog(){
        Swal.fire({
            title: "Cargando",
            html: `
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <img src="img/cargando.gif" class="img-responsive" width="250" height="250" >
                    </div>
                </div>
                </div>

            `,
            showConfirmButton: false,
            allowOutsideClick: false
        });
    }
</script>

</html>