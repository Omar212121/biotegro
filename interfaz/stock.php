<?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>

    <?php
    require_once "menu.php";
    require_once "../clases/Conexion.php";
    $c = new conectar();
    $conexion = $c->conexion();
    $sql = "
                   select nombre,
                   descripcion,
                   presentacion,
                   capacidad,
                   code_brg,
                   stock, 
Stockp,
(stock * capacidad)+ stockp as total
from berries";

    $result = mysqli_query($conexion, $sql);
    ?>
    <html>
        <div class="table-responsive">
            <div class="input-group">
                <span style="border: 2px solid DodgerBlue;" class="input-group-addon">Buscar</span>
                <input id="filtrar" type="text" class="form-control" placeholder="Escribe el producto que deseas buscar...">
            </div>
            <p></p>
            <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
                <caption></caption>
                <thead style="background-color: #0c5460;color: white; font-weight: bold;">

                    <tr>
                        <td>Codigo del producto</td>

                        <td>Nombre</td>

                        <td>Descripcion</td>

                        <td>presentacion</td>

                        <td>capacidad</td>

                        <td>Saldo (cajas)</td>

                        <td>piezas </td>

                        <td>Total piezas</td>

                        <td>Editar</td>

                        <td>eliminar</td>
                </thead>
                </tr>
                <tfoot style="background-color: #0c5460;color: white; font-weight: bold;">

                <td>Codigo del producto</td>

                <td>Nombre</td>

                <td>Descripcion</td>

                <td>presentacion</td>

                <td>capacidad</td>

                <td>Saldo (cajas)</td>

                <td>piezas</td>

                <td>Total piezas</td>

                <td>Editar</td>

                <td>eliminar</td>
                </tr>

                </tfoot>
                <?php while ($ver = mysqli_fetch_row($result)): ?>
                    <tbody class="buscar">
                        <tr>
                            <td><?php echo $ver[4]; ?></td>

                            <td><?php echo $ver[0]; ?></td>

                            <td><?php echo $ver[1]; ?></td>

                            <td><?php echo $ver[2]; ?></td>

                            <td><?php echo $ver[3]; ?></td>

                            <td><?php echo $ver[5]; ?></td>

                            <td><?php echo $ver[6]; ?></td>


                            <td><?php echo $ver[7]; ?></td>


                            <td>
                                <span class="btn btn-warning btn-xs" >
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </span>
                            </td>
                            <td>
                                <span class="btn btn-danger btn-xs" >
                                    <span class="glyphicon glyphicon-remove"></span>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                <?php endwhile; ?>
            </table>
            <?php
            require_once "../clases/Conexion.php";

            $c = new conectar();
            $conexion = $c->conexion();
            $sql = "  select nombre, stock from berries ";
            $result = mysqli_query($conexion, $sql);
            ?>
            <head>
                <script type="text/javascript" src="loader.js"></script>
                <script type="text/javascript">
                    google.charts.load('current', {'packages': ['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['berries', 'stock'],
    <?php
    while ($filas = $result->fetch_assoc()) {
        echo" ['" . $filas["nombre"] . "'," . $filas["stock"] . "],";
    }
//['nombre', 'stock'],
    ?>
                        ]);

                        var options = {
                            title: 'Saldo berries',
                            pieHole: 0.4,
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));

                        chart.draw(data, options);
                    }
                </script>
            </head>
            <body>
    <div id="donutchart" style="width: 500px; height: 300px;"></div>

            </body>


    </html>       


    <script type="text/javascript">

        $(document).ready(function () {

            (function ($) {

                $('#filtrar').keyup(function () {

                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();

                })

            }(jQuery));

        });
    </script>
    
    
    
    
    
    <?php
} else {
    header("location:../index.php");
}
?>