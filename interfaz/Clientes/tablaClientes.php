<?php
require_once "../../clases/Conexion.php";

$obj = new conectar();
$conexion = $obj->conexion();
$sql = "SELECT id_cliente, nombre,email,telefono from clientes ";

$result = mysqli_query($conexion, $sql);
?>




<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
        <caption><label></label></caption>
        <thead style="background-color: #0c5460 ;color: white; font-weight: bold;">

            <tr>
                <td>Nombre</td>
                <td>Email</td>
                <td>Telefono</td>
                <td>Eliminar</td>
            </tr>
        </thead>
            <?php while ($ver = mysqli_fetch_row($result)): ?>
                <tr>
                    <td><?php echo $ver[1]; ?></td>
                    <td><?php echo $ver[2]; ?></td>
                    <td><?php echo $ver[3]; ?></td>
                    <td>
                        <span class="btn btn-danger btn-sm" onclick="eliminarCliente('<?php echo $ver[0]; ?>')">
                            <span class="glyphicon glyphicon-remove"></span>
                        </span>
                    </td>

                </tr>

            <?php endwhile; ?>
    </table>


</div>