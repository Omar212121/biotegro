<?php
require_once "../../clases/Conexion.php";
$c = new conectar();
$conexion = $c->conexion();
$sql = "SELECT des.piezas,
    des.code_bgr,
    des.fechaCaptura,
    emp.nombre,
    emp.descripcion,
    emp.PrecioUnidad,
    (des.piezas * emp.PrecioUnidad) as Total,
    des.id_desecho
        FROM desecho as des inner join empaque as emp
        on des.id_empaque = emp.id_empaque";
$result = mysqli_query($conexion, $sql);
?>
<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
        <caption></caption>
        <tr>
            <td>Codigo del producto</td>
            <td>Nombre</td>
            <td>Descripcion</td>
            <td>Piezas</td>
            <td>Precio</td>
            <td>Perdida Total $</td>

            <td>Fecha de Ingreso</td>
            <td>Editar</td>
            <td>Eliminar</td>

        </tr>
        <?php while ($ver = mysqli_fetch_row($result)): ?>
            <tr>
                <td><?php echo $ver[1]; ?></td>
                <td><?php echo $ver[3]; ?></td>
                <td><?php echo $ver[4]; ?></td>
                <td><?php echo $ver[0]; ?></td>
                <td><?php echo $ver[5]; ?></td>
                <td><?php echo $ver[6]; ?></td>
                                <td><?php echo $ver[2]; ?></td>

                <td>
                    <span data-toggle="modal" data-target="#modalUpdate" class="btn btn-warning btn-xs" onclick="agregaDatosDesecho('<?php echo $ver[7] ?>')">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </span>
                </td>
                <td>


                    <span class="btn btn-danger btn-xs" onclick="eliminarDesecho('<?php echo $ver[7] ?>')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </span>


                </td>

            </tr>
        <?php endwhile; ?>
    </table>
</div>