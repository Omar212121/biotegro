<?php
require_once "../../clases/Conexion.php";
$c = new conectar();
$conexion = $c->conexion();

$sql = "SELECT nombre, descripcion,presentacion,capacidad,code_brg, stock, Stockp, id_berrie from berries";

$result = mysqli_query($conexion, $sql);
?>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" style="text-align: center;">

        <caption><label></label></caption>
        <thead class="thead-dark">
            <tr>
                <th>code_bgr</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Presentacion</th>
                <th>Capacidad</th>
                <th>saldo</th>
                <th>Piezas sueltas</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            <?php
            while ($ver = mysqli_fetch_row($result)):
                ?>

                <tr>
                    <td><?php echo $ver[4]; ?></td>
                    <td><?php echo $ver[0]; ?></td>
                    <td><?php echo $ver[1]; ?></td>
                    <td><?php echo $ver[2]; ?></td>
                    <td><?php echo $ver[3]; ?></td>
                    <td><?php echo $ver[5]; ?></td>
                    <td><?php echo $ver[6]; ?></td>
                    <td>
                        <span data-toggle="modal" data-target="#updateberries" class="btn btn-warning btn-xs" onclick="obtenDatosBerries('<?php echo $ver[7] ?>')">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </span>
                    </td>
                    <td>
                        <span class="btn btn-danger btn-xs" onclick="eliminaBerrie('<?php echo $ver[7] ?>')">
                            <span class="glyphicon glyphicon-remove"></span>
                        </span>
                    </td>
                </tr>
            <?php endwhile; ?>

        </thead>
    </table>
</div>
