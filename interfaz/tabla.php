<?php
require_once "../clases/Conexion.php";
$c=new conectar();
$conexion=$c->conexion();

$sql="SELECT id_berrie, nombre,Descripcion, presentacion, capacidad from berries";

$result= mysqli_query($conexion,$sql);

?>


<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered"  id="iddatatabla">

        <caption><label></label></caption>
        <thead style="background-color: #040505;color: white; font-weight: bold;">
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Caja</th>
                <th>Capacidad</th>
                <th>Eliminar</th>
            </tr>
                    </thead>
        <tfoot style="background-color: #0c5460;color: white; font-weight: bold;">
         <th>Nombre</th>
                <th>Descripcion</th>
                <th>Caja</th>
                <th>Capacidad</th>
                <th>Eliminar</th>
                        </tfoot>

            <?php
            while ($ver=mysqli_fetch_row($result)):
                ?>
                   <tbody>

            <tr>
                <td><?php echo $ver[1] ?></td>
                <td><?php echo $ver[2]; ?></td>
                <td><?php echo $ver[3]; ?></td>
                <td><?php echo $ver[4]; ?></td>


                <td>
                    <span class="btn btn-danger btn-xs" onclick="eliminaBerries('<?php echo $ver[0] ?>')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </span>
                </td>
            </tr>
                    </tbody>

            <?php endwhile; ?>

    </table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#iddatatabla').DataTable()();
} );
</script>