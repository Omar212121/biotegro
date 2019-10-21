<?php
require_once "../../clases/Conexion.php";
$c= new conectar();
$conexion=$c->conexion();
$sql="     SELECT code_bgr, nombre, descripcion, saldo, PrecioUnidad, id_empaque FROM empaque";
$result= mysqli_query($conexion,$sql);
?>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
        <caption></caption>
        <tr>
            <td>Codigo del producto</td>
            <td>Nombre</td>
            <td>Descripcion</td>
            <td>Saldo</td>
            <td>Precio por unidad</td>
            <td>Editar</td>
            <td>Eliminar</td>

        </tr>
        <?php while ($ver=mysqli_fetch_row($result)): ?>
            <tr>
                <td><?php echo $ver[0];  ?></td>
                <td><?php echo $ver[1];  ?></td>
                <td><?php echo $ver[2];  ?></td>
                <td><?php echo $ver[3];  ?></td>
                <td><?php echo $ver[4];  ?></td>


                <td>
                    <span data-toggle="modal" data-target="#ModalUpdate" class="btn btn-warning btn-xs" onclick="agregaDatosClamshell('<?php echo $ver[5] ?>')">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </span>
                </td>
                <td>


                    <span class="btn btn-danger btn-xs" onclick="eliminaClamshell('<?php echo $ver[5] ?>')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </span>


                </td>

            </tr>
            <?php endwhile; ?>
    </table>
</div>