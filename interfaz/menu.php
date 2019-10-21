<?php require_once "links.php" ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">

    </head>

    <body style="background-color:#DDD8D8;">


        <nav class="navbar navbar-expand-sm bg-info navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="#"></a>




            <!-- Links -->
            <ul class="navbar-nav">

                <li class="nav-item">

                    <a class="nav-link"  href="http://localhost/Tecnologico/interfaz/admin.php">Inicio</a>
                </li>



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Administrar Productos
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"  href="http://localhost/Tecnologico/interfaz/categorias.php"><p style="color:blue;">Categorias</p></a>
                        <a class="dropdown-item" href="http://localhost/tecnologico/interfaz/entrada.php"><p style="color:blue;">entrada</p></a>

                </li>

                </div>

                </div>             



                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/tecnologico/interfaz/salidasBe.php">Salidas De productos</a>
                </li>

                </div>



                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/tecnologico/interfaz/stock.php">Stock de berries</a>
                </li>

                </div>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Desecho
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"  href="http://localhost/tecnologico/interfaz/desecho.php"><p style="color:blue;">Entrada Desecho</p></a>
                        <a class="dropdown-item" href="http://localhost/tecnologico/interfaz/saldodesecho.php"><p style="color:blue;">Saldo</p></a>
                        <?php
                        if ($_SESSION['usuario'] == "admin"):
                            ?>
                            <a class="dropdown-item" href="http://localhost/tecnologico/interfaz/clamshell.php"><p style="color:blue;">Clamshell</p></a>
                            <?php
                        endif;
                        ?>
                </li>
                </div>

                <?php
                if ($_SESSION['usuario'] == "admin"):
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/tecnologico/interfaz/berries.php">Alta de productos</a>
                    </li>
                    <?php
                endif;
                ?>
                </div>
                <li class="nav-item">

                    <a class="nav-link"  href="http://localhost/Tecnologico/interfaz/clientes.php">clientes</a>
                </li>


                </div>          






                <?php
                if ($_SESSION['usuario'] == "admin"):
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="Usuarios.php">Administrar Usuarios</a>
                    </li>

                    <?php
                endif;
                ?>

                <li class="nav-item dropdown" >
                    <a class="nav-link dropdown-toggle" href="" id="navbardrop" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Usuario: <?php echo $_SESSION['usuario']; ?>  </a>
                    <ul class="dropdown-menu">
                        <li> <a   href="../procesamiento/salir.php"><p style="color:red;">Cerrar sesion</p></a></li>
                        </a>
                    </ul>
                </li>  


            </ul>


        </nav>
        <br>


    </body>

</html>
