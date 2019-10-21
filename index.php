<?php
require_once "clases/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

$sql = "SELECT * from usuarios where email='admin'";

$result = mysqli_query($conexion, $sql);
$validar = 0;
if (mysqli_num_rows($result) > 0) {
    $validar = 1;
}
?>




<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
        <script src="librerias/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">

        <script src="js/validar.js"></script>

    </head>
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}

        .input-container {
            display: -ms-flexbox; /* IE10 */
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
            padding: 10px;
            outline: none;
        }

        .input-field:focus {
            border: 2px solid dodgerblue;
        }

        /* Set a style for the submit button */
        .btn {
            background-color: dodgerblue;
            color: white;
            padding: 15px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .btn:hover {
            opacity: 1;
        }
    </style>
    <body background= "img/fonfo.jpg">
        <br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="panel panel-primary">
                        <div class="panel panel-heading">Biotegro</div>
                        <div class="panel-body">
                            <p>
                            <center>
                                <img src="img/biotegro.png" height="150px"
                            </center>
                            </p>
                            <form id="frmLogin">


                                <div class="input-container">
                                    <i class="fa fa-user icon"></i>
                                    <input  id="usuario" class="input-field" type="text" placeholder="Username"  name="usuario" >
                                </div>


                                <p></p>
                                <div class="input-container">
                                    <i class="fa fa-key icon"></i>
                                    <input class="input-field" id="password" type="password" placeholder="Password" name="password">
                                </div>
                                <p></p>

                                <input type="checkbox" onclick="myFunction()">Mostrar Contraseña

                                <p></p>
                                <span class="btn btn-primary btn-sm"id="entrarSistema">Entrar</span>
                                <?php if (!$validar): ?>
                                    <a href="registro.php" class="btn btn-primary btn-sm">Registrar</a>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
                </body>

                </html>

                <script>
                    function myFunction() {
                        var x = document.getElementById("password");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                </script>


                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#entrarSistema').click(function () {

                            vacios = validarFormVacio('frmLogin');

                            if (vacios > 0) {
                                alert("Debes llenar todos los ampos");
                                return false;
                            }



                            datos = $('#frmLogin').serialize();
                            $.ajax({
                                type: "POST",
                                data: datos,
                                url: "procesamiento/proLogin/login.php",
                                success: function (r) {
                                    if (r == 1) {
                                        window.location = "interfaz/admin.php"
                                    } else {
                                        alert("no se puede acceer");
                                    }

                                }
                            });
                        });

                    });
                </script>






