<?php

require_once "../../clases/Conexion.php";
$c=new conectar();
$conexion=$c->conexion();
$sql= "SELECT  id_usuario, nombre, apellido, email FROM usuarios";
$result=mysqli_query($conexion,$sql);

?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
    <caption><label></label></caption>
    <tr>
    <td>Nombre</td>
    <td>Apellido</td>
    <td>Usuario</td>
    
    <td>Eliminar</td>
    </tr>
    <?php
    while($ver=mysqli_fetch_row($result)):
    ?>
    
    <tr>
        <td><?php echo $ver[1]; ?></td>
        <td><?php echo $ver[2]; ?></td>
        <td><?php echo $ver[3];?></td>
        <td>
            <span class="btn btn-danger btn-sm" onclick="eliminaUsuario('<?php echo $ver[0]; ?>')">
                <span class="glyphicon glyphicon-remove"></span>
            </span>
        </td>
    </tr>
 <?php endwhile;?>
</table>